<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">
        Coloca tu nuevo password
    </p>
    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <?php
    if ($token_valido) {
    ?>
        <form class="formulario" method="POST" action="">
            <div class="formulario__campo">
                <label class="formulario__label" for="password">Nuevo Password</label>
                <input type="password" class="formulario__input" placeholder="Un Nuevo password" id="password" name="password">
            </div>
            <input type="submit" class="formulario__submit" value="Guardar Password">
        </form>
    <?php
    }
    ?>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inciar session</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
    </div>


</main>