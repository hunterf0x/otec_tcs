<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
		<div class="buttons"><a href="<?=site_url('admin/cursos/curso')?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a></div>
	</div>
	<div class="widget-content">
        <?= $this->pagination->create_links() ?>
		<div class="row-fluid">
			<table class="table table-listas table-bordered " id="lista_productos">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Codigo SENCE</th>
                        <th>Horas</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $key => $c) :?>
                        <tr>
                            <td><?=$c->id?></td>
                            <td><?=$c->nombre?></td>
                            <td><?=$c->codigo_sence?></td>
                            <td><?=$c->horas_curso?></td>
                            <td style="white-space: nowrap;">
                                <a class="btn btn-success addtip" data-toggle="tooltip" data-placement="top" title="" data-original-title="agregar Clase" href="<?=site_url('admin/clases/clase/'.$c->id)?>"><i class="icon-edit icon-plus"></i></a>
                                <a class="btn btn-primary" href="<?=site_url('admin/cursos/curso/'.$c->id)?>"><i class="icon-edit icon-white"></i></a>
                            </td>

                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>