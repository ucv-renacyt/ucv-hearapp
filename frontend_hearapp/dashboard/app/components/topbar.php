<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i><?= $adminObj->nombre ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" >
                        <li><a class="dropdown-item" href="account-settings"><i class='bx bx-cog' ></i> Configuraci&oacute;n</a></li>
                        <li><a class="dropdown-item" href="app/components/logout.php"><i class='bx bx-exit'></i> Cerrar Sesi&oacute;n</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>