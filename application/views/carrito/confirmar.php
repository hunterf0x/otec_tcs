<div class="span9">
    <?=$breadcrumb?>
    <h3> <?=$title?> </h3>
    <hr class="soft">
    <?php if (isset($msje)):?>
    <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=$msje;?>
            </div>
    <?php endif;?>
    <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Al hacer click en pagar usted será redirigido a la platadorma de pago DineroMail donde realizará el pago.
            </div>
  


  
<form method="POST" action="https://checkout.dineromail.com/CheckOut" name="CheckOut5">
    <input type="hidden" value="3" name="country_id">
    <input type="hidden" value="es" name="language">
    
    <?php $cnt=1;?>
    <?php foreach($this->cart->contents() as $items):?>
    <input type="hidden" value="<?=$items['name']?>" name="item_name_<?=$cnt;?>">
    <input type="hidden" value="<?=$items['qty']?>" name="item_quantity_<?=$cnt;?>">
    <input type="hidden" value="<?=number_format($items['price'],2,'.','')?>" name="item_ammount_<?=$cnt;?>">
    <input type="hidden" value="clp" name="item_currency_<?=$cnt;?>">
    <?php $cnt++;?>
    <?php endforeach;?>
    
    
    <input type="hidden" value="0" name="change_quantity">
    <input type="hidden" value="all" name="payment_method_available">
    <input type="hidden" value="cl_visa,3" name="payment_method_1">	
    <input type="hidden" value="button" name="tool">
    <input type="hidden" value="0328905" name="merchant">	
    <input type="hidden" value="<?=$usuario->nombre?>" name="buyer_name">
    <input type="hidden" value="<?=$usuario->apellido;?>" name="buyer_lastname">
    <input type="hidden" value="<?=$usuario->sexo;?>" name="buyer_sex">
    <input type="hidden" value="chl" name="buyer_nacionality">
    <input type="hidden" value="cpf" name="buyer_document_type">
    <input type="hidden" value="<?=$usuario->usuario?>" name="buyer_email">
    <input type="hidden" value="<?=$usuario->fono?>" name="buyer_phone">
    <input type="hidden" value="<?=site_url('carrito/aprobado')?>" name="ok_url" />
    <input type="hidden" value="<?=site_url('carrito/noRealizado')?>" name="error_url" />
    <input type="hidden" value="www.pending.com" name="pending_url"  />    
    <input type="hidden" value="1" name="url_redirect_enabled"  />    
    
    
    
    <input type="hidden" value="chl" name="buyer_country">
    <input type='image'src='https://chile.dineromail.com/imagenes/botones/pagar-medios_c.gif' border='0' name='submit' alt='Pagar con DineroMail'>
</form>
 </div>   
    