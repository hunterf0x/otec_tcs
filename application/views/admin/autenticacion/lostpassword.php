<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ecommerce HunterFox - Aiep</title>
<!-- Bootstrap -->
<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?=base_url()?>assets/backend/css/backend.css" rel="stylesheet" media="screen">
<style>
body {
    background: url("<?=site_url()?>assets/backend/images/brushed_alu.png")
        repeat 0 0 !important;
}
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span4 offset4">
                <div class="signin">
                    <form method="post" class="ajaxForm signin-wrapper" action="<?= site_url('admin/autenticacion/lostpassword_form') ?>">
                        <fieldset>
                            <div class="content">
                                <legend><h3><?=$title?></h3></legend>
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
                                <div class="validacion"></div>
                                <label>Ingrese su correo electrónico</label> <input name="usuario" type="text" class="input input-block-level">
                                <?=$captcha['image'];?>
                                <label>Ingrese el código</label> <input name="captcha" type="text" class="input input-block-level">
                            </div>
                            <div class="actions">
                                <button class="btn btn-info pull-right" type="submit">Ingresar</button>
                                </span>
                                <div class="clearfix"></div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /container -->
    <!--  <script src="<?= base_url() ?>assets/js/jquery.js" type="text/javascript"></script>-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
+            var site_url = "<?= site_url() ?>";
+            var base_url = "<?= base_url() ?>";
+        </script>
    <script src="<?=base_url()?>assets/js/common.js"></script>
</body>
</html>
