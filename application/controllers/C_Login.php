<?php
// --
class C_Login extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->check_session($this->segment->get('isActive'));
        $this->view->set_js('index');
        $this->view->set_view('default');
    }

    // --
    public function login() { 
        // ---
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (
                isset($input['user']) && 
                isset($input['password'])
            ) {
                // --
                $obj_login = $this->load_model('Login');
                $obj_menu = $this->load_model('Menu');
                // --
                $user = trim($input['user']);
                $password = $this->functions->encrypt_password($input['password']);
                // --
                $bind = array(
                    'user' => $user,
                    'password' => $password,
                    // 'status' => 1 
                );
                // --
                $cookieToken = $this->segment->get('tokenUser');
                $bind_token = array('token' => $cookieToken);
                $response_intent = $obj_login->user_attemepts($bind_token);
                // --
                $total_count = 0;
                // --
                if ($response_intent['status'] == 'OK') {
                    $total_count = intval($response_intent['result']['total_count']); 
                }
                // -- ingresar un validador de tiempo, máximo 10min
                // -- eliminar los token generados (como máximo en el 3er intento "cuando hace login")
                // -- timestamp en php time(); 594564564 (11:38)   ----- 94566565(12:00)  comparar los timestamp 
                // -- validar los 10 min, diferencia entre timestamp
                // --
                if ($total_count > 10) {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'msg' => 'Excedio el número de intentos, contacte con su administrador.'
                    ); 
                } else {
                    // --
                    $response = $obj_login->get_user($bind);
                    // --
                    switch ($response['status']) {
                        // --
                        case 'OK':
                            // --
                            $result_user = $response['result'][0]; // -- First
                            // --    
                            $bind_validate = array(
                                'id_user' => $result_user['id_user'],
                                'status' => 1
                            );
                            // --
                            $response_validate = $obj_login->validate_user($bind_validate);
                            // --

                            switch ($response_validate['status']) {
                                // --
                                case 'OK':
                                    // --
                                    $campus = array();
                                    // --
                                    foreach ($response['result'] as $item) {
                                    // --
                                        $campus[] = array('id' => $item['id_campus'], 'description' => $item['description_campus']);
                                    }
                                    // --
                                    $bind_menu = array('id_role' => $result_user['id_role']);
                                    $menu = $obj_menu->get_menu_by_role($bind_menu);
                                    // 
                                    $data = array(
                                        'id_user' => $result_user['id_user'],
                                        'id_role' => $result_user['id_role'],
                                        'id_document_type' => $result_user['id_document_type'],
                                        'document_number' => $result_user['document_number'],
                                        'first_name' => $result_user['first_name'],
                                        'last_name' => $result_user['last_name'],
                                        'role' => $result_user['description_role'],
                                        'campus' => $campus
                                    );
                                    // --
                                    $group_menu = array();
                                    // --
                                    foreach ($menu['result'] as $item) {
                                        $group_menu[$item['id_menu']][] = $item;
                                    }
                                    // --
                                    $menu = array();
                                    $index = 0;
                                    // --
                                    foreach ($group_menu as $item) {
                                        // --
                                        foreach ($item as $row) {
                                            // --
                                            $menu[$index]['id'] = $row['id_menu'];
                                            $menu[$index]['description'] = $row['description_menu'];
                                            $menu[$index]['icon'] = $row['icon_menu'];
                                            $menu[$index]['order'] = $row['order_menu'];
                                            // --
                                            $menu[$index]['sub_menu'][] = array(
                                                'id' => $row['id_sub_menu'],
                                                'description' => $row['description_sub_menu'],
                                                'icon' => $row['icon_sub_menu'],
                                                'url' => $row['url_sub_menu'],
                                                'order' => $row['order_sub_menu']
                                            );
                                        }
                                        // --
                                        $index++;
                                    }
                                    // --
                                    // $this->segment->set('isActive', true);
                                    $this->segment->set('data', $data);
                                    $this->segment->set('modules', $menu);
                                    $this->segment->set('isExist', true);
                                    // --
                                    $json = array(
                                        'status' => 'OK',
                                        'msg' => 'Bienvenido(a) ' . $result_user['first_name']
                                    );
                                    // --
                                    break;
                                case 'ERROR':
                                    // --
                                    $json = array(
                                        'status' => 'ERROR',
                                        'msg' => 'Cuenta desactivada, comuniquese con su administrador.'
                                    );
                                    // --
                                    break;
                
                                case 'EXCEPTION':
                                    // --
                                    $json = array(
                                        'status' => 'ERROR',
                                        'msg' => $response['result']->getMessage(),
                                    );
                                    // --
                                    break;
                                }
                            break;

                        case 'ERROR':
                            // --
                            $cookieToken = $this->segment->get('tokenUser');
                            $bind_attempts = array(); // -- Initialize
                            // --
                            if ($cookieToken == "" || $cookieToken == null) {
                                // --
                                $token = base64_encode(random_bytes(100));
                                $this->segment->set('tokenUser', $token);
                                // --
                                $bind_attempts = array('token' => $token);
                            } else {
                                // --
                                $bind_attempts = array('token' => $cookieToken);
                            }
                            // --
                            $obj_login->create_attempts($bind_attempts);
                            // --
                            $json = array(
                                'status' => 'ERROR',
                                'msg' => 'Credenciales de autenticación incorrectas.',
                            );
                            // --
                            break;

                        case 'EXCEPTION':
                            // --
                            $json = array(
                                'status' => 'ERROR',
                                'msg' => $response['result']->getMessage(),
                            );
                            // --
                            break;
                    }
                }

            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'msg' => 'Verificar parámetros.'
                ); 
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'msg' => 'Método no permitido.'
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function get_active() {
        // --
        $this->functions->validate_session($this->segment->get('isExist'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            $dataUser = $this->segment->get('data');
            // --
            if (
                !empty($input['id_location']) &&
                $dataUser["id_user"]
            ) {

                // -- Connection user view
                $id_user = $this->functions->clean_string($dataUser["id_user"]);
                // --
                $bind = array(
                    'id_user' => $id_user,
                    'connection' => 1
                );

                $obj_users = $this->load_model('Login');
                // --
                $response = $obj_users->user_connection($bind);


                // -- Location segment
                $id_location = $this->functions->clean_string($input['id_location']);
                
                $this->segment->set('isLocation', $id_location);
                $this->segment->set('isActive', true);

                $responseSegment = $this->segment->get('isActive');
                // --
                if ($responseSegment) {
                    
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Iniciando Sesión.',
                        // 'msg' => ,
                        'data' => array()
                    );
                    // --
                }else{
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'Error al iniciar sesión, intentelo de nuevo.',
                        'data' => array(),
                    );
                }

            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                    'data' => array()
                );
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
                'data' => array()
            );
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

}