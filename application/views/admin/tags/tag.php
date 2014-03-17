<?php $id = isset($tag->id)?$tag->id:''; ?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title;?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/tags/tag_form/'.$id) ?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Etiqueta</label>
                    <div class="controls">
                        <input type="text" name="etiqueta" value="<?=isset($tag->id)?$tag->etiqueta:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Categoría</label>
                    <div class="controls">
                        <select class="selectpicker show-tick dropup" name="categoria_id">
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($categorias as $k => $c): ?>
                                <option value="<?=$c?>" <?= ($c == $tag->categoria) ? 'selected="selected"' : ''; ?>><?=$c?></option>
                            <?php endforeach; ?>
                        </select>
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