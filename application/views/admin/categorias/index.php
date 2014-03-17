<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
		<div class="buttons"><a href="<?=site_url('admin/categorias/categoria')?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a></div>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
		   <?php $categorias = array_chunk($categorias->getData(), ceil($categorias->count()/4))?>
            <?php foreach($categorias as $cat):?>
                <div class="span3">
                <?php foreach ($cat as $c): ?>
                    <?php if($c->parent_id == NULL):?>
                    <div class="box ">
                        <div class="titulo-caja <?=($c->public)?'habilitado':'deshabilitado'?>">
                            <?= $c->nombre ?>
                            <a class="btn pull-right  btn-mini" href="<?=site_url('admin/subcategorias/subcategoria/'.$c->id)?>" data-placement="right" data-original-title="Agregar"><i class="icon-plus"></i> </a>
                            <a class="btn pull-right  btn-mini" href="<?=site_url('admin/subcategorias/ver/'.$c->id)?>" data-placement="right" data-original-title="Ver"><i class="icon-eye-open"></i> </a>
                            <a class="btn pull-right  btn-mini" href="<?=site_url('admin/categorias/categoria/'.$c->id)?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>
                        </div>
                            
                            <ul>
                                <?php foreach ($c->getSubCategoriasPublicadas() as $subcategoria):?>
                                    <!--  <li><a href="<?=site_url('admin/subcategorias/subcategoria/'.$c->id.'/'.$subcategoria->id)?>"><?=$subcategoria->nombre?></a></li>-->
                                    <li><a href="<?=site_url('admin/subcategorias/ver/'.$subcategoria->id)?>"><?=$subcategoria->nombre?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
                </div>
            <?php endforeach ?>
			
			
		</div>
	</div>
</div>
