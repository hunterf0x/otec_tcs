<div class="widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon icon-shopping-cart"></i></span>
		<h5><?=$title?></h5>
		
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<table class="table table-listas table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalle as $key => $d) :?>
                        <tr>
                            <td><?=$d->id?></td>
                            <td><?=$d->Producto->nombre?></td>
                            <td><span class="badge badge-info"><?=$d->cantidad?></span></td>
                            <td>$<?=number_format($d->precio,0,',','.')?></td>
                            <td><a class="btn btn-primary" href="<?=site_url('admin/clientes/producto/'.$d->producto_id)?>"><i class=" icon-forward"></i></a></td>
                             
                            
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
		</div>
	</div>
</div>