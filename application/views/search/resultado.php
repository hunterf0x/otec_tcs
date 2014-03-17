
<div class="span9">
    <?=$breadcrumb?>
    <?php if(!isset($resultados)) :?>
        <h3><?=$title?></h3>
        <h5>No se han encontrado resultados para la búsqueda que haces. Prueba con otra palabra</h5>
    <?php else: ?>
        <h3> <?=$title?> <small class="pull-right"><?=$resultados->count()?> productos disponibles </small></h3>
        <hr class="soft">
        <ul class="thumbnails">

            <?php foreach ($resultados as $r):?>
                <li class="span3">
                    <div class="thumbnail">
                        <a href="<?=site_url('clientes/producto/'.$r->id)?>"><img src="<?= base_url('uploads/clientes/thumbs/'.$r->getImagen()) ?>" style="height: 160px;" alt="<?=$r->nombre?>" /></a>
                        <div class="caption">
                            <h5><?=character_limiter($r->nombre,40)?></h5>
                            <p><?=$r->Categoria->nombre?></p>

                            <h4 style="text-align: center">
                                <a class="btn" href="<?=site_url('clientes/producto/'.$r->id)?>"> <i class="icon-zoom-in"></i></a>
                                <a class="btn addtocart" data-producto="<?=$r->id?>" href="javascript:void(0);">Agregar a <i class="icon-shopping-cart"></i></a>
                                <a class="btn btn-primary btn-noclick">$<?=number_format($r->precio,0,',','.')?></a>
                            </h4>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>


        </ul>
    <?php endif; ?>
</div>