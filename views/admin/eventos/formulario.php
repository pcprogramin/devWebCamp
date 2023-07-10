<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre Evento</label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Evento" value="<?php echo $evento->nombre ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripcion Evento</label>
        <textarea name="descripcion" placeholder="Descripcion Evento" id="descripcion" cols="30" rows="10"></textarea>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categorias o Tipo de Eventos</label>
        <select class="formulario__select" id="categoria" name="categoria">
            <option value="">- Seleccionar -</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categorias o Tipo de Eventos</label>
        <select class="formulario__select" id="categoria" name="categoria">
            <option value="">- Seleccionar -</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Selecciona el día</label>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) {?>
                <div>
                    <label for="<?php strtolower($dia->nombre) ?>"><?php echo $dia->nombre ?></label>
                    <input
                        type="radio"
                        id="<?php strtolower($dia->nombre) ?>"
                        name="dia"
                        value="<?php $dia->id ?>"
                    >
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="horas" class="formulario__campo">
        <label for="" class="formulario__label">Seleccionar Hora</label>
        <ul class="horas">
            <?php 
                foreach ($horas as $hora) {
            ?>
                
                <li class="horas__hora"><?php echo $hora->hora ?> </li>
            <?php
                }
            ?>
        </ul>
    </div>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legen">Información Extra</legend>
    
</fieldset>