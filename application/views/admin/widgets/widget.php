<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon-th-list"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/widgets/widget_form/'.$widget->id)?>">
                <div class="validacion"></div>

                <div class="control-group">
                    <label class="control-label">Producto</label>
                    <div class="controls">
                        <select class="selectpicker show-tick dropup" name="producto_id">
                            <option value="">Seleccione un producto</option>
                            <?php foreach ($productos as $k => $producto): ?>
                                <option value="<?=$producto->id?>" <?=($widget->producto_id == $producto->id)?'selected':''?> ><?=$producto->nombre?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Habilitado</label>
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" value='1' name="habilitado" <?=isset($widget->id)?($widget->habilitado)?'checked':'':'checked'?>>
                        </label>
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