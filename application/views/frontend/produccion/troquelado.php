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
            <li>Troquelado - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Troquelado - Fast Track N° <?php echo $ordenDeCompra->id?></li>
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
            <div  onclick="ver_informacion('informacion')" class="page-header"><h3>Troquelado - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
            <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 520px;">
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
                 $ccac1=$confeccion_molde_troquel->tamano_cuchillo_1-$ing->tamano_a_imprimir_1;
                $ccac2=$confeccion_molde_troquel->tamano_cuchillo_2-$ing->tamano_a_imprimir_2;
                ?>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>	                      
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li><strong>PDF trazado de Ingeniería</strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                    <li>
                        <?php
                        if(sizeof($emplacado)==0)
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
                    <?php
                    if($emplacado->estado==1)
                    {
                        ?>
                        <li>Fecha liberación emplacado : <strong><?php echo fecha($emplacado->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <?php
                    if($fotomecanica->troquel_por_atras=='SI')
                    {
                        ?>
                        <li>Troquelar al revés o derecho : <strong>Lleva troquel por atrás</strong></li>
                        <?php
                    }else
                    {
                        ?>
                        <li>Troquelar al revés o derecho : <strong>No lleva troquel por atrás</strong></li>
                        <?php
                    }
                    ?>
                    <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                    <li>Descripción liner : <strong><?php echo $materialidad_3->nombre?></strong></li>
                    <li>Cantidad de golpes : <strong><?php echo number_format($hoja->placa_kilo,0,'','.');?></strong></li>
                    <li>CCAC1 : <strong><?php echo $ccac1?></strong></li>
                    <li>CCAC2 : <strong><?php echo $ccac2?></strong></li>
                    <li>Total pliegos cortados : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                     <li>Total pliegos producidos : <strong><?php echo $corrugado->total_pliegos_producidos?></strong></li>
                    <li>Total pliegos buenos (Imprenta producción) : <strong><?php echo $imprenta->total_pliegos_buenos?></strong></li>
                    <li>Total pliegos buenos (Emplacado) : <strong><?php echo $emplacado->total_pliegos_buenos?></strong></li>
                     <li>Gato : <strong><?php echo $imprenta->gato?></strong></li>
                    <li>Largo pinza : <strong><?php echo $imprenta->largo_de_pinza?></strong></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div  onclick="ver_informacion('informacion')" class="page-header"><h3>Troquelado - Fast Track N° <?php echo $id?></h3></div>
            <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 490px;">
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
                     <li>Tamaño Pliego : <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
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
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
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
		<label class="control-label" for="usuario">Número molde troquel <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_molde_troquel" value="<?php if(sizeof($control) != 0){echo $orden->id_molde;}else{echo set_value_input($control,'numero_molde_troquel',$control->numero_molde_troquel);}?>" placeholder="Número molde troquel"/>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total Pliegos a troquelar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_a_troquelar" placeholder="Total Pliegos a troquelar" value="<?php echo set_value_input($control,'total_pliegos_a_troquelar',$control->total_pliegos_a_troquelar);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos recibidos de emplacado</label>
		<div class="controls">
			<input type="text" name="total_pliegos_recibidos_de_emplacado" value="<?php echo $emplacado->total_pliegos_buenos?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->operador==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
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
                foreach($usuarios2 as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($control->ayudante_1==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos buenos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_buenos" placeholder="Total pliegos buenos" value="<?php echo $control->total_pliegos_buenos?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Merma</label>
		<div class="controls">
			<input type="text" name="merma" value="<?php echo $hoja->total_merma?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo Máquina</label>
		<div class="controls">
			<input type="text" name="tipo_maquina" value="<?php if($emplacado->ccac1<2){echo 'troquelar máquina manual';}else{echo 'troquelar máquina automática';}?>" readonly="true" />
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
