<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <?php foreach(FuncionesHelper::getRecords('Widget') as $k=> $w): ?>
                <?php if($w->habilitado && $w->slideshow): ?>
                    <div class="item <?=($k==1)?'active':''?>">
                        <div class="container">
                            <a href="<?=site_url('clientes/producto/'.$w->Producto->id)?>"><img style="width: 100%" src="<?= base_url() ?>uploads/slides/<?=$w->imagen?>" alt="special offers" /></a>
                            <div class="carousel-caption">
                                <h4><?=$w->Producto->nombre?></h4>
                                <p><?=$w->descripcion?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach;?>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>