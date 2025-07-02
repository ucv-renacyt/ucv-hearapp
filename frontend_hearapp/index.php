<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard/assets/css/login.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="col-xl-3 col-md-10 p-5 div_card ms-xl-5 ms-md-0 ms-0">
                    <div class="col-12 d-flex justify-content-center mb-2">
                        <!-- <img src="dashboard/assets/img/logo_large.png" class="img-fluid" alt=""> -->
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-2">
                        <!-- <img src="dashboard/assets/img/logo_hearapp.png" style="width:80px;" alt=""> -->
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <h5 class="fw-bold">HEAR APP</h5>
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <h5 class="fw-bold">Bienvenido Administrador !</h5>
                    </div>
                    <form id="access" class="signin-form" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
                            <label for="floatingInput">Ingresar Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                            <label for="floatingPassword">Ingresar Contraseña</label>
                        </div>
                        <div>
                            <button class="btn btn_login w-100">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="dashboard/assets/js/admin/access.js"></script>
</body>

</html>