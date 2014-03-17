<?php $id = isset($usuario->id)?$usuario->id:''; ?>
<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>

    <hr class="soft">
    <p>Haznos saber cualquier duda que tengas y nosotros te responderemos a la brevedad</p>
    <div class="row-fluid">
        <form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('paginas/contacto_form/') ?>">
            <div class="validacion"></div>
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input type="text" name="email" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                    <input type="text" name="nombre" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Mensaje</label>
                <div class="controls">
                    <textarea name="mensaje" id="mensaje" cols="50" rows="5" ></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button type="button" class="btn" onclick="history.back()">Cancelar</button>
            </div>
            <input type="hidden" name="redirect" value=true>
        </form>
    </div>
</div>
