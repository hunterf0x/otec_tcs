<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=config('nombre_sitio')?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet/less" type="text/css" href="<?= base_url() ?>assets/backend/less/bootstrap.less">
        <script src="<?= base_url() ?>assets/backend/js/less/less.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/fullcalendar.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/datepicker/css/datepicker.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/backend.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/delta.grey.css"/>
        <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap-select.min.css"/>
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery.fineuploader/fineuploader-3.2.css" type="text/css">
    </head>
    <body>
    <br>
    <div id="sidebar">
        <h1 id="logo"><a href="index.php">Hunter SHOP</a></h1>
        <a href="<?=site_url('admin')?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <ul>
            <li <?=(!$this->uri->segment(2)?'class="active"':'')?>><a href="<?=site_url('admin')?>"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
            <li class="submenu <?= $this->uri->segment(2) == 'clientes'? 'open active':'' ?>">
                <a href="#"><i class="icon icon-briefcase"></i> <span>Clientes</span></a>
                <ul>
                    <li><a href="<?=site_url('admin/clientes/')?>">Todos los clientes</a></li>
                    <li><a href="<?=site_url('admin/clientes/cliente')?>">Nuevo cliente</a></li>
                </ul>
            </li>
            <li class="submenu <?= $this->uri->segment(2) == 'cursos'? 'open active':'' ?>">
                <a href="#"><i class="icon icon-file"></i> <span>Cursos</span></a>
                <ul>
                    <li><a href="<?=site_url('admin/cursos/')?>">Todos los cursos</a></li>
                    <li><a href="<?=site_url('admin/cursos/curso')?>">Nuevo curso</a></li>
                </ul>
            </li>
            <li class="submenu <?= $this->uri->segment(2) == 'clases'? 'open active':'' ?>">
                <a href="#"><i class="icon icon-book"></i> <span>Clases</span></a>
                <ul>
                    <li><a href="<?=site_url('admin/clases/')?>">Todos los clases</a></li>
                    <li><a href="<?=site_url('admin/clases/clase')?>">Nuevo clase</a></li>
                </ul>
            </li>
            <li class="<?= $this->uri->segment(2) == 'usuarios'? 'open active':'' ?>">
                <a href="<?=site_url('admin/usuarios/')?>"><i class="icon icon-user"></i> <span>Usuarios</span></a>
            </li>
        </ul>
    </div>
    <div id="mainBody">
        <h1>Dashboard
            <div class="pull-right">
                <a class="btn btn-large" title="" href="<?=site_url('admin/usuarios/usuario/'.UsuarioSesion::usuario()->id)?>"><i class="icon icon-user"></i> <span><?=UsuarioSesion::usuario()->usuario?></span></a>
                <?php if(UsuarioSesion::usuario()->perfil_id==1):?>
                    <a class="btn btn-large" title="" href="<?=site_url('admin/settings/')?>"><i class="icon icon-cog"></i> Configuración</a>
                <?php endif; ?>
                <a class="btn btn-large btn-danger tip-bottom" title="Salir del Administrador" href="<?=site_url('admin/autenticacion/logout')?>"><i class="icon-off"></i></a>
            </div>
        </h1>
        <?=$breadcrumb;?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('message') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('message_error')): ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('message_error') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('message_warning')): ?>
                        <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $this->session->flashdata('message_warning') ?>
                        </div>
                    <?php endif ?>
                    <?php $this->load->view($content) ?>
                </div>
            </div>
            <?php if(FuncionesHelper::is_home('dashboard')):?>
                <?php $this->load->view('admin/widget1') ?>
            <?php endif;?>
            <div class="row-fluid">
                <div id="footer" class="span12">
                    <?=html_entity_decode(config('copyright'))?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/jquery.ui.custom.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/jquery.peity.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/fullcalendar.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/bootstrap-timepicker.min.js"></script>

    <script src="<?= base_url() ?>assets/backend/js/delta.js"></script>
    <!-- <script src="<?= base_url() ?>assets/backend/js/delta.dashboard.js"></script>-->
    <script src="<?= base_url() ?>assets/js/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>assets/js/datepicker/js/locales/bootstrap-datepicker.es.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.fineuploader/jquery.fineuploader-3.2.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/bootstrap-select.js"></script>
    <script>
        var site_url = "<?= site_url() ?>";
        var base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/common.js"></script>
    <script src="<?= base_url() ?>assets/js/backend.js"></script>
    <?php echo put_headers();?>
	</body>
</html>