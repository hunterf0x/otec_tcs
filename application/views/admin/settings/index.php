<div class="widget-box">
    <div class="widget-title">
        <span class="icon"><i class="icon icon-cog"></i></span>
        <h5><?=$title. " OTEC"?></h5>
    </div>
    <div class="widget-content">
        <div class="row-fluid">
            <h5 style="text-align: center;webkit-align:center">Ingrese los datos de la OTEC</h5>
            <form method="POST" class="form-horizontal ajaxForm" action="<?=site_url('admin/settings/configuracion_otec')?>">
                <div class="validacion"></div>
                <div class="control-group">
                    <label class="control-label">Rut</label>
                    <div class="controls">
                        <input type="text" name="rut" value="<?=$otec[0]['rut']?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombre" value="<?=$otec[0]['nombre']?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Giro</label>
                    <div class="controls">
                        <input type="text" name="giro" value="<?=$otec[0]['giro']?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Dirección</label>
                    <div class="controls">
                        <input type="text" name="direccion" value="<?=$otec[0]['direccion']?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Teléfono</label>
                    <div class="controls">
                        <input type="text" name="telefono" value="<?=$otec[0]['telefono']?>">
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




<div class="widget-box">
    <div class="widget-title">
        <span class="icon"><i class="icon icon-cog"></i></span>
        <h5>Administración de la plataforma</h5>

    </div>

    <div class="widget-content">
        <div class="row-fluid">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#sitio" data-toggle="tab">Sitio</a></li>
                <li class=""><a href="#administracion" data-toggle="tab">Administración</a></li>
                <li class=""><a href="#paginas" data-toggle="tab">Paginas</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="sitio">
                    <form method="POST" class="form-horizontal ajaxForm" action="<?=site_url('admin/settings/configuracion_form/sitio')?>">
                        <div class="validacion"></div>
                        <div class="control-group">
                            <label class="control-label">Nombre del Sitio</label>
                            <div class="controls">
                                <input type="text" name="nombre_sitio" value="<?=$c->getValorConfig('nombre_sitio')?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Descripción del sitio</label>
                            <div class="controls">
                                <input type="text" name="descripcion_sitio" value="<?=$c->getValorConfig('descripcion_sitio')?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Autor </label>
                            <div class="controls">
                                <input type="text" name="autor_sitio" value="<?=$c->getValorConfig('autor_sitio')?>">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <button type="button" class="btn" onclick="history.back()">Cancelar</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade " id="administracion">
                    <div class="tab-pane fade active in" id="sitio">
                        <form method="POST" class="form-horizontal ajaxForm" action="<?=site_url('admin/settings/configuracion_form/administracion')?>">
                            <div class="validacion"></div>
                            <div class="control-group">
                                <label class="control-label">Casilla de correo</label>
                                <div class="controls">
                                    <input type="text" name="casilla_sitio" value="<?=($c->getValorConfig('casilla_sitio'))?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nombre de acceso</label>
                                <div class="controls">
                                    <input type="text" name="cuenta_sitio" value="<?=($c->getValorConfig('cuenta_sitio'))?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contraseña de cuenta</label>
                                <div class="controls">
                                    <input type="password" name="clave_sitio" value="<?=($c->getValorConfig('clave_sitio'))?>">
                                </div>
                            </div>

                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" value='1' name="smtp_google" > SMTP de Google
                                </label>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button type="button" class="btn" onclick="history.back()">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="paginas">
                    <div class="tab-pane fade active in" id="sitio">
                        <form method="POST" class="form-horizontal ajaxForm" action="<?=site_url('admin/settings/configuracion_form/paginas')?>">
                            <div class="validacion"></div>
                            <div class="control-group">
                                <label class="control-label">Términos y condiciones</label>
                                <div class="controls">
                                    <textarea name="terminos_condiciones" id="content2" rows="4"><?=($c->getValorConfig('terminos_condiciones'))?></textarea>
                                    <?php echo display_ckeditor($ckeditor_2);?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Copyright</label>
                                <div class="controls">
                                    <textarea name="copyright" id="content3" rows="4"><?=($c->getValorConfig('copyright'))?></textarea>
                                    <?php echo display_ckeditor($ckeditor_3);?>
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
        </div>
    </div>
</div>

