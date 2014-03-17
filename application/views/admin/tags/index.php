<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<table class="table table-listas table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tag</th>
                        <th>Categoria (<?php foreach($categorias as $c) echo $c.' - ';?>)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tags as $key => $t) :?>
                        <tr>
                            <td><?=$t->id?></td>
                            <td><?=$t->etiqueta?></td>
                            <td><?=$t->categoria?></td>
                            <td style="white-space: nowrap;"><a class="btn btn-primary" href="<?=site_url('admin/tags/tag/'.$t->id)?>"><i class="icon-edit icon-white"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>