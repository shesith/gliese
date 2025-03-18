<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Campus Starts -->
                <section id="supportmonthly_details">

                    <!-- Header title -->
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Agregar Supportmonthly</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Header table-->

                    <!-- Container for adding products -->
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="create_supportmonthly_details_form" class="row" onsubmit="return false">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div>
                                            <label class="form-label">Cliente</label>
                                            <select name="business_name" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    <label class="form-label">Fecha Emisión (*)</label>
                                    <input name="fecha_emision" type="date" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fecha Vencimiento (*)</label>
                                    <input name="fecha_vencimiento" type="date" class="form-control">
                                </div>


                                
                                <div class="row mb-3">
                                    <div class="col-12"><br>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_supportmonthly_product_modal">Agregar productos</button>
                                    </div>
                                </div>
                           
                                <!-- Table -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <table class="table" id="add_products">
                                                <thead>
                                                    <tr>
                                                        <th>Acciones</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio compra</th>
                                                        <th>%</th>
                                                        <th>Precio venta</th>
                                                        <th>Sub total</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Table -->

                                <div class="col-12">
                                    <button id="btn_update_guardar" type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='Supportmonthly/index.php'">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Container to add products -->

                    <!-- Create Supportmonthly Products Modal -->
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="modal fade" id="create_supportmonthly_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-product">
                                <!-- Contenido del modal -->
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-transparent pb-3">
                                            <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body px-sm-5 pb-5">
                                            <div class="text-center mb-2">
                                                <h1 class="mb-1">Selecionar Producto</h1>
                                            </div>
                                            <table class="table table-striped" id="datatables-supportmonthly-products">
                                                <thead>
                                                    <tr>
                                                        <th>Acción</th>
                                                        <th>Codigo</th>
                                                        <th>Categoría</th>
                                                        <th>Descripcion</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Create Supportmonthly Products Modal -->

                </section>   
                <!-- Permissions ends -->       
            </div>
        </div> 
    </div>
    <!-- END: Content-->