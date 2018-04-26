<div class="control-group">
<hr />


		    <?php 
			$datos=$this->cotizaciones_model->getCotizacionPorId($this->input->post("valor2",true));
			$Hoja_costo=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($this->input->post("valor2",true));			

			$cantidad = $this->input->post("valor1",true);		
			if($datos->cantidad_1 != 0)
			{
			$inferior1 = $datos->cantidad_1 - (($datos->cantidad_1 /100)*10);
		    $superior1 = $datos->cantidad_1 + (($datos->cantidad_1 /100)*10);
			}else{
			$inferior1 = 0;
		    $superior1 = 0;
			}
			if($datos->cantidad_2 != 0)
			{
			$inferior2 = $datos->cantidad_2 - (($datos->cantidad_2 /100)*10);
		    $superior2 = $datos->cantidad_2 + (($datos->cantidad_2 /100)*10);
			}else{
			$inferior2 = 0;
		    $superior2 = 0;
			}
			if($datos->cantidad_3 != 0)
			{
			$inferior3 = $datos->cantidad_3 - (($datos->cantidad_3 /100)*10);
		    $superior3 = $datos->cantidad_3 + (($datos->cantidad_3 /100)*10);
			}else{
			$inferior3 = 0;
		    $superior3 = 0;
			}
			if($datos->cantidad_4 != 0)
			{
			$inferior4 = $datos->cantidad_4 - (($datos->cantidad_4 /100)*10);
		    $superior4 = $datos->cantidad_4 + (($datos->cantidad_4 /100)*10);
			}else{
			$inferior4 = 0;
		    $superior4 = 0;
			}
			
			if($cantidad == $datos->cantidad_1)
			{
			$igual = '1';	
			}elseif($cantidad == $datos->cantidad_2)
			{
			$igual = '2';		
			}elseif($cantidad == $datos->cantidad_3)
			{
			$igual = '3';		
			}elseif($cantidad == $datos->cantidad_4)
			{
			$igual = '4';		
			}
		//####################################################################

			if(sizeof($igual) == 0)
			{		
		
			
			if($cantidad >= $inferior1 and $cantidad<= $superior1)
				{
					
				$igual2 = $datos->cantidad_1;
				$posicion = 1;
				
				}
				elseif($cantidad >= $inferior2 and $cantidad<= $superior2)
				{
							$igual2 = $datos->cantidad_2;
							$posicion = 2;
					
				}
				elseif($cantidad >= $inferior3 and $cantidad<= $superior3)
				{
					
					
						$igual2 = $datos->cantidad_3;
						$posicion = 3;
				
				}
				
				elseif($cantidad >= $inferior4 and $cantidad<= $superior4)
				{
				
						$igual2 = $datos->cantidad_4;
						$posicion = 4;
				
				}
			
			?>
			   <table>
				<tr>
				<td>
			      <div class="controls">
					<label class="control-label" for="usuario"> <strong style="color: Red;">
					<?php echo 'La cantidad de cajas ingresadas no corresponde a las cantidades Cotizadas'?> 		
					<?php echo '<br>' ?> 	
					<?php echo '¡Al liberar se debe pedir autorización'?> 		
					<?php echo '<br>' ?> 	
					<?php echo 'Se considerara los valores de las cantidades cotizadas N :'.$posicion ?> 	
					<?php //echo 'Cantidad Saliente: '.$igual2 ?> 		
					<?php echo '<br>' ?> 	
					<?php //echo 'Cantidad cotizada: '.$posicion ?> 		
					</strong></label>
				  </div>
				  
				</td>
				</tr>
				</table> 
		        
			
			<?php		
			}else
			{
			?>
                <table>
				<tr>
				<td>
			      <div class="controls">
					<label class="control-label" for="usuario"> <strong style="color: green;">
					<?php echo 'La cantidad ingresada  corresponde exactamente a la Cantidad Cotizada N: '.$igual ?> 		
					</strong></label>
				  </div>
					  
				</td>
				</tr>
				</table> 
		        
			
			<?php		
			}
			?>
			
<hr />
</div>

