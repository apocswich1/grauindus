<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php   // print_r($control); ?>
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
            <li>Imprenta Producción - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Imprenta Producción - Fast Track N° <?php echo $id?></li>
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
            <div onclick="ver_informacion('informacion')"   class="page-header"><h3>Imprenta Producción - Orden de Producción N° <?php echo $id?></h3></div>
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
                    
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div onclick="ver_informacion('informacion')"   class="page-header"><h3>Imprenta Producción - Fast Track N° <?php echo $id?></h3></div>
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
                     <?php echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
                     <li>Reserva : <strong><?php echo $fotomecanica->reserva_barniz; ?></strong></li>        
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                     <li>Piezas Adicionales: <strong><?php echo $ing->piezas_adicionales; ?></strong></li>  
                     <li>2da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales2; ?></strong></li>  
                     <li>3da Pieza Adicional: <strong><?php echo $ing->piezas_adicionales3; ?></strong></li>                      
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Mts</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <!--<li>CCAC2 : <strong><?php //echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     -->
                     <li>CCAC2 : <strong><?php echo (($corte_cartulina->largo_realmente_cortado-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                     </ul>
                     <strong>Trabajos Internos</strong>
                <ul>
                     <li>Acabado Impresión Interno 1 : <strong><?php echo $fotomecanica->acabado_impresion_1 ?></strong></li>                     
                     <li>Acabado Impresión Interno 2 : <strong><?php echo $fotomecanica->acabado_impresion_2 ?> </strong></li>                     
                     <li>Acabado Impresión Interno 3 : <strong><?php echo $fotomecanica->acabado_impresion_3 ?> </strong></li>                     
                </ul>
                <strong>Trabajos Externos</strong>
                <ul>                     
                     <li>Acabado Impresión Enterno 1 : <strong><?php echo $fotomecanica->acabado_impresion_4 ?></strong></li>                     
                     <li>Acabado Impresión Enterno 2 : <strong><?php echo $fotomecanica->acabado_impresion_5 ?> </strong></li>                     
                     <li>Acabado Impresión Enterno 3 : <strong><?php echo $fotomecanica->acabado_impresion_6 ?> </strong></li>                     
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
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<input type="text" name="colores" value="<?php echo $fotomecanica->colores?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Metálicos o Fluor</label>
		<div class="controls">
            <input type="text" name="colores_metalicos" value="<?php echo $fotomecanica->colores_metalicos?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño a imprimir</label>
		<div class="controls">
			<input type="text" name="tamano_a_imprimir_1" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $ing->tamano_a_imprimir_1 ?>" placeholder="0" readonly="true" /> X <input type="text" name="tamano_a_imprimir_2" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $corte_cartulina->largo_realmente_cortado; ?>" placeholder="0" readonly="true" />
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño real cartulina</label>
		<div class="controls">
                <?php // if($control->tamano_real_cartulina>0) {?>
                    <input type="text" name="tamano_real_cartulina" readonly="true" value="<?php // echo set_value_input($control,'tamano_real_cartulina',$control->tamano_real_cartulina);?>" placeholder="Tamaño real cartulina" />
                <?php // } else {?>
			<input type="text" name="tamano_real_cartulina" readonly="true" value="<?php // echo $corte_cartulina->ancho_realmente_cortado; ?> X <?php // echo $corte_cartulina->largo_realmente_cortado;  ?> Cms" readonly="true" />                         
                <?php // } ?>                       
		</div>
	</div>-->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Imprimir por Gato</label>
		<div class="controls">
			<input type="text" name="gato" value="<?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';}?>" readonly="true" />
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
		<label class="control-label" for="usuario">Cantidad Parcial</label>
			<div class="controls">
				<input type="text" name="can_parcial" value="<?php echo number_format($bobinado_liner->can_parcial,0,'','');?>" />
		   </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción de la tapa</label>
		<div class="controls">
			<input type="text" readonly="true" name="tipo_cartulina" placeholder="Descripción de la tapa" value="<?php if ($control->tipo_cartulina=='') echo $control_cartulina->descripcion_de_la_tapa; else echo set_value_input($control,'tipo_cartulina',$control->tipo_cartulina);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo $materialidad_1->gramaje?>" readonly="true" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
            <input type="text" name="barniz" value="<?php echo $fotomecanica->lleva_barniz?>" readonly="true" /> 
		</div>
	</div>
    
    <div class="control-group">
<label class="control-label" for="usuario">LLeva Laca</label>
		<div class="controls">
            <select name="laca">
                <option value="">Seleccione</option>
                <option value="NO" <?php echo set_value_select($control,'laca',$control->laca,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'laca',$control->laca,'SI');?>>SI</option>
            </select> 
		</div>
	</div>
    

    
    <div class="control-group">
		<label class="control-label" for="usuario">Maestro <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		<select name="maestro">
                <option value="">Seleccione</option>
                <?php
                foreach($usuarios2 as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php echo set_value_select($control,'maestro',$control->maestro,$usuario2->id);?>><?php echo $usuario2->nombre?></option>
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
                <option value="">Seleccione</option>
                            
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control,'ayudante_1',$control->ayudante_1,$usuario->id);?>><?php echo $usuario->nombre?></option>
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
                <option value="">Seleccione</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control,'ayudante_2',$control->ayudante_2,$usuario->id);?>><?php echo $usuario->nombre?></option>
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
                <option value="">Seleccione</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control,'ayudante_3',$control->ayudante_3,$usuario->id);?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a imprimir</label>
		<div class="controls">
                <?php if($imprenta_programacion->cantidad>0) {?>
            <input type="text" name="cantidad_a_imprimir" value="<?php echo $imprenta_programacion->cantidad; ?>" readonly="true" /> 
                <?php } else {?>
			<input type="text" name="cantidad_a_imprimir" readonly="true" value="<?php echo $hoja->placa_kilo; ?>" readonly="true" />                         
                <?php } ?>                      
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos buenos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text"  onblur="multiplicarPliegos();"  name="total_pliegos_buenos" value="<?php if ($control->total_pliegos_buenos=='') echo $imprenta_programacion->cantidad; else echo set_value_input($control,'total_pliegos_buenos',$control->total_pliegos_buenos);?>" placeholder="Total pliegos buenos" /> 
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos Malos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_pliegos_malos" readonly="true"  value="<?php echo set_value_input($control,'total_pliegos_malos',$control->total_pliegos_malos);?>" placeholder="Total pliegos Malos" /> 
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total Merma Considerada</label>
		<div class="controls">
            <input type="text" name="total_merma" value="<?php echo $hoja->total_merma?>" readonly="true" /> 
		</div>
	</div>
    
    <div class="control-group">
        		<label class="control-label" for="usuario">Largo de pinza sugerido</label>
		<div class="controls">
            <input type="text" name="largo_de_pinza_sugerido" value="<?php if($emplacado->ccac1>20){echo '15';}else{echo '10';}?>"  readonly="true"/> 
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Largo de pinza <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="largo_de_pinza" value="<?php if($emplacado->ccac1>20){echo '15';}else{echo '10';}?>" /> 
		</div>
	</div>
            
<div class="control-group">
		<label class="control-label" for="usuario">Largo de pinza por la cola<strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="largo_de_pinza_por_cola" value="<?php if($pinza->largo_de_pinza_por_cola<>""){echo $pinza->largo_de_pinza_por_cola;}else{echo '';}?>" /> 
		</div>
	</div>
              <div class="control-group">
		<label class="control-label" for="usuario">Largo en gato tiro derecho<strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="largo_de_pinza_gato_derecho" value="<?php if($pinza->largo_de_pinza_gato_derecho<>""){echo $pinza->largo_de_pinza_gato_derecho;}else{echo '';}?>" /> 
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Largo en gato retiro izquierdo<strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="largo_de_pinza_gato_izquierdo" value="<?php if($pinza->largo_de_pinza_gato_izquierdo<>""){echo $pinza->largo_de_pinza_gato_izquierdo;}else{echo '';}?>" /> 
		</div>
	</div>
<!--     <div class="control-group">
		<label class="control-label" for="usuario">Impresión para trabajo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="impresion_para_trabajo" value="<?php // echo set_value_input($control,'impresion_para_trabajo',$control->impresion_para_trabajo);?>" /> 
		</div>
	</div>-->
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    

        <div class="control-group">
		<label class="control-label" for="usuario">Tiempo de Arreglo</label>
		<div class="controls">
                    <input type="text" name="tiempo_de_arreglo" value="<?php echo set_value_input($control,'tiempo_de_arreglo',$control->tiempo_de_arreglo);?>" placeholder="Tiempo de arreglo" />
		</div>
	</div>     

        <div class="control-group">
		<label class="control-label" for="usuario">Tiempo de Producción</label>
		<div class="controls">
                    <input type="text" name="tiempo_de_produccion" value="<?php echo set_value_input($control,'tiempo_de_produccion',$control->tiempo_de_produccion);?>" placeholder="Tiempo de Produccion" />
		</div>
	</div>  

        <div class="control-group">
		<label class="control-label" for="usuario">Tiempo de Preparación</label>
		<div class="controls">
                    <input type="text" name="tiempo_de_preparacion" value="<?php echo set_value_input($control,'tiempo_de_preparacion',$control->tiempo_de_preparacion);?>" placeholder="Tiempo de Preparación" />
		</div>
	</div>  

        <div class="control-group">
		<label class="control-label" for="usuario">Tiempo de Mantención</label>
		<div class="controls">
                    <input type="text" name="tiempo_de_mantencion" value="<?php echo set_value_input($control,'tiempo_de_mantencion',$control->tiempo_de_mantencion);?>" placeholder="Tiempo de Mantención" />
		</div>
	</div>  



        <div class="control-group">
		<label class="control-label" for="usuario">Formula de la Tinta</label>
		<div class="controls">
                    <input type="text" name="formula_de_tinta" value="<?php echo set_value_input($control,'formula_de_tinta',$control->formula_de_tinta);?>" placeholder="Tiempo de preparación de Tinta" />
		</div>
	</div>  

    <h3>Secuencia de Colores</h3>

        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 1</label>
		<div class="controls">
                    <input type="text" name="cuerpo1" value="<?php echo set_value_input($control,'cuerpo1',$control->cuerpo1);?>" placeholder="Cuerpo 3" />
		</div>
	</div>  



        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 2</label>
		<div class="controls">
                    <input type="text" name="cuerpo2" value="<?php echo set_value_input($control,'cuerpo2',$control->cuerpo3);?>" placeholder="Cuerpo 2" />
		</div>
	</div> 


        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 3</label>
		<div class="controls">
                    <input type="text" name="cuerpo3" value="<?php echo set_value_input($control,'cuerpo3',$control->cuerpo3);?>" placeholder="Cuerpo 3" />
		</div>
	</div> 

        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 4</label>
		<div class="controls">
                    <input type="text" name="cuerpo4" value="<?php echo set_value_input($control,'cuerpo4',$control->cuerpo4);?>" placeholder="Cuerpo 4" />
		</div>
	</div> 


        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 5</label>
		<div class="controls">
                    <input type="text" name="cuerpo5" value="<?php echo set_value_input($control,'cuerpo5',$control->cuerpo5);?>" placeholder="Cuerpo 5" />
		</div>
	</div> 

        <div class="control-group">
		<label class="control-label" for="usuario">Cuerpo 6</label>
		<div class="controls">
                    <input type="text" name="cuerpo6" value="<?php echo set_value_input($control,'cuerpo6',$control->cuerpo6);?>" placeholder="Cuerpo 6" />
		</div>
	</div> 

    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Importantes</label>
		<div class="controls">
			<textarea id="comentarios_produccion" name="comentarios_produccion" placeholder="Comentarios Producción"><?php echo $control->comentarios_produccion?></textarea>
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
