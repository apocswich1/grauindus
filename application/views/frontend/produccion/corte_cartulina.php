<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php // print_r($tapa); ?>


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
            <li>Corte Cartulina - Orden de Producción N° <?php echo $orden->ot?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Corte Cartulina - Fast Track N° <?php echo $ot?></li>
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
            <div onclick="ver_informacion('informacion')" class="page-header"><h3>Corte Cartulina - Orden de Producción N° <?php echo $orden->id?></h3></div>
            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 450px;">
                <div class="controls" style="margin-left: 0px;width:40%;float:left;">                    
            <ul>
                <?php
                    $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                    $cliente=$cli->razon_social;
                    $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
    //                if($orden->tiene_molde=='NO')
    //                {
    //                    $moldeNuevo='Molde Antiguo';
    //                }else
    //                {
    //                    $moldeNuevo='Molde nuevo';
    //                }
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
                    $hayparcial=$this->produccion_model->getParcialCorteCartulina($id);
                    $hayparcial2=$this->produccion_model->getParcialBobinadoCartulinaSuma($id);
                ?>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php echo $cliente?></b></a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>                
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <strong>(<?php echo $moldeNuevo?>)</strong></li>
                    <li>Lleva Troquel : <strong> <?php if ($fotomecanica2->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>                            
                    <?php if(!empty($ing->archivo)){?> 
                    <li><strong>PDF trazado de Ingeniería</strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                    <li><strong>PDF imagen</strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        $archivoFotomecanica='NO';
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    <li>
                        <?php
                        if(sizeof($control_cartulina)==0 or sizeof($bobinado_cartulina)==0)
                           {
                               ?>
                               Situación : <strong>Pendiente</strong>
                               <?php
                                
                           }else
                           {
                             switch($control->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    Situación : <strong>Liberada el <?php echo fecha_con_hora($control->fecha_liberada);?></strong>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    Situación : <strong>Activa el <?php echo fecha_con_hora($control->fecha_activa);?></strong>
                                    <?php
                                break;
                             }
                           }
                        ?>
                    </li>
                    <li><strong>Cambio esto en todo los formularios subsiguientes ya que salen de control carulina que se define esto</strong></li>
                    <li>Descripción de la Tapa Cotizada : <strong><?php echo $tapa->nombre?></strong></li>
                    <li>Gramaje de la Tapa Cotizada : <strong><?php echo $tapa->gramaje?></strong></li>   
                    <li>Descripción de la Tapa Seleccionada : <strong><?php echo $control_cartulina->descripcion_de_la_tapa; ?></strong></li>
                    <li>Gramaje de la Tapa Seleccionado : <strong><?php echo $control_cartulina->gramaje?></strong></li>                    
                    <li>Descripción de la Onda Cotizada : <strong><?php echo $materialidad_2->nombre?></strong></li>                    
                    <li>Gramaje de la onda Cotizada : <strong><?php echo $materialidad_2->gramaje?></strong></li>                    
                    <li><strong>Fin Cambio esto en todo los formularios subsiguientes</strong></li>
                </ul>
            	</div>                    
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Corte Cartulina - Fast Track N° <?php echo $id?></h3></div>
            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 380px;">
                <div class="controls" style="margin-left: 0px;width:40%;float:left;">                
            <ul>
                <?php
                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                ?>
                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
            	</div>                          
            <?php
        break;
      }
      ?>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul>
                     <li>Total kilos Control Cartulina : <strong><?php echo $total_kilos_control_cartulina; ?></strong></li>                     
                     <li>Ancho de Bobina : <strong><?php echo $control_cartulina->ancho_de_bobina; ?></strong></li>                     
                     <li>Fecha liberación control cartulina : <strong><?php echo fecha($control_cartulina->cuando)?></strong></li>
                     <?php
                     if($control->total_o_parcial=='Total' and sizeof($control)>0)
                     {
                        ?>
                        <li>Saldo pliegos a cortar : <strong><?php echo $control->total_pliegos_a_cortar?></strong></li>
                        <?php
                     }else
                     {
//                       $parcial=$control->can_despacho_1+$control->can_despacho_2+$control->can_despacho_3; 
//                       $total=$control->total_pliegos_a_cortar-$parcial;
                         $total=$hoja->placa_kilo;
                       ?>
                       <li>Saldo pliegos a cortar : <strong><?php echo $total?></strong></li>
                       <?php
                     }
                     ?>                    
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><b>Placa :</b></li>
                            <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </li>                        
                    <?php } else { ?>
                           <li><b>Placa : </b></li>
                           <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>   </li>                        
                    <?php } ?>
                    <li><b><?php echo $fotomecanica2->materialidad_datos_tecnicos; ?></b>:</li>
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Onda : <b>Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li><b>Onda : </b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><?php echo $monda->materiales_tipo.'&nbsp; '.$monda->gramaje; ?></li>   
                            <li><?php echo $hoja->onda_kilo.'&nbsp;'.$monda->gramaje; ?></li>                               
                    <?php } else { ?>
                            <li><b>Liner: </b><?php echo $mliner->materiales_tipo.'&nbsp; '.$mliner->gramaje; ?></li>   
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
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;margin-top: 0%;">
                <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica2->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                </ul>
            	</div>                     
            </div>                  
	<p>
         
    </p>
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
			<input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
  
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción de la Tapa Seleccionada</label>
		<div class="controls">
			<input type="text" name="descripcion_de_la_tapa_referencia" value="<?php echo $control_cartulina->descripcion_de_la_tapa; ?>" readonly="true" />
       </div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Seleccionado</label>
		<div class="controls">
			<input type="text" name="gramaje_referencia" id="gramaje" value="<?php echo $control_cartulina->gramaje; ?>" readonly="true" />
        </div>
	</div>    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de bobina</label>
		<div class="controls">
			<input type="text" name="ancho_bobina" value="<?php echo $control_cartulina->ancho_de_bobina?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Tapa Realmente Seleccionado</label>
		<div class="controls">
			<input type="text" name="gramaje_tapa_realmente_cortado" value="<?php echo $control->gramaje_tapa_realmente_cortado?>" />
		</div>
	</div>
    
    <div class="control-group">
        <label class="control-label" for="usuario">Largo a cortar</label>
		<div class="controls">
			<input type="text" name="largo_a_cortar" value="<?php echo $ing->tamano_a_imprimir_1?>" readonly="true" /> x <input type="text" name="ancho_a_cortar" value="<?php echo $ing->tamano_a_imprimir_2?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos a cortar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_a_cortar" placeholder="Total pliegos a cortar" value="<?php if ($control->total_pliegos_a_cortar!='') echo set_value_input($control,'total_pliegos_a_cortar',$control->total_pliegos_a_cortar); else echo set_value_input($hoja,'total_pliegos_a_cortar',$hoja->placa_kilo);?>" readonly="true"/>
		</div>
	</div>
	
	
	<?php
			if(sizeof($control) > 0)
			{
				
			}	
			else
			{
				if($control_cartulina->hay_que_bobinar == 'SI') //Hay bobinado?
				{
					//Con Bobinado cartulina	
					
				
				if($hayparcial2->sum > 0)
					{
						//con Parcial en Bobinado	
						$control_cartulina_kilos = $hayparcial2->sum;
					}else{
						//Sin Parcial en Bobinado		
						$control_cartulina_kilos = $this->produccion_model->MermasParaProduccion($id,$control_cartulina->gramaje_seleccionado,$control_cartulina->ancho_seleccionado_de_cartulina);
					}
					
				}else
				{
				//Sin Bobinado cartulina (Solo control Cartulina: parcial o total)
					$hayparcial=$this->produccion_model->getParcialControlCartulina($id);
					if($hayparcial->sum > 0)
					{
						//con Parciales control cartulina
						$control_cartulina_kilos = $hayparcial->sum;
						
						
					}else{
						//Sin Parciales control cartulina: solo control cartulina TOTAL
						 $control_cartulina_kilos = $this->produccion_model->MermasParaProduccion($id,$control_cartulina->gramaje_seleccionado,$control_cartulina->ancho_seleccionado_de_cartulina);
					}
														
				}				
			}
	?>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Total kilos Control Cartulina<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_kilos" placeholder="Total kilos" value="<?php echo number_format($total_kilos_control_cartulina,0,'','');?>" readonly="true"/>
		</div>
	</div>
	
    <!--<div class="control-group">
		<label class="control-label" for="usuario">Total kilos de Control Onda <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_kilos" placeholder="Total kilos" value="<?php //echo number_format($control_cartulina_kilos,0,'','');?>" />
		</div>
	</div>-->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control,'operador',$control->operador,$usuario->id);?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
   
    <div class="control-group">
		<label class="control-label" for="usuario">Número de tarimas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_de_tarimas" placeholder="Número de tarimas" value="<?php echo set_value_input($control,'numero_de_tarimas',$control->numero_de_tarimas);?>" />
		</div>
	</div>
    
  
     
     <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos cortados <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_cortados" placeholder="Total pliegos cortados" value="<?php echo set_value_input($control,'total_pliegos_cortados',$control->total_pliegos_cortados);?>" />
		</div>
	 </div>
     
     <div class="control-group">
		<label class="control-label" for="usuario">Ancho realmente cortado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_realmente_cortado" placeholder="Ancho realmente cortado" value="<?php echo set_value_input($control,'ancho_realmente_cortado',$control->ancho_realmente_cortado*10);?>" />
		</div>
	 </div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Largo realmente cortado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="largo_realmente_cortado" placeholder="Largo realmente cortado" value="<?php echo set_value_input($control,'largo_realmente_cortado',$control->largo_realmente_cortado*10);?>" />
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
				<input type="text" name="can_despacho_1"  />
				<?php
				//Pendientes
				if(sizeof($hayparcial->sum) == 0)
				{ 
					?>
					<input type="text" name="total_kilos_a_bobinar" value="<?php echo 'Pendientes : '.$control_cartulina_kilos; ?>" readonly="true" />
					<?php
					
				}else
				{
					$pendiente = $control_cartulina_kilos - $hayparcial->sum;
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.number_format($pendiente,0,'','.');?>" readonly="true" />
				<?php
				}
				//Pendientes 
				?>
				
		   </div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
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
			<input type="button" value="Guardar" class="btn <?php if($control->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
   		    <input type="button" value="Rechazar" class="btn <?php if($control->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
			<?php
			
			if($control->estado == 1) 
				{
					echo 'Corte Cartulina Liberado!';
				}
				else
				{
					if($control_cartulina->estado == 1 or  $bobinado_cartulina->estado == 1) 
						{							
			?>	
           <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
		   <input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial'/>
			<?php
						}
						else
						{					
			?>
						
			<?php					  
						}				
				}
			?>
		</div>
	</div>
</form>

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
