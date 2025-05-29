<?php
$args = $args ?? (object)($response ?? []);
include_once LAYOUTS . 'main_head.php'; 
setHeader($args);
?>

    <link rel="stylesheet" type="text/css" href="<?=CSS?>styles.css">
</head>
<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <h5 class="card-title">Registro de usuario</h5>
            <hr>
            <?php if(isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['login_error'] ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            <form action="/Session/register" method="post" id="register-form">
                <div class="form-group input-group">
                    <label for="nombre" class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </label>
                    <input type="text" class="form-control"
                            id="nombre"
                            name="nombre"
                            placeholder="Nombre"
                            required>
                </div>
                
                <div class="form-group input-group mt-2">
                    <label for="apellidos" class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </label>
                    <input type="text" class="form-control"
                            id="apellidos"
                            name="apellidos"
                            placeholder="Apellidos"
                            required>
                </div>
                
                <div class="form-group input-group mt-2">
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
                
                <div class="form-group input-group mt-2">
                    <label for="telefono" class="input-group-text">
                        <i class="bi bi-telephone-fill"></i>
                    </label>
                    <input type="tel" class="form-control"
                            id="telefono"
                            name="telefono"
                            placeholder="Teléfono (opcional)">
                </div>
                
                <div class="form-group input-group mt-2">
                    <label for="sexo" class="input-group-text">
                        <i class="bi bi-gender-ambiguous"></i>
                    </label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                
                <div class="form-group input-group mt-2">
                    <label for="direccion" class="input-group-text">
                        <i class="bi bi-house-fill"></i>
                    </label>
                    <input type="text" class="form-control"
                            id="direccion"
                            name="direccion"
                            placeholder="Dirección (opcional)">
                </div>
                
                <div class="d-grid gap-2 my-2">
                    <hr>
                    <button class="btn btn-primary mt-3" type="submit" name="register">
                        Registrarme <i class="bi bi-person-plus-fill"></i>
                    </button>
                    <a href="/VitalCare/app/public/?uri=Session/iniSession" class="btn btn-link float-end">¿Ya tienes cuenta? Inicia sesión</a>
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
        const $rf = $("#register-form")
        $rf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData(this)
            fetch('/Session/register', {
                method: 'POST',
                body: data
            }).then(resp => {
                if(resp.redirected) {
                    window.location.href = resp.url;
                } else {
                    return resp.json().then(data => {
                        alert(data.error || "Error en el registro");
                    });
                }
            }).catch(err => console.error(err))
        })
    })
</script>

<?php 
closeFooter();
?>