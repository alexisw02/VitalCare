<?php
// Verificar si el usuario está logueado usando la estructura de sesión correcta
$userSession = $_SESSION['user'] ?? null;
$isLoggedIn = isset($userSession) && $userSession['sv'] === true;
$userName = $isLoggedIn ? $userSession['username'] : '';
$userRole = $isLoggedIn ? $userSession['tipo'] : '';

// Configurar los argumentos para los layouts
$args = (object)[
    'title' => 'VitalCare',
    'ua' => $userSession ?? ['sv' => false],
    'styles' => '
        <style>
            body {
                background-color: #f8f9fa;
            }
            .navbar {
                background-color: #0d6efd;
            }
            .navbar-brand, .nav-link {
                color: #fff !important;
            }
            .btn-custom {
                background-color: #0d6efd;
                color: white;
            }
            .btn-custom:hover {
                background-color: #084298;
            }
            .dropdown-menu {
                min-width: 200px;
            }
            .user-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                margin-right: 8px;
                background-color: #fff;
                color: #0d6efd;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
            }
            .hero-section {
                background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            }
        </style>
    '
];

// Incluir el header usando la ruta correcta
require_once __DIR__ . '/../layouts/main_head.php';
setHeader($args);
?>
    <style>
        body {
        background-color: #f8f9fa;
        }
        .navbar {
        background-color: #0d6efd;
        }
        .navbar-brand, .nav-link {
        color: #fff !important;
        }
        .btn-custom {
        background-color: #0d6efd;
        color: white;
        }
        .btn-custom:hover {
        background-color: #084298;
        }
        .dropdown-menu {
        min-width: 200px;
        }
        .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 8px;
        background-color: #fff;
        color: #0d6efd;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">VitalCare</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="/Usuarios">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="/Citas">Citas</a></li>
            </ul>
            
            <ul class="navbar-nav">
                <?php if($isLoggedIn): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <span class="user-avatar"><?= strtoupper(substr($userName, 0, 1)) ?></span>
                            <?= htmlspecialchars($userName) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/Perfil"><i class="bi bi-person-circle me-2"></i>Mi perfil</a></li>
                            <?php if($userRole === 'administrador'): ?>
                                <li><a class="dropdown-item" href="/Admin"><i class="bi bi-gear me-2"></i>Administración</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/Session/logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/VitalCare/app/public/?uri=Session/iniSession"><i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/VitalCare/app/public/?uri=Session/register"><i class="bi bi-person-plus me-1"></i>Registrarse</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<section class="text-center text-white py-5 hero-section">
    <h1 class="display-4 fw-bold">Bienvenido a VitalCare</h1>
    <p class="lead">Gestión de pacientes, citas y servicios médicos en un solo lugar.</p>
    <?php if($isLoggedIn): ?>
        <a href="/Citas" class="btn btn-lg mt-3 text-white" style="background-color: #0dcaf0;">
            <?= ($userRole === 'paciente') ? 'Agendar Cita' : 'Ver Citas' ?>
        </a>
    <?php else: ?>
        <div class="d-flex justify-content-center gap-3">
            <a href="/VitalCare/app/public/?uri=Session/iniSession" class="btn btn-lg mt-3 text-white" style="background-color: #0dcaf0;">Iniciar sesión</a>
        </div>
    <?php endif; ?>
</section>

<section class="container text-center my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-badge fs-1 text-primary"></i>
                    <h5 class="card-title mt-3">Gestión de Doctores</h5>
                    <p>Administra horarios y datos médicos.</p>
                    <?php if($isLoggedIn && in_array($userRole, ['medico', 'administrador'])): ?>
                        <a href="/Doctores" class="btn btn-outline-primary">Administrar</a>
                    <?php else: ?>
                        <button class="btn btn-outline-primary" disabled>Inicia sesión</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people fs-1 text-success"></i>
                    <h5 class="card-title mt-3">Pacientes</h5>
                    <p>Controla expedientes.</p>
                    <?php if($isLoggedIn && in_array($userRole, ['medico', 'administrador'])): ?>
                        <a href="/Pacientes" class="btn btn-outline-success">Ver Pacientes</a>
                    <?php else: ?>
                        <button class="btn btn-outline-success" disabled>Requiere acceso</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="bi bi-calendar-check fs-1 text-danger"></i>
                    <h5 class="card-title mt-3">Citas Médicas</h5>
                    <p>Gestiona las citas médicas.</p>
                    <a href="<?= $isLoggedIn ? '/Citas' : '/Session/iniSession' ?>" class="btn btn-outline-danger">
                        <?= $isLoggedIn ? 'Ver Citas' : 'Inicia sesión' ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white text-center py-3">
    © <?= date('Y') ?> VitalCare. Todos los derechos reservados.
</footer>

<?php
    require_once __DIR__ . '/../layouts/main_foot.php';
    setFooter($args);
    closeFooter();
?>