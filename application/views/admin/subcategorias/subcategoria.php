<?php $id = isset($categoria->id)?$categoria->id:''; ?>
<div class="widget-box">
    <div class="widget-title">
        <span class="icon"><i class="icon-th-list"></i></span>
        <h5><?=$title?></h5>
    </div>
    <div class="widget-content">
        <div class="row-fluid">
            <form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/subcategorias/subcategoria_form/'.$id)?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Categoría padre</label>
                    <div class="controls">
                        <select name="parent_id">
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($subcategorias as $k => $s): ?>
                                <option value="<?=$s->id?>" <?=($s->id == $parent_id)?'selected':''?>><?=$s->nombre?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombre" value="<?=isset($categoria->id)?$categoria->nombre:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Descripción</label>
                    <div class="controls">
                        <textarea name="descripcion" rows="4"><?=isset($categoria->id)?$categoria->descripcion:''?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Público</label>
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" value='1' name="public" <?=isset($categoria->id)?($categoria->public)?'checked':'':'checked'?>> 
                        </label>
                    </div>
                </div>
                <?php if(isset($categoria->id)):?>
                    <?php if(!count($categoria->getSubCategoriasPublicadas())):?>
                    <div class="control-group">
                        <label class="control-label">Estado</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox" value='1' name="estado" <?=isset($categoria->id)?($categoria->estado)?'checked':'':''?>> <em> habilitado para cargar productos <i class=" icon-info-sign"></i></em>
                            </label>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endif;?>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button type="button" class="btn" onclick="history.back()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>