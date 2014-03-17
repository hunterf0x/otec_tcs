
<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> <small class="pull-right"> <?=$categoria->getCuenta() ?> Subcategorías </small></h3>
    <hr class="soft">
    <ul class="thumbnails">
        <?php foreach ($categoria->getSubCategoriasPublicadas() as $sub):?>
            <?php if($sub->getContent()):?>
            <li class="span3">
            <div class="thumbnail">
                <div class="caption">
                    <h5><?=$sub->nombre?></h5>
                    <p><?=character_limiter($sub->descripcion,40)?></p>

                    <h4 style="text-align: center">
                        <a class="btn btn-info" href="<?=site_url('categorias/categoria/'.$sub->id)?>"> <i class="icon-eye-open"></i>Ver más</a>
                    </h4>
                </div>
            </div>
            </li>
            <?php endif;?>
        <?php endforeach;?>
        
        
    </ul>

    
</div>
