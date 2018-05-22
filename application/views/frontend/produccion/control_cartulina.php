<style type="text/css">
.chosen-container{
    width: 230px !important;
}

.label-danger-mio{
    left:2px;
    background-color: #ff3333;
    color: #fff;
    border-radius: 3px 3px 3px 3px;
    padding: 1px 4px 2px;
    font-size: 12px;
    font-weight: bold;
}

#stock_parcial_opciones1,#stock_parcial_opciones2,#comprar_parcial_opciones1,#comprar_parcial_opciones2,
#comprar_total_opciones1,#comprar_total_opciones2,#comprar_total_opciones3,#comprar_total_opciones4,#comprar_total_opciones5,
#comprar_saldo_opciones1,#comprar_saldo_opciones2,#comprar_saldo_opciones3,#comprar_saldo_opciones4,#comprar_saldo_opciones5,
#comprar_parcial_opciones1,#comprar_parcial_opciones2,#comprar_parcial_opciones3,#comprar_parcial_opciones4,#comprar_parcial_opciones5
{
  display: none;
}
</style>
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/datepicker.css">
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/mis_funciones.js"></script>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php //print_r($control_cartulina); exit(); ?>

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
            <li>Control Cartulina - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Control Cartulina - Fast Track N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
 <?php if (sizeof($control_cartulina)>0) { ?>
        <?php if($control_cartulina->estado==1){ ?>        
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Este Registro ya fue liberado..</div>
        <?php } elseif($control_cartulina->estado==0){ ?>   
        <div style="background-color: #41630a; color:white; width: 100%;">&nbsp;&nbsp;Este Registro ya guardado con exito..</div>
        <?php }
 }
 ?>   
   <!-- /Migas -->

                <?php
                  switch($tipo)
                  {
                    case '1':
                        ?>
                        <div onclick="ver_informacion('informacion')" class="page-header"><h3>Control Cartulina - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
                        <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 440px;">
                            <div class="controls" style="margin-left: 0px;width:40%;float:left;">                        
                        <ul>
                           <?php
                            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                            $cliente=$cli->razon_social;
                            $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
//                            if($orden->tiene_molde=='NO')
//                            {
//                                $moldeNuevo='Molde Antiguo';
//                            }else
//                            {
//                                $moldeNuevo='Molde nuevo';
//                            }
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
                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);     
                            $produccionFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($id);
                            $hayparcial=$this->produccion_model->getParcialControlCartulina($id);
                    //echo $kilos1;
                            ?>
                                <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>	                    
                                <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>	                    
                                <li>Descripción : <b><?php echo $datos->producto?></b></li>
                                <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                                <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                                <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                                <?php if (!empty($molde->archivo)) {  ?>
                                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <strong>(<?php echo $moldeNuevo?>)</strong></li>
                                <?php } else {    ?>
                                    <li><strong>NO ESTÁ EL PDF DEL MOLDE</strong></li>
                                <?php }?>                         
                                <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                                <li>Cantidad Pliegos a Cortar : <strong><?php echo $hoja->placa_kilo; ?></strong></li>     
                                <?php if(($hoja->placa_kilo>0) && ($ing->tamano_a_imprimir_1>0) && ($ing->tamano_a_imprimir_2>0)  && ($materialidad_1->gramaje>0)){ $tk=floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000);?>
                                <li>Total Kilos de la orden : <strong><?php echo floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000); ?> Kg</strong></li>    
                                <?php } else { ?>  
                                    <li>Total Kilos de la orden : <strong>0 </strong></li>    
                                <?php }?>  
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
                                   <?php  if(sizeof($fotomecanica2)==0){ ?>
                                    <li>Situación : <strong>Pendiente</strong></li>
                                    <?php } else {
                                         switch($control_cartulina->situacion)
                                         {
                                            case 'Liberada':
                                                ?>
                                                <li>Situación : <strong>Liberada el <?php echo fecha_con_hora($control_cartulina->fecha_liberada);?></strong></li>
                                                <?php
                                            break;
                                            case 'Activa':
                                                ?>
                                                <li>Situación : <strong>Activa el <?php echo fecha_con_hora($control_cartulina->fecha_activa);?></strong></li>
                                                <?php
                                            break;
                                         }
                                       }
                                    ?>
                                
                                
                            </ul>
                            <!--<hr />-->
                        <?php
                    break;
                    case '2':
                        ?>
                        <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Control Cartulina - Fast Track N° <?php echo $id?></h3></div>
                        <div id="informacion"  style="margin-left: 0px;width:100%;float:left;height: 440px;">
                            <div class="controls" style="margin-left: 0px;width:40%;float:left;">                         
                        <ul>
                            <?php
                             $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                            ?>
                                <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php echo $cliente->razon_social; ?></b></a></li>	                    
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
                //echo '<pre>';
                //print_r($fotomecanica);
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Placa :
                            <b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </b></li>                        
                    <?php } else { ?>
                           <li>Placa :
                           <b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>  </b> </li>                        
                    <?php } ?>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>                           
                     <li><b><?php echo $fotomecanica->materialidad_datos_tecnicos; ?></b>:</li>
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li> Onda : Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li>Onda : <b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></b></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
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
                     <li>Colores : <strong><?php  echo $fotomecanica->colores; ?></strong></li>
                     <?php echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
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

                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                </ul>
            	</div>  
            </div>

	
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo_referencia" value="<?php echo set_value_input($control_cartulina,'descripcion_del_trabajo',$control_cartulina->descripcion_del_trabajo);?>" />
       </div>
	</div> 
   <!-- 
   <div class="control-group">
		<label class="control-label" for="usuario">Dimensionar a:</label>
		<div class="controls">-->
                    <input type="hidden" name="dimensionar_a_ancho" style="width: 100px;" value="<?php echo $ing->tamano_a_imprimir_1;?>" placeholder="Ancho" readonly="true" /><!-- X --><input type="hidden" name="dimensionar_a_largo" style="width: 100px;" value="<?php echo $ing->tamano_a_imprimir_2; ?>" placeholder="Largo" readonly="true" />
		<!-- </div>
	</div>-->
   
    
                
                
                
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción de la Placa Cotizada</label>
		<div class="controls">
			<input type="text" name="descripcion_de_la_tapa_referencia" value="<?php echo $materialidad_1->nombre;?>" readonly="true" />
       </div>
	</div>



                
    
    
   <?php $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);?>
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Cotizado</label>
		<div class="controls">
			<input type="text" name="gramaje" id="gramaje" value="<?php echo $gramaje_cotizado = $materialidad_1->gramaje?>" readonly="true" />
            <input type="hidden" name="aplica_gramaje" value="<?php echo $control_cartulina->aplica_gramaje?>" /> 
        </div>
	</div>
    
<!--                
	<div class="control-group">
		<label class="control-label" for="usuario">Microcorrugado o Corrugado</label>
		<div class="controls">-->
            <input type="hidden" name="datos_tecnicos" value="<?php echo $fotomecanica->materialidad_datos_tecnicos;?>" readonly="true" />
       <!--</div>
	</div>
-->
	


	<?php
	$kilosCartulina=$this->produccion_model->MermasParaProduccion($id,$materialidad_1->gramaje,$ing->tamano_a_imprimir_1);
	$kilosCartulina = str_replace('.', '',number_format($kilosCartulina,0,'','.'));
	?>
		
   <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina Cotizado (<?php echo $ing->tamano_a_imprimir_1;?> Cms)</label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina" id="ancho_de_bobina" value="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>" readonly="true" /> <strong>(Mms)</strong>
        </div>
	</div>

	
	
    <div class="control-group">
		<label class="control-label" for="usuario">Total Kilos de la Cartulina Cotizadas</label>
		<div class="controls">
      <input type="text"  id="total_kilos" name="total_kilos" onkeypress="return soloNumeros(event)" value="<?php echo $total_kilos = floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000); ?>" placeholder="0" readonly="true" /> 
			
				<?php
				if(sizeof($hayparcial->sum) == 0)
				{ 
				}else
				{
					$pendiente = $control_cartulina->total_kilos - $hayparcial->sum;
					if($control_cartulina->estado ==3 ){
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />
				<?php
					}
				}
				?>
			<span style="display: inline-block;"><strong>Total Metros: </strong><?php echo round(($total_kilos/($ancho_cotizado*$gramaje_cotizado)*1000000)); ?></span>
        </div>

	</div>
  <!--EXISTENCIA-->
    <h3>Existencia</h3>
    <div class="control-group">
      <label class="control-label" for="usuario">Estado Materia prima</label>
      <div class="controls">
        <select name="existencia" id="existencia">
            <option value="">Seleccione...</option>
            <option value="stock_total">Hay stock total</option>
            <option value="Comprar Total" id="comprar_total">Comprar total</option>
            <option value="Stock Parcial" id="stock_parcial">Hay stock parcial</option>
            <option value="Comprar Parcial" id="comprar_parcial">Comprar parcial</option>
        </select>
      </div>
    </div>

    <div class="control-group" id="stock_parcial_opciones1">
      <label class="control-label" for="usuario">Opciones</label>
      <div class="controls">
        <select name="" id="select_stock_parcial_opciones1">
          <option value="">Seleccione</option>
          <option value="Comprar Saldo" id="comprar_saldo">Comprar Saldo</option>
          <option value="Se produce parcial">Se produce parcial</option>
        </select>
      </div>
    </div>

        <div class="control-group" id="comprar_saldo_opciones1">
          <label class="control-label" for="usuario">Proveedor</label>
          <div class="controls">
            <select name="proveedor_existencia"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
                <option value="">Seleccione</option>
                <?php
                $proves=$this->proveedores_model->getProveedores();

                    foreach($proves as $prove)
                    {
                    ?>
                      <option value="<?php echo $prove->id?>" <?php if($control->proveedor==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    }
                ?>
            </select>
          </div>
        </div>

       

        <div class="control-group" id="comprar_saldo_opciones2">
          <label class="control-label" for="usuario">Material Comprado</label>
          <div class="controls">
            <select id="mate1" name="materialidad_1" class="chosen-select" style="width: 300px">
              <option value="0">Seleccione......</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa){
              if (sizeof($ing)>0) {  ?>                
                  <?php if($ing->id_mat_placa1!=""){?>
                  <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php }else{ ?>
                  <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php } ?>
              <?php } else { ?>
                  <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($datos->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                  <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>

        <div class="control-group" id="comprar_saldo_opciones3">
          <label class="control-label" for="usuario">Ancho (Cms)</label>
          <div class="controls">
            <input type="number" placeholder="Ancho" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
          </div>
        </div>

        <div class="control-group" id="comprar_saldo_opciones4">
          <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
          <div class="controls">
            <input type="date" name="fecha_estimada_de_produccion">
          </div>
        </div>

        <div class="control-group" id="comprar_saldo_opciones5">
          <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
          <div class="controls">
            <input type="date" name="fecha_estimada_de_produccion">
          </div>
        </div>

     <!--<div class="control-group" id="comprar_parcial_opciones1">
      <label class="control-label" for="usuario">Opciones</label>
      <div class="controls">
        <select name="" id="">
          <option value="">Seleccione</option>
          <option value="Se compra el saldo total">Se compra el saldo total</option>
          <option value="Se produce parcial">Se produce parcial</option>
        </select>
      </div>
    </div>-->
        
        <div class="control-group" id="comprar_parcial_opciones1">
          <label class="control-label" for="usuario">Proveedor</label>
          <div class="controls">
            <select name="proveedor_existencia"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
                <option value="">Seleccione</option>
                <?php
                $proves=$this->proveedores_model->getProveedores();

                    foreach($proves as $prove)
                    {
                    ?>
                      <option value="<?php echo $prove->id?>" <?php if($control->proveedor==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    }
                ?>
            </select>
          </div>
        </div>

       

        <div class="control-group" id="comprar_parcial_opciones2">
          <label class="control-label" for="usuario">Material Comprado</label>
          <div class="controls">
            <select id="mate1" name="materialidad_1" class="chosen-select" style="width: 300px">
              <option value="0">Seleccione......</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa){
              if (sizeof($ing)>0) {  ?>                
                  <?php if($ing->id_mat_placa1!=""){?>
                  <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php }else{ ?>
                  <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php } ?>
              <?php } else { ?>
                  <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($datos->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                  <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>

        <div class="control-group" id="comprar_parcial_opciones3">
          <label class="control-label" for="usuario">Ancho (Cms)</label>
          <div class="controls">
            <input type="number" placeholder="Ancho" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
          </div>
        </div>

        <div class="control-group" id="comprar_parcial_opciones4">
          <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
          <div class="controls">
            <input type="date" name="fecha_estimada_de_produccion">
          </div>
        </div>

        <div class="control-group" id="comprar_parcial_opciones5">
          <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
          <div class="controls">
            <input type="date" name="fecha_estimada_de_produccion">
          </div>
        </div>


  

   



    <div class="control-group" id="comprar_total_opciones1">
      <label class="control-label" for="usuario">Proveedor</label>
      <div class="controls">
        <select name="proveedor_existencia"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
            <option value="">Seleccione</option>
            <?php
            $proves=$this->proveedores_model->getProveedores();

                foreach($proves as $prove)
                {
                ?>
                  <option value="<?php echo $prove->id?>" <?php if($control->proveedor==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                <?php
                }
            ?>
        </select>
      </div>
    </div>

   

    <div class="control-group" id="comprar_total_opciones2">
      <label class="control-label" for="usuario">Material Comprado</label>
      <div class="controls">
        <select id="mate1" name="materialidad_1" class="chosen-select" style="width: 300px">
          <option value="0">Seleccione......</option>
          <?php
          $tapas=$this->materiales_model->getMaterialesSelectCartulina();
          foreach($tapas as $tapa){
          if (sizeof($ing)>0) {  ?>                
              <?php if($ing->id_mat_placa1!=""){?>
              <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
              <?php }else{ ?>
              <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
              <?php } ?>
          <?php } else { ?>
              <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($datos->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
              <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /*echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
          <?php }
          }
          ?>
        </select>
      </div>
    </div>

    <div class="control-group" id="comprar_total_opciones3">
      <label class="control-label" for="usuario">Ancho (Cms)</label>
      <div class="controls">
        <input type="number" placeholder="Ancho" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
      </div>
    </div>

    <div class="control-group" id="comprar_total_opciones4">
      <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
      <div class="controls">
        <input type="date" name="fecha_estimada_de_produccion">
      </div>
    </div>

    <div class="control-group" id="comprar_total_opciones5">
      <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
      <div class="controls">
        <input type="date" name="fecha_estimada_de_produccion">
      </div>
    </div>

  



    <!--PRIMERA BOBINA-->
    <h3>PRIMERA BOBINA</h3>    
    <div class="control-group">
      <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 1ra Bobina</label>
      <div class="controls">
        <select name="descripcion_de_la_tapa" id="select_bobina1" class="chosen-select" onchange="carga_ajax_obtenerGramaje(this.value,'gramaje_ajax');">
            <option value="0">Seleccione......</option>
            <option value="no_hay">No hay</option>
            <?php
            $tapas=$this->materiales_model->getMaterialesSelectCartulina();
            foreach($tapas as $tapa)
            {
              if ($control_cartulina->descripcion_de_la_tapa=='')  {
                ?>
                  <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                <?php
                } else  { ?>
                  <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                 <?php }
             }
            ?>
        </select>
      </div>
    </div>
    
    <div class="control-group" hidden>
  		<label class="control-label" for="usuario">Gramaje seleccionado 1ra Bobina</label>
  		<div id="gramaje_ajax" class="controls">
        <input type="text" name="gramaje_seleccionado" id="gramaje_seleccionado" value="<?php if(sizeof($control_cartulina) == 0){echo $materialidad_1->gramaje;}else{echo $control_cartulina->gramaje;}?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
      </div>
  	</div>

    <div class="control-group">
      <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 1ra Bobina</label>
      <div class="controls">
        <input type="text" name="ancho_seleccionado_de_bobina" id="ancho_seleccionado_de_bobina"  value="<?php if($control_cartulina->ancho_seleccionado_de_bobina >0){echo ($control_cartulina->ancho_seleccionado_de_bobina);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validacion_ancho_seleccionado_de_bobina_control_cartulina();" onchange="validacion_ancho_seleccionado_de_bobina_control_cartulina();ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong>
      </div>
    </div>

    <div class="control-group">
		  <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 1ra Bobina</label>
		  <div class="controls">
        <input type="text" name="kilos_bobina_seleccionada"  onblur="validacion_kilos_bobina_seleccionada_control_cartulina();reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada"  value="<?php if($control_cartulina->kilos_bobina_seleccionada >0){echo ($control_cartulina->kilos_bobina_seleccionada);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto1_metros"></span><span class="" id="resto1"></span>
      </div> 
	  </div> 

    <div class="control-group">
  		<label class="control-label" for="usuario"><strong>Hay que bobinar</strong></label>
  		<div class="controls">
        <select id="hay_que_bobinar" name="hay_que_bobinar" onchange="validar_kilos_bobina_seleccionada();Hay_Que_Bobinar_Carutlina(this.value);otra_bobina(this.value);totalbobinas();">
          <option value="" <?php if (sizeof($control_cartulina)==0){echo "selected";}?>>Seleccione</option>                                            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'NO');?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'SI');?>>SI</option>
        </select>
      </div>
    </div>
    <!------------------------------------------------------------------>
    <!--SEGUNDA BOBINA-->
    <h3>SEGUNDA BOBINA</h3>    
    <div id="bobina_adicional" <?php // if(sizeof($bobinas)==0){ echo 'hidden="true"';}?>>
        <?php //print_r($control_cartulina); exit();// echo $control_cartulina->descripcion_de_la_tapa."holaaaa"; ?>
      <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 2da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa" id="select_bobina2" class="chosen-select" onchange="carga_ajax_obtenerGramaje2(this.value,'gramaje_ajax2');">
              <option value="0">Seleccione......</option>
              <option value="no_hay">No hay</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa)
              {
                if ($control_cartulina->descripcion_de_la_tapa=='')  {
                  ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php
                  } else  { ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                   <?php }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 2da Bobina</label>
        <div id="gramaje_ajax2" class="controls">
          <input type="text" name="gramaje_seleccionado2" id="gramaje_seleccionado2" value="<?php if(sizeof($control_cartulina) == 0){echo $materialidad_1->gramaje;}else{echo $bobinas->gramaje;}?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado2(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 2da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina2" id="ancho_seleccionado_de_bobina2"  value="<?php if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validacion_ancho_seleccionado_de_bobina_control_cartulina();" onchange="validacion_ancho_seleccionado_de_bobina_control_cartulina();ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong>
        </div>
      </div> 

      <div class="control-group">
  		  <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 2da Bobina</label>
  		  <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada2"  onblur="validacion_kilos_bobina_seleccionada_control_cartulina();reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada2"  value="<?php if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto2_metros"></span><span class="" id="resto2"></span>
        </div>
      </div> 
    </div>

    <!------------------------------------------------------------------>
    <!--TERCERA BOBINA-->
    <h3>TERCERA BOBINA</h3>
    <div id="bobina_adicional" <?php // if(sizeof($bobinas)==0){ echo 'hidden="true"';}?>>
        <?php //print_r($control_cartulina); exit();// echo $control_cartulina->descripcion_de_la_tapa."holaaaa"; ?>
      <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 3da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa" id="select_bobina3" class="chosen-select" onchange="carga_ajax_obtenerGramaje3(this.value,'gramaje_ajax3');">
              <option value="0">Seleccione......</option>
              <option value="no_hay">No hay</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa)
              {
                if ($control_cartulina->descripcion_de_la_tapa=='')  {
                  ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php
                  } else  { ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                   <?php }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 3ra Bobina</label>
        <div id="gramaje_ajax3" class="controls">
          <input type="text" name="gramaje_seleccionado3" id="gramaje_seleccionado3" value="<?php if(sizeof($control_cartulina) == 0){echo $materialidad_1->gramaje;}else{echo $bobinas->gramaje;}?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado3(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 3da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina3" id="ancho_seleccionado_de_bobina3"  value="<?php if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validacion_ancho_seleccionado_de_bobina_control_cartulina();" onchange="validacion_ancho_seleccionado_de_bobina_control_cartulina();ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong>
        </div>
      </div> 

      <div class="control-group">
        <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 3da Bobina</label>
        <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada3"  onblur="validacion_kilos_bobina_seleccionada_control_cartulina();reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada3"  value="<?php if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto3_metros"></span><span class="" id="resto3"></span>
        </div>
      </div> 
    </div>




    <!------------------------------------------------------------------>
      <h3>RESUMEN</h3>    
    
        <div id="ancho_bobina_seleccionado_bobinar" <?php if (($control_cartulina->hay_que_bobinar=="NO" ) or ($control_cartulina->hay_que_bobinar=="")) { ?> style="display:none" <?php } ?> >   
        <div class="control-group">
                    <label class="control-label" for="usuario">Ancho a Cortar Primer Corte</label>
                    <div class="controls">
                        <input type="text" onchange="reiniciar_calculos_bobinas_cortes();" onblur="cortes_de_bobina();sumar_bobina_control_cartulina();" name="bobinar_ancho_cartulina1" id="bobinar_ancho_cartulina1" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina1?>"/> <strong>(Mms)</strong>
                    <div id="msg_bobinas1"> </div>
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label"  for="usuario">Ancho a Cortar Segundo Corte</label>
                    <div class="controls">
                        <input type="text" readonly="true" onblur="sumar_bobina_control_cartulina();"  name="bobinar_ancho_cartulina2"  id="bobinar_ancho_cartulina2" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina2?>"/> <strong>(Mms)</strong>
                    <div id="msg_bobinas2"> </div>
                    
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label"  for="usuario">Ancho a Cortar Tercer Corte</label>
                    <div class="controls">
                        <input type="text" readonly="true" onblur="sumar_bobina_control_cartulina();" name="bobinar_ancho_cartulina3" id="bobinar_ancho_cartulina3" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->bobinar_ancho_cartulina3?>"/> <strong>(Mms)</strong>
                    <div id="msg_bobinas3"> </div>
                    
            </div>
            </div>
<!--        <div class="control-group">
                    <label class="control-label"  for="usuario"></label>
                    <div class="controls"><a onclick="ver_informacion('otras_bobinas');">¿Necesita Mas Bobinas?</a>
                    </div>
        </div>     -->
    <!--<div id="otras_bobinas" <?php //  if ((($control_cartulina->segunda_bobina_adicional_ancho==0 ) and ($control_cartulina->segunda_bobina_adicional_kilos==0) and ($control_cartulina->tercera_bobina_adicional_ancho==0 ) and ($control_cartulina->tercera_bobina_adicional_kilos==0) and ($control_cartulina->cuarta_bobina_adicional_ancho==0 ) and ($control_cartulina->cuarta_bobina_adicional_kilos==0)) or (sizeof($control_cartulina)==0)) { ?> style="display:none" <?php //  } ?> >-->

    <div class="control-group">
		<label class="control-label" for="usuario"><strong><input type="button" value="Agregar Bobinas" class="btn" onclick="ver_informacion('otras_bobinas');"/></strong></label>
		<div class="controls">

		
        </div>                
	</div> 


    <div id="otras_bobinas" <?php  if ((($control_cartulina->segunda_bobina_adicional_ancho==0 ) and ($control_cartulina->segunda_bobina_adicional_kilos==0) and ($control_cartulina->tercera_bobina_adicional_ancho==0 ) and ($control_cartulina->tercera_bobina_adicional_kilos==0) and ($control_cartulina->cuarta_bobina_adicional_ancho==0 ) and ($control_cartulina->cuarta_bobina_adicional_kilos==0)) or (sizeof($control_cartulina)==0)) { ?> style="display:none" <?php  } ?> >
    <hr />

    <h3>Bobinas Adicionales (Ancho || Peso)&nbsp;&nbsp;&nbsp;<span id="comprobacion_de_kilos" style="color:red; font-size: 14px !important;"></span></h3>

        <div class="control-group">
                    <label class="control-label" for="usuario">Tercera Bobina</label>
                    <div class="controls">
                        <input style="width: 80px" type="text"  name="segunda_bobina_adicional_ancho" id="segunda_bobina_adicional_ancho" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->segunda_bobina_adicional_ancho?>"/> <strong>(Mms)</strong>
                        <input style="width: 80px" type="text"  name="segunda_bobina_adicional_kilos" id="segunda_bobina_adicional_kilos" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->segunda_bobina_adicional_kilos?>" onchange="comprobarkilos();" onblur="comprobarkilos(); comprobarvacio();"/> <strong>(Kg)</strong>                        
                        <span>&nbsp;&nbsp;Hay que bobinar?</span>
                        <select style="width: 110px" id="segunda_bobinar" name="segunda_bobinar" <?php echo set_value_select($control_cartulina,'segunda_bobinar',$control_cartulina->segunda_bobinar,$control_cartulina->segunda_bobinar)?>>
                            <option value="">Seleccione</option>
                            <option value="Si" <?php if($control_cartulina->segunda_bobinar=="Si"){echo "selected";} ?>>Si</option>
                            <option value="No" <?php if($control_cartulina->segunda_bobinar=="No"){echo "selected";} ?>>No</option>
                        </select>
                    <div id="msg_bobinas1"> </div>
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label"  for="usuario">Cuarta Bobina</label>
                    <div class="controls">
                        <input style="width: 80px" type="text"  name="tercera_bobina_adicional_ancho" id="tercera_bobina_adicional_ancho" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->tercera_bobina_adicional_ancho?>"/> <strong>(Mms)</strong>
                        <input style="width: 80px" type="text"  name="tercera_bobina_adicional_kilos" id="tercera_bobina_adicional_kilos" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->tercera_bobina_adicional_kilos?>" onchange="comprobarkilos();" onblur="comprobarkilos(); comprobarvacio();"/> <strong>(Kg)</strong>     
                        <span>&nbsp;&nbsp;Hay que bobinar?</span>
                        <select style="width: 110px" id="tercera_bobinar" name="tercera_bobinar" <?php echo set_value_select($control_cartulina,'tercera_bobinar',$control_cartulina->tercera_bobinar,$control_cartulina->tercera_bobinar)?>>
                            <option value="">Seleccione</option>
                            <option value="Si" <?php if($control_cartulina->tercera_bobinar=="Si"){echo "selected";} ?>>Si</option>
                            <option value="No" <?php if($control_cartulina->tercera_bobinar=="No"){echo "selected";} ?>>No</option>
                        </select>
                    <div id="msg_bobinas2"> </div>
                    
            </div>
            </div>

        <div class="control-group">
                    <label class="control-label"  for="usuario">Quinta Bobina</label>
                    <div class="controls">
                        <input style="width: 80px" type="text"  name="cuarta_bobina_adicional_ancho" id="cuarta_bobina_adicional_ancho" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->cuarta_bobina_adicional_ancho?>"/> <strong>(Mms)</strong>
                        <input style="width: 80px" type="text"  name="cuarta_bobina_adicional_kilos" id="cuarta_bobina_adicional_kilos" onkeypress="return soloNumeros(event)" value="<?php echo $control_cartulina->cuarta_bobina_adicional_kilos?>" onchange="comprobarkilos();" onblur="comprobarvacio();"/> <strong>(Kg)</strong>     
                        <span>&nbsp;&nbsp;Hay que bobinar?</span>
                        <select style="width: 110px" id="cuarta_bobinar" name="cuarta_bobinar" <?php echo set_value_select($control_cartulina,'cuarta_bobinar',$control_cartulina->cuarta_bobinar,$control_cartulina->cuarta_bobinar)?>>
                            <option value="">Seleccione</option>
                            <option value="Si" <?php if($control_cartulina->cuarta_bobinar=="Si"){echo "selected";} ?>>Si</option>
                            <option value="No" <?php if($control_cartulina->cuarta_bobinar=="No"){echo "selected";} ?>>No</option>
                        </select>
                    <div id="msg_bobinas3"> </div>
                    
            </div>
            </div>
    
    <hr />
     </div>              
            
        <div class="control-group">
                    <label class="control-label" for="usuario">Kilos de la orden que hay que Bobinar</label>
                    <div class="controls">
                        <input type="text" readonly="true"  id="kilos_orden_a_bobinar" name="kilos_orden_a_bobinar" onkeypress="return soloNumeros(event)" value="<?php if($control_cartulina->kilos_orden_a_bobinar >0){echo ($control_cartulina->kilos_orden_a_bobinar);}?>"/> 
            </div>
            </div>            

    </div>

 
            
<!--        <div class="control-group">
                    <label class="control-label" for="usuario">Kilos de la orden que hay que Bobinar</label>
                    <div class="controls">
                        <input type="text" readonly="true"  name="kilos_orden_a_bobinar" onkeypress="return soloNumeros(event)" value="<?php // if($control_cartulina->kilos_orden_a_bobinar >0){echo ($control_cartulina->kilos_orden_a_bobinar);}?>"/> 
            </div>
            </div>            -->



        <div class="control-group">
                    <label class="control-label" for="usuario">Total Metros</label>
                    <div class="controls">
                        <input type="text" readonly="true" id="total_metros" name="total_metros" onkeypress="return soloNumeros(event)" value="<?php echo (($hoja->placa_kilo*$ing->tamano_a_imprimir_2)/100);?>"/> 
            </div>
            </div>   


        <div class="control-group" style="display: none">
                    <label class="control-label" for="usuario">Total Pliegos</label>
                    <div class="controls">
                            <input type="text" id="total_pliegos" name="total_pliegos" onkeypress="return soloNumeros(event)" value="<?php echo $hoja->placa_kilo?>" readonly="true" /> 
            </div>
            </div>

    
	


	
    <!--Kilos seleccionados -->
	 <div id="hola">
     </div>
    <!--Kilos seleccionados --> 
	
    <div class="control-group">
		<label class="control-label" for="usuario">Unidades por pliego</label>
		<div class="controls">
			<input type="text" id="unidades_por_pliego" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php echo $ing->unidades_por_pliego?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Bobina <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="numero_de_bobina" name="numero_de_bobina" placeholder="Número de Bobina" value="<?php echo set_value_input($control_cartulina,'numero_de_bobina',$control_cartulina->numero_de_bobina);?>" />
		</div>
	</div>
    
    <div class="control-group" hidden="true" id="numero_de_bobina2_div">
		<label class="control-label" for="usuario">Número de Bobina 2 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="numero_de_bobina2" name="numero_de_bobina2" placeholder="Número de Bobina2" value="<?php echo set_value_input($control_cartulina,'numero_de_bobina2',$control_cartulina->numero_de_bobina2);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total de Bobinas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="total_de_bobinas" name="total_de_bobinas" placeholder="Total de Bobinas" value="<?php echo set_value_input($control_cartulina,'total_de_bobinas',$control_cartulina->total_de_bobinas);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="quien_sabe_ubicacion_de_la_bobina">Quién sabe ubicación de la Bobina <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select id="quien_sabe_ubicacion_de_la_bobina" name="quien_sabe_ubicacion_de_la_bobina"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'quien_sabe_ubicacion_de_la_bobina',$control_cartulina->quien_sabe_ubicacion_de_la_bobina,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <h3>En caso de no haber disponibilidad en fabrica</h3>    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay en stock en Plaza</label>
		<div class="controls">
			<select name="hay_en_stock" onchange="hayEnStock(this.value); mostraria(this.value);">
                            <option value="">--Seleccione--</option>            
                <option value="NO" <?php echo set_value_select($control_cartulina,'hay_en_stock',$control_cartulina->hay_en_stock,'NO')?>>NO</option>
                <option value="SI" <?php echo set_value_select($control_cartulina,'hay_en_stock',$control_cartulina->hay_en_stock,'SI')?>>SI</option>
            </select>
       </div>
	</div>
    
	
	 <div class="control-group">
			<label class="control-label" for="usuario">Cantidad Total o parcial <strong style="color: red;">(*)</strong></label>
			<div class="controls">
				<select name="cantidad_total_o_parcial" onchange="Parcial(this.value)" >
					<option value="Total"   <?php if($control_cartulina->cantidad_total_o_parcial=='Total'){echo 'selected="true"';}  ?>>Total</option>
					<option value="Parcial" <?php if($control_cartulina->cantidad_total_o_parcial=='Parcial'){echo 'selected="true"';}?>>Parcial</option>
				</select>
			</div>
		</div>
		
	  <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
                    <select name="proveedor" onchange="llenar_datos_proveedor(this.value);">
                        <option value="">-- Seleccione --</option>
                <?php
                $proves=$this->proveedores_model->getProveedores();
                foreach($proves as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($control_cartulina->proveedor==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
       </div>
	</div> 	
        <div class="control-group">
		<label class="control-label" for="usuario">Fecha estimada de recepción en fabrica<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" name="fecha_estimada_recepcion" class="datepicker" placeholder="Introduzca Fecha" value="<?php if(sizeof($control_cartulina)>0){  $invert = explode("-",$control_cartulina->fecha_estimada_recepcion);
                    $fecha_estimada_recepcion = $invert[2]."-".$invert[1]."-".$invert[0]; echo $fecha_estimada_recepcion;}?>">
		</div>
        </div>    
    <div class="control-group">
		<label class="control-label" for="usuario">Quien Compra</label>
		<div class="controls">
            	<select name="quien_compra"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'quien_compra',$control_cartulina->quien_compra,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
	</div>
	<div class="control-group" id="totaloparcial" style="<?php if($control_cartulina->cantidad_total_o_parcial=='Parcial'){echo 'display: block';}else{ echo 'display: none';}?>;">
		<label class="control-label" for="usuario">Total de Kilos Seleccionados</label>
			<div class="controls">
                            <input type="text" name="total_kilos2"  value="<?php echo $control_cartulina->total_kilos2 ?>"/>
				<?php
				//Pendientes
				if(sizeof($hayparcial->sum) == 0)
				{ 
					if($control_cartulina->total_kilos >0)
					{
					?>
					<input type="text" name="total_kilos_a_bobinar" value="<?php echo $control_cartulina->total_kilos; ?>" readonly="true" />
					<?php
					}
				}else
				{
					$pendiente = $control_cartulina->total_kilos - $hayparcial->sum;
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />
				<?php
				}
				//Pendientes 
				?>
				
		   </div>
	</div>
	
	
    <div class="control-group" id="stock_1" style="display: <?php if($control_cartulina->hay_en_stock=='SI'){echo 'block';}else{echo 'none';}?>;"> 
		<!--<label class="control-label" for="usuario">Preguntar a</label>-->
<!--		<div class="controls">
			<input type="text" name="preguntar_stock_a" value="<?php// echo $control_cartulina->preguntar_stock_a?>" />
       </div>-->
<!--       <label class="control-label" for="usuario">Cantidad total o parcial</label>
		<div class="controls">
			<select name="cantidad_total_o_parcial">
                <option value="NO" <?php if($control_cartulina->cantidad_total_o_parcial=='NO'){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($control_cartulina->cantidad_total_o_parcial6=='SI'){echo 'selected="true"';}?>>SI</option>
            </select>
       </div>-->
	</div>
    <div class="control-group" id="ocultillo">
		<label class="control-label" for="usuario">Preguntar a</label>
		<div class="controls">
            	<select name="preguntar_stock_a"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'preguntar_stock_a',$control_cartulina->preguntar_stock_a,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Recepcionado</label>
		<div class="controls">
                    <select name="recepcionados" onchange="recepcionado(this.value);">
                <option value="">Seleccione.....</option>
                <option value="SI" <?php echo set_value_select($control_cartulina,'recepcionados',$control_cartulina->recepcionados,"SI")?>>Si</option>
                <option value="NO" <?php echo set_value_select($control_cartulina,'recepcionados',$control_cartulina->recepcionados,"NO")?>>No</option>
            </select>
                </div>
	</div>
    <div class="control-group" id="fecha_recepcionada" <?php if($control_cartulina->recepcionados!="SI"){echo 'hidden="true"';}?>>
		<label class="control-label" for="usuario">Fecha de recepcionado<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" name="fecha_recepcionada" class="datepicker" placeholder="Introduzca Fecha" value="<?php if(sizeof($control_cartulina)>0){  $invert = explode("-",$control_cartulina->fecha_recepcionada);
                    $fecha_estimada_recepcionada = $invert[2]."-".$invert[1]."-".$invert[0]; echo $fecha_estimada_recepcionada;}?>">
		</div>
        </div>   
    <div class="control-group" id="stock_2" style="display: <?php if($control_cartulina->hay_en_stock=='NO'){echo 'block';}else{echo 'none';}?>;"> 
		<label class="control-label" for="usuario">Opciones de Stock</label>
		<div class="controls">
			<select name="stock_opciones" onchange="hayEnStock2(this.value);">
                <?php
                $array=array('esperar','comprar','esperarando despacho local','esperando importación');
                for($i=0;$i<sizeof($array);$i++)
                {
                    ?>
                    <option value="<?php echo $array[$i]?>" <?php if($control_cartulina->stock_opciones==$array[$i]){echo 'selected="true"';}?>><?php echo $array[$i]?></option>
                    <?php
                }
                ?>
            </select>
       </div>
	</div>
    
    <div id="stock_3" style="display: <?php if($control_cartulina->hay_en_stock=='NO' and $control_cartulina->stock_opciones=='comprar'){echo 'block';}else{echo 'none';}?>;">
    
    </div>
      <div class="control-group" id="rechazo" style="display: <?php if($control_cartulina->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control_cartulina->glosa?></textarea>
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
            <input type="hidden" id="ccac1" name="ccac1" value="<?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?>" />
            <input type="hidden" id="can_imprimir" name="can_imprimir" value="<?php echo $hoja->placa_kilo; ?>" />
            <input type="hidden" id="tamano_a_imprimir_2" name="tamano_a_imprimir_2" value="<?php echo $ing->tamano_a_imprimir_2; ?>" />            
            <input type="hidden" id="can_minima_primer_corte" name="can_minima_primer_corte" value="<?php echo ($ing->tamano_a_imprimir_1*10); ?>" />
            <input type="hidden" id="tamano_cuchillo_2" name="tamano_cuchillo_2" value="<?php echo ($ing->tamano_cuchillo_2); ?>" />
            
			<?php 
                        $bobinado=$this->produccion_model->getBobinadoCartulinaPorTipo(1,$datos->id);
                        $ccartulina=$this->produccion_model->getCorteCartulinaPorTipo(1,$datos->id);
                        
			if($produccionFotomecanica->estado == 1){
				if($control_cartulina->estado !=1)
				{   
			?>
			
			<input type="button" value="Parcial" class="btn <?php if($control_cartulina->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial' />
			<input type="button" value="Guardar" class="btn <?php if($control_cartulina->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
                        <input type="button" value="Liberar" class="btn <?php if($control_cartulina->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
			
			
			<?php
				}else{
                                    if(count($bobinado) == 0 && count($ccartulina) == 0){?>
                                    <input type="button" value="Parcial" class="btn <?php if($control_cartulina->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial' />
                                    <input type="button" value="Guardar" class="btn <?php if($control_cartulina->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
                                    <input type="button" value="Liberar" class="btn <?php if($control_cartulina->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
                                    <?php
                                    echo '&nbsp;&nbsp;&nbsp;<span style="background-color:green; color:white;">&nbsp;&nbsp;Control Cartulina Liberado (Pendiente en bobinado y corte cartulina)&nbsp;&nbsp;<span>';
                                    }else{    
                                    echo 'Control Cartulina Liberado';
                                    }
                                    }
			}else{
				echo '<h7>Libere FOTOMECÁNICA antes de guardar proceso Control Cartulina</h7>';
				
				?>
				<br>
				<br>
				<br>
				<input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />		
				<?php
			}
			?>
			
		</div>
	</div>
</form>

<?php

//if($control_cartulina->gramaje != $materialidad_1->gramaje)
//{
	?>
<!--	<script type="text/javascript">
		ControlGranajeSeleccionado(<?php // echo $id?>);
	</script>-->
<?php
//}

?>

<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
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
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".datepicker").datepicker({
		startDate	: 'today',
                format          : 'yyyy-mm-dd',
	});
});
</script>
<script type="text/javascript">
    $(window).load(function() {
    verificaAnchoSeleccionadoDeBobina('<?php echo ($ing->tamano_a_imprimir_1*10);  ?>');
});    

</script>
<script type="text/javascript">
    $(window).load(function() {
      function comprobarkilos(){
      var tk=$("#total_kilos").val();
      var kb=$("#kilos_bobina_seleccionada").val();
      var sbk=$("#segunda_bobina_adicional_kilos").val();
      var tbk=$("#tercera_bobina_adicional_kilos").val();
      var cbk=$("#cuarta_bobina_adicional_kilos").val();
      if((kb+sbk+tbk+cbk)<tk){    
        $("#comprobacion_de_kilos").text("Faltan bobinas para alcanzar el total de kilos de la Cartulina Cotizadas")
      }else{
        $("#comprobacion_de_kilos").text("")    
      }
    }

    $('#existencia').change(function() {                
        if($('#existencia option:selected').val() != 'Stock Parcial') {
          $('#stock_parcial_opciones1').hide();
          $('#stock_parcial_opciones2').hide();

          $('#comprar_saldo_opciones1').hide();
          $('#comprar_saldo_opciones2').hide();
          $('#comprar_saldo_opciones3').hide();
          $('#comprar_saldo_opciones4').hide();
          $('#comprar_saldo_opciones5').hide();
          $('#select_stock_parcial_opciones1').val("");
        }else{
          $("#stock_parcial_opciones1").show();
          $("#stock_parcial_opciones2").show();
        }

        if($('#existencia option:selected').val() != 'Comprar Parcial') {
          $('#comprar_parcial_opciones1').hide();
          $('#comprar_parcial_opciones2').hide();
          $('#comprar_parcial_opciones3').hide();
          $('#comprar_parcial_opciones4').hide();
          $('#comprar_parcial_opciones5').hide();
        }else{
          $("#comprar_parcial_opciones1").show();
          $("#comprar_parcial_opciones2").show();
          $("#comprar_parcial_opciones3").show();
          $("#comprar_parcial_opciones4").show();
          $("#comprar_parcial_opciones5").show();
        }

        if($('#existencia option:selected').val() != 'Comprar Total') {
          $('#comprar_total_opciones1').hide();
          $('#comprar_total_opciones2').hide();
          $('#comprar_total_opciones3').hide();
          $('#comprar_total_opciones4').hide();
          $('#comprar_total_opciones5').hide();
        }else{
          $("#comprar_total_opciones1").show();
          $("#comprar_total_opciones2").show();
          $("#comprar_total_opciones3").show();
          $("#comprar_total_opciones4").show();
          $("#comprar_total_opciones5").show();
        }
    });



    $('#select_stock_parcial_opciones1').change(function() {                
        if($('#select_stock_parcial_opciones1 option:selected').val() != 'Comprar Saldo') {
          $('#comprar_saldo_opciones1').hide();
          $('#comprar_saldo_opciones2').hide();
          $('#comprar_saldo_opciones3').hide();
          $('#comprar_saldo_opciones4').hide();
          $('#comprar_saldo_opciones5').hide();
        }else{
          $("#comprar_saldo_opciones1").show();
          $("#comprar_saldo_opciones2").show();
          $("#comprar_saldo_opciones3").show();
          $("#comprar_saldo_opciones4").show();
          $("#comprar_saldo_opciones5").show();
        }
    });
    
    

$("#cuarta_bobina_adicional_kilos").on("keyup",function(){
    var tk=$("#total_kilos").val();
    var kb=$("#kilos_bobina_seleccionada").val();
    var sbk=$("#segunda_bobina_adicional_kilos").val();
    var tbk=$("#tercera_bobina_adicional_kilos").val();
    var cbk=$("#cuarta_bobina_adicional_kilos").val();
    
    var cant =parseInt(kb)+parseInt(sbk)+parseInt(tbk)+parseInt(cbk);
    if(cant<tk){    
    $("#comprobacion_de_kilos").text("Faltan bobinas para alcanzar el total de kilos de la Cartulina Cotizadas")
    }else{
    $("#comprobacion_de_kilos").text("")    
    }
});
$("#tercera_bobina_adicional_kilos").on("keyup",function(){
    var tk=$("#total_kilos").val();
    var kb=$("#kilos_bobina_seleccionada").val();
    var sbk=$("#segunda_bobina_adicional_kilos").val();
    var tbk=$("#tercera_bobina_adicional_kilos").val();
    var cbk=$("#cuarta_bobina_adicional_kilos").val();
    
    var cant =parseInt(kb)+parseInt(sbk)+parseInt(tbk)+parseInt(cbk);
    if(cant<tk){    
    $("#comprobacion_de_kilos").text("Faltan bobinas para alcanzar el total de kilos de la Cartulina Cotizadas")
    }else{
    $("#comprobacion_de_kilos").text("")    
    }
});
$("#segunda_bobina_adicional_kilos").on("keyup",function(){
    var tk=$("#total_kilos").val();
    var kb=$("#kilos_bobina_seleccionada").val();
    var sbk=$("#segunda_bobina_adicional_kilos").val();
    var tbk=$("#tercera_bobina_adicional_kilos").val();
    var cbk=$("#cuarta_bobina_adicional_kilos").val();

    var cant =parseInt(kb)+parseInt(sbk)+parseInt(tbk)+parseInt(cbk);
    if(cant<tk){    
    $("#comprobacion_de_kilos").text("Faltan bobinas para alcanzar el total de kilos de la Cartulina Cotizadas")
    }else{
    $("#comprobacion_de_kilos").text("")    
    }
});

$("#kilos_bobina_seleccionada").on("change",function(){
    var h = $("#hay_que_bobinar").val();
    if((h=="NO") || (h=="SI")){
        totalbobinas();
    }
});
$("#kilos_bobina_seleccionada").on("keyup",function(){
    var h = $("#hay_que_bobinar").val();
    if((h=="NO") || (h=="SI")){
        totalbobinas();
    }
});


//--------------------PRIMERA BOBINA-----------------//
  //-------------Si cambia un valor en el select -------//
  $("#select_bobina1").change(function(){

      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }

      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });
  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }



      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#numero_de_bobina2").val(0);
        $("#numero_de_bobina2_div").hide();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto+" Kilos")
        $("#numero_de_bobina2_div").show();
      }

      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = (parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }
      ba();
});

//--------------------SEGUNDA BOBINA--------------------------//
  //-------------Si cambia un valor en el select -------//
  $("#select_bobina2").change(function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }


      //IMPRIMIR KILOS
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });

  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada2").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }


      //IMPRIMIR KILOS
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada2").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

        $("#numero_de_bobina2").val(0);
        $("#numero_de_bobina2_div").hide();
      }else{1
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto+" Kilos")
        $("#numero_de_bobina2_div").show();
      }

      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = (parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }
      ba();
});


//----------- TERCERA BOBINA --------------------//
//-------------Si cambia un valor en el select -------//
 $("#select_bobina3").change(function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }



      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });

  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada3").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        
        $("#resto2_metros").removeClass("label label-danger-mio padding");    
        $("#resto2_metros").addClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        $("#resto3_metros").removeClass("label label-danger-mio padding");    
        $("#resto3_metros").addClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto2_metros").addClass("label label-danger-mio padding");    
        $("#resto2_metros").removeClass("label label-success padding");    
        $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

        $("#resto3_metros").addClass("label label-danger-mio padding");    
        $("#resto3_metros").removeClass("label label-success padding");    
        $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }



      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        
        $("#resto2").removeClass("label label-danger-mio padding");    
        $("#resto2").addClass("label label-success padding");    
        $("#resto2").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");

        $("#resto3").removeClass("label label-danger-mio padding");    
        $("#resto3").addClass("label label-success padding");    
        $("#resto3").text(" Sobrepasa por: "+(resto_prueba*-1)+" Kilos");
        $("#numero_de_bobina2").val(0);
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto2").addClass("label label-danger-mio padding");    
        $("#resto2").removeClass("label label-success padding");    
        $("#resto2").text(" Restante: "+resto_prueba+" Kilos")

        $("#resto3").addClass("label label-danger-mio padding");    
        $("#resto3").removeClass("label label-success padding");    
        $("#resto3").text(" Restante: "+resto_prueba+" Kilos")

        $("#numero_de_bobina2_div").show();
      }
      ba();
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada3").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());

      //--------------------------METROS--------------------------------//

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3);
      if(resto<0){
      $("#resto1").removeClass("label label-danger-mio padding");    
      $("#resto1").addClass("label label-success padding");    
      $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

      $("#resto2").removeClass("label label-danger-mio padding");    
      $("#resto2").addClass("label label-success padding");    
      $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

      $("#resto3").removeClass("label label-danger-mio padding");    
      $("#resto3").addClass("label label-success padding");    
      $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos");

      $("#numero_de_bobina2").val(0);
      $("#numero_de_bobina2_div").hide();
      }else{1
      $("#resto1").addClass("label label-danger-mio padding");    
      $("#resto1").removeClass("label label-success padding");    
      $("#resto1").text(" Restante: "+resto+" Kilos")

      $("#resto2").addClass("label label-danger-mio padding");    
      $("#resto2").removeClass("label label-success padding");    
      $("#resto2").text(" Restante: "+resto+" Kilos")

      $("#resto3").addClass("label label-danger-mio padding");    
      $("#resto3").removeClass("label label-success padding");    
      $("#resto3").text(" Restante: "+resto+" Kilos")
      $("#numero_de_bobina2_div").show();
      }

      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      var resto_metros = Math.round(parseInt(resto)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000);
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      var resto_metros_ingresados1 = (Math.round(parseInt(bob1)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado1))*1000000));
      var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado2))*1000000));
      var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(bob_ancho)*parseInt(gramaje_seleccionado3))*1000000));

      var total_metros_ingresados = (parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros<0){
      $("#resto1_metros").removeClass("label label-danger-mio padding");    
      $("#resto1_metros").addClass("label label-success padding");    
      $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      
      $("#resto2_metros").removeClass("label label-danger-mio padding");    
      $("#resto2_metros").addClass("label label-success padding");    
      $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

      $("#resto3_metros").removeClass("label label-danger-mio padding");    
      $("#resto3_metros").addClass("label label-success padding");    
      $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
      }else{
      $("#resto1_metros").addClass("label label-danger-mio padding");    
      $("#resto1_metros").removeClass("label label-success padding");    
      $("#resto1_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

      $("#resto2_metros").addClass("label label-danger-mio padding");    
      $("#resto2_metros").removeClass("label label-success padding");    
      $("#resto2_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)

      $("#resto3_metros").addClass("label label-danger-mio padding");    
      $("#resto3_metros").removeClass("label label-success padding");    
      $("#resto3_metros").text("Metros ingresados: "+total_metros_ingresados+" Metros Restantes: "+resta_de_metros)
      }
      ba();
});










function ba(){
if($("#bobina_adicional").is(":visible")){
    $("#total_de_bobinas").val(2);
    $("#numero_de_bobina2_div").show();
    //$("#numero_de_bobina2").val(0);
}else{
    $("#total_de_bobinas").val(1);
    $("#numero_de_bobina2_div").hide();
    //$("#numero_de_bobina2").val("");
}}

$("#hay_que_bobinar").on("change",function(){
ba();    
});

ba();

comprobarkilos();

function comprobarvacio(){
    var kb=$("#kilos_bobina_seleccionada").val();
    var sbk=$("#segunda_bobina_adicional_kilos").val();
    var tbk=$("#tercera_bobina_adicional_kilos").val();
    var cbk=$("#cuarta_bobina_adicional_kilos").val();
    
    if(kb==""){
        $("#kilos_bobina_seleccionada").val(0);
    }
    if(sbk==""){
        $("#segunda_bobina_adicional_kilos").val(0);
    }
    if(tbk==""){
        $("#tercera_bobina_adicional_kilos").val(0);
    }
    if(cbk==""){
        $("#cuarta_bobina_adicional_kilos").val(0);
    }
}

});    



//totalbobinas();
</script>
</div>
