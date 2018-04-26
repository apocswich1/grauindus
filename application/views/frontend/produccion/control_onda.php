<link rel ="stylesheet" type = "text/css" href ="<?php echo base_url(); ?>css/datepicker.css">
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Control Onda - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Control Onda - Fast Track N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
   <!-- /Migas -->
   
                    <?php
                      switch($tipo)
                      {
                        case '1':
                            ?>
                            <div onclick="ver_informacion('informacion')" class="page-header"><h3>Control Onda - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
                            <?php
                        break;
                        case '2':
                            ?>
                            <div onclick="ver_informacion('informacion')" class="page-header"><h3>Control Papel - Fast Track N° <?php echo $id?></h3></div>
                            <?php
                        break;
                      }
                      ?>          
   

            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 500px; margin-top: 2px; margin-bottom: 2px;">
                <div class="controls" style="margin-left: 0px;width:36%;float:left;">
                    <?php
                      switch($tipo)
                      {
                        case '1':
                            ?>
                            <ul>
                                <?php
                                $ordenCompra=$this->orden_model->getOrdenesDeCompraPorCotizacion($id);
                                $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
                                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                                $cliente=$cli->razon_social;
                                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
//                                if($orden->tiene_molde=='NO')
//                                {
//                                    $moldeNuevo='Molde Antiguo';
//                                }else
//                                {
//                                    $moldeNuevo='Molde nuevo';
//                                }
                                if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='NO'))// CUANDO ES NUEVO Y NO ESTAN HECHOS LOS MOLDES
                                {
                                    $moldeNuevo='Molde Nuevo';
                                }                    
                                elseif(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                                {
                                    $moldeNuevo='Molde Antiguo';
                                }
                                elseif(($orden->tiene_molde=='NO') && ($orden->estan_los_moldes=='NO'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                                {
                                    $moldeNuevo='No Corresponde';
                                }           
                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);
                                $hayparcial=$this->produccion_model->getParcialControlOndaSuma($id);
                                ?>
                                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>                       
                                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>                   
                                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                                    <?php if ($molde->nombre!=''){?> 
                                        <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <strong>(<?php echo $moldeNuevo?>)</strong></li>
                                    <?php }?>                                        
                                    <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                                    <?php if(!empty($ing->archivo)){?> 
                                    <li>PDF trazado de Ingeniería <a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                                    <?php }else
                                    {
                                        ?>
                                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                                        <?php
                                    }?>
                                   <?php if(!empty($fotomecanica2->archivo))
                                    {
                                    $archivoFotomecanica='SI';
                                    ?> 
                                    <li>PDF imagen <a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                                    <?php }else
                                    {
                                        $archivoFotomecanica='NO';
                                        ?>
                                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                                        <?php
                                    }?>
                                    
                                        <?php
                                        if(sizeof($fotomecanica2)==0)
                                           {
                                               ?>
                                               <li>Situación : <strong>Pendiente</strong></li>
                                               <?php
                                                
                                           }else
                                           {
                                             switch($control_onda->situacion)
                                             {
                                                case 'Liberada':
                                                    ?>
                                                    <li>Situación : <strong>Liberada el <?php echo fecha_con_hora($control_onda->fecha_liberada);?></strong></li>
                                                    <?php
                                                break;
                                                case 'Activa':
                                                    ?>
                                                    <li>Situación : <strong>Activa el <?php echo fecha_con_hora($control_onda->fecha_activa);?></strong></li>
                                                    <?php
                                                break;
                                             }
                                           }
                                        ?>
                                    
                                    <?php
                                    if($fotomecanica->estado==1)
                                    {
                                        ?>
                                        <li>Fecha liberación fotomecánica : <strong><?php echo fecha($fotomecanica->cuando)?></strong></li>
                                        <?php
                                    }
                                    ?>
                                    <li>Descripción de la onda : <strong><?php echo $materialidad_2->nombre?></strong></li>
                                    <li>Gramaje de la onda : <strong><?php echo $materialidad_2->gramaje?></strong></li>
                                    <li>Descripción liner : <strong><?php echo $materialidad_3->nombre?></strong></li>
                                    <li>Gramaje liner : <strong><?php echo $materialidad_3->gramaje?></strong></li>
                                    <li>Ancho seleccionado de Bobina: <strong><?php echo $ing->tamano_a_imprimir_1?></strong></li>
                                    <li>Largo seleccionado de Bobina : <strong><?php echo $ing->tamano_a_imprimir_2?></strong></li>                                    
                                    <li>Cantidad Solicitada : <strong><?php echo $ordenCompra->cantidad_de_cajas?></strong></li>  

                                </ul>
                                <hr />
                            <?php
                        break;
                        case '2':
                            ?>
                            <ul>
                                <?php
                                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                                ?>
                                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                                </ul>
                                <hr />
                            <?php
                        break;
                      }
                      ?>                
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;margin-top: 0%;">
                <ul>
                     <li>Cantidad de Pliegos : <strong><?php echo $hoja->onda_kilo; ?></strong></li>                    
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Placa :<b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </b></li>                        
                    <?php } else { ?>
                           <li>Placa :<b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </b>  </li>                        
                    <?php } ?>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>                           
                    <li><b><?php echo $fotomecanica2->materialidad_datos_tecnicos; ?></b>:</li>
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Onda : Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li>Onda : <b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></b></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><?php echo $monda->materiales_tipo.'&nbsp; '.$monda->gramaje; ?></li>   
                            <li><?php echo $hoja->onda_kilo.'&nbsp;'.$monda->gramaje; ?></li>                               
                    <?php } else { ?>
                            <li>Liner: <b><?php echo $mliner->materiales_tipo.'&nbsp; '.$mliner->gramaje; ?></b></li>
                    <?php } ?>       
                     <li>Tamaño Pliego : <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
                     <li>Unidad Pliego: <strong><?php echo $ing->unidades_por_pliego; ?></strong></li>
                     <li>Repetición: <strong><?php  if($datos->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
                     <li>Traxado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Cromalin : <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                  
                     <li>Colores : <strong><?php  echo $fotomecanica2->colores; ?></strong></li>
                     <li>Barniz : <strong><?php echo $fotomecanica2->fot_lleva_barniz; ?></strong></li>                     
                     <li>Reserva : <strong><?php echo $fotomecanica2->fot_reserva_barniz; ?></strong></li>        
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;margin-top: 0%;">
                <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica2->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
<!--                     <li>CCAC1 : <strong><?php //echo $emplacado->ccac1?></strong></li>
                     <li>CCAC2 : <strong><?php //echo $emplacado->ccac2?></strong></li>-->
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Cantidad de Tiros : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>                     
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Cms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Cms</strong></li>                     
                </ul>
            	</div>                
            </div>
	<p>
         
    </p>
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control_onda,'descripcion_del_trabajo',$control_onda->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina a usar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_a_usar_onda" value="<?php echo $ancho_bobina_a_usar; ?>" readonly="true" />
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina Recomendada</label>
		<div class="controls">
            <input type="text" name="ancho_seleccionado_recomendada" id="ancho_seleccionado_recomendada"  value="<?php echo $control_onda->ancho_seleccionado_recomendada;?>" placeholder="Ancho de bobina recomendada"/>
       </div>
	</div>    -->
    
   	  <div class="control-group">
		<label class="control-label" for="usuario">Para Bobinado onda</label>
		<div class="controls">
            <select name="para_bobinado">
                <option value="Para Bobinado" <?php echo set_value_select($control_onda,'para_bobinado',$control_onda->para_bobinado,'Para Bobinado');?>>Para Bobinado</option>
                <option value="Directo para Producción" <?php echo set_value_select($control_onda,'para_bobinado',$control_onda->para_bobinado,'Directo para Producción');?>>Directo para Producción</option>
            </select>
		</div>
	</div> 
    <div class="control-group">
          <label class="control-label" for="usuario">Onda Seleccionado 1ra Bobina</label>
          <div class="controls">
          <select name="descripcion_de_la_tapa2" style="width:300px" class="chosen-select" onchange="carga_ajax_obtenerGramaje2(this.value,'gs');">
              <option value="0">Seleccione......</option>
              <option value="no_hay">No hay</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa)
              {
                if ($bobinas->descripcion=='')  {
                  ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$bobinas->descripcion){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php
                  } else  { ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$bobinas->descripcion){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                   <?php }
               }
              ?>
          </select>
          </div>
    </div>
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Onda</label>
		<div class="controls">
			<input type="text" name="gramaje_onda" placeholder="Gramaje Onda" value="<?php echo $materialidad_2->gramaje?>" readonly="true" />
		</div>
	</div>
	
	<?php
	if($control_onda->ancho_seleccionado_de_bobina > 0)
	{
		$nancho = $control_onda->ancho_seleccionado_de_bobina;
		$gramaje_onda = $control_onda->gramaje_seleccionado;
	}else
	{
		$nancho = $ing->tamano_a_imprimir_1;
		$gramaje_onda = $materialidad_2->gramaje;
	}
	$kilos1=$this->produccion_model->LlamarKilosOnda($id,$gramaje_onda,$nancho);
	?>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje seleccionado Onda 1era bobina</label>
                <div class="controls" id="gs">
            <input type="text" name="gramaje_seleccionado" id="gramaje_seleccionado" value="<?php if($control_onda->gramaje_onda > 0 ){echo $control_onda->gramaje_onda;}else{echo $materialidad_2->gramaje;} ?>" placeholder="Gramaje seleccionado" onchange="ControlGramajeSeleccionadoOnda(<?php echo $id?>);"/>
       </div>
	</div>
        <div class="control-group">
		<label class="control-label" for="usuario">Kilo Onda 1ra bobina</label>
		<div class="controls">
			<input type="text" name="gramaje_onda" placeholder="Gramaje Onda" value="<?php echo $materialidad_2->gramaje?>" />
		</div>
	</div>
         <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina Onda seleccionada</label>
		<div class="controls">
            <input type="text" name="ancho_seleccionado_de_bobina" id="ancho_seleccionado_de_bobina"  value="<?php  echo $ancho_bobina_a_usar; ?>" placeholder="Ancho seleccionado de bobina" onchange="ControlGramajeSeleccionadoOnda(<?php echo $id?>);"/>
                           Ancho de Bobina a usar : <?php echo $ancho_bobina_a_usar?>

                </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="usuario">Kilo Onda 1ra bobina</label>
		<div class="controls">
			<input type="text" name="kilo_onda" id="kilo_onda"  value="<?php echo number_format($kilos1,0,'','.') ?>" readonly="true" />
		</div>
	</div>    
    
    	
	<!--Kilos seleccionados -->
	 <div id="hola">
     </div>
    <!--Kilos seleccionados -->

    
    
   
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ubicación Onda <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ubicacion_onda" placeholder="Ubicación Onda" value="<?php echo set_value_input($control_onda,'ubicacion_onda',$control_onda->ubicacion_onda);?>" />
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Preguntar a (Onda) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="preguntar_a_onda" placeholder="Preguntar a (Onda)" value="<?php //echo set_value_input($control_onda,'preguntar_a_onda',$control_onda->preguntar_a_onda);?>" />
		</div>
	</div>-->
    <div class="control-group">
		<label class="control-label" for="usuario">Preguntar a (Onda) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            	<select name="preguntar_a_onda"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_onda,'preguntar_a_onda',$control_onda->preguntar_a_onda,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Bobina Onda <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_bobina_onda" placeholder="Número de Bobina Onda" value="<?php echo set_value_input($control_onda,'numero_bobina_onda',$control_onda->numero_bobina_onda);?>" />
		</div>
	</div>
    
    
    
    
    <?php
    if($ing->tamano_a_imprimir_1==60)
    {
        $ancho_bobina=$ing->tamano_a_imprimir_1*3;    
    }else
    {
        $ancho_bobina=$ing->tamano_a_imprimir_1*2;
    }
    
    ?>
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Ancho de Bobina 2</label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina" value="<?php echo $ancho_bobina?>" readonly="true" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay que comprar onda</label>
		<div class="controls">
			<input type="text" name="hay_que_comprar_onda" value="<?php echo set_value_input($control_onda,'hay_que_comprar_onda',$control_onda->hay_que_comprar_onda);?>" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
            <select name="proveedor">
                <?php
                $proves=$this->proveedores_model->getProveedores();
                foreach($proves as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php echo set_value_select($control_onda,'proveedor',$control_onda->proveedor,$prove->id);?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
       </div>
	</div> 
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Fecha estimada de entrega</label>
		<div class="controls">
			<input type="date" name="fecha_estimada_de_entrega" value="<?php// echo set_value_input($control_onda,'fecha_estimada_de_entrega',$control_onda->fecha_estimada_de_entrega);?>" /> 
        </div>
	</div>-->
<div class="control-group" id="fecha_recepcionada">
		<label class="control-label" for="usuario">Fecha estimada de entrega<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" name="fecha_estimada_de_entrega" class="datepicker" placeholder="Introduzca Fecha" value="<?php if(sizeof($control_onda)>0){  $invert = explode("-",$control_onda->fecha_estimada_de_entrega);
                    $fecha_estimada_de_entrega = $invert[0]."-".$invert[1]."-".$invert[2]; echo $fecha_estimada_de_entrega;}?>">
		</div>
        </div>   
    
	 <div class="control-group">
			<label class="control-label" for="usuario">Total o parcial <strong style="color: red;">(*)</strong></label>
			<div class="controls">
				<select name="total_o_parcial" onchange="Parcial(this.value)" >
					<option value="Total"   <?php if($bobinado_liner->total_o_parcial=='Total'){echo 'selected="true"';}  ?>>Total</option>
					<option value="Parcial" <?php if($bobinado_liner->total_o_parcial=='Parcial'){echo 'selected="true"';}?>>Parcial</option>
				</select>
			</div>
		</div>
	
	
	<div class="control-group" id="totaloparcial" style="<?php if($control->total_o_parcial=='Parcial'){echo 'display: block';}else{ echo 'display: none';}?>;">
		<label class="control-label" for="usuario">Total de Kilos Seleccionados</label>
			<div class="controls">
				<input type="text" name="total_kilos2"  />
				<?php
				//Pendientes
				if(sizeof($hayparcial->sum) == 0)
				{ 
					if($control_onda->total_kilos >0)
					{
					?>
					<input type="text" name="total_kilos_a_bobinar" value="<?php echo $control_onda->total_kilos; ?>" readonly="true" />
					<?php
					}
				}else
				{
					$pendiente = $control_onda->total_kilos - $hayparcial->sum;
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.number_format($pendiente,0,'','.');?>" readonly="true" />
				<?php
				}
				//Pendientes 
				?>
				
		   </div>
	</div>
	
	
    <div class="control-group" id="rechazo" style="display: <?php if($control_onda->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control_onda->glosa?></textarea>
		</div>
	</div>
    
  
    
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="id_cliente" value="<?php if($tipo==1){echo $datos->id_cliente;}else{echo $datos->cliente;}?>" />
			<input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			
		 <?php
		 if($control_onda->estado == 1)
		 { 
			echo 'control Onda: Liberado';
		}else
		{
		?>
            <input type="button" value="Liberar" class="btn <?php if($control_onda->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
			<input type="button" value="Guardar" class="btn <?php if($control_onda->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
			<input type="button" value="Rechazar" class="btn <?php if($control_onda->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
			<input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial'/>
			
		 <?php
		 }
		 ?>
			
		</div>
	</div>
</form>


<?php

if($control_cartulina->gramaje != $materialidad_1->gramaje)
{
	?>
	<script type="text/javascript">

		ControlGramajeSeleccionadoOnda(<?php echo $id?>);
	</script>
<?php
}

?>

<script type="text/javascript">
$(document).ready(function() {
	$(".datepicker").datepicker({
		startDate	: 'today',
                format          : 'yyyy-mm-dd',
	});
});
</script>
<script type="text/javascript">
     jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
