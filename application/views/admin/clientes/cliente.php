<?php $id = isset($cliente->id)?$cliente->id:''; ?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/clientes/cliente_form/'.$id) ?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Rut</label>
                    <div class="controls">
                        <input type="text" name="rut" value="<?=isset($cliente->id)?$cliente->rut:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombre" value="<?=isset($cliente->id)?$cliente->nombre:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Giro</label>
                    <div class="controls">
                        <input type="text" name="giro" value="<?=isset($cliente->id)?$cliente->giro:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Contacto empresa</label>
                    <div class="controls">
                        <input type="text" name="contacto_empresa" value="<?=isset($cliente->id)?$cliente->contacto_empresa:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Contacto email</label>
                    <div class="controls">
                        <input type="text" name="contacto_email" value="<?=isset($cliente->id)?$cliente->contacto_email:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Contacto teléfono</label>
                    <div class="controls">
                        <input type="text" name="contacto_telefono" value="<?=isset($cliente->id)?$cliente->contacto_telefono:''?>">
                    </div>
                </div>



                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button type="button" class="btn" onclick="history.back()">Cancelar</button>
                </div>
            </form>
		</div>
	</div>
</div>