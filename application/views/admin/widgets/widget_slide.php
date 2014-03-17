<?php
$id = isset($widget->id)?$widget->id:'';
?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon-th-list"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/widgets/widget_slide_form/'.$id)?>">
                <div class="validacion"></div>

                <div class="control-group">
                    <label class="control-label">Producto</label>
                    <div class="controls">
                        <select class="selectpicker show-tick dropup" name="producto_id">
                            <option value="">Seleccione un producto</option>
                            <?php foreach ($productos as $k => $producto): ?>
                                <option value="<?=$producto->id?>" <?=(isset($widget->id))?($widget->producto_id == $producto->id)?'selected':'':'';?> ><?=$producto->nombre?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Habilitado</label>
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" value=1 name="habilitado" <?=isset($widget->id)?($widget->habilitado)?'checked':'':''?>>
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Descripción</label>
                    <div class="controls">
                        <textarea name="descripcion" id="descripcion" rows="4"><?=isset($widget->id)?$widget->descripcion:''?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Imagen</label>
                    <div class="controls">
                        <div id="uploader_slide"></div>
                        <div id="thumb_pic"></div>
                    </div>
                </div>
                <input type="hidden" name="imagen" value="<?=isset($widget->id)?$widget->imagen:''?>" />
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button type="button" class="btn" onclick="history.back()">Cancelar</button>
                </div>
            </form>
		</div>
	</div>
</div>