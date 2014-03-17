<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            <div class="span6">
                <?php if(UsuarioSesion::usuario()):?>
                    Bienvenido!<strong> <a href="<?=site_url('usuarios/usuario/'.UsuarioSesion::usuario()->id)?>"><?=UsuarioSesion::usuario()->nombre?></a></strong>
                <?php endif;?>
            </div>
            
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                
                <a class="brand" href="<?=site_url()?>"><img src="<?= base_url() ?>assets/frontend/images/logo.png" alt="HunterSHOP" /></a>
                
                
                
                
                <form class="form-search navbar-search form-inline pull-left" action="<?=site_url('resultado/index')?>" method="post">
                    <div class="input-append">
                    <input type="text" class="span2 search-query" name="busqueda">
                        <button type="submit" class="btn lupa"><i class="icon-search"></i></button>
                    </div>
                    </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><a href="special_offer.html">Ofertas especiales</a></li>
                    <li class=""><a href="<?=site_url('paginas/contacto')?> ">Contacto</a></li>
                    <?php if(!UsuarioSesion::usuario()):?>
                        <li class=""><a href="<?=site_url('paginas/registro/')?>" role="button"  data-toggle="modal" data-target="#registro">Registro</a></li>
                    <?php endif;?>
                    <?php if(UsuarioSesion::usuario()):?>
                        <li class=""><a href="<?=site_url('admin/autenticacion/logout')?>"  role="button"  style="padding-right: 0"><span class="btn btn-danger">Salir</span></a>
                    <?php else:?>
                        <li class=""><a href="#login" role="button"  data-toggle="modal" style="padding-right: 0"><span class="btn btn-success">Login</span></a>
                    <?php endif;?>
                        <div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Ingrese a su cuenta</h3>
                            </div>
                            
                            <div class="modal-body">
                                <form method="post" class="ajaxForm form-horizontal" action="<?= site_url('usuarios/login_form') ?>">
                                    <div class="validacion"></div>
                                    
                                    <div class="control-group">
                                        <input type="text" name="usuario" id="usuario" placeholder="Email" class="input input-block-level">
                                    </div>
                                    <div class="control-group">
                                        <input type="password" name="password" id="password" placeholder="Password" class="input input-block-level">
                                    </div>
                                    <div class="actions">
                                    <div class="control-group">
                                    <button type="submit" class="btn btn-success">Login</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div id="registro" class="modal hide fade modal-registro" tabindex="-1" role="dialog" aria-labelledby="registro" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Registro</h3>
                            </div>
                            <div class="modal-body body-registro">
                                
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>