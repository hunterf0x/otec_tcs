<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
		<div class="buttons"><a href="<?=site_url('admin/clientes/cliente')?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a></div>
	</div>
	<div class="widget-content">
        <?= $this->pagination->create_links() ?>
		<div class="row-fluid">
			<table class="table table-listas table-bordered " id="lista_productos">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Giro</th>
                        <th>Contacto empresa</th>
                        <th>Contacto correo</th>
                        <th>Contacto teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $key => $c) :?>
                        <tr>
                            <td><?=$c->id?></td>
                            <td><?=$c->rut?></td>
                            <td><?=$c->nombre?></td>
                            <td><?=$c->giro?></td>
                            <td><?=$c->contacto_empresa?></td>
                            <td><?=$c->contacto_email?></td>
                            <td><?=$c->contacto_telefono?></td>
                            <td style="white-space: nowrap;"><a class="btn btn-primary" href="<?=site_url('admin/clientes/cliente/'.$c->id)?>"><i class="icon-edit icon-white"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>
<div id="imagen_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <img src="#"/>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>