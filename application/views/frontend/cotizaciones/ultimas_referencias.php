<h3>Últimas Referencias</h3>
    
    <?php
    if(sizeof($cotis)>=1)
    {
        ?>
        <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Últimas Cotizaciones</label>
		<div class="controls">
        <?php
        $i=0;
        foreach($cotis as $coti)
        {
            $i++;
            ?>
            <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $coti->id?>" class="fancybox fancybox.ajax"><?php echo $i?></a>
            <?php
            if($i<sizeof($cotis))
            {
                echo " - ";
            }
        }
        ?>
			 
		</div>
	</div>
        <?php
    }
    ?>
    
      <?php
    if(sizeof($ordenes)>=1)
    {
        ?>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Últimas Órdenes de Producción</label>
		<div class="controls">
        <?php
        $i=0;
        foreach($ordenes as $ordene)
        {
            $i++;
            ?>
            <a href="<?php echo base_url()?>ordenes/detalle/<?php echo $ordene->id?>" class="fancybox fancybox.ajax"><?php echo $ordene->id?></a>
            <?php
            if($i<sizeof($ordenes))
            {
                echo " - ";
            }
        }
        ?>
		
		</div>
	</div>
    <?php
    }
    ?>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Últimas Facturas</label>
		<div class="controls">
			<a href="">23423</a> - <a href="">23423</a> - <a href="">23423</a> - <a href="">23423</a> - <a href="">23423</a> 
		</div>
	</div>