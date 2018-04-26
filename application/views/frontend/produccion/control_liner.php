<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php // echo $ancho_a_usar_liner; ?>
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
            <li>Control Liner - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Control Papel - Fast Track N° <?php echo $id?></li>
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
            <div onclick="ver_informacion('informacion')"   class="page-header"><h3>Control Liner - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
                        <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 390px;">
                            <div class="controls" style="margin-left: 0px;width:40%;float:left;">                
            <ul>
                <?php
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
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
		$hayparcial=$this->produccion_model->getParcialControlLinerSuma($id);
                ?>
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>                   
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a><strong> (<?php echo $moldeNuevo?>)</strong></li>
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica2->troquel_por_atras?></li>
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
                             switch($control_liner->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    <li>Situación : <strong>Liberada el <?php echo fecha_con_hora($control_liner->fecha_liberada);?></strong></li>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    <li>Situación : <strong>Activa el <?php echo fecha_con_hora($control_liner->fecha_activa);?></strong></li>
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

                     <li>Descripción liner : <strong><?php echo $materialidad_3->nombre?></strong></li>
                     <li>Gramaje liner : <strong><?php echo $materialidad_3->gramaje?></strong></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div onclick="ver_informacion('informacion')"   class="page-header"><h3>Control Papel - Fast Track N° <?php echo $id?></h3></div>
                        <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 440px;">
                            <div class="controls" style="margin-left: 0px;width:40%;float:left;">                
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
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul><?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Placa :<b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </b></li>                        
                    <?php } else { ?>
                           <li>Placa : <b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>  </b> </li>                        
                    <?php } ?>
                    <li><b><?php echo $fotomecanica2->materialidad_datos_tecnicos; ?></b>:</li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>                    
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Onda : Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li>Onda : <b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></b></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><?php echo $monda->materiales_tipo.'&nbsp; '.$monda->gramaje; ?></li>   
                            <li><?php echo $hoja->onda_kilo.'&nbsp;'.$monda->gramaje; ?></li>                               
                    <?php } else { ?>
                            <li>Liner: <b><?php echo $mliner->materiales_tipo.'&nbsp; '.$mliner->gramaje.'&nbsp; ('.$mliner->reverso.')'; ?></b></li>   
                    <?php } ?>          
                     <li>Tamaño Pliego : <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
                     <li>Unidad Pliego: <strong><?php echo $ing->unidades_por_pliego; ?></strong></li>
                     <li>Repetición: <strong><?php  if($datos->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
                     <li>Traxado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Cromalin : <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                     <li>Colores : <strong><?php  echo $fotomecanica->colores; ?></strong></li>
                     <li>Barniz : <strong><?php echo $fotomecanica->fot_lleva_barniz; ?></strong></li>                     
                     <li>Reserva : <strong><?php echo $fotomecanica->fot_reserva_barniz; ?></strong></li>        
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>

                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Cms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Cms</strong></li>                     
                </ul>
            	</div>  
            </div>
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control_liner,'descripcion_del_trabajo',$control_liner->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho corte final a usar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_a_usar_liner" value="<?php if ($control_liner->ancho_a_usar_liner!='') echo $control_liner->ancho_a_usar_liner; else echo $ancho_a_usar_liner;?>" readonly="true" />
                    Ancho de Bobina a usar en Onda: <?php echo $ancho_a_usar_onda?>
                </div> 
	</div>
            
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina Liner seleccionado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_seleccionado_de_bobina"  id="ancho_seleccionado_de_bobina" placeholder="Ancho de Bobina liner seleccionado" value="<?php if ($control_liner->ancho_seleccionado_de_bobina!='') echo $control_liner->ancho_seleccionado_de_bobina; else echo $ancho_a_usar_liner;?>" onchange="ControlGramajeSeleccionadoLiner(<?php echo $id?>);"/> 
                    Ancho de Bobina a usar en Onda: <?php echo $ancho_a_usar_onda?>
               </div>
	</div> 
            
        <div class="control-group">
		<label class="control-label" for="usuario">Ancho Seleccionado Liner a Bobinar</label>
		<div class="controls">
                    <!--ehndz :Hice modificaciones en la siguiente linea en el contenido de las etiquetas-->
                    <input type="text" name="bobinar_ancho_liner" onblur="sumar_bobina_liner();" onkeypress="return soloNumeros(event)" value="<?php if ($control_liner->bobinar_ancho_liner!="") echo ($control_liner->bobinar_ancho_liner); else echo ($ancho_a_usar_onda); ?> "/>  <strong> <?php if ($control_liner->bobinar_ancho_liner!="") echo $control_liner->bobinar_ancho_liner." Cms => "; else echo (($ancho_a_usar_onda)/(10)." Cms => "); ?> <?php if ($control_liner->bobinar_ancho_liner!="") echo ($control_liner->bobinar_ancho_liner); else echo ($ancho_a_usar_onda); ?> Mms</strong>
        </div>
	</div>               
    

      <div class="control-group">
		<label class="control-label" for="usuario">Para Bobinado Liner</label>
		<div class="controls">
                    <select name="para_bobinado" onchange="Hay_Que_Bobinar_Liner(this.value)">
                        <option value="Para Bobinado" <?php echo set_value_select($control_liner,'para_bobinado',$control_liner->para_bobinado,'Para Bobinado');?>>Para Bobinado</option>
                        <option value="Directo para Producción" <?php echo set_value_select($control_liner,'para_bobinado',$control_liner->para_bobinado,'Directo para Producción');?>>Directo para Producción</option>
                    </select>
		</div>
	</div>  
            
            
        <div id="ancho_bobina_seleccionado_bobinar" <?php if ($control_liner->bobinar_ancho_liner=="Para Bobinado" ) { ?> style="display: none"> <?php } else echo ">"?>    
            
        
               
            
        <div class="control-group">
                    <label class="control-label" for="usuario">Ancho a Cortar Primer Corte</label>
                    <div class="controls">
                    <input type="text" onblur="sumar_bobina_liner();" name="bobinar_ancho_cartulina1" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina?>"/> 
                    <div id="msg_bobinas1"> </div>
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label" for="usuario">Ancho a Cortar Segundo Corte</label>
                    <div class="controls">
                    <input type="text"  name="bobinar_ancho_cartulina2" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina?>"/> 
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label" for="usuario">Ancho a Cortar Tercer Corte</label>
                    <div class="controls">
                    <input type="text" name="bobinar_ancho_cartulina3" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina?>"/> 
            </div>
            </div>
            
        <div class="control-group">
                    <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada</label>
                    <div class="controls">
                        <input type="text" readonly="true"  name="kilos_bobina_seleccionada" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->kilos_bobina_seleccionada?>"/> 
            </div>
            </div>            

    </div>            
            
            
          
    
<?php echo "<h1>".$control_liner."</h1>";?>

    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Ancho a usar liner</label>
		<div class="controls">
			<input type="text" name="ancho_a_usar_liner" value="<?php //  echo $ing->tamano_a_imprimir_1;?>" readonly="true" />
		</div>
	</div>-->
    

    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje liner</label>
		<div class="controls">
			<input type="text" name="gramaje_liner" placeholder="Gramaje liner" value="<?php echo $materialidad_3->gramaje?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje seleccionado liner</label>
		<div class="controls">
            <input type="text" name="gramaje_seleccionado" id="gramaje_seleccionado"  value="<?php if($control_liner->gramaje_seleccionado > 0){ echo $control_liner->gramaje_seleccionado;}else{echo $materialidad_3->gramaje;}?>" placeholder="Gramaje seleccionado liner" onchange="ControlGramajeSeleccionadoLiner(<?php echo $id?>);"/>
       </div>
	</div>
	
	
	
	<?php
	if($control_liner->ancho_seleccionado_de_bobina > 0)
	{
		$nancho = $control_liner->ancho_seleccionado_de_bobina;
		$gramaje_liner = $control_liner->gramaje_seleccionado;
	}else
	{
		$nancho = $ing->tamano_a_imprimir_1;
		$gramaje_liner = $materialidad_3->gramaje;
	}
	$kilos1=$this->produccion_model->LlamarKilosLiner($id,$gramaje_liner,$nancho);
	?>
	
	 <div class="control-group">
		<label class="control-label" for="usuario">Kilo Liner</label>
		<div class="controls">
			<input type="text" name="kilo_liner" id="kilo_liner"  value="<?php echo number_format($kilos1,0,'','.') ?>" readonly="true" />
		</div>
	</div>
	
		<!--Kilos seleccionados -->
	 <div id="hola">
     </div>
    <!--Kilos seleccionados -->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ubicación Liner <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ubicacion_liner" placeholder="Ubicación Liner" value="<?php echo set_value_input($control_liner,'ubicacion_liner',$control_liner->ubicacion_liner);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Preguntar a (Liner) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="preguntar_a_liner" placeholder="Preguntar a (Liner)" value="<?php echo set_value_input($control_liner,'preguntar_a_liner',$control_liner->preguntar_a_liner);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Bobina Liner <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_bobina_liner" placeholder="Número de Bobina Liner" value="<?php echo set_value_input($control_liner,'numero_bobina_liner',$control_liner->numero_bobina_liner);?>" />
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
		<label class="control-label" for="usuario">Ancho de Bobina 2 </label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina" value="<?php echo $ancho_bobina?>" readonly="true" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay que comprar Liner</label>
		<div class="controls">
			<input type="text" name="hay_que_comprar_liner" value="<?php echo set_value_input($control_liner,'hay_que_comprar_liner',$control_liner->hay_que_comprar_liner);?>" /> 
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
                    <option value="<?php echo $prove->id?>" <?php echo set_value_select($control_liner,'proveedor',$control_liner->proveedor,$prove->id);?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Fecha estimada de entrega</label>
		<div class="controls">
			<input type="date" name="fecha_estimada_de_entrega" value="<?php echo set_value_input($control_liner,'fecha_estimada_de_entrega',$control_liner->fecha_estimada_de_entrega);?>" /> 
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
					if($control_liner->total_kilos >0)
					{
					?>
					<input type="text" name="total_kilos_a_bobinar" value="<?php echo $control_liner->total_kilos; ?>" readonly="true" />
					<?php
					}
				}else
				{
					$pendiente = $control_liner->total_kilos - $hayparcial->sum;
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.number_format($pendiente,0,'','.');?>" readonly="true" />
				<?php
				}
				//Pendientes 
				?>
				
		   </div>
	</div>
	
	
    <div class="control-group" id="rechazo" style="display: <?php if($control_liner->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control_liner->glosa?></textarea>
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
            <input type="text" id="ccac1" name="ccac1" value="<?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?>" />
            <input type="text" id="can_imprimir" name="can_imprimir" value="<?php echo $hoja->placa_kilo; ?>" />
              
			
			<?php
		 if($control_liner->estado == 1)
		 { 
			echo 'control Liner: Liberado';
			}else
			{
			?>
			
			<input type="button" value="Guardar" class="btn <?php if($control_liner->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
   		    <input type="button" value="Rechazar" class="btn <?php if($control_liner->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
			
            <input type="button" value="Liberar" class="btn <?php if($control_liner->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
			
			
			<input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial'/>
			
			
		 <?php
			}
		 ?>	
		</div>
	</div>
</form>



<?php

if($control_liner->gramaje != $materialidad_3->gramaje)
{
	?>
	<script type="text/javascript">

		ControlGramajeSeleccionadoLiner(<?php echo $id?>);
	</script>
<?php
}

?>

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
