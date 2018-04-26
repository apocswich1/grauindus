<div class="control-group">
<hr />


		    <?php 
			$datos=$this->cotizaciones_model->getCotizacionPorId($this->input->post("valor2",true));
			$Hoja_costo=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($this->input->post("valor2",true));			
			
			$precio = $this->input->post("valor3",true);
			
			

			$cantidad = $this->input->post("valor1",true);		
			if($datos->cantidad_1 != 0)
			{
			$inferior1 = $datos->cantidad_1 - (($datos->cantidad_1 /100)*10);
		    $superior1 = $datos->cantidad_1 + (($datos->cantidad_1 /100)*10);
			$valorEmpresa1 = $Hoja_costo->valor_empresa;
			}else{
			$inferior1 = 0;
		    $superior1 = 0;
			}
			if($datos->cantidad_2 != 0)
			{
			$inferior2 = $datos->cantidad_2 - (($datos->cantidad_2 /100)*10);
		    $superior2 = $datos->cantidad_2 + (($datos->cantidad_2 /100)*10);
			$valorEmpresa2 = $Hoja_costo->valor_empresa_2;
			}else{
			$inferior2 = 0;
		    $superior2 = 0;
			}
			if($datos->cantidad_3 != 0)
			{
			$inferior3 = $datos->cantidad_3 - (($datos->cantidad_3 /100)*10);
		    $superior3 = $datos->cantidad_3 + (($datos->cantidad_3 /100)*10);
			$valorEmpresa3 = $Hoja_costo->valor_empresa_3;
			}else{
			$inferior3 = 0;
		    $superior3 = 0;
			}
			if($datos->cantidad_4 != 0)
			{
			$inferior4 = $datos->cantidad_4 - (($datos->cantidad_4 /100)*10);
		    $superior4 = $datos->cantidad_4 + (($datos->cantidad_4 /100)*10);
			$valorEmpresa4 = $Hoja_costo->valor_empresa_4;
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
			
			//Valores iguales
			if($precio == $valorEmpresa1)
			{
			$precioOK = $valorEmpresa1;	
			}elseif($precio == $valorEmpresa2)
			{
			$precioOK = $valorEmpresa2;		
			}elseif($precio == $valorEmpresa3)
			{
			$precioOK = $valorEmpresa3;	
			}elseif($precio == $valorEmpresa4)
			{
			$precioOK = $valorEmpresa4;	
			}
		//####################################################################

		
		
			if(sizeof($igual) == 0) // (A) cantidad no exacta
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
				
						switch($posicion)
                               {
                                    case '1':
									$precioEstimado = $valorEmpresa1;
                                    break;
                                    case '2':
                                    $precioEstimado = $valorEmpresa2;
                                    break;
                                    case '3':
                                    $precioEstimado = $valorEmpresa3;
                                    break;
									case '4':
                                    $precioEstimado = $valorEmpresa4;
                                    break;
                               }
			?>
			   <table>
				<tr>
				<td>
			      <div class="controls">
					<label class="control-label" for="usuario"> <strong style="color: Red;">
					<?php //echo 'Advertencia 1' ?> 
					<?php //echo '<br>' ?> 
					<?php //echo '* Se considerara los valores de las cantidades cotizadas N :'.$posicion ?> 	
					<?php //echo '<br>' ?> 	
					<?php 
					
					//echo '* Precio segun cantidad ingresada : ';
					if($precio == $precioEstimado)
					{
						echo '<label class="control-label" for="usuario"> <strong style="color: green;"> OK </strong></label>';
						
					}else
					{
						echo 'Valor Tendra que ser autorizado';
					  //  echo '<br>';
					  //  echo '* Cantidad cotizada No corresponde al Precio Ingresado';
					}		
					
					?> 	
						
					<?php //echo '<br>' ?> 	
					<?php //echo '* Valor correspondiente a la Cantidad : $'.$precioEstimado;?> 		
					<?php //echo '<br>' ?> 	
					<?php //echo '* Valor1 :'.$valorEmpresa1 ?> 	
					<?php //echo '<br>' ?> 	
					<?php //echo '* Valor2 :'.$valorEmpresa2 ?> 	
					<?php //echo '<br>' ?> 	
					<?php //echo '* Valor3 :'.$valorEmpresa3 ?> 	
					<?php //echo '<br>' ?> 	
					<?php //echo '* Valor4 :'.$valorEmpresa4 ?> 	
					</strong></label>
				  </div>
				  
				</td>
				</tr>
				</table> 
		        
			
			<?php	
			}else
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
				
						switch($posicion)
                               {
                                    case '1':
									$precioEstimado = $valorEmpresa1;
                                    break;
                                    case '2':
                                    $precioEstimado = $valorEmpresa2;
                                    break;
                                    case '3':
                                    $precioEstimado = $valorEmpresa3;
                                    break;
									case '4':
                                    $precioEstimado = $valorEmpresa4;
                                    break;
                               }
			?>
			<table>
				<tr>
				<td>
			      <div class="controls">
					<label class="control-label" for="usuario"> <strong style="color: Red;">
					
					<?php 
					
					//echo '* Precio segun cantidad ingresada : ';
					if($precio == $precioEstimado)
					{
						echo '<label class="control-label" for="usuario"> <strong style="color: green;"> OK </strong></label>';
						
					}else
					{
						echo 'Valor Tendra que ser autorizado';
					  //  echo '<br>';
					  //  echo '* Cantidad cotizada No corresponde al Precio Ingresado';
					}		
					
					?> 	
					</strong></label>
				  </div>
				  
				</td>
				</tr>
				</table> 
			<?php
			}
			?>
<hr />



