<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php //   print_r($control); ?>
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
            <li>Imprenta Programación - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Imprenta Programación - Fast Track N° <?php echo $id?></li>
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
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Imprenta Programación - Orden de Producción N° <?php echo $id?></h3></div>
            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 480px;">
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
//                    print_r($ing);
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
                    <li><strong> PDF trazado de Ingeniería </strong> <a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                    <?php if(!empty($fotomecanica2->pdf_imagen)){?> 
                    <li><strong> PDF imagen </strong> <a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica2->pdf_imagen ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    
                        <?php
                        if(sizeof($control_cartulina)==0)
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
                    if($control_cartulina->estado==1)
                    {
                        ?>
                       <li>Fecha liberación control cartulina : <strong><?php echo fecha($control_cartulina->cuando)?></strong></li> 
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
                    <?php
                     if($control->total_o_parcial=='Total' and sizeof($control)>0)
                     {
                         $total=$corte_cartulina->total_pliegos_cortados;
                        ?>
                        <li>Saldo pliegos a imprimir : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                        <?php
                     }else
                     {
                       $parcial=$control->can_despacho_1+$control->can_despacho_2+$control->can_despacho_3; 
                       $total=$corte_cartulina->total_pliegos_cortados-$parcial;
                       ?>
                       <li>Saldo pliegos a imprimir : <strong><?php echo $total?></strong></li>
                       <?php
                     }
                     ?>
                    <li>Descripción de la Tapa Cotizada : <strong><?php echo $tapa->nombre?></strong></li>
                    <li>Gramaje de la Tapa Cotizada : <strong><?php echo $tapa->gramaje?></strong></li>   
                    <li>Descripción de la Tapa Seleccionada : <strong><?php echo $control_cartulina->descripcion_de_la_tapa; ?></strong></li>
                    <li>Gramaje de la Tapa Seleccionado : <strong><?php echo $control_cartulina->gramaje?></strong></li>                    
                    <li>Descripción de la Onda Cotizada : <strong><?php echo $materialidad_2->nombre?></strong></li>                    
                    <li>Gramaje de la onda Cotizada : <strong><?php echo $materialidad_2->gramaje?></strong></li>   
                    <li>Total kilos Control Cartulina : <strong><?php echo $total_kilos_control_cartulina; ?></strong></li>                     
                </ul>
            	</div>         
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Imprenta Programación - Fast Track N° <?php echo $id?></h3></div>
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
                <ul><?php
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
                     <li>Tamaño Pliego Cotizado: <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
                     <li>Tamaño Pliego Realmente Cortado: <strong><?php echo $corte_cartulina->ancho_realmente_cortado; ?> X <?php echo $corte_cartulina->largo_realmente_cortado;  ?> Cms</strong></li>
                     <li>Unidad Pliego: <strong><?php echo $ing->unidades_por_pliego; ?></strong></li>
                     <li>Repetición: <strong><?php  if($datos->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
                     <li>Traxado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Cromalin : <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                     <li>Colores : <strong><?php  echo $fotomecanica2->colores; ?></strong></li>
                     <?php// echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
                     <li>Barniz : <strong><?php echo $fotomecanica2->fot_lleva_barniz; ?></strong></li>        
                     <li>Reserva : <strong><?php echo $fotomecanica2->fot_reserva_barniz; ?></strong></li>        
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                     <li>Piezas Adicionales: <strong><?php echo $ing->piezas_adicionales; ?></strong></li>  
                     <li>2da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales2; ?></strong></li>  
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;margin-top: 0%;">
                <ul>
                     <li>3da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales3; ?></strong></li>                      
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica2->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Mts</strong></li>        
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($corte_cartulina->largo_realmente_cortado-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                </ul>
            	</div>                     
            </div>                     
	<p>
         
    </p>
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" placeholder="Descripción del trabajo" />
       </div>
	</div> 
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño a imprimir <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_a_imprimir_1" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $corte_cartulina->ancho_realmente_cortado; ?>" placeholder="0" readonly="true" /> X <input type="text" name="tamano_a_imprimir_2" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $corte_cartulina->largo_realmente_cortado; ?>" placeholder="0" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<input type="text" name="colores" value="<?php echo $fotomecanica2->colores?>" readonly="true" />
		</div> 
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Procesos adicionales <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                <?php if(($fotomecanica2->acabado_impresion_1==17) || ($fotomecanica2->acabado_impresion_2==17) || ($fotomecanica2->acabado_impresion_3==17)){ ?>              
			<input type="text" name="procesos_adicionales" value="NO" placeholder="Procesos adicionales"  readonly="true" /> 
                <?php } else  { ?> 
			<input type="text" name="procesos_adicionales" value="SI" placeholder="Procesos adicionales"  readonly="true" /> 
                <?php } ?>                         
        </div>
	</div>
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
	<div class="controls">
        <?php
            if($fotomecanica2->acabado_impresion_4==17) {
                $mostrar_combo_1=false; 
                $aca1=$datos->impresion_acabado_impresion_4;
                    if ($control->id_proveedor_acabado_1!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
            } else {
                $mostrar_combo_1=true;                 
                $aca1=$fotomecanica2->acabado_impresion_4;
                    if ($control->id_proveedor_acabado_1!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4); 
                }
//            print_r($externos);
            ?>
            <select name="acabado_impresion_4"  disabled="true"  onchange="carga_ajax_obtenerKilos(this.value,'kilos_externo_4');"  style="width: 500px;">
                <?php
                foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca1==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica2->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" readonly="true" name="input_variable_externo_4"  value="<?php echo $fotomecanica2->input_variable_externo_4; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_1" <?php if(!$mostrar_combo_1) { ?> style="display:none;"<?php }?>>            
                Proveedor
		<select name="id_proveedor_acabado_1" id="id_proveedor_acabado_1">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                </select>
            </div>                
	</div>
    </div>  
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
	<div class="controls">
        <?php
            if($fotomecanica2->acabado_impresion_5==17) {
               $mostrar_combo_2=false;                   
               $aca2=$datos->impresion_acabado_impresion_5;  
                    if ($control->id_proveedor_acabado_2!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                } else {
                $mostrar_combo_2=true;                   
                $aca2=$fotomecanica2->acabado_impresion_5;
                    if ($control->id_proveedor_acabado_2!="")
                        $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                    else
                        $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                }
            ?>
            <select name="acabado_impresion_4"  disabled="true" onchange="carga_ajax_obtenerKilos(this.value,'kilos_externo_4');"  style="width: 500px;">
                <?php foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca2==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica2->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" readonly="true" name="input_variable_externo_4"  value="<?php echo $fotomecanica2->input_variable_externo_5; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_2" <?php if(!$mostrar_combo_2) { ?> style="display:none;"<?php }?>>            
                Proveedor
		<select name="id_proveedor_acabado_2" id="id_proveedor_acabado_2">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                </select>      
            </div>                
	</div>
    </div> 


    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
	<div class="controls">
        <?php
            if($fotomecanica2->acabado_impresion_6==17)  {
               $mostrar_combo_3=false;                   
               $aca3=$datos->impresion_acabado_impresion_6;   
                if ($control->id_proveedor_acabado_3!="")
                    $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                else
                    $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);
                }else {
               $mostrar_combo_3=true;                   
               $aca3=$fotomecanica2->acabado_impresion_6;
                if ($control->id_proveedor_acabado_3!="")
                    $proveedor_seleccionado=$control->id_proveedor_acabado_1;
                else
                    $proveedor_seleccionado=$this->acabados_model->getAcabadoPorIdImprenta($datos->impresion_acabado_impresion_4);            }
            ?>
            <select name="acabado_impresion_4"  disabled="true"  onchange="carga_ajax_obtenerKilos(this.value,'kilos_externo_4');"  style="width: 500px;">
                <?php foreach($externos as $externo) { ?>
                <option value="<?php echo $externo->id?>" <?php if($aca3==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php  } ?>
            </select>
            <?php // $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
            </br>
            <div id="kilos_externo_4" <?php if($fotomecanica2->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
                <input type="text" readonly="true" name="input_variable_externo_4"  value="<?php echo $fotomecanica2->input_variable_externo_6; ?>" />&nbsp;&nbsp;Kilos   
            </div>
            <div id="proveedor_3" <?php if(!$mostrar_combo_3) { ?> style="display:none;"<?php }?>>
                Proveedor
		<select name="id_proveedor_acabado_3" id="id_proveedor_acabado_3">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($proveedor_seleccionado->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                </select>                     
            </div>            
       
	</div>
    </div>     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Máquina a imprimir <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            
			<select name="maquina">
                <?php
                $maquinas=listadoMaquinas();
                for($i=0;$i<sizeof($maquinas);$i++)
                {
                    ?>
                    <option value="<?php echo $maquinas[$i]?>" <?php echo set_value_select($control,'maquina',$control->maquina,$maquinas[$i]);?>><?php echo $maquinas[$i]?></option>
                    <?php
                }
                ?>
                
            </select>
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Confección de Troquel <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="troquel" onchange="imprentaProgramacion(this.value);">
                <option value="Interno" <?php echo set_value_select($control,'troquel',$control->troquel,'Interno');?>>Interno</option>
                <option value="Externo" <?php echo set_value_select($control,'troquel',$control->troquel,'Externo');?>>Externo</option>
            </select> 
        </div>
	</div>
    
    <div id="proveedor" style="display: <?php if($control->troquel=='Externo'){echo 'block';}else{echo 'none';}?>;">
        <div class="control-group">
    		<label class="control-label" for="usuario">Proveedor Troquel</label>
    		<div class="controls">
    			<select name="proveedor">
                    <?php
                    $proves=$this->proveedores_model->getProveedoresPorRubro('troquel');
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
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción cartulina</label>
		<div class="controls">
                <?php if($control_cartulina->descripcion_de_la_tapa!='') {?>
			<input type="text" name="descripcion_cartulina" value="<?php echo $control_cartulina->descripcion_de_la_tapa;?>" readonly="true" /> 
                <?php } else {?>
			<input type="text" name="descripcion_cartulina" value="<?php echo $tapa->nombre; ?>" readonly="true" />                         
                <?php } ?>                                            
        </div>
	</div>
       
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
                <?php if($control_cartulina->gramaje!='') {?>
			<input type="text" name="gramaje" value="<?php echo $control_cartulina->gramaje;?>" readonly="true" /> 
                <?php } else {?>
			<input type="text" name="gramaje" value="<?php echo $tapa->gramaje; ?>" readonly="true" />                         
                <?php } ?>                     
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="cantidad" value="<?php if ($control->cantidad=='') echo $total; else echo $control->cantidad; ?>" placeholder="Cantidad" /> 
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
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Importantes</label>
		<div class="controls">
			<textarea id="comentarios_imprenta" name="comentarios_imprenta" placeholder="Comentarios Importantes"><?php echo $control->comentarios_imprenta?></textarea>
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
            <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
			
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
