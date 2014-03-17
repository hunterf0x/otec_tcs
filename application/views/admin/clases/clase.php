<?php $id = isset($clase->id)?$clase->id:''; ?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/clases/clase_form/'.$id) ?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Codigo SENCE</label>
                    <div class="controls">
                        <input type="text" disabled name="codigo_sence" value="<?=isset($curso->id)?$curso->codigo_sence:''?>">
                    </div>
                </div>
                <div class="input-daterange " id="datepicker">
                    <label class="control-label">Fechas de inicio y fin</label>
                    <div class="controls">
                        <input type="text"  class="input-small" id="finicio"  name="start" value="" />
                        <span class="add-on">A</span>
                        <input type="text"  class="input-small ftermino" id="ftermino"  name="end" value="" />
                        <button type="button" id="cargar_dias" class="btn btn-primary" >Cargar días</button>
                    </div>
                </div>

                    <div class="control-group">
                        <label class="control-label"><h6>Dias del curso</h6></label>
                    </div>
                    <div id="seleccionSemanas"></div>
                    <div id="seleccionDias"></div>
                    <div class="control-group">
                        <label class="control-label">Observaciones</label>
                        <div class="controls">
                            <textarea id="observaciones"></textarea>
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