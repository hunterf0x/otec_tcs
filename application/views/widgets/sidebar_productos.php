<br />
<div id="calugas">
    <?php foreach(FuncionesHelper::getRecords('Widget') as $w): ?>
        <?php if($w->habilitado && $w->sidebar): ?>
        <br>
        <div class="thumbnail">
            <img src="<?= base_url('uploads/clientes/thumbs/'.$w->Producto->getImagen()) ?>" alt="<?=$w->Producto->nombre?>" />
            <div class="caption">
                <h5><?=$w->Producto->nombre?></h5>
                <h4 style="text-align: center">
                    <a class="btn" href="<?=site_url('clientes/producto/'.$w->Producto->id)?>"> <i class="icon-zoom-in"></i></a>
                    <a class="btn addtocart" data-producto="<?=$w->Producto->id?>" href="javascript:void(0);">Agregar a <i class="icon-shopping-cart"></i></a>
                    <a class="btn btn-primary btn-noclick" >$<?=number_format($w->Producto->precio,0,',','.')?></a>
                </h4>
            </div>
        </div>
        <?php endif;?>
    <?php endforeach; ?>
</div>