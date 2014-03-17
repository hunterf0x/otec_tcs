<?php $id = isset($usuario->id)?$usuario->id:''; ?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-user"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
        <?php if($id): ?>
        <div class="row-fluid">
            <div class="thumbnail pull-left ">
                <img src="<?=isset($usuario->avatar)?$usuario->avatar:''?>"  alt="<?=isset($usuario->id)?$usuario->nombre:''?>">
            </div>
        </div>
        <?php endif; ?>
		<div class="row-fluid">
			<form method="POST" class="form-horizontal ajaxForm" action="<?= site_url('admin/usuarios/usuario_form/'.$id) ?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <input type="text" name="usuario" value="<?=isset($usuario->id)?$usuario->usuario:''?>">
                    </div>
                </div>
                <?php if(!isset($usuario->id)):?>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <input type="password" name="password" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Confirmación Password</label>
                    <div class="controls">
                        <input type="password" name="repassword" value="">
                    </div>
                </div>
                <?php endif;?>
                <div class="control-group">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombre" value="<?=isset($usuario->id)?$usuario->nombre:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Apellido</label>
                    <div class="controls">
                        <input type="text" name="apellido" value="<?=isset($usuario->id)?$usuario->apellido:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Sexo</label>
                    <div class="controls">
                        <label class="radio">Masculino
                            <input type="radio" name="sexo" <?=(isset($usuario->sexo))?($usuario->sexo=='M')?'checked':'':'';?> value='M'>
                        </label>
                        <label class="radio">Femenino
                            <input type="radio" name="sexo" <?=(isset($usuario->sexo))?($usuario->sexo=='F')?'checked':'':'';?> value='F'>
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Region</label>
                    <div class="controls">
                        <select  name="region_codigo">
                            <option value="">Seleccione una región</option>
                            <?php foreach ($regiones as $k => $region): ?>
                                <option <?=isset($usuario->region_codigo)?($region->codigo==$usuario->region_codigo)?'selected':'':''?> value="<?=$region->codigo?>"><?=$region->nombre?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="region" name="region_nombre" value="<?=isset($usuario->region_nombre)?$usuario->region_nombre:''?>">
                <div class="control-group">
                    <label class="control-label">Comuna</label>
                    <div class="controls">
                        <select class="" name="comuna_codigo">
                            <option value="">Seleccione una comuna</option>
                            <?php foreach ($comunas as $k => $comuna): ?>
                                <option <?=isset($usuario->comuna_codigo)?($comuna->codigo==$usuario->comuna_codigo)?'selected':'':''?> value="<?=$comuna->codigo?>"><?=$comuna->nombre?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="comuna" name="comuna_nombre" value="<?=isset($usuario->comuna_nombre)?$usuario->comuna_nombre:''?>">
                <div class="control-group">
                    <label class="control-label">Dirección</label>
                    <div class="controls">
                        <input type="text" name="direccion" value="<?=isset($usuario->id)?$usuario->direccion:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Teléfono</label>
                    <div class="controls">
                        <input type="text" name="fono" value="<?=isset($usuario->id)?$usuario->fono:''?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Perfil</label>
                    <div class="controls">
                        <select class="selectpicker show-tick dropup" name="perfil_id">
                            <option value="">Seleccione un perfil</option>
                            <?php foreach ($perfiles as $k => $perfil): ?>
                                <option value="<?=$perfil->id?>" <?=(isset($usuario->perfil_id))?($usuario->perfil_id==$perfil->id)?'selected':'':''?>><?=$perfil->nombre?></option>
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