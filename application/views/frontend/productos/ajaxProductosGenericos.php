<div class="control-group">
<div class="controls">
<h3>Productos Genericos</h3>

<?php 
$cont = 1;
foreach($datos as $i=>$dato)
//foreach($cotizacion as $i=>$cotizaciones)
{
	
    ?>
	   <table>
		<tr>
		<td>
    <a href="<?php echo base_url()?>cotizaciones/rep_ajax/<?php echo $dato->id_cotizacion?>/<?php echo $pagina ;?>" title="Repeticion Sin Cambio" class="fancybox fancybox.ajax"">	
    <?php echo $cont.' N. de Cotizacion: '.$dato->id_cotizacion?> ( <?php echo 'Cod: '.$dato->codigo?> )	( <?php echo 'Producto: '.$dato->nombre?> )	
    </a>
	    </td>
		</tr>
		</table> 
<!--<HR width=100% align="center">-->		
    <?php
	$cont = $cont + 1;
}
?>

<!--<hr />-->
</div>
</div>    
