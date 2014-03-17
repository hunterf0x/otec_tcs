
<script src="<?= base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<!--  <script src="http://code.jquery.com/jquery-latest.js"></script>-->

<script src="<?=base_url()?>assets/js/common.js"></script>
<form method="post" id="registro-front" class="ajaxForm-registro form-horizontal" action="<?= site_url('usuarios/usuario_form/') ?>">
    <div class="validacion_registro"></div>

    <div class="row-fluid">
        <div class="span12">
            <div class="row-fliud">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="usuario" value="">
                        </div>
                    </div>
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
                    <div class="control-group">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input type="text" name="nombre" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Apellido</label>
                        <div class="controls">
                            <input type="text" name="apellido" value="">
                        </div>
                    </div>
                    
                </div>
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Sexo</label>
                        <div class="controls">
                            <label class="radio">Masculino <input type="radio" name="sexo" value='M'>
                            </label> <label class="radio">Femenino <input type="radio" name="sexo" value='F'>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Region</label>
                        <div class="controls">
                            <select name="region_codigo">
                                <option value="">Seleccione una región</option>
                                                                <?php foreach ($regiones as $k => $region): ?>
                                                                    <option value="<?=$region->codigo?>"><?=$region->nombre?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="region" name="region_nombre" value="">
                    <div class="control-group">
                        <label class="control-label">Comuna</label>
                        <div class="controls">
                            <select class="" name="comuna_codigo">
                                <option value="">Seleccione una comuna</option>
                                                                <?php foreach ($comunas as $k => $comuna): ?>
                                                                    <option value="<?=$comuna->codigo?>"><?=$comuna->nombre?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="comuna" name="comuna_nombre" value="">
                    <div class="control-group">
                        <label class="control-label">Dirección</label>
                        <div class="controls">
                            <input type="text" name="direccion" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Teléfono</label>
                        <div class="controls">
                            <input type="text" name="fono" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
    </div>
</form>