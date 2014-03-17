<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    <?php if (isset($msje)):?>
    <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$msje;?>
            </div>
    <?php endif;?>
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
                <a href="<?=site_url('carrito')?>" class="btn" ">Volver</a>
            </div>
        </div>
    </form>
</div>
