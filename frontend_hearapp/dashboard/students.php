<?php include 'app/components/header.php';
$campusAll = General::getCampusAll();

?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>



<!-- start content -->
<!-- start content -->
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">
            <!-- <i class="bx bx-library me-1"></i>  -->
            Listado de Estudiantes</h1>
        <div class="d-flex gap-1">
            <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
        </div>
    </div>
    <!-- Modal Agregar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addStudents" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Docente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombres" placeholder="name@example.com" name="nombres" required>
                                <label for="floatingInput">Nombre Completo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="codigo" placeholder="name@example.com" name="codigo" required>
                                <label for="floatingInput">Codigo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="celular" placeholder="name@example.com" name="celular" required>
                                <label for="floatingInput">Celular</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="sexo" name="sexo" required>
                                    <option selected="">Seleccionar una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <label for="floatingSelect">Sexo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="estado_civil" name="estado_civil" required>
                                    <option selected="">Seleccionar una opción</option>
                                    <option value="SOLTERO">Soltero</option>
                                    <option value="CASADO">Casado</option>
                                    <option value="DIVORCIADO">Divorciado</option>
                                    <option value="VIUDO">Viudo</option>
                                </select>
                                <label for="floatingSelect">Estado Civil</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="campus_id" name="campus_id" required>
                                    <option value="" selected>Seleccionar una opción</option>
                                    <?php foreach ($campusAll as $result) : ?>
                                        <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingSelect">Sedes</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="correo_institucional" placeholder="name@example.com" name="correo_institucional" required>
                                <label for="floatingInput">Correo Institucional</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="corre_personal" placeholder="name@example.com" name="corre_personal" required>
                                <label for="floatingInput">Correo Personal</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="pass" placeholder="name@example.com" name="pass" required>
                                <label for="floatingInput">Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class='bx bx-save me-1'></i>Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editTeacher" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Estudiante</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <input type="hidden" id="id" name="id">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombres" placeholder="name@example.com" name="nombres" required>
                                    <label for="floatingInput">Nombre Completo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="codigo" placeholder="name@example.com" name="codigo" required>
                                    <label for="floatingInput">Codigo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="celular" placeholder="name@example.com" name="celular" required>
                                    <label for="floatingInput">Celular</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="sexo" name="sexo" required>
                                        <option selected="">Seleccionar una opción</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    <label for="floatingSelect">Sexo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="estado_civil" name="estado_civil" required>
                                        <option selected="">Seleccionar una opción</option>
                                        <option value="SOLTERO">Soltero</option>
                                        <option value="CASADO">Casado</option>
                                        <option value="DIVORCIADO">Divorciado</option>
                                        <option value="VIUDO">Viudo</option>
                                    </select>
                                    <label for="floatingSelect">Estado Civil</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select selectProduct" id="campus_id" name="campus_id" required>
                                        <option value="" selected>Seleccionar una opción</option>
                                        <?php foreach ($campusAll as $result) : ?>
                                            <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Sedes</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="correo_institucional" placeholder="name@example.com" name="correo_institucional" required>
                                    <label for="floatingInput">Correo Institucional</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="corre_personal" placeholder="name@example.com" name="corre_personal" required>
                                    <label for="floatingInput">Correo Personal</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="pass" placeholder="name@example.com" name="pass" required>
                                    <label for="floatingInput">Contraseña</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" id="estado" name="estado" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                                <label for="floatingInput">Estado</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning"><i class='bx bx-save me-1'></i>Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 ">
            <div class="table-responsive table-light shadow small-table p-3">
                <table class="table p-lg-4" id="table-students">
                    <!-- Van haber las opciones : VER ECUACION, VER VOUCHER DE COMPRA, CAMBIO DE ESTADO A APROBADO O RECHAZADO -->
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">NOMBRE COMPLETO</th>
                            <th class="text-center" scope="col">CODIGO</th>
                            <th class="text-center" scope="col">SEXO</th>
                            <th class="text-center" scope="col">ESTADO CIVIL</th>
                            <th class="text-center" scope="col">CORREO INSTITUCIONAL</th>
                            <th class="text-center" scope="col">CORREO PERSONAL</th>
                            <th class="text-center" scope="col">SEDE</th>
                            <th class="text-center" scope="col">CELULAR</th>
                            <th class="text-center" scope="col">ESTADO</th>
                            <th class="text-center" scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>

<script src="assets/js/general/get-students.js"></script>
<script src="assets/js/general/add-students.js"></script>
<script src="assets/js/general/edit-teacher.js"></script>