<div class="span9">
    <div class="well well-small">
        <h4>
            Productos destacados <small class="pull-right"><?=count($productos_destacados)?>
                Productos destacados</small>
        </h4>
        <div class="row-fluid">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">
                    <?php foreach ($productos_destacados as $key => $p):?>
                    <?php $resto = $key%4;?>
                        <?php if($resto < 4):?>
                            
                            <?php if ($resto == 0):?>
                                <div class="item <?=($key < 4)?'active':''?>">
                        <ul class="thumbnails">
                            <?php endif;?>
                                <li class="span3 carrusel_destacado">
                                <div class="thumbnail">
                                    <a href="<?=site_url('clientes/producto/'.$p->id)?>"><img src="<?= base_url('uploads/clientes/thumbs/'.$p->getImagen()) ?>"
                                        alt=""></a>
                                    <div class="caption">
                                        <h5><?=character_limiter($p->nombre,30)?></h5>
                                        <h4>
                                            <a class="btn" href="<?=site_url('clientes/producto/'.$p->id)?>">Ver</a> <span class="pull-right">$<?=number_format($p->precio,0,',','.')?></span>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            
                            <?php if ($resto == 3 || (count($productos_destacados) == ($key+1))):?>
                                </ul>
                    </div>
                            <?php endif;?>
                            
                        <?php endif;?>
                    <?php endforeach;?>
                    
                    
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a> <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Últimos productos</h4>
    <ul class="thumbnails">
        <?php foreach ($productos_ultimos as $p):?>
            <li class="span3">
            <div class="thumbnail">
                <?=($p->destacado)?'<i class="destacado"></i>':''?><a href="<?=site_url('clientes/producto/'.$p->id)?>"><img src="<?= base_url('uploads/clientes/thumbs/'.$p->getImagen()) ?>" style="height: 160px;" alt="<?=$p->nombre?>" /></a>
                <div class="caption">
                    <h5><?=character_limiter($p->nombre,25)?></h5>
                    <p><?=$p->Categoria->nombre?></p>

                    <h4 style="text-align: center">
                        <a class="btn" href="<?=site_url('clientes/producto/'.$p->id)?>"> <i class="icon-zoom-in"></i></a>
                        <a class="btn addtocart" data-producto="<?=$p->id?>" href="javascript:void(0);">Agregar a <i class="icon-shopping-cart"></i></a>
                        <button class="btn btn-primary btn-noclick " >$<?=number_format($p->precio,0,',','.')?></button>
                    </h4>
                </div>
            </div>
        </li>
        <?php endforeach;?>
        
        
    </ul>

</div>
