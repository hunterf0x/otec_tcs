<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    
   <form method="POST" class="form-horizontal" action="<?= site_url('carrito/actualizarCarrito/') ?>">
    <ul class="media-list">
        <?php $cnt = 1;?>
        <?php foreach ($productos as $p):?>
        <li class="media">
            <a class="pull-left" href="#"> <img class="media-object" data-src="holder.js/160x160" alt="160x160" style="width: 160px; height: 160px;" src="<?=site_url('uploads/clientes/thumbs/') ;?>/<?=FuncionesHelper::getImageCarrito($p['id']);?>"></a>
            <div class="media-body">
                <h4 class="media-heading"><?=$p['name']?></h4>
                <p><strong>Precio:</strong> $<?=number_format($p['price'],0,',','.')?></p>
                <p><strong>Cantidad :</strong> <input id="cantidad" type="text" value="<?=$p['qty']?>" class="input-cantidad-form" name="qty[]"></p>
                <p><a class="btn btn-danger" href="<?=site_url('carrito/quitar_producto/'.$p['id'])?>">Quitar<i class="icon-trash"></i></a></p>
                
                <p><strong>SubTotal :</strong> $<?=number_format($p['subtotal'],0,',','.')?></p>
                <input type="hidden" name="rowid[]" value="<?=$p['rowid']?>">
                <hr />
            </div>
        </li>
        <?php $cnt++;?>
        <?php endforeach;?>
        <li><button class="btn btn-success" type="submit">Actualizar carrito <i class="icon-refresh"></i></button></li>
    </ul>
    </form>

<div class="row-fluid">
<table class="table table-striped ">
        
              <tbody>
                <tr>
                  <th class="span8">Total items</th>
                  <td class="span1"><strong><?=$this->cart->total_items();?> Unidades</strong></td>
                </tr>
                <tr>
                  <th class="span8 ">Total valor</th>
                  <td><strong>$<?=number_format($this->cart->total(),0,',','.');?></strong></td>
                  
                </tr>
               
              </tbody>
</table>
 </div>
 </div>   
    <hr class="soft">
    
    
        <a class="btn  span2 offset1" type="button" href="<?=site_url('inicio')?>"><i class=" icon-arrow-left"></i> Seguir comprando</a>
        <?php if($this->cart->total_items()):?>
        <a class="btn  span2 offset2" type="submit" href="<?=site_url('carrito/checkout')?>">Ir a CheckOut <i class="icon-arrow-right"></i></a>
        <?php endif;?>
    