<div class="span9">
    <?=$breadcrumb?>
    <h3> Etiqueta <?=$title?> <small class="pull-right"><?=$tag->Productos->count()?> productos disponibles </small></h3>
    <hr class="soft">
    <ul class="thumbnails">
        
        <?php foreach ($tag->Productos as $p):?>
            <li class="span3">
            <div class="thumbnail">
                <a href="<?=site_url('clientes/producto/'.$p->id)?>"><img src="<?= base_url('uploads/clientes/thumbs/'.$p->getImagen()) ?>" style="height: 160px;" alt="<?=$p->nombre?>" /></a>
                <div class="caption">
                    <h5><?=character_limiter($p->nombre,40)?></h5>
                    <p><?=$p->Categoria->nombre?></p>

                    <h4 style="text-align: center">
                        <a class="btn" href="<?=site_url('clientes/producto/'.$p->id)?>"> <i class="icon-zoom-in"></i></a>
                        <a class="btn addtocart" data-producto="<?=$p->id?>" href="javascript:void(0);">Agregar a <i class="icon-shopping-cart"></i></a>
                        <a class="btn btn-primary btn-noclick">$<?=number_format($p->precio,0,',','.')?></a>
                    </h4>
                </div>
            </div>
        </li>
        <?php endforeach;?>
        
        
    </ul>

    
</div>