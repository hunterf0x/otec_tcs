<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-pencil"></i></span>
		<h5><?=$title?></h5>
		<div class="buttons"><a href="<?=site_url('admin/usuarios/usuario')?>" class="btn btn-mini"><i class="icon-plus"></i> Agregar</a></div>
	</div>
	<div class="widget-content">
        <?= $this->pagination->create_links() ?>
		<div class="row-fluid">
			<table class="table table-listas table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Activo</th>
                        <th>Avatar</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Sexo</th>
                        <th>Región</th>
                        <th>Comuna</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Perfil</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $key => $u) :?>
                        <tr>
                            <td><?=$u->id?></td>
                            <?php if(UsuarioSesion::usuario()->Perfil->id == 1 && $u->Perfil->id != 1):?>
                                <td><?=($u->activo)?'<a href="'.site_url('admin/usuarios/toggleActive/'.$u->id).'"><span class="label label-success"><i class="icon-ok"></i></span></a>':'<a href="'.site_url('admin/usuarios/toggleActive/'.$u->id).'"><span class="label label-important"><i class="icon-off"></i></span></a>';?></td>
                            <?php else:?>
                                <td><?=($u->activo)?'<span class="label label-success"><i class="icon-ok"></i></span>':'<span class="label label-important"><i class="icon-off"></i></span>';?></td>
                            <?php endif; ?>
                            <td><img src="<?=$u->avatar?>" height="8px" /></td>
                            <td><?=$u->usuario?></td>
                            <td><?=$u->nombre?></td>
                            <td><?=$u->apellido?></td>
                            <td><?=$u->sexo?></td>
                            <td><?=$u->region_nombre?></td>
                            <td><?=$u->comuna_nombre?></td>
                            <td><?=$u->direccion?></td>
                            <td><?=$u->fono?></td>
                            <td><?=$u->Perfil->nombre?></td>
                            <td style="white-space: nowrap;"><a class="btn btn-primary" href="<?=site_url('admin/usuarios/usuario/'.$u->id)?>"><i class="icon-edit icon-white"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>