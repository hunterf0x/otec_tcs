

<div id="sidebar" class="span3">
    <div class="well well-small">
        <a id="myCart" href="<?=site_url('carrito')?>"><img src="<?= base_url() ?>assets/frontend/images/ico-cart.png" alt="cart"><span id="cantidad"><?=$this->cart->total_items()?></span> items en el
            carro <span class="badge badge-warning pull-right total-carro">$<?=number_format($this->cart->total(),0,',','.');?></span></a>
    </div>
    <div class="alert alert-success product-add" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('message')?>
    </div>

    <div id="sideManuAux" class="span12">
        <ul  class="nav nav-tabs nav-stacked">
                    <?php foreach ($sidebar as $key => $categoria):?>
    		   
                		    <?php if($categoria->getContent()):?>
                		   
                    		<li><a href="<?=site_url('categorias/categoria/'.$categoria->id)?>"> <?=ucfirst($categoria->nombre)?></a></li>
                    		<?php endif;?>
                		<?php endforeach;?>
                </ul>
    </div>

    <ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php foreach ($sidebar as $key => $categoria):?>
		   
		    <?php if($categoria->getContent()):?>
		   
    		<li class="subMenu open"><a href="<?=site_url('categorias/categoria/'.$categoria->id)?>"> <?=ucfirst($categoria->nombre)?></a>
            <ul>
    				<?php foreach ($categoria->getSubcategoriasPublicadas() as $sub):?> 
    				<?php if($sub->SubCategorias->count() || $sub->Productos->count()):?>
    				    <?php if($sub->getContent()):?>
        				    <li><a class="active" href="<?=site_url('categorias/categoria/'.$sub->id)?>"><i class="icon-chevron-right"></i><?=$sub->nombre?>  </a></li>
						<?php endif;?>
    				<?php endif;?>
    				<?php endforeach;?>
    			</ul></li>
    		<?php endif;?>
		<?php endforeach;?>
	</ul>
	
    <?=$this->load->view('widgets/sidebar_productos');?>    
	
	
	
</div>