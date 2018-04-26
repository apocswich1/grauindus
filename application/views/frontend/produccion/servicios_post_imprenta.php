<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<?php //  print_r($imprenta_produccion); ?>    
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Servicios Post Imprenta - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Servicios Post Imprenta - Fast Track N° <?php echo $id?></li>
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
            <div onclick="ver_informacion('informacion')"   class="page-header"><h3>Servicios Post Imprenta - Orden de Producción N° <?php echo $id?></h3></div>
            <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 550px;">
                <div class="controls" style="margin-left: 0px;width:40%;float:left;">                         
            <ul>
                 <?php
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                if($orden->tiene_molde=='NO')
                {
                    $moldeNuevo='Molde Antiguo';
                }else
                {
                    $moldeNuevo='Molde nuevo';
                }
                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                ?>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>                
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li><strong> PDF trazado de Ingeniería </strong> <a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                    <?php if(!empty($fotomecanica->archivo)){?> 
                    <li><strong> PDF imagen </strong> <a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    
                        <?php
                        if(sizeof($corte_cartulina)==0 or sizeof($imprenta_programacion)==0 or sizeof($control_cartulina)==0)
                           {
                               ?>
                               <li>Situación : <strong>Pendiente</strong></li>
                               <?php
                                
                           }else
                           {
                             switch($control->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    <li>Situación : <strong>Liberada el <?php echo fecha_con_hora($control->fecha_liberada);?></strong></li>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    <li>Situación : <strong>Activa el <?php echo fecha_con_hora($control->fecha_activa);?></strong></li>
                                    <?php
                                break;
                             }
                           }
                        ?>
                    
                    <?php
                    if($corte_cartulina->estado==1)
                    {
                        ?>
                        <li>Fecha Liberación Corte cartulina : <strong><?php echo fecha($corte_cartulina->cuando)?></strong></li>
                        <?php
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
                    <li>Descripción de la Tapa Cotizada : <strong><?php echo $tapa->nombre?></strong></li>
                    <li>Gramaje de la Tapa Cotizada : <strong><?php echo $tapa->gramaje?></strong></li>   
                    <li>Descripción de la Tapa Seleccionada : <strong><?php echo $control_cartulina->descripcion_de_la_tapa; ?></strong></li>
                    <li>Gramaje de la Tapa Seleccionado : <strong><?php echo $control_cartulina->gramaje?></strong></li>                    
                    <li>Descripción de la Onda Cotizada : <strong><?php echo $materialidad_2->nombre?></strong></li>                    
                    <li>Gramaje de la onda Cotizada : <strong><?php echo $materialidad_2->gramaje?></strong></li>
                    <li>Cantidad de golpes : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                    <li>Total kilos Control Cartulina : <strong><?php echo $total_kilos_control_cartulina; ?></strong></li>                     
                    <li>Fecha liberación Imprenta producción : <strong><?php echo fecha($imprenta_produccion->cuando);?></strong></li>

                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Servicios Post Imprenta - Fast Track N° <?php echo $id?></h3></div>
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
                            <li><b>Placa :</b></li>
                            <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </li>                        
                    <?php } else { ?>
                           <li><b>Placa : </b></li>
                           <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>   </li>                        
                    <?php } ?>
                    <li><b><?php echo $fotomecanica->materialidad_datos_tecnicos.'aqui'; ?></b>:</li>
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Onda : <b>Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li><b>Onda : </b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><?php echo $monda->materiales_tipo.'&nbsp; '.$monda->gramaje; ?></li>   
                            <li><?php echo $hoja->onda_kilo.'&nbsp;'.$monda->gramaje; ?></li>                               
                    <?php } else { ?>
                            <li><b>Liner: </b><?php echo $mliner->materiales_tipo.'&nbsp; '.$mliner->gramaje; ?></li>   
                    <?php } ?>          
                     <li>Tamaño Pliego Cotizado: <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
                     <li>Tamaño Pliego Realmente Cortado: <strong><?php echo $corte_cartulina->ancho_realmente_cortado; ?> X <?php echo $corte_cartulina->largo_realmente_cortado;  ?> Cms</strong></li>
                     <li>Unidad Pliego: <strong><?php echo $ing->unidades_por_pliego; ?></strong></li>
                     <li>Repetición: <strong><?php  if($datos->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
                     <li>Traxado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Cromalin : <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                     <li>Colores : <strong><?php  echo $fotomecanica->colores; ?></strong></li>
                     <li>Barniz : <strong><?php echo $fotomecanica->fot_lleva_barniz; ?></strong></li>                     
                     <li>Reserva : <strong><?php echo $fotomecanica->fot_reserva_barniz; ?></strong></li>        
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                     <li>Piezas Adicionales: <strong><?php echo $ing->piezas_adicionales; ?></strong></li>  
                     <li>2da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales2; ?></strong></li>  
                     <li>3da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales3; ?></strong></li>                      
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul>
                    <?php
                    if($fotomecanica->acabado_impresion_4!='17')
                    {
                        $acabado_1=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                        ?>
                        <li>Proceso Externo 1 : <strong><?php echo $acabado_1->caracteristicas?></strong></li>
                        <?php
                    }
                    ?>
                    <?php
                    if($fotomecanica->acabado_impresion_5!='17')
                    {
                        $acabado_2=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                        ?>
                        <li>Proceso Externo 2 : <strong><?php echo $acabado_2->caracteristicas?></strong></li>
                        <?php
                    }
                    ?>
                    <?php
                    if($fotomecanica->acabado_impresion_6!='17')
                    {
                        $acabado_3=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                        ?>
                        <li>Proceso Externo 3 : <strong><?php echo $acabado_3->caracteristicas?></strong></li>
                        <?php
                    }
                    ?>                    
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Mts</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                     <li>Pliegos Buenos: <strong><?php echo $imprenta_produccion->total_pliegos_buenos; ?></strong></li>                      
                     <li>Pliegos Malos: <strong><?php echo $imprenta_produccion->total_pliegos_malos; ?></strong></li>                      
                     <li>Total Pliegos: <strong><?php echo $imprenta_produccion->cantidad_a_imprimir; ?></strong></li>                      
                     <li>Largo de pinza por el Gato: <strong><?php echo $imprenta_produccion->largo_de_pinza_gato; ?></strong></li>
                     <li>Precio Cotizado en H.C.: <strong><?php echo number_format($hoja->valor_empresa_2,2,',','.'); ?></strong></li>                     
                     
                </ul>
            	</div>  
            </div>

	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" placeholder="Descripción del trabajo" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Si o NO</label>
		<div class="controls">
            <select name="si_no">
                <option value="NO" <?php echo set_value_select($control,'si_no',$control->si_no,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'si_no',$control->si_no,'SI');?>>SI</option>
            </select>
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción trabajo externo</label>
		<div class="controls">
            <input type="text" name="descripcion_trabajo_externo" value="<?php echo set_value_input($control,'descripcion_trabajo_externo',$control->descripcion_trabajo_externo);?>" placeholder="Descripción trabajo externo" />
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
                    <option value="<?php echo $prove->id?>" <?php echo set_value_select($control,'proveedor',$control->proveedor,$prove->id);?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
       </div>
	</div> 
            
    <div class="page-header"><h3>Trabajos Externos</h3></div>                 
            
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
	<div class="controls">
        <?php
            if($fotomecanica->acabado_impresion_4==17) {
                $mostrar_combo_1=false; 
                $aca1=$datos->impresion_acabado_impresion_4;
                $arreglo_precio_acabado_1=$this->acabados_model->getAcabadosPorId($aca1);
                $precio_acabado_1=$arreglo_precio_acabado_1->costo_compra;
                    if ($control->id_proveedor_acabado_1!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
            } else {
                $mostrar_combo_1=true;                 
                $aca1=$fotomecanica->acabado_impresion_4;
                    if ($control->id_proveedor_acabado_1!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4); 
                }
                $arreglo_precio_acabado_1=$this->acabados_model->getAcabadosPorId($aca1);
//                print_r($proveedor_seleccionado);
                $precio_acabado_1=$arreglo_precio_acabado_1->costo_compra;                

            ?>
            <input type="hidden" id="id_acabado_externo_1" name="id_acabado_externo_1" value="<?php echo $aca1; ?>">            
            <select name="acabado_impresion_4"  disabled="true"  style="width: 500px;">
                <?php
                foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca1==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" readonly="true" name="input_variable_externo_4"  value="<?php echo $fotomecanica->input_variable_externo_4; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_1" <?php if(!$mostrar_combo_1) { ?> style="display:none;"<?php }?>>            
                <strong>Proveedor</strong>
		<select name="id_proveedor_acabado_1" id="id_proveedor_acabado_1">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $prove)
                {
                    if ($control->id_proveedor_acabado_1!='')
                    {     
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($control->id_proveedor_acabado_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    } else { ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php }
                }
                ?>
                </select>
                </br>
                <strong>Precio Referencia:</strong>    
                <?php $precio1=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales); ?>
		<input style="width: 60px;" readonly="true"  type="text" id="precio_referencia_1" name="precio_referencia_1" value="<?php echo $precio_acabado_1; ?>" placeholder="0">
                </br>
                <strong>Precio:</strong>                 
		<input style="width: 60px;" type="text" id="precio1" name="precio1" value="<?php if ($ordenes_compras_trabajos_externos->precio_venta1!='') echo $ordenes_compras_trabajos_externos->precio_venta1; else echo $precio_acabado_1; ?>" placeholder="0">	                
            </div>                
	</div>
    </div>  
    
            
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Acabado Impresión Externo 1 Para Proveedor</label>
		<div class="controls">
			<textarea id="comentarios_acabados_1" name="comentarios_acabados_1" placeholder="Comentarios Acabado Impresión Externo 1"><?php echo $control->comentarios_imprenta?></textarea>
		</div>
	</div>   

            
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
	<div class="controls">
        <?php
            if($fotomecanica->acabado_impresion_5==17) {
               $mostrar_combo_2=false;                   
               $aca2=$datos->impresion_acabado_impresion_5;  
                    if ($control->id_proveedor_acabado_2!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                } else {
                $mostrar_combo_2=true;                   
                $aca2=$fotomecanica->acabado_impresion_5;
                    if ($control->id_proveedor_acabado_2!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                }
                $arreglo_precio_acabado_2=$this->acabados_model->getAcabadosPorId($aca2);
                $precio_acabado_2=$arreglo_precio_acabado_2->costo_compra;                  
            ?>
            <input type="hidden" id="id_acabado_externo_2" name="id_acabado_externo_2" value="<?php echo $aca2; ?>">                        
            <select name="acabado_impresion_5"  disabled="true" onchange="carga_ajax_obtenerKilos(this.value,'kilos_externo_4');"  style="width: 500px;">
                <?php foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca2==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica->input_variable_externo_5==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" readonly="true" name="input_variable_externo_5"  value="<?php echo $fotomecanica->input_variable_externo_5; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_2" <?php if(!$mostrar_combo_2) { ?> style="display:none;"<?php }?>>            
                <strong>Proveedor</strong>
		<select name="id_proveedor_acabado_2" id="id_proveedor_acabado_2">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $prove)
                {
                    if ($control->id_proveedor_acabado_2!='')
                    {     
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($control->id_proveedor_acabado_2==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    } else { ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php }
                }
                ?>                
                </select>      
                </br>
                <strong>Precio Referencia:</strong>    
                <?php $precio1=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales); ?>
		<input style="width: 60px;" readonly="true"  type="text" id="precio_referencia_2" name="precio_referencia_2" value="<?php echo $precio_acabado_2; ?>" placeholder="0">
                </br>
                <strong>Precio:</strong>                 
		<input style="width: 60px;" type="text" id="precio2" name="precio2" value="<?php if ($ordenes_compras_trabajos_externos->precio_venta2!='') echo $ordenes_compras_trabajos_externos->precio_venta1; else echo $precio_acabado_2 ?>" placeholder="0">	                
            </div>                
	</div>
    </div> 
    
                    
        
        
       
            

     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Acabado Impresión Externo 2 Para Proveedor</label>
		<div class="controls">
			<textarea id="comentarios_acabados_2" name="comentarios_acabados_2" placeholder="Comentarios Acabado Impresión Externo 2"><?php echo $control->comentarios_imprenta?></textarea>
		</div>
	</div>               


    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
	<div class="controls">
        <?php
            if($fotomecanica->acabado_impresion_6==17)  {
               $mostrar_combo_3=false;                   
               $aca3=$datos->impresion_acabado_impresion_6;   
                if ($control->id_proveedor_acabado_3!="")
                    $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                else
                    $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                }else {
               $mostrar_combo_3=true;                   
               $aca3=$fotomecanica->acabado_impresion_6;
                if ($control->id_proveedor_acabado_3!="")
                    $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                else
                    $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);            
                }
                $arreglo_precio_acabado_3=$this->acabados_model->getAcabadosPorId($aca3);
                $precio_acabado_3=$arreglo_precio_acabado_3->costo_compra;                      
            ?>
            <input type="hidden" id="id_acabado_externo_3" name="id_acabado_externo_3" value="<?php echo $aca3; ?>">                        
            <select name="acabado_impresion_5"  disabled="true"  onchange="carga_ajax_obtenerKilos(this.value,'kilos_externo_4');"  style="width: 500px;">
                <?php foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca3==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php  } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica->input_variable_externo_5==0) { ?> style="display:none;"<?php }?>>
                <input type="text" readonly="true" name="input_variable_externo_6"  value="<?php echo $fotomecanica->input_variable_externo_6; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_3" <?php if(!$mostrar_combo_3) { ?> style="display:none;"<?php }?>>
                <strong>Proveedor</strong>
		<select name="id_proveedor_acabado_3" id="id_proveedor_acabado_3">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $prove)
                {
                    if ($control->id_proveedor_acabado_3!='')
                    {     
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($control->id_proveedor_acabado_3==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    } else { ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php }
                }
                ?>                    
                </select>                     
                </br>
                <strong>Precio Referencia:</strong>    
                <?php $precio1=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales); ?>
		<input style="width: 60px;" readonly="true"  type="text" id="precio_referencia_3" name="precio_referencia_3" value="<?php echo $precio_acabado_3; ?>" placeholder="0">
                </br>
                <strong>Precio:</strong>                 
		<input style="width: 60px;" type="text" id="precio3" name="precio3" value="<?php if ($ordenes_compras_trabajos_externos->precio_venta1!='') echo $ordenes_compras_trabajos_externos->precio_venta1; else echo $precio_acabado_3; ?>" placeholder="0">	                
            </div>            
       
	</div>
    </div>          
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Acabado Impresión Externo 3 Para Proveedor</label>
		<div class="controls">
			<textarea id="comentarios_acabados_3" name="comentarios_acabados_3" placeholder="Comentarios Acabado Impresión Externo 3"><?php echo $control->comentarios_imprenta?></textarea>
		</div>
	</div>      
            
	<div class="control-group">
		<label class="control-label" for="usuario">Empresas que envia Orden:</label>
		<div class="controls">
                <select name="empresa" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $clientes_fastrack=$this->clientes_model->getClientesNormalFast();
                foreach($clientes_fastrack as $clientes)
                {
                    ?>
                    <option value="<?php echo $clientes->id?>" <?php if($clientes->id==$ordenes_compras_trabajos_externos->empresa){echo 'selected="true"';}?>><?php echo $clientes->razon_social?></option>
                    <?php
                }
                ?>
                    ?>
                </select>   
                    Quien la Emite 
		<select name="envia" id="envia">
                <?php
                foreach($usuarios_orden_compra as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($ordenes_compras_trabajos_externos->envia==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>  
                </select>                      
                    Quien la Recibe
		<select name="recibe" id="recibe">
                <?php
                foreach($usuarios_orden_compra as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($ordenes_compras_trabajos_externos->recibe==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>       
                </select>                      
		</div>
	</div>           
    
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Tipo de Despacho</label>
		<div class="controls">
		<select name="tipo_despacho" id="tipo_despacho">
                    <option value="1" <?php if($ordenes_compras_trabajos_externos->tipo_despacho==1){echo 'selected="true"';}?>>Proveedor entrega en Nuestras Bodegas</option>                    
                    <option value="2" <?php if($ordenes_compras_trabajos_externos->tipo_despacho==2){echo 'selected="true"';}?>>Nosotros Retiramos</option>                    
                    <option value="3" <?php if($ordenes_compras_trabajos_externos->tipo_despacho==3){echo 'selected="true"';}?>>Proveedor Envia por Tercero por cuenta de él</option>                    
                    <option value="4" <?php if($ordenes_compras_trabajos_externos->tipo_despacho==4){echo 'selected="true"';}?>>Proveedor Envia por Tercero por cuenta Nuestra</option>                    
                </select>  
                    Sección:                    
		<select name="tipo_seccion" id="tipo_seccion">
                    <option value="1" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==1){echo 'selected="true"';}?>>Mantención</option>                    
                    <option value="2" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==2){echo 'selected="true"';}?>>Administración</option>                    
                    <option value="3" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==3){echo 'selected="true"';}?>>Imprenta</option>                    
                    <option value="4" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==4){echo 'selected="true"';}?>>Troquelado</option>                    
                    <option value="5" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==5){echo 'selected="true"';}?>>Pegado</option>                    
                    <option value="6" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==6){echo 'selected="true"';}?>>Corrugado</option>                    
                    <option value="7" <?php if($ordenes_compras_trabajos_externos->tipo_seccion==7){echo 'selected="true"';}?>>Otros</option>                          
                </select>                        
                </div>
	</div>          
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Fecha de Entrega</label>
		<div class="controls">
		<input type="date" name="fecha_entrega" value="<?php echo $ordenes_compras_trabajos_externos->fecha_entrega?>" />
		</div>
	</div>    
        
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Guardar Orden de Trabajos Externos</label>
		<div class="controls">
        	<input type="button" value="Imprimir Orden de Trabajos Externos" class="btn <?php if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarOrdenCompraTrabajosExternos();" />
		</div>
	</div>         
	<div class="page-header"></div>      
            
             
            
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño cartulina</label>
		<div class="controls">
            <input type="text" name="tamano_cartulina" value="<?php echo set_value_input($control,'tamano_cartulina',$control->tamano_cartulina);?>" placeholder="Tamaño cartulina" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad de pliegos  (Validar solo numero) </label>
		<div class="controls">
            <input type="text" name="cantidad_de_pliegos" value="<?php echo set_value_input($control,'cantidad_de_pliegos',$control->cantidad_de_pliegos);?>" placeholder="Cantidad de pliegos" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Enviar instrucciones de despacho</label>
		<div class="controls">
            <input type="text" name="instrucciones_de_despacho" value="<?php echo set_value_input($control,'instrucciones_de_despacho',$control->instrucciones_de_despacho);?>" placeholder="Enviar instrucciones de despacho" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Fecha recepción pedido</label>
		<div class="controls">
            <input type="date" name="fecha_recepcion_pedido" value="<?php echo set_value_input($control,'fecha_recepcion_pedido',$control->fecha_recepcion_pedido);?>" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total o parcial <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="total_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')">
                <option value="Total" <?php echo set_value_select($control,'total_o_parcial',$control->total_o_parcial,'Total');?>>Total</option>
                <option value="Parcial" <?php echo set_value_select($control,'total_o_parcial',$control->total_o_parcial,'Parcial');?>>Parcial</option>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="cantidadesDespacho" style="display: <?php if($control->total_o_parcial=='Total'){echo 'none';}else{echo 'block';}?>;">
           <div>
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                <input type="text" name="can_despacho_1" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="%" value="<?php echo set_value_input($control,'can_despacho_1',$control->can_despacho_1);?>" /> - <input type="text" name="can_despacho_2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="%" value="<?php echo set_value_input($control,'can_despacho_2',$control->can_despacho_2);?>" /> - <input type="text" name="can_despacho_3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="%" value="<?php echo set_value_input($control,'can_despacho_3',$control->can_despacho_3);?>" />
                </div>
                </div>
     </div>
    
    <input type="hidden" name="direccion_proveedor" />
    <input type="hidden" name="horario_proveedor" />
    <input type="hidden" id="cantidad" name="cantidad" value="<?php echo $cotizacion->cantidad_1;?> " />    
    <input type="hidden" name="despachador" />
    <input type="hidden" name="camion_de_despacho" />
    <input type="hidden" name="chofer" />
    
    
    <!--
<div class="control-group">
		<label class="control-label" for="usuario">Dirección proveedor</label>
		<div class="controls">
            <input type="text" name="direccion_proveedor" value="<?php echo $control->direccion_proveedor?>" placeholder="Dirección proveedor" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Horario proveedor</label>
		<div class="controls">
            <input type="text" name="horario_proveedor" value="<?php echo $control->horario_proveedor?>" placeholder="Horario proveedor" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Despachador</label>
		<div class="controls">
            <input type="text" name="despachador" value="<?php echo $control->despachador?>" placeholder="Despachador" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Camión de despacho</label>
		<div class="controls">
            <input type="text" name="camion_de_despacho" value="<?php echo $control->camion_de_despacho?>" placeholder="Camión de despacho" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Chofer</label>
		<div class="controls">
            <input type="text" name="chofer" value="<?php echo $control->chofer?>" placeholder="Chofer" />
       </div>
	</div>
-->
    
    
    
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
            <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
			<input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" />
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
