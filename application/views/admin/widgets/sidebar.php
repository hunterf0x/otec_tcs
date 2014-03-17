<div class="widget-box">
    <div class="widget-title">
        <span class="icon"><i class="icon-briefcase"></i></span>
        <h5><?=$title?></h5>

    </div>
    <div class="widget-content">
        <div class="row-fluid">
            <div class="span3">
                <div class="box ">
                    <div class="titulo-caja <?=($widgets[0]->habilitado)?'habilitado':'deshabilitado';?> " >
                        Producto 1
                        <a class="btn pull-right  btn-mini" href="<?=site_url('admin/widgets/widget/1')?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>
                    </div>
                    <ul>
                        <li><?=(isset($widgets[0]->id))?$widgets[0]->Producto->nombre:'No asignado';?></li>
                    </ul>

                </div>
            </div>
            <div class="span3">
                <div class="box ">
                    <div class="titulo-caja <?=($widgets[1]->habilitado)?'habilitado':'deshabilitado';?> ">
                        Producto 2
                        <a class="btn pull-right  btn-mini" href="<?=site_url('admin/widgets/widget/2')?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>
                    </div>
                    <ul>
                        <li><?=($widgets[1]->producto_id)?$widgets[1]->Producto->nombre:'No asignado';?></li>
                    </ul>
                </div>
            </div>
            <div class="span3">
                <div class="box ">
                    <div class="titulo-caja <?=($widgets[2]->habilitado)?'habilitado':'deshabilitado';?> ">
                        Producto 3
                        <a class="btn pull-right  btn-mini" href="<?=site_url('admin/widgets/widget/3')?>" data-placement="right" data-original-title="Editar"><i class="icon-pencil"></i> </a>
                    </div>
                    <ul>
                        <li><?=($widgets[2]->producto_id)?$widgets[2]->Producto->nombre:'No asignado';?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>