<?php include 'app/components/header.php'; ?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>



<!-- start content -->
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">
            <!-- <i class="bx bx-cog me-1"></i>  -->
            Configuraci&oacute;n de Cuenta</h1>
    </div>

    <form id="editAdmin" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <input type="hidden" value="<?= $adminObj->id ?>" name="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?= $adminObj->nombre ?>" name="nombre" placeholder="name@example.com">
                    <label for="floatingInput">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" value="<?= $adminObj->pass ?>" name="pass" placeholder="name@example.com">
                    <label for="floatingInput">Contraseña</label>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?= $adminObj->usuario ?>" name="usuario" placeholder="name@example.com">
                    <label for="floatingInput">Apellidos</label>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-warning" type="submit">Editar Datos</button>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>

<script src="assets/js/general/settings-admin.js"></script>