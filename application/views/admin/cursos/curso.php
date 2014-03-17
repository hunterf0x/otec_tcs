<?php $id = isset($curso->id)?$curso->id:''; ?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/cursos/curso_form/'.$id) ?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombre" value="<?=isset($curso->id)?$curso->nombre:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Codigo SENCE</label>
                    <div class="controls">
                        <input type="text" name="codigo_sence" value="<?=isset($curso->id)?$curso->codigo_sence:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Horas del curso</label>
                    <div class="controls">
                        <input type="text" name="horas_curso" value="<?=isset($curso->id)?$curso->horas_curso:''?>">
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