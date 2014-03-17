<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    <?= $this->pagination->create_links() ?>
        <div class="row-fluid">
			<table class="table table-listas table-striped ">
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
                            <td><strong>$<?=number_format($d->precio,0,',','.')?></strong></td>
                            <td><a class="btn" href="<?=site_url('clientes/producto/'.$d->producto_id)?>"><i class="icon-eye-open"></i></a></td>
                             
                            
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="actions">
                <button type="button" class="btn" onclick="history.back()"><i class="icon-arrow-left"></i> Volver</button>
                
            </div>
		</div>
        
        
    
</div>
