<div>
<hr />
<h4>Últimas cotizaciones de cliente : <?php echo $cliente->razon_social?></h4>
<ul>
    <?php
    foreach($datos as $key=> $dato)
    {
        $existe=$this->cotizaciones_relacion_model->getCotizacionPorClienteDiezRegistros($id,$dato->id);
        ?>
        <li <?php //if($id==$dato->id){echo 'style="font-weight: bold;color: green;"';}else{echo 'style="color: red;"';}?>><!--
<input type="checkbox" name="name_<?php echo $key?>" value="<?php echo $dato->id?>" />
--><?php if($id==$dato->id){echo '<i class="icon-ok"></i>';}?> Cotización N° <?php echo $dato->id?> (<?php echo $dato->producto?>) <?php if(sizeof($existe)==0){?><a href="<?php echo base_url()?>hoja/datos_fotomecanica/<?php echo $id?>/<?php echo $pagina?>"><img src="<?php echo base_url()?>public/frontend/images/add.png" style="width: 16px;height: 16px;" /></a><?php }else{?><a href="<?php echo base_url()?>hoja/datos_fotomecanica/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/trash.png" style="width: 16px;height: 16px;" /></a><?php }?></li>
        <?php
    }
    ?>
</ul>
<hr />
</div>