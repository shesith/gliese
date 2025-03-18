<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Campus Starts -->
            <section id="carrier">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
                <!-- Header title -->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Lista de <?php echo strtolower($selected_sub_menu); ?></h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><?php echo $selected_menu; ?></a>
                                        </li>
                                        <li class="breadcrumb-item active"><span><?php echo $selected_sub_menu; ?></span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Header table-->

                <!-- Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table" id="datatable-carrier">
                                <thead>
                                    <tr>
                                        <th>Razon Social</th>
                                        <th>Encargado</th>
                                        <th>Documento</th>
                                        <th>Nº De Documento</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Table -->


                <!-- Create Carrier Modal -->
                <div class="modal fade" id="create_carrier_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pb-5">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Agregar nuevo proveedor</h1>
                                    <!-- <p data-i18n="Add new campus description">Permissions you may use and assign to your users.</p> -->
                                </div>
                                <form method="POST" enctype="multipart/form-data" id="create_carrier_form" class="row" onsubmit="return false">
                                    <div class="col-6">
                                        <label class="form-label">Razón Social</label>
                                        <input type="text" name="name" class="form-control" placeholder="Razón social" autofocus data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Encargado</label>
                                        <input type="text" name="manager" class="form-control" placeholder="Encargado" autofocus data-msg="" required />
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Tipo de documento</label>
                                            <select id="document_type" name="document_type" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Nº De Documento</label>
                                        <div class="input-group">
                                            <input type="number" id="document_number" name="document_number" class="form-control" placeholder="Nº De Documento" autofocus data-msg="" required />
                                            <button type="button" class="btn btn-primary btn_get_company_data">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="user@example.com" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Teléfono</label>
                                            <input type="phone" name="phone" class="form-control" placeholder="Teléfono" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Dirección</label>
                                            <input type="address" name="address" class="form-control" placeholder="Dirección" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Marca</label>
                                            <input type="brand" name="brand" class="form-control" placeholder="Marca" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Placa</label>
                                            <input type="plate" name="plate" class="form-control" placeholder="Placa" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Licencia de Conducir</label>
                                            <input type="drivers_license" name="drivers_license" class="form-control" placeholder="Licencia de Conducir" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button id="btn_create_carrier" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                            <span>Cancelar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Create Carrier Modal -->



                <!-- Update Carrier Modal -->
                <div class="modal fade" id="update_carrier_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pb-5">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Actualizar Proveedor</h1>
                                </div>
                                <form method="POST" enctype="multipart/form-data" id="update_carrier_form" class="row" onsubmit="return false">
                                    <div class="col-6">
                                        <label class="form-label">Razón Social</label>
                                        <input type="text" name="name" class="form-control" placeholder="Razón Social" autofocus data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Encargado</label>
                                        <input type="text" name="manager" class="form-control" placeholder="Encargado" autofocus data-msg="" required />
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Tipo de documento</label>
                                            <select name="document_type" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Nº De Documento</label>
                                        <input type="number" name="document_number" class="form-control" placeholder="Nº De Documento" autofocus data-msg="" required />
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="user@example.com" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Teléfono</label>
                                            <input type="phone" name="phone" class="form-control" placeholder="Teléfono" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Dirección</label>
                                            <input type="address" name="address" class="form-control" placeholder="Dirección" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Marca</label>
                                            <input type="brand" name="brand" class="form-control" placeholder="Marca" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Placa</label>
                                            <input type="plate" name="plate" class="form-control" placeholder="Placa" data-msg="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">Licencia de Conducir</label>
                                            <input type="drivers_license" name="drivers_license" class="form-control" placeholder="Licencia de Conducir" data-msg="" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_carrier">

                                    <div class="col-12 text-center">
                                        <button id="btn_update_carrier" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                            <span>Cancelar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Update Carrier Modal -->

            </section>
            <!-- Permissions ends -->
        </div>
    </div>
</div>
<!-- END: Content-->