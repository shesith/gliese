    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Campus Starts -->
                <section id="supporttechnical">

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
                                <table class="table" id="datatable-supporttechnical">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Fecha Ingreso</th>.
                                            <th>Nombre Cliente</th>            
                                            <th>Codigo Servicio</th>
                                            <th>Area de Servicio</th>
                                            <th>Estado Servicio</th>
                                            <th>Estado Pagado</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->
                    
                </section>
                <!-- Permissions ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->