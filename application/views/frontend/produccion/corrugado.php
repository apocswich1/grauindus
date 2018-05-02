<?php $this->layout->element('admin_mensaje_validacion');  ?>
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
            <li>Corrugado - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Corrugado - Fast Track N° <?php echo $ordenDeCompra->id?></li>
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
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Corrugado - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
                        <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 420px;">
                            <div class="controls" style="margin-left: 0px;width:40%;float:left;">               
            <ul>
                <?php
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                $ccac1=$confeccion_molde_troquel->tamano_cuchillo_1-$ing->tamano_a_imprimir_1;
                $ccac2=$confeccion_molde_troquel->tamano_cuchillo_2-$ing->tamano_a_imprimir_2;
                /******************Añadido por ehndz para traer el valor real de la onda***********************/
                $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
                /*****************************************/
                if($orden->tiene_molde=='NO')
                {
                    $moldeNuevo='Molde Antiguo';
                }else
                {
                    $moldeNuevo='Molde nuevo';
                }
                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                ?>
                    
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>	                
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $molde->id?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li><strong>PDF trazado de Ingeniería </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                    <?php if(!empty($fotomecanica->archivo)){?> 
                    <li><strong>PDF imagen </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                        <?php
                        if(sizeof($control_papel)==0 or sizeof($bobinado_onda)==0 or sizeof($bobinado_onda)==0)
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
                    
<!--                    <li>CCAC1 : <strong><?php // echo $ccac1?></strong></li>
                    <li>CCAC2 : <strong><?php // echo $ccac2?></strong></li>-->
                    <li>Descripción de la Tapa Cotizada : <strong><?php echo $tapa->nombre?></strong></li>
                    <li>Gramaje de la Tapa Cotizada : <strong><?php echo $tapa->gramaje?></strong></li>   
                    <li>Descripción de la Tapa Seleccionada : <strong><?php echo $control_cartulina->descripcion_de_la_tapa; ?></strong></li>
                    <li>Gramaje de la Tapa Seleccionado : <strong><?php echo $control_cartulina->gramaje?></strong></li>                    
                    <li>Descripción de la Onda Cotizada : <strong><?php echo $materialidad_2->nombre?></strong></li>                    
                    <li>Gramaje de la onda Cotizada : <strong><?php echo $materialidad_2->gramaje?></strong></li>   
                    <li>Gramaje de la onda Seleccionada : <strong><?php echo $control_onda->gramaje_seleccionado?></strong></li>   
                    <li>Total kilos Control Cartulina : <strong><?php echo $total_kilos_control_cartulina; ?></strong></li>                     
                    <?php
                    if($imprenta_produccion->estado==1)
                    {
                        ?>
                        <li>Fecha liberación imprenta producción : <strong><?php echo fecha($imprenta_produccion->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <?php
                    if($control_papel->estado==1)
                    {
                        ?>
                        <li>Fecha liberación control papel : <strong><?php echo fecha($control_papel->cuando)?></strong></li>
                        <?php
                    }
                    ?>

                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Corrugado - Fast Track N° <?php echo $id?></h3></div>
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
                            <li><b>Placa :</b></li>
                            <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </li>                        
                    <?php } else { ?>
                           <li><b>Placa : </b></li>
                           <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>   </li>                        
                    <?php } ?>
                    <li><b><?php echo $fotomecanica->materialidad_datos_tecnicos; ?></b>:</li>
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
                     <li>Tamaño Pliego Realmente Cortado: <strong><?php echo $corte_cartulina->ancho_realmente_cortado; ?> X <?php echo $corte_cartulina->largo_realmente_cortado;?> Cms</strong></li>                        
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
                     <li>Total pliegos impresos : <strong><?php echo $imprenta_produccion->total_pliegos_buenos?></strong></li>
                     <li>Largo pinza : <strong><?php echo $imprenta_produccion->largo_de_pinza?></strong></li>                        
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <!--<li>CCAC2 : <strong><?php // echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     -->
                     <li>CCAC2 : <strong><?php echo (($corte_cartulina->largo_realmente_cortado-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                     <li>Largo de Pinza : <strong><?php echo $pinza->largo_de_pinza; ?></strong></li>                     
                     <li>Largo de Pinza por Cola : <strong><?php echo $pinza->largo_de_pinza_por_cola; ?> </strong></li>                     
                     <li>Largo en Gato Tiro Derecho : <strong><?php echo $pinza->largo_de_pinza_gato_derecho; ?> </strong></li>                     
                     <li>Largo en Gato Retiro Izquierdo : <strong><?php echo $pinza->largo_de_pinza_gato_derecho; ?> </strong></li>                     
                </ul>
            	</div>  
            </div>
                            
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
			<input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
  
    <div class="control-group">
		<label class="control-label" for="usuario">Onda a usar</label>
		<div class="controls">
			<!--<input type="text" name="onda_a_usar" value="<?php //echo $materialidad_1->nombre?>" readonly="true" />-->
			<input type="text" name="onda_a_usar" value="<?php echo $control_onda->gramaje_seleccionado?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho onda a usar</label>
		<div class="controls">
			<!--modificado ehndz para corregir valor <input type="text" name="ancho_de_onda_a_usar" value="<?php //echo $materialidad_1->ancho?>" readonly="true" />-->
			<input type="text" name="ancho_de_onda_a_usar" value="<?php echo $control_onda->ancho_seleccionado_de_bobina ?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Liner a usar</label>
		<div class="controls">
			<input type="text" name="liner_a_usar" value="<?php echo $materialidad_3->nombre?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho Liner a usar</label>
		<div class="controls">
			<!-- modificado ehndz para corregir valor <input type="text" name="ancho_de_liner_a_usar" value="<?php //echo $materialidad_3->ancho?>" readonly="true" />-->
			<input type="text" name="ancho_de_liner_a_usar" value="<?php echo $control_onda->ancho_a_usar_onda; ?>" readonly="true" />
		</div>
	</div>
    
<!-- comentado por ehndz no va este campo   <div class="control-group">
		<label class="control-label" for="usuario">Tamaño a fabricar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_a_fabricar" placeholder="Tamaño a fabricar" value="<?php //echo set_value_input($control,'tamano_a_fabricar',$control->tamano_a_fabricar);?>" />
		</div>
	</div>-->
    <?php
    $anchoW=$corte_cartulina->ancho_realmente_cortado*10-5; 
    //$largoH=90;
    $largoH=$corte_cartulina->largo_realmente_cortado*10-5;
    $c1=$ing->tamano_cuchillo_1;
    $c2=$ing->tamano_cuchillo_2;
    if(($anchoW/10 > $c1) && ($largoH/10 > $c2)){
        $se_puede_currugar=1;
    }else{
        $se_puede_currugar=0;
    }
    
    ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño (Ancho x Largo) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                <!--comentada por ehndz <input type="text" name="tamano_1" placeholder="Ancho" value="<?php //echo set_value_input($control,'tamano_1',$control->tamano_1);?>" /><input type="text" name="tamano_2" placeholder="Largo" value="<?php //echo set_value_input($control,'tamano_2',$control->tamano_2);?>" />-->
                <input type="text" name="tamano_1" placeholder="Ancho" value="<?php echo $anchoW;?>" /><input type="text" name="tamano_2" placeholder="Largo" value="<?php echo $largoH;?>" />
                    <?php if($se_puede_currugar <> 1){
                    echo "<span style='color:red; font-weight:bold;'>No se puede corrugar</span>";
                    }?>
                    
		</div>
	</div>
    
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Tamaño Cuchillo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_cuchillo_1" placeholder="Tamaño Cuchillo 1" value="<?php echo $control->tamano_1?>" /><input type="text" name="tamano_cuchillo_2" placeholder="Tamaño Cuchillo 2" value="<?php echo $control->tamano_cuchillo_1?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Pinza</label>
		<div class="controls">
			<input type="text" name="pinza" value="<?php echo $imprenta_produccion->largo_de_pinza?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Reverso a usar</label>
		<div class="controls">
			<input type="text" name="reverso_a_usar" value="<?php echo $materialidad_3->reverso?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos a fabricar</label>
		<div class="controls">
			<input type="text" name="total_pliegos_a_fabricar" value="<?php echo $imprenta_produccion->total_pliegos_buenos?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios2 as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($control->operador==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ayudante 1 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante_1">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->ayudante_1==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Ayudante 2 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante_2">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->ayudante_2==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ayudante 3 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante_3">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->ayudante_3==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos producidos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_producidos" placeholder="Total pliegos producidos" value="<?php echo set_value_input($control,'total_pliegos_producidos',$control->total_pliegos_producidos);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total tarimas producidas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_tarimas_producidas" placeholder="Total tarimas producidas" value="<?php echo set_value_input($control,'total_tarimas_producidas',$control->total_tarimas_producidas);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho a corrugar</label>
		<div class="controls">
			<input type="text" name="ancho_a_corrugar" value="<?php echo set_value_input($control,'ancho_a_corrugar',$control->ancho_a_corrugar);?>" placeholder="Ancho a corrugar" />
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
<?php //print_r($control_onda);?>
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
