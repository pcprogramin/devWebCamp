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
    <?php
        if ($token_valido){
    ?>
       <a href="/login" class="acciones__enlace" style="text-align:center">Inciar session</a>
    <?php
        }
    ?>
    </div>

</main>