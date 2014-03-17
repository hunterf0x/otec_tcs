<?php $id = isset($usuario->id)?$usuario->id:''; ?>
<div class="span9">
    <?=$breadcrumb?>
    <select class="selectpicker select_page show-tick pull-right" onchange="window.location.href = $(this).val()">
        <option value="<?=site_url('usuarios/usuario/'.UsuarioSesion::usuario()->id)?>" data-icon="icon-user"   > Mis datos</option>
        <option value="<?=site_url('usuarios/perfil/'.UsuarioSesion::usuario()->id)?>" data-icon="icon-shopping-cart" selected > Mis compras</option>
    </select>
    <h3> <?=$title?> </h3>
    <hr class="soft">
        <?= $this->pagination->create_links() ?>
        <div class="row-fluid">
			<table class="table table-listas table-striped ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Direccion</th>
                        <th>Comuna</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Checkout</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $key => $p) :?>
                        <tr>
                            <td><?=$p->id?></td>
                            <td><?=$p->direccion_destino?></td>
                            <td><?=$p->comuna_destino?></td>
                            <td><?=$p->fono_destino?></td>
                            <td><?=$p->estado?'<span class="label label-success">Pagado</span>':'<span class="label label-important">No realizado</span>';?></td>
                            <td><?=$p->updated_at?></td>
                            
                            <td style="white-space: nowrap;"><a class="btn " href="<?=site_url('usuarios/detalle/'.$p->usuario_id.'/'.$p->id)?>"><i class="icon-shopping-cart icon-white"></i></a> 
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
        
        
    
</div>
