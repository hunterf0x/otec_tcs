<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    <?php if (isset($msje)):?>
    <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$msje;?>
            </div>
    <?php endif;?>
   <form method="POST" class="form-horizontal" action="<?= site_url('carrito/actualizarCarrito/') ?>">
    <ul class="media-list">
        <?php $cnt = 1;?>
        <?php foreach ($productos as $p):?>
        <li class="media">
            <a class="pull-left" href="#"> <img class="media-object" data-src="holder.js/160x160" alt="160x160" style="width: 160px; height: 160px;" src="<?=site_url('uploads/clientes/thumbs/') ;?>/<?=FuncionesHelper::getImageCarrito($p['id']);?>"></a>
            <div class="media-body">
                <h4 class="media-heading"><?=$p['name']?></h4>
                <p><strong>Precio:</strong> $<?=number_format($p['price'],0,',','.')?></p>
                <p><strong>Cantidad :</strong> <?=$p['qty']?>                
                
                <p><strong>SubTotal :</strong> $<?=number_format($p['subtotal'],0,',','.')?></p>
                <input type="hidden" name="rowid[]" value="<?=$p['rowid']?>">
                <hr />
            </div>
        </li>
        <?php $cnt++;?>
        <?php endforeach;?>
        
    </ul>
    </form>

<div class="row-fluid">
<table class="table table-striped ">
        
              <tbody>
                <tr>
                  <th class="span8">Total items</th>
                  <td class="span1"><strong><?=$total_items?> Unidades</strong></td>
                </tr>
                <tr>
                  <th class="span8 ">Total valor</th>
                  <td><strong>$<?=number_format($total,0,',','.');?></strong></td>
                  
                </tr>
               
              </tbody>
</table>
 </div>
 </div>   
    
    