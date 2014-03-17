<?php 

$c = ($categoria->id)?$categoria:'';
?>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title;?></h5>
		<div class="buttons">
            <button onclick="javascript:history.back();" class="btn btn-mini"><i class="icon-arrow-up"></i> Subir</button>
            <a href="<?=site_url('admin/subcategorias/subcategoria/'.$c->id)?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a>
        </div>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
		<?php if (($subcategorias->count())):?>
		   <?php $subcategorias = array_chunk($subcategorias->getData(), ceil($subcategorias->count()/4))?>
            <?php foreach($subcategorias as $subcat):?>
                <div class="span3">
                <?php foreach ($subcat as $s): ?>
                    <?php if($s->parent_id != NULL):?>
                    <div class="box">
                           <div class="titulo-caja <?=($s->public)?'habilitado':'deshabilitado'?>">
                           <?= $s->nombre ?>
                                <a class="btn pull-right  btn-mini" href="<?=site_url('admin/subcategorias/subcategoria/'.$s->id)?>" data-placement="right" data-original-title="Agregar"><i class="icon-plus"></i> </a>
                                <a class="btn pull-right  btn-mini" href="<?=site_url('admin/subcategorias/ver/'.$s->id)?>" data-placement="right" data-original-title="Ver"><i class="icon-eye-open"></i> </a>
                                <a class="btn pull-right  btn-mini" href="<?=site_url('admin/subcategorias/subcategoria/'.$c->id.'/'.$s->id)?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>
                            </div>
                            <ul>
                                <?php foreach ($s->getSubCategoriasPublicadas() as $subcategoria):?>
                                    <!--  <li><a href="<?=site_url('admin/subcategorias/subcategoria/'.$s->id.'/'.$subcategoria->id)?>"><?=$subcategoria->nombre?></a></li>-->
                                    <li><a href="<?=site_url('admin/subcategorias/ver/'.$subcategoria->id)?>"><?=$subcategoria->nombre?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
                </div>
            <?php endforeach ?>
			<?php endif;?>
			
		</div>
	</div>
</div>