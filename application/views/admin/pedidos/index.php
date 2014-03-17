<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-shopping-cart"></i></span>
		<h5><?=$title?></h5>
		
	</div>
	<div class="widget-content">
        <?= $this->pagination->create_links() ?>
		<div class="row-fluid">
			<table class="table table-listas table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
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
                            <td><?=($total--) - ($offset)?></td>
                            <td><?=$p->Usuario->usuario?></td>
                            <td><?=$p->direccion_destino?></td>
                            <td><?=$p->comuna_destino?></td>
                            <td><?=$p->fono_destino?></td>
                            <td><?=$p->estado?'<span class="label label-success">Pagado</span>':'<span class="label label-important">No realizado</span>';?></td>
                            <td><?=$p->updated_at?></td>
                            
                            <td style="white-space: nowrap;"><a class="btn btn-primary" href="<?=site_url('admin/pedidos/detalle/'.$p->usuario_id.'/'.$p->id)?>"><i class="icon-shopping-cart icon-white"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>