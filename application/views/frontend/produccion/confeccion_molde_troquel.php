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
            <li>Confección Molde de troquel - Orden de Producción N° <?php echo $orden->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Confección Molde de troquel - Fast Track N° <?php echo $id?></li>
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
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Confección Molde de troquel - Orden de Producción N° <?php echo $orden->id?></h3></div>
            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 380px;">
                <div class="controls" style="margin-left: 0px;width:40%;float:left;">            
                    <ul>
                         <?php
                        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                        $cliente=$cli->razon_social;
                        $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                        if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='NO'))// CUANDO ES NUEVO Y NO ESTAN HECHOS LOS MOLDES
                        {
                            $moldeNuevo='Molde Nuevo';
                            $hayQueHacerMolde='SI';
                        }                    
                        elseif(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                        {
                            $moldeNuevo='Molde Antiguo';
                            $hayQueHacerMolde='NO';                    
                        }
                        elseif(($orden->tiene_molde=='NO') && ($orden->estan_los_moldes=='NO'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                        {
                            $moldeNuevo='No Corresponde';
                            $hayQueHacerMolde='NO';                    
                        }                
                        $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);
                        ?>
                            <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php echo $cliente?></b></a></li>	                    
                            <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>	                        
                            <li>Descripción : <b><?php echo $datos->producto?></b></li>
                            <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                            <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                            <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                            <?php if ($molde->nombre!=''){?> 
                                <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <strong>(<?php echo $moldeNuevo?>)</strong></li>
                            <?php }?>                            <li>Lleva Troquel : <strong> <?php if ($fotomecanica2->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>                            
                            <?php if(!empty($ing->archivo)){?> 
                            <li><strong>PDF trazado de Ingeniería </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                            <li><strong>PDF imagen </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                                      <li> Situación : <strong>Pendiente</strong></li>
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
                            if($fotomecanica->estado==1)
                            {
                                ?>
                                <li>Fecha Liberación Fotomecánica : <strong><?php echo fecha($fotomecanica->cuando)?></strong></li>
                                <?php
                            }
                            ?>
                            <li>Fecha Confección películas Fotomecánica : <strong><?php echo fecha($fotomecanica->confeccion_de_peliculas_fecha);?></strong></li>
                            <li>Cantidad de golpes : <strong><?php echo number_format($hoja->placa_kilo,0,'','.');?></strong></li>
                            <li>Total metros de cuchillo a usar : <strong><?php echo $ing->metros_de_cuchillo;?></strong></li>
            	</div>  
            <?php
        break;
        case '2':
            ?>
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Confección Molde de troquel - Fast Track N° <?php echo $id?></h3></div>
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
			<input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <?php
    if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='NO')) {  ?>
        <div class="control-group">
            <label class="control-label" for="usuario">Molde para revisión</label>
            <div class="controls">
                <input type="text" name="molde_revision" value="NO" readonly="true" />
                <input type="text" name="molde_para_revision" value="NO" readonly="true" />
            </div>
	</div> 
    <?php } else { ?>
        <div class="control-group">
            <label class="control-label" for="usuario">Molde para revisión</label>
            <div class="controls">
		<input type="text" name="molde_revision" value="Para Revisión" readonly="true" />
            </div>
	</div> 
        <div class="control-group">
            <label class="control-label" for="usuario">Opciones Molde para revisión</label>
		<div class="controls">
		<select name="molde_para_revision">
                    <option value="Molde bueno">Molde bueno</option>
                    <option value="Molde en observación">Molde en observación</option>
                    <option value="Molde en mal estado, para cambiar en próximo pedido">Molde en mal estado, para cambiar en próximo pedido</option>
                </select>
                </div>
	</div> 
        <?php } ?>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay madera <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <?php
            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
            {
                ?>
                <input type="text" name="hay_madera" value="SI" readonly="true"  />
                <?php
            }else
            {
                ?>
                <select name="hay_madera">
                <option value="NO" <?php echo set_value_select($control,'hay_madera',$control->hay_madera,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'hay_madera',$control->hay_madera,'SI');?>>SI</option>
            </select>
                <?php
            }
            ?>
			
          	</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay cuchillos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
        <?php
            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
            {
                ?>
                <input type="text" name="hay_cuchillos" value="SI" readonly="true"  />
                <?php
            }else
            {
                ?>
                	<select name="hay_cuchillos">
                <option value="NO" <?php echo set_value_select($control,'hay_cuchillos',$control->hay_cuchillos,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'hay_cuchillos',$control->hay_cuchillos,'SI');?>>SI</option>
            </select>
                <?php
            }
            ?>
			
		
          	</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Calado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
        <?php
            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
            {
                ?>
                <input type="text" name="calado" value="SI" readonly="true"  />
                <?php
            }else
            {
                ?>
                <select name="calado">
                <option value="NO" <?php echo set_value_select($control,'calado',$control->calado,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'calado',$control->calado,'SI');?>>SI</option>
            </select>
                <?php
            }
            ?>
			
			
          	</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Confección de cuchillo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
        <?php
            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
            {
                ?>
                <input type="text" name="confeccion_de_chuchillo" value="SI" readonly="true"  />
                <?php
            }else
            {
                ?>
                <select name="confeccion_de_chuchillo">
                <option value="NO" <?php echo set_value_select($control,'confeccion_de_chuchillo',$control->confeccion_de_chuchillo,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'confeccion_de_chuchillo',$control->confeccion_de_chuchillo,'SI');?>>SI</option>
            </select>
                <?php
            }
            ?>
			
          	</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Armado de Molde <strong style="color: red;">(*)</strong></label>
		<div class="controls">
        <?php
            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
            {
                ?>
                <input type="text" name="armado_de_molde" value="SI" readonly="true"  />
                <?php
            }else
            {
                ?>
               <select name="armado_de_molde">
                <option value="NO" <?php echo set_value_select($control,'armado_de_molde',$control->armado_de_molde,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'armado_de_molde',$control->armado_de_molde,'SI');?>>SI</option>
            </select>
                <?php
            }
            ?>
			
          	</div>
	</div>
    <?php
    if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))
    {
        ?>
        <input type="hidden" name="molde_listo" value="NO" />
        <?php
    }else
    {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Molde Listo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="molde_listo">
                <option value="NO" <?php echo set_value_select($control,'molde_listo',$control->armado_de_molde,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'molde_listo',$control->armado_de_molde,'SI');?>>SI</option>
            </select>
       	</div>
	</div>
        <?php
    }
    ?>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Existe PDF Ingeniería </label>
		<div class="controls">
			<?php
                    if(!empty($ing->archivo))
                    {
                        ?>
                        <input type="text" name="existe_pdf_ingenieria" value="SI" readonly="true" />
                        <?php
                    }else
                    {
                        ?>
                        <input type="text" name="existe_pdf_ingenieria" value="NO" readonly="true" />
                        <?php
                    }
                    ?>
          	</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay que hacer molde</label>
		<div class="controls">
			<!--
<select name="hay_que_hacer_molde">
                <option value="NO" <?php echo set_value_select($control,'hay_que_hacer_molde',$control->hay_que_hacer_molde,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'hay_que_hacer_molde',$control->hay_que_hacer_molde,'SI');?>>SI</option>
            </select>
-->
                <input type="text" name="hay_que_hacer_molde" value="<?php echo $hayQueHacerMolde?>" readonly="true" />
          	</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Distancia cuchillo a cuchillo</label>
		<div class="controls">
			<input type="text" name="tamano_cuchillo_1" style="width: 100px;"  value="<?php echo $ing->tamano_cuchillo_1; ?>" placeholder="0" readonly="true" /> X <input type="text" name="tamano_cuchillo_2" style="width: 100px;" value="<?php echo $ing->tamano_cuchillo_2; ?>" placeholder="0" readonly="true" /> 
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    
    <input type="hidden" name="id_molde" value="<?php echo $molde->id?>" />
    <input type="hidden" name="cuchillocuchillo" value="<?php echo $molde->cuchillocuchillo?>" />
    <input type="hidden" name="cuchillocuchillo2" value="<?php echo $molde->cuchillocuchillo2?>" />
    
    
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
			if($fotomecanica->estado == 1){
			?>
			
            <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
			
			<?php
			}else{
				?>
				<input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" disabled/>
				
				<?php
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
