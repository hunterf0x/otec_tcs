<div class="widget-box">
    <div class="widget-title">
        <span class="icon"><i class="icon-briefcase"></i></span>
        <h5><?=$title?></h5>
        <div class="buttons"><a href="<?=site_url('admin/widgets/widget_slide')?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a></div>
    </div>
    <div class="widget-content">
        <div class="row-fluid">
            <?php if($widgets->count() > 0 ): ?>
                <?php $widgets = array_chunk($widgets->getData(), ceil($widgets->count()/4))?>
                <?php foreach($widgets as $k=> $wid):?>
                    <?php foreach($wid as  $w):?>
                    <div class="span3">
                        <div class="box ">
                            <div class="titulo-caja <?=($w->habilitado)?'habilitado':'deshabilitado'?>">
                                Slide <?= $k +1?>
                                <a class="btn pull-right  btn-mini" href="<?=site_url('admin/widgets/eliminar_slide/'.$w->id)?>" data-placement="right" data-original-title="Eliminar"><i class="icon-trash"></i> </a>
                                <a class="btn pull-right  btn-mini" href="<?=site_url('admin/widgets/widget_slide/'.$w->id)?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>

                            </div>
                            <div class="thumbnail">
                                <a href="<?=site_url('admin/widgets/widget_slide/'.$w->id)?>"><img src="<?= base_url('uploads/slides/thumbs/'.$w->imagen) ?>" style="height: 100px;" alt="<?=$w->Producto->nombre?>" /></a>
                                <div class="caption">
                                    <h5><?=$w->Producto->nombre?></h5>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>