<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    <ul class="thumbnails">

        <?php foreach ($marcas as $m):?>
            <li class="span3">
                <div class="thumbnail marca">

                    <div class="caption">
                        <h5><a href="<?=site_url('marcas/marca/'.$m->id)?>"><?=$m->etiqueta?></a></h5>
                    </div>
                </div>
            </li>
        <?php endforeach;?>


    </ul>

</div>
