<?php
    // Asegurarte de que $args exista si la vista fue llamada con $response
    $args = $args ?? (object)($response ?? []);
    include_once LAYOUTS . 'main_head.php';
    setHeader($args);
?>
    <link rel="stylesheet" type="text/css" href="<?=CSS?>styles.css">
</head>
<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <h5 class="card-title">Inicio de sesión</h5>
            <hr>
            <?php if(isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['login_error'] ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            <?php if(isset($_SESSION['login_success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['login_success'] ?></div>
                <?php unset($_SESSION['login_success']); ?>
            <?php endif; ?>
            <form action="/Session/userAuth" method="post" id="login-form">
                <div class="form-group input-group">
                    <label for="email" class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </label>
                    <input type="email" class="form-control"
                            id="email"
                            name="email"
                            placeholder="Correo electrónico"
                            required>
                </div>
                <div class="form-group input-group mt-2">
                    <label for="password" class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </label>
                    <input type="password" class="form-control"
                            id="password"
                            name="password"
                            placeholder="Contraseña"
                            required>
                </div>
                <div class="d-grid gap-2 my-2">
                    <small class="form-text text-danger d-none" id="error">
                        Sus datos de inicio de sesión son incorrectos
                    </small>
                    <hr>
                    <button class="btn btn-primary mt-3" type="submit" name="login">
                        Iniciar sesión <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                    <a href="/VitalCare/app/public/?uri=Session/register" class="btn btn-link float-end">Registrarse</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    $args = $args ?? (object)($response ?? []);
    include_once LAYOUTS . 'main_foot.php';
    setFooter($args);
    closeFooter();
?>

<script>
    $(function(){
        const $lf = $("#login-form")
        $lf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData(this)
            fetch('/Session/userAuth', {
                method: 'POST',
                body: data
            })
            .then(resp => resp.json())
            .then(data => {
                if (data.r) {
                    window.location.href = '/'; // o la vista principal
                } else {
                    $("#error").removeClass('d-none');
                }
            }).catch(err => console.error(err))
        })
    })
</script>

<?php 
closeFooter();
?>