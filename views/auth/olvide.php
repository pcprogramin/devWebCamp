<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">
        Recupera tu acceso a DevWebCam
    </p>

    <form class="formulario">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input type="email" class="formulario__input" placeholder="Tu email" id="email">
        </div>
        <input type="submit" class="formulario__submit" value="Enviar Intrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inciar session</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
    </div>

</main>