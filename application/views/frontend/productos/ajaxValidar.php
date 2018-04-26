<div class="control-group">
<hr />


		    <?php 
		//	print_r($valor2);exit;
			if($nombreProducto->nombre)
			{
	
			?>
			   <table>
				<tr>
				<td>
			<!-- <a href="<?php //echo base_url()?>cotizaciones/rep_ajax/<?php //echo $dato->id_cotizacion?>/<?php //echo $pagina ;?>" title="Repeticion Sin Cambio" class="fancybox fancybox.ajax"">	-->
		<label class="control-label" for="usuario"> <strong style="color: red;">
			<?php echo 'Descripción del producto ya existe, No se guardara la solicitud: ' ?> <?php echo $nombreProducto->id_cotizacion ?> <?php echo $nombreProducto->nombre ?> <?php echo $nombreProducto->codigo ?> 
		</strong></label>
			</a>
				</td>
				</tr>
				</table> 
		    <HR width=100% align="center">		
			
			<?php
				
			}else{
		    ?>
			<table>
				<tr>
				<td>
						<label class="control-label" for="usuario"> <strong style="color: green;">
					<?php echo 'Descripcion del producto OK' ?> 
					</strong></label>
					
					</td>
				</tr>
				</table> 
			<?php } ?> 
<hr />
</div>
