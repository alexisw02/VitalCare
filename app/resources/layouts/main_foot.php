<?php
function setFooter($args){
    $ua = isset($args->ua) ? as_object($args->ua) : (object)[
        'sv' => false,
        'id' => null,
        'username' => '',
        'tipo' => ''
    ];
?>

    <script src="<?=JS?>jquery.js"></script>
    <script src="<?=JS?>bootstrap.js"></script>
    <script src="<?=JS?>sweetalert2.js"></script>
    <script src="<?=JS?>app.js"></script>
    <script src="<?=JS?>script.js"></script>

    <script>
        $(function(){
            app.user.sv = <?=$ua->sv?'true':'false'?>;
            app.user.id = "<?=$ua->id??''?>";
            app.user.username = "<?=$ua->username??''?>";
            app.user.tipo = "<?=$ua->tipo??''?>";
            
            // Manejo de mensajes de error/éxito
            <?php if(isset($_SESSION['login_error'])): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?=$_SESSION["login_error"]?>'
                });
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['login_success'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '<?=$_SESSION["login_success"]?>'
                });
                <?php unset($_SESSION['login_success']); ?>
            <?php endif; ?>
            
            // Toggle entre login/register (similar a tu script.js original)
            $('.register-btn').click(function(){
                $('.login-form').hide();
                $('.register-form').show();
            });
            
            $('.login-btn').click(function(){
                $('.register-form').hide();
                $('.login-form').show();
            });
        });
    </script>
<?php } 

function closeFooter() {?>
    </body>
    </html> 
<?php }