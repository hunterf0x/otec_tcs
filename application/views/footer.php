<div id="footerSection">
    <div class="container">
        <div class="row foot-pad">
            <div class="span3">
                <h5>CUENTA</h5>
                <?php if(UsuarioSesion::usuario()): ?>
                    <a href="<?=site_url('usuarios/usuario/'.UsuarioSesion::usuario()->id)?>" >MI CUENTA</a>
                    <a href="<?=site_url('usuarios/perfil/'.UsuarioSesion::usuario()->id)?>">MIS COMPRAS</a>
                <?php else: ?>
                    <a href="#login" data-toggle="modal">MI CUENTA</a>
                <?php endif; ?>

            </div>
            <div class="span3">
                <h5>INFORMACIÓN</h5>
                <a href="<?=site_url('paginas/contacto')?>">CONTACTO</a>
                <?php if(!UsuarioSesion::usuario()): ?>
                    <a href="<?=site_url('paginas/registro')?>" data-toggle="modal" data-target="#registro">REGISTRO</a>
                <?php endif; ?>
                <a href="<?=site_url('paginas/terminos')?>">TERMINOS Y CONDICIONES</a>
                <a href="<?=site_url('paginas/empresa')?>">NUESTRA EMPRESA</a>
                <a href="<?=site_url('paginas/faq')?>">FAQ</a>
            </div>
            <div class="span3">
                <h5>NUESTRAS OFERTAS</h5>
                <a href="#">NUEVOS PRODUCTOS</a> 
                <a href="#">TOP VENTAS</a> 
                <a href="#">OFERTAS ESPECIALES</a> 
                <a href="<?=site_url('marcas')?>">MARCAS</a>
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA</h5>
                <a href="<?=config('facebook_link')?>"><img width="60" height="60" src="<?= base_url() ?>assets/frontend/images/facebook.png" title="facebook" alt="facebook" /></a>
                <a href="<?=config('twitter_link')?>"><img width="60" height="60" src="<?= base_url() ?>assets/frontend/images/twitter.png" title="twitter" alt="twitter" /></a>
                <a href="<?=config('facebook_link')?>"><img width="60" height="60" src="<?= base_url() ?>assets/frontend/images/youtube.png" title="youtube" alt="youtube" /></a>
            </div>
        </div>
    </div>
    <!-- Container End -->
</div>