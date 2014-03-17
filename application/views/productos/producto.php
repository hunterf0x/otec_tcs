<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> <small class="pull-right"> <?=$producto->stock?> productos disponibles </small></h3>
    <hr class="soft">
    
        <div class="row-fluid">
            <div class="offset1 span5">
                
                <div class="image"><img src="<?= base_url('uploads/clientes/'.$producto->getImagen()) ?>" style="width: 256px;" /></div>
                <p><h2>$<?=number_format($producto->precio,0,',','.')?> c/u</h2></p>
                <form method="POST" class="form ajaxForm-comprar" action="<?= site_url('carrito/comprar/'.$producto->id) ?>">
                    <input id="cantidad" type="text" value="1" class="input-cantidad" name="cantidad">
                    <button class="btn btn-large btn-primary" type="submit">Comprar</button>
                </form>
                <div class="tags">
                    <?php foreach($producto->Tags as $tag):  ?>
                        <a href="<?=site_url('tags/tag/'.$tag->id)?>"><span class="label label-success"><?=$tag->etiqueta?></span></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="span6">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#descripcion" data-toggle="tab">Descripción</a></li>
                    <li class=""><a href="#tecnica" data-toggle="tab">Especificaciones técnicas</a></li>
                </ul>
                
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="descripcion">
                        <p><?=nl2br($producto->short_descripcion)?></p>
                        <ul>
                            <li>Categoría:<strong><?=$producto->Categoria->nombre?></strong></li>
                            <li>Peso: <strong><?=$producto->peso?> Grs.</strong></li>
                            <li>Stock: <strong><?=$producto->stock?> Unidades</strong></li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tecnica">
                        <p><?=$producto->full_descripcion?></p>
                    </div>
                </div>
                
                
                
            </div>
        </div>
        
        
    <hr class="soft">
    <h4>Últimos productos</h4>
    <ul class="thumbnails">
        <?php foreach ($productos_ultimos as $p):?>
            <li class="span3">
            <div class="thumbnail">
                <a href="<?=site_url('clientes/producto/'.$p->id)?>"><img src="<?= base_url('uploads/clientes/thumbs/'.$p->imagen) ?>" style="height: 160px;" alt="<?=$p->nombre?>" /></a>
                <div class="caption">
                    <h5><?=$p->nombre?></h5>
                    <p><?=$p->Categoria->nombre?></p>

                    <h4 style="text-align: center">
                        <a class="btn" href="<?=site_url('clientes/producto/'.$p->id)?>"> <i class="icon-zoom-in"></i></a>
                        <a class="btn addtocart" data-producto="<?=$p->id?>" href="javascript:void(0);">Agregar a <i class="icon-shopping-cart"></i></a>
                        <a class="btn btn-primary btn-noclick" >$<?=number_format($p->precio,0,',','.')?></a>
                    </h4>
                </div>
            </div>
        </li>
        <?php endforeach;?>
        
        
    </ul>

</div>
