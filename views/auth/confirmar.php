<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">
        Tu cuenta de DevWebCamp
    </p>
    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>
       <div class="acciones">
       <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inciar session</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password? </a>
    </div>

</main>