<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=config('nombre_sitio')?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?=config('descripcion_sitio')?>">
	<meta name="author" content="">
	
<!-- Bootstrap style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" media="screen"/>
    <link href="<?= base_url() ?>assets/frontend/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/frontend/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->
    <link href="<?= base_url() ?>assets/frontend/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/css/bootstrap-select.min.css"/>
	
	
</head>
<body>
<!-- header  -->
<?php $this->load->view('header') ?>
<!-- header End====================================================================== -->
<?php if(FuncionesHelper::is_home('inicio')):?>
<?php $this->load->view('widgets/carrusel') ?>
<?php endif;?>

<div id="mainBody">
    <div class="container">
        <div class="row-fluid">
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
        </div>
        <div class="row">
    <!-- Sidebar ================================================== -->
            <?php $this->load->view('sidebar') ?>
    <!-- Sidebar end=============================================== -->
            
            <?php $this->load->view($content) ?>
        </div>
    </div>
</div>
<!-- Footer ================================================================== -->
    <?php $this->load->view('footer') ?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/frontend/js/google-code-prettify/prettify.js"></script>
    <script src="<?= base_url() ?>assets/frontend/js/bootshop.js"></script>
    <script src="<?= base_url() ?>assets/frontend/js/jquery.lightbox-0.5.js"></script>
    <script src="<?= base_url() ?>assets/js/common.js"></script>
    <script src="<?= base_url() ?>assets/backend/js/bootstrap-select.js"></script>
    <script>
        var site_url = "<?= site_url() ?>";
        var base_url = "<?= base_url() ?>";
    </script>
    <?php echo put_headers();?>
</body>
</html>