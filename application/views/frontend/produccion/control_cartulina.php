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
.h3_no_liberada{
  float: left;
  width: 100%;
  text-align: center;
  margin-top: -110px;
}
#numero_bobina2_div,#numero_bobina3_div,
#stock_parcial_opciones1,#stock_parcial_opciones2,#comprar_parcial_opciones1,#comprar_parcial_opciones2,
#comprar_total_opciones1,#comprar_total_opciones2,#comprar_total_opciones3,#comprar_total_opciones4,#comprar_total_opciones5,#comprar_total_opciones6,
#comprar_saldo_opciones0,#comprar_saldo_opciones1,#comprar_saldo_opciones2,#comprar_saldo_opciones3,#comprar_saldo_opciones4,#comprar_saldo_opciones5,#comprar_saldo_opciones6,
#comprar_parcial_opciones1,#comprar_parcial_opciones2,#comprar_parcial_opciones3,#comprar_parcial_opciones4,#comprar_parcial_opciones5,#comprar_parcial_opciones6,#comprar_parcial_opciones7,
#ComprarSaldoTotal_ComprarParcial_opciones1,#ComprarSaldoTotal_ComprarParcial_opciones2,#ComprarSaldoTotal_ComprarParcial_opciones3,#ComprarSaldoTotal_ComprarParcial_opciones4,#ComprarSaldoTotal_ComprarParcial_opciones5,#ComprarSaldoTotal_ComprarParcial_opciones6,
#menu_pliego,#menu_bobina
{
  display: none;
}
.border{
  border: 1px solid #dee2e6!important;
  padding: 10px;
  margin-top: 20px;
}
.parcial_bobina{
  border: 1px solid #dee2e6!important;
  display: inline-block;
  margin-top: 10px;
}
.parcial_bobina input{
  width: 70%;
  background: transparent;
}
.parcial_bobina h6{
  margin-left: 20px;
}
.totales_parcial{
  display: inline-block;
  width: 24%;
  margin-top: 10px;
}
.padding1{
  margin-left: 10px;
}
.totales_parcial span{
  width: 48%  !important;
  display: inline-block;
  float: left;
  padding-top: 4px
}
.totales_parcial input{
  width: 110px !important;
  float: right;
  margin-right: 75px;
  background: transparent;
}
.KilosFaltantes_ComprarParcial{
  float: right;
  margin-right: 20%;
  margin-top: -3.5%;
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
                                <li>Saldo pendiente : <strong><?php echo $hoja->placa_kilo - 0; ?></strong></li>     
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
                                  if ($fotomecanica2->fecha_liberada == '0000-00-00') {
                                    $fecha_liberada_foto = "No ha sido liberada de Fotomecanica";
                                  } else {
                                    $fecha_liberada_foto=fecha($fotomecanica2->fecha_liberada);
                                  } ?>
                                  <li>Fecha de liberacion Fotomecanica : <strong><?php echo $fecha_liberada_foto; ?></strong></li>
                                  <?php if ($control_cartulina->fecha_liberada!='0000-00-00 00:00:00') { ?>
                                    <li>Fecha de liberacion Control Cartulina : <strong><?php echo fecha($control_cartulina->fecha_liberada); ?></strong></li>
                                  <?php } ?>
                                  
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
ancho de la cartulina menos ccac1
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>                     
                     <li>Pinza : <strong><?php if($ing->pinza==""){echo $ing->tamano_a_imprimir_1 - (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10)." Mms | Ex."; }else{ echo $ing->pinza. "Mms";} ?> </strong></li>                     
                </ul>
            	</div>  
    </div>
    <?php if($produccionFotomecanica->estado != 3 && $produccionFotomecanica->estado != 1){ ?>
      <h3 class="h3_no_liberada"> Debe liberar en FOTOMECÁNICA antes de guardar todos los datos de Control Cartulina</h3>
    <?php } ?>
     
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
      <label class="control-label" for="usuario">Largo a cortar</label>
      <div class="controls">
        <input type="text" name="largo_a_cortar" id="largo_a_cortar" value="<?php echo $ing->tamano_a_imprimir_2; ?>" readonly="true" /> <strong>(Cms)</strong>
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
  					<!--<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />-->
  				<?php
  					}
  				}
  				?>
  			<span style="display: inline-block;"><strong>Total Metros: </strong><?php echo $total_metros_cotizados = round(($total_kilos/($ancho_cotizado*$gramaje_cotizado)*1000000)); ?></span>
        <input type="hidden" value="<?php echo $total_metros_cotizados; ?>" id="total_metros_cotizados">
      </div>
  	</div>
    
    <div class="control-group">
      <label class="control-label" for="usuario">Seleccionar Menu</label>
      <div class="controls">
        <select name="menu_bobina_pliego" id="menu_bobina_pliego" <?php echo set_value_select($control_cartulina,'menu_bobina_pliego',$control_cartulina->menu_bobina_pliego,$control_cartulina->menu_bobina_pliego)?>>
          <option value="">Seleccione</option>
          <option value="Menu Bobina" <?php if($control_cartulina->menu_bobina_pliego=="Menu Bobina"){echo "selected";} ?>>Menu Bobina</option>
          <option value="Menu Pliego" <?php if($control_cartulina->menu_bobina_pliego=="Menu Pliego"){echo "selected";} ?>>Menu Pliego</option>
        </select>
      </div>
    </div>

    <div id="menu_bobina">

    <?php if ($control_cartulina->situacion=='Parcial' && ($control_cartulina->fecha_liberada!='0000-00-00 00:00:00' || $control_cartulina->fecha_liberada!=null)) { ?>
        <!--<div class="border">-->
          <!--INICIO - PRIMERA LIBERACION PARCIAL-->
            <!--<h4 align="center">Primera liberación parcial</h4>-->
            
            <!--BOBINA 1
            <div class="parcial_bobina">
              <h6>Bobina 1</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina1_parcial_1" name="tapa_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina1_parcial_1" name="ancho_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina1_parcial_1" name="kilos_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina1_parcial_1" name="gramaje_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->

            <!--BOBINA 2
            <div class="parcial_bobina">
              <h6>Bobina 2</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina2_parcial_1" name="tapa_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina2_parcial_1" name="ancho_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina2_parcial_1" name="kilos_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina2_parcial_1" name="gramaje_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--BOBINA 3
            <div class="parcial_bobina">
              <h6>Bobina 3</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina3_parcial_1" name="tapa_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina3_parcial_1" name="ancho_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina3_parcial_1" name="kilos_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina3_parcial_1" name="gramaje_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--INICIO - TOTAL-->
              <div class="totales_parcial padding1">
                  <span>Fecha Liberada 1</span>
                  <div class="controls">
                    <input type="text"  id="fecha_liberada_parcial_1" name="fecha_liberada_parcial_1" value="<?php echo $control_cartulina->fecha_liberada; ?>" readonly="true" /> 
                  </div>
              </div>

              <!--<div class="totales_parcial">
                  <span>Metros Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_ingresados_parcial_1" name="total_metros_ingresados_parcial_1" value="<?php echo $control_cartulina->total_metros_ingresados_parcial_1; ?>" readonly="true" /> 
                  </div>
              </div>-->
             
              <div class="totales_parcial">
                  <span>Kilos Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_ingresados_parcial_1" name="total_kilos_ingresados_parcial_1" value="<?php if($control_cartulina->total_kilos_ingresados==null || $control_cartulina->total_kilos_ingresados==''){echo 0;}else{echo $control_cartulina->total_kilos_ingresados;} ?>" readonly="true" /> 
                  </div>
              </div>

              <div class="totales_parcial">
                  <span>Kilos Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_restantes_parcial_1" name="total_kilos_restantes_parcial_1" value="<?php echo $kilos_restantes_parcial_1 = $control_cartulina->total_kilos_restantes; ?>" readonly="true" /> 
                  </div>
              </div>
              
              <div class="totales_parcial">
                  <span>Metros Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_restantes_parcial_1" name="total_metros_restantes_parcial_1" value="<?php if($control_cartulina->total_metros_restantes==null || $control_cartulina->total_metros_restantes==''){echo 0;}else{echo $control_cartulina->total_metros_restantes;} ?>" readonly="true" /> 
                  </div>
              </div>
            <!--FIN - TOTAL-->
          <!--FIN - PRIMERA LIBERACION PARCIAL-->
        <!--</div>-->
        <br>
    <?php } if($control_cartulina->fecha_liberada_parcial_2!='0000-00-00 00:00:00' && $control_cartulina->fecha_liberada_parcial_2!=null) { ?>
        <!--  <div class="border"> -->
          <!--INICIO - Segunda LIBERACION PARCIAL-->
            <!--<h4 align="center">Segunda liberación parcial</h4>-->
            
            <!--BOBINA 1
            <div class="parcial_bobina">
              <h6>Bobina 1</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina1_parcial_1" name="tapa_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina1_parcial_1" name="ancho_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina1_parcial_1" name="kilos_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina1_parcial_1" name="gramaje_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->

            <!--BOBINA 2
            <div class="parcial_bobina">
              <h6>Bobina 2</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina2_parcial_1" name="tapa_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina2_parcial_1" name="ancho_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina2_parcial_1" name="kilos_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina2_parcial_1" name="gramaje_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--BOBINA 3
            <div class="parcial_bobina">
              <h6>Bobina 3</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina3_parcial_1" name="tapa_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina3_parcial_1" name="ancho_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina3_parcial_1" name="kilos_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina3_parcial_1" name="gramaje_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--INICIO - TOTAL-->  
              <div class="totales_parcial padding1">
                  <span>Fecha Liberada 2</span>
                  <div class="controls">
                    <input type="text"  id="fecha_liberada_parcial_2" name="fecha_liberada_parcial_2" value="<?php echo $control_cartulina->fecha_liberada_parcial_2; ?>" readonly="true" /> 
                  </div>
              </div>

              <!--<div class="totales_parcial">
                  <span>Metros Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_ingresados_parcial_2" name="total_metros_ingresados_parcial_2" value="<?php echo $control_cartulina->total_metros_ingresados_parcial_2; ?>" readonly="true" /> 
                  </div>
              </div>-->

              
              
              <div class="totales_parcial">
                  <span>Kilos Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_ingresados_parcial_2" name="total_kilos_ingresados_parcial_2" value="<?php if($control_cartulina->total_kilos_ingresados_parcial_2==null || $control_cartulina->total_kilos_ingresados_parcial_2==''){echo 0;}else{echo $control_cartulina->total_kilos_ingresados_parcial_2;} ?>" readonly="true" /> 
                  </div>
              </div>

              <div class="totales_parcial">
                  <span>Kilos Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_restantes_parcial_2" name="total_kilos_restantes_parcial_2" value="<?php echo $kilos_restantes_parcial_2 = $control_cartulina->total_kilos_restantes_parcial_2; ?>" readonly="true" /> 
                  </div>
              </div>

              <div class="totales_parcial">
                  <span>Metros Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_restantes_parcial_2" name="total_metros_restantes_parcial_2" value="<?php if($control_cartulina->total_metros_restantes_parcial_2==null || $control_cartulina->total_metros_restantes_parcial_2==''){echo 0;}else{echo $control_cartulina->total_metros_restantes_parcial_2;} ?>" readonly="true" /> 
                  </div>
              </div>
            <!--FIN - TOTAL-->
          <!--FIN - SEGUNDA LIBERACION PARCIAL-->
        <!--</div>-->
        <br>
    <?php } if($control_cartulina->fecha_liberada_parcial_3!='0000-00-00 00:00:00' && $control_cartulina->fecha_liberada_parcial_3!=null) { ?>
        <!--<div class="border"> -->
          <!--INICIO - Tercera LIBERACION PARCIAL-->
            <!--<h4 align="center">Tercera liberación parcial</h4>-->
            
            <!--BOBINA 1
            <div class="parcial_bobina">
              <h6>Bobina 1</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina1_parcial_1" name="tapa_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina1_parcial_1" name="ancho_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina1_parcial_1" name="kilos_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina1_parcial_1" name="gramaje_seleccionado_bobina1_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina1_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->

            <!--BOBINA 2
            <div class="parcial_bobina">
              <h6>Bobina 2</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina2_parcial_1" name="tapa_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina2_parcial_1" name="ancho_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina2_parcial_1" name="kilos_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina2_parcial_1" name="gramaje_seleccionado_bobina2_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina2_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--BOBINA 3
            <div class="parcial_bobina">
              <h6>Bobina 3</h6>
              <div class="control-group">
                <label class="control-label" for="usuario">Tapas seleccionado</label>
                <div class="controls">
                  <input type="text"  id="tapa_seleccionado_bobina3_parcial_1" name="tapa_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->tapa_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Ancho seleccionado</label>
                <div class="controls">
                  <input type="text"  id="ancho_seleccionado_bobina3_parcial_1" name="ancho_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->ancho_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Kilos seleccionado</label>
                <div class="controls">
                  <input type="text"  id="kilos_seleccionado_bobina3_parcial_1" name="kilos_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->kilos_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="usuario">Gramaje seleccionado</label>
                <div class="controls">
                  <input type="text"  id="gramaje_seleccionado_bobina3_parcial_1" name="gramaje_seleccionado_bobina3_parcial_1" value="<?php echo $control_cartulina->gramaje_seleccionado_bobina3_parcial_1; ?>" readonly="true" /> 
                </div>
              </div>
            </div>
            -->
            <!--INICIO - TOTAL-->  
              <div class="totales_parcial padding1">
                  <span>Fecha Liberada 3</span>
                  <div class="controls">
                    <input type="text"  id="fecha_liberada_parcial_3" name="fecha_liberada_parcial_3" value="<?php echo $control_cartulina->fecha_liberada_parcial_3; ?>" readonly="true" /> 
                  </div>
              </div>

              <!--<div class="totales_parcial">
                  <span>Metros Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_ingresados_parcial_3" name="total_metros_ingresados_parcial_3" value="<?php echo $control_cartulina->total_metros_ingresados_parcial_3; ?>" readonly="true" /> 
                  </div>
              </div>-->

              
              
              <div class="totales_parcial">
                  <span>Kilos Ingresados</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_ingresados_parcial_3" name="total_kilos_ingresados_parcial_3" value="<?php if($control_cartulina->total_kilos_ingresados_parcial_3==null || $control_cartulina->total_kilos_ingresados_parcial_3==''){echo 0;}else{echo $control_cartulina->total_kilos_ingresados_parcial_3;} ?>" readonly="true" /> 
                  </div>
              </div>

              <div class="totales_parcial">
                  <span>Kilos Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_kilos_restantes_parcial_3" name="total_kilos_restantes_parcial_3" value="<?php echo $control_cartulina->total_kilos_restantes_parcial_3; ?>" readonly="true" /> 
                  </div>
              </div>

              <div class="totales_parcial">
                  <span>Metros Restantes</span>
                  <div class="controls">
                    <input type="text"  id="total_metros_restantes_parcial_3" name="total_metros_restantes_parcial_3" value="<?php if($control_cartulina->total_metros_restantes_parcial_3==null || $control_cartulina->total_metros_restantes_parcial_3==''){echo 0;}else{echo $control_cartulina->total_metros_restantes_parcial_3;} ?>" readonly="true" /> 
                  </div>
              </div>
            <!--FIN - TOTAL-->
          <!--FIN - Tercera LIBERACION PARCIAL-->
        <!--</div>-->
    <?php } ?>


  
  <!--INICIO - EXISTENCIA-->
    <h3>Existencia</h3>
    <div class="control-group">
      <label class="control-label" for="usuario">Estado Materia prima</label>
      <div class="controls">
          <select name="existencia" id="existencia" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia,$control_cartulina->existencia)?> onchange="return restringe_bobinas();">
            <option value="">Seleccione...</option>
            <option value="Hay stock total" <?php if($control_cartulina->existencia=="Hay stock total"){echo "selected";} ?> >Hay stock total</option>
            <option value="Comprar Total" id="comprar_total"  <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Comprar Total');?>>Comprar total</option>
            <option value="Stock Parcial" id="stock_parcial" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Stock Parcial');?>>Hay stock parcial</option>
            <option value="Comprar Parcial" id="comprar_parcial" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Comprar Parcial');?>>Comprar Parcial</option>
        </select>
      </div>
    </div>
    <!--INCIO - RESULTADO DE LA RESTA DE: TOTAL_KILOS - KILOS COMPRAR PARCIAL -->
      <?php 
        $resultado_faltante=$total_kilos-$control_cartulina->Kilos_ComprarParcial;
        if ($resultado_faltante>0 && $control_cartulina->existencia=='Comprar Parcial') { ?>
          <div class="KilosFaltantes_ComprarParcial">
            <label class="control-label" for="usuario">Cantidad de kilos faltantes</label>
            <div class="controls">
              <input type="text" readonly value="<?php echo $resultado_faltante; ?>">
            </div>
          </div>
        <?php } ?>
      
    <!--FIN - RESULTADO DE LA RESTA DE: TOTAL_KILOS - KILOS COMPRAR PARCIAL -->  
  
    <!--INCIO - Proviene del select "existencia" y al presionar "Comprar Total"-->
      <div class="control-group" id="comprar_total_opciones1">
        <label class="control-label" for="usuario">Proveedor</label>
        <div class="controls">
          <select name="Proveedor_CompraTotal"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
              <option value="">Seleccione</option>

              <?php
              if ($control_cartulina->existencia=="Comprar Total") { ?>
                <option value="<?php echo $control_cartulina->Proveedor_CompraTotal ?>"><?php echo $control_cartulina->Proveedor_CompraTotal?></option>
              <?php }
              $proves=$this->proveedores_model->getProveedores();

                  foreach($proves as $prove)
                  {
                  ?>
                    <option value="<?php echo $prove->id?>" <?php if($control_cartulina->Proveedor_CompraTotal==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                  <?php
                  }
              ?>
          </select>
        </div>
      </div>

      <div class="control-group" id="comprar_total_opciones2">
        <label class="control-label" for="usuario">Material Comprado</label>
        <div class="controls">
          <select id="mate1" name="MaterialComprado_CompraTotal" class="chosen-select" style="width: 300px">
            <option value="0">Seleccione......</option>
            <?php
            $tapas=$this->materiales_model->getMaterialesSelectCartulina();
            foreach($tapas as $tapa){
            if (sizeof($ing)>0) {  ?>                
                <?php if($ing->id_mat_placa1!=""){?>
                <option value="<?php echo $tapa->id?>" <?php if($control_cartulina->MaterialComprado_CompraTotal==$tapa->id){ echo 'selected="true"';}?> ><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
          <input type="number" name="Ancho_CompraTotal" id="Ancho_CompraTotal" value="<?php echo $control_cartulina->Ancho_CompraTotal; ?>" placeholder="Ancho" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
        </div>
      </div>

      <div class="control-group" id="comprar_total_opciones6">
        <label class="control-label" for="usuario">Kilos</label>
        <div class="controls">
          <input type="number" name="Kilos_CompraTotal" id="Kilos_CompraTotal" value="<?php echo $control_cartulina->Kilos_CompraTotal; ?>" placeholder="Kilos">
        </div>
      </div>

      <div class="control-group" id="comprar_total_opciones4">
        <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
        <div class="controls">
          <input type="date" name="FechaEstimada_CompraTotal" value="<?php echo $control_cartulina->FechaEstimada_CompraTotal; ?>">
        </div>
      </div>

      <div class="control-group" id="comprar_total_opciones5">
        <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
        <div class="controls">
          <input type="date" name="FechaRecepcion_CompraTotal" value="<?php echo $control_cartulina->FechaRecepcion_CompraTotal; ?>">
        </div>
      </div>
    <!--FIN - Proviene del select "existencia" y al presionar "Comprar Total"-->

    <!--INICIO - Proviene del select "existencia" y al presionar "Hay Stock Parcial"-->
      <div class="control-group" id="stock_parcial_opciones1">
        <label class="control-label" for="usuario">Opciones</label>
        <div class="controls">
          <select name="Opciones_StockParcial" id="Opciones_StockParcial">
            <option value="">Seleccione</option>
            <option value="Comprar Saldo" id="comprar_saldo" <?php echo set_value_select($control_cartulina,'Opciones_StockParcial',$control_cartulina->Opciones_StockParcial  ,'Comprar Saldo');?>>Comprar Saldo</option>
            <option value="Se produce parcial" <?php echo set_value_select($control_cartulina,'Opciones_StockParcial',$control_cartulina->Opciones_StockParcial  ,'Se produce parcial');?>>Se produce parcial</option>
            <option value="Comprar Parcial y Producir Parcial" id="comprar_parcial_producir_parcial" <?php echo set_value_select($control_cartulina,'Opciones_StockParcial',$control_cartulina->Opciones_StockParcial  ,'Comprar Parcial Producir Parcial');?>>Comprar Parcial y Producir Parcial</option>
          </select>
        </div>
      </div>
      
        <!--INICIO - Proviene del select "Opciones_StockParcial" y al presionar "Comprar Saldo"-->

          <div class="control-group" id="comprar_saldo_opciones0">
            <label class="control-label" for="usuario">¿Cuantos kilos hay en stock?</label>
            <div class="controls">
              <input type="number" name="KilosEnStock_ComprarSaldo_StockParcial" id="KilosEnStock_ComprarSaldo_StockParcial" value="<?php echo $control_cartulina->KilosEnStock_ComprarSaldo_StockParcial; ?>" placeholder="Kilos en stock">
            </div>
          </div>

          <div class="control-group" id="comprar_saldo_opciones1">
            <label class="control-label" for="usuario">Proveedor</label>
            <div class="controls">
              <select name="Proveedor_ComprarSaldo_StockParcial"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
                  <option value="">Seleccione</option>
                  <?php
                  $proves=$this->proveedores_model->getProveedores();

                      foreach($proves as $prove)
                      {
                      ?>
                        <option value="<?php echo $prove->id?>" <?php if($control_cartulina->Proveedor_ComprarSaldo_StockParcial==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                      <?php
                      }
                  ?>
              </select>
            </div>
          </div>

          <div class="control-group" id="comprar_saldo_opciones2">
            <label class="control-label" for="usuario">Material Comprado</label>
            <div class="controls">
              <select id="mate1" name="MaterialComprado_ComprarSaldo_StockParcial" class="chosen-select" style="width: 300px">
                <option value="0">Seleccione......</option>
                <?php
                $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                foreach($tapas as $tapa){
                if (sizeof($ing)>0) {  ?>                
                    <?php if($control_cartulina->MaterialComprado_ComprarSaldo_StockParcial!=""){?>
                    <option value="<?php echo $tapa->id?>" <?php if($control_cartulina->MaterialComprado_ComprarSaldo_StockParcial==$tapa->id){ echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
              <input type="number" name="Ancho_ComprarSaldo_StockParcial" id="Ancho_ComprarSaldo_StockParcial" value="<?php echo $control_cartulina->Ancho_ComprarSaldo_StockParcial; ?>" placeholder="Ancho" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
            </div>
          </div>

          <div class="control-group" id="comprar_saldo_opciones6">
            <label class="control-label" for="usuario">Kilos</label>
            <div class="controls">
              <input type="number" name="Kilos_ComprarSaldo_StockParcial" id="Kilos_ComprarSaldo_StockParcial" value="<?php echo $control_cartulina->Kilos_ComprarSaldo_StockParcial; ?>" placeholder="Kilos">
            </div>
          </div>

          <div class="control-group" id="comprar_saldo_opciones4">
            <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
            <div class="controls">
              <input type="date" name="FechaEstimada_ComprarSaldo_StockParcial" value="<?php echo $control_cartulina->FechaEstimada_ComprarSaldo_StockParcial; ?>">
            </div>
          </div>

          <div class="control-group" id="comprar_saldo_opciones5">
            <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
            <div class="controls">
              <input type="date" name="FechaRecepcion_ComprarSaldo_StockParcial" value="<?php echo $control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial; ?>">
            </div>
          </div>
        <!--FIN - Proviene del select "Opciones_StockParcial" y al presionar "Comprar Saldo"-->
    <!--FIN - Proviene del select "existencia" y al presionar "Hay Stock Parcial"-->

    <!--INCIO - Proviene del select "existencia" y al presionar "Comprar Parcial"-->
      <div class="control-group" id="comprar_parcial_opciones1">
        <label class="control-label" for="usuario">Proveedor</label>
        <div class="controls">
          <select name="Proveedor_ComprarParcial"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
              <option value="">Seleccione</option>
              <?php
              $proves=$this->proveedores_model->getProveedores();

                  foreach($proves as $prove)
                  {
                  ?>
                    <option value="<?php echo $prove->id?>" <?php if($control_cartulina->Proveedor_ComprarParcial==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                  <?php
                  }
              ?>
          </select>
        </div>
      </div>

      <div class="control-group" id="comprar_parcial_opciones2">
        <label class="control-label" for="usuario">Material Comprado</label>
        <div class="controls">
          <select id="mate1" name="MaterialComprado_ComprarParcial" class="chosen-select" style="width: 300px">
            <option value="0">Seleccione......</option>
            <?php
            $tapas=$this->materiales_model->getMaterialesSelectCartulina();
            foreach($tapas as $tapa){
            if (sizeof($ing)>0) {  ?>                
                <?php if($control_cartulina->MaterialComprado_ComprarParcial!=""){?>
                <option value="<?php echo $tapa->id?>" <?php if($control_cartulina->MaterialComprado_ComprarParcial==$tapa->id){ echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                <?php }else{ ?>
                <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /* echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                <?php } ?>
            <?php } else { ?>
                <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($datos->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){ /* echo 'selected="true"';*/}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
            <?php }
            }
            ?>
          </select>
        </div>
      </div>

      <div class="control-group" id="comprar_parcial_opciones3">
        <label class="control-label" for="usuario">Ancho (Cms)</label>
        <div class="controls">
          <input type="number" name="Ancho_ComprarParcial" id="Ancho_ComprarParcial" placeholder="Ancho" value="<?php echo $control_cartulina->Ancho_ComprarParcial; ?>" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
        </div>
      </div>

      <div class="control-group" id="comprar_parcial_opciones7">
        <label class="control-label" for="usuario">Kilos</label>
        <div class="controls">
          <input type="number" name="Kilos_ComprarParcial" id="Kilos_ComprarParcial" placeholder="Kilos" value="<?php echo $control_cartulina->Kilos_ComprarParcial; ?>">
        </div>
      </div>

      <div class="control-group" id="comprar_parcial_opciones4">
        <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
        <div class="controls">
          <input type="date" name="FechaEstimada_ComprarParcial" id="FechaEstimada_ComprarParcial" value="<?php if ($control_cartulina->FechaEstimada_ComprarParcial != '0000-00-00'){ echo $control_cartulina->FechaEstimada_ComprarParcial; } else { echo '0000-00-00';} ?>">
        </div>
      </div>

      <div class="control-group" id="comprar_parcial_opciones5">
        <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
        <div class="controls">
          <input type="date" name="FechaRecepcion_ComprarParcial" id="FechaRecepcion_ComprarParcial" value="<?php if ($control_cartulina->FechaRecepcion_ComprarParcial != '0000-00-00'){ echo $control_cartulina->FechaRecepcion_ComprarParcial; } else {echo "0000-00-00"; } ?>">
        </div>
      </div>
      
      <div class="control-group" id="comprar_parcial_opciones6">
        <label class="control-label" for="usuario">Opciones</label>
        <div class="controls">
          <select name="Opciones_ComprarParcial" id="Opciones_ComprarParcial" <?php echo set_value_select($control_cartulina,'Opciones_ComprarParcial',$control_cartulina->Opciones_ComprarParcial,$control_cartulina->Opciones_ComprarParcial)?>>
            <option value="">Seleccione</option>
            <option value="Comprar saldo total" <?php echo set_value_select($control_cartulina,'Opciones_ComprarParcial',$control_cartulina->Opciones_ComprarParcial  ,'Comprar saldo total');?>>Comprar saldo total</option>
            <option value="Se produce parcial"  <?php echo set_value_select($control_cartulina,'Opciones_ComprarParcial',$control_cartulina->Opciones_ComprarParcial  ,'Se produce parcial');?>>Se produce parcial</option>
          </select>
        </div>
      </div>
        

      <!-- SE VISUALIZA SI ESTA SELECCIONADO "COMPRAR PARCIAL" Y SI SELECCIONA "COMPRAR SALDO TOTAL" -->
        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones1">
          <label class="control-label" for="usuario">Proveedor</label>
          <div class="controls">
            <select name="Proveedor_ComprarSaldo_ComprarParcial"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
                <option value="">Seleccione</option>
                <?php
                $proves=$this->proveedores_model->getProveedores();
                    foreach($proves as $prove)
                    {
                    ?>
                      <option value="<?php echo $prove->id?>" <?php if($control_cartulina->Proveedor_ComprarSaldo_ComprarParcial==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                    <?php
                    }
                ?>
            </select>
          </div>
        </div>

        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones2">
          <label class="control-label" for="usuario">Material Comprado</label>
          <div class="controls">
            <select id="MaterialComprado_ComprarSaldo_ComprarParcial" name="MaterialComprado_ComprarSaldo_ComprarParcial" class="chosen-select" style="width: 300px">
              <option value="0">Seleccione......</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa){
              if (sizeof($ing)>0) {  ?>                
                  <?php if($control_cartulina->MaterialComprado_ComprarSaldo_ComprarParcial!=""){?>
                  <option value="<?php echo $tapa->id?>" <?php if($control_cartulina->MaterialComprado_ComprarSaldo_ComprarParcial==$tapa->id){ echo 'selected="true"'; }?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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

        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones3">
          <label class="control-label" for="usuario">Ancho (Cms)</label>
          <div class="controls">
            <input type="number" name="Ancho_ComprarSaldo_ComprarParcial" id="Ancho_ComprarSaldo_ComprarParcial" placeholder="Ancho" value="<?php echo $control_cartulina->Ancho_ComprarSaldo_ComprarParcial; ?>" min="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>">
          </div>
        </div>

        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones6">
          <label class="control-label" for="usuario">Kilos</label>
          <div class="controls">
            <input type="number" name="Kilos_ComprarSaldo_ComprarParcial" id="Kilos_ComprarSaldo_ComprarParcial" placeholder="Kilos" value="<?php echo $control_cartulina->Kilos_ComprarSaldo_ComprarParcial; ?>">
          </div>
        </div>

        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones4">
          <label class="control-label" for="usuario">Fecha estimada de recepcion en fabrica</label>
          <div class="controls">
            <input type="date" name="FechaEstimada_ComprarSaldo_ComprarParcial" id="FechaEstimada_ComprarSaldo_ComprarParcial" value="<?php echo $control_cartulina->FechaEstimada_ComprarSaldo_ComprarParcial; ?>">
          </div>
        </div>

        <div class="control-group" id="ComprarSaldoTotal_ComprarParcial_opciones5">
          <label class="control-label" for="usuario">Fecha de recepcion efectiva en fabrica</label>
          <div class="controls">
            <input type="date" name="FechaRecepcion_ComprarSaldo_ComprarParcial" id="FechaRecepcion_ComprarSaldo_ComprarParcial" value="<?php echo $control_cartulina->FechaRecepcion_ComprarSaldo_ComprarParcial ?>">
          </div>
        </div>
      <!--FIN COMPRA SALDO TOTAL DE COMPRAR PARCIAL-->
    <!--FIN - Proviene del select "existencia" y al presionar "Comprar Parcial"-->
  <!-- FIN - EXISTENCIA-->

  <!--PRIMERA BOBINA-->
  <div id="primera_bobina" style="display: none">
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
        <input type="text" name="gramaje_seleccionado" id="gramaje_seleccionado" value="<?php echo $gramaje_cotizado = $materialidad_1->gramaje?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
      </div>
  	</div>

    <div class="control-group">
      <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 1ra Bobina</label>
      <div class="controls">
        <input type="text" name="ancho_seleccionado_de_bobina" id="ancho_seleccionado_de_bobina"  value="<?php if($control_cartulina->ancho_seleccionado_de_bobina >0){echo ($control_cartulina->ancho_seleccionado_de_bobina);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onchange="validar_ancho_bobina_seleccionada();" onchange="/*validacion_ancho_bobina_seleccionada_control_cartulina();ControlGranajeSeleccionado(<?php //echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina1"></span>
      </div>
    </div>


    <div class="control-group">
		  <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 1ra Bobina</label>
		  <div class="controls">
        <input type="text" name="kilos_bobina_seleccionada"  max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada"  value="<?php if($control_cartulina->kilos_bobina_seleccionada >0 && ($control_cartulina->situacion=='Guardar' || $control_cartulina->situacion=='Liberada')){echo ($control_cartulina->kilos_bobina_seleccionada);}else{echo 0;}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto1_metros"></span><span class="" id="resto1"></span>
      </div> 
	  </div> 

    <div class="control-group">
  		<label class="control-label" for="usuario"><strong>Hay que bobinar</strong></label>
  		<div class="controls">
        <select id="hay_que_bobinar" name="hay_que_bobinar" onchange="validar_kilos_bobina_seleccionada();Hay_Que_Bobinar_Carutlina(this.value);otra_bobina(this.value);totalbobinas();validar_ancho_bobina_seleccionada(this)">
          <option value="" <?php if (sizeof($control_cartulina)==0){echo "selected";}?>>Seleccione</option>                                            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'NO');?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'SI');?>>SI</option>
        </select>
      </div>
          </div>
    </div>
    <div id="segunda_bobina" style="display: none">
  <!------------------------------------------------------------------>
  <!--SEGUNDA BOBINA-->
    <h3>SEGUNDA BOBINA</h3>    
      <div   <?php // if(sizeof($bobinas)==0){ echo 'hidden="true"';}?>>
        <?php //print_r($control_cartulina); exit();// echo $control_cartulina->descripcion_de_la_tapa."holaaaa"; ?>
      <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 2da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa2" id="select_bobina2" class="chosen-select" onchange="carga_ajax_obtenerGramaje2(this.value,'gramaje_ajax2');">
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
                  } else  { 
                      if ($control_cartulina->descripcion_de_la_tapa2=='') { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa ){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php } else { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php }
                    ?>
                    
                   <?php }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 2da Bobina</label>
        <div id="gramaje_ajax2" class="controls">
          <input type="text" name="gramaje_seleccionado2" id="gramaje_seleccionado2" value="<?php if ($control_cartulina->gramaje_seleccionado2>0) { echo $control_cartulina->gramaje_seleccionado2; } else { echo $gramaje_cotizado = $materialidad_1->gramaje;} ?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado2(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 2da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina2" id="ancho_seleccionado_de_bobina2"  value="<?php if ($control_cartulina->ancho_seleccionado_de_bobina2>0) { echo $control_cartulina->ancho_seleccionado_de_bobina2;}else{echo 0;}//if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="//validacion_ancho_bobina_seleccionada_control_cartulina2();" onchange="/*validacion_ancho_bobina_seleccionada_control_cartulina2();*/ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina2"></span>
        </div>
      </div> 

      <div class="control-group">
  		  <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 2da Bobina</label>
  		  <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada2"   max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada2"  value="<?php if ($control_cartulina->kilos_bobina_seleccionada2>0) { echo $control_cartulina->kilos_bobina_seleccionada2;}else{echo 0;}//if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto2_metros"></span><span class="" id="resto2"></span>
        </div>
      </div> 
    </div>
    </div>
  <div id="tercera_bobina" style="display: none">
  <!------------------------------------------------------------------>
  <!--TERCERA BOBINA-->
    <h3>TERCERA BOBINA</h3>
    <!-- id="bobina_adicional"  pertenece al DIV de abajo, su funcion es ocultar la tercera bobina si el select "hay que bobinar" == SI -->
    <div <?php // if(sizeof($bobinas)==0){ echo 'hidden="true"';}?>>
        <?php //print_r($control_cartulina); exit();// echo $control_cartulina->descripcion_de_la_tapa."holaaaa"; ?>
      <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 3da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa3" id="select_bobina3" class="chosen-select" onchange="carga_ajax_obtenerGramaje3(this.value,'gramaje_ajax3');">
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
                  } else  {

                      if ($control_cartulina->descripcion_de_la_tapa3=='') { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php } else { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php }
                  }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 3ra Bobina</label>
        <div id="gramaje_ajax3" class="controls">
          <input type="text" name="gramaje_seleccionado3" id="gramaje_seleccionado3" value="<?php if ($control_cartulina->gramaje_seleccionado3>0) { echo $control_cartulina->gramaje_seleccionado3; }else{ echo $gramaje_cotizado = $materialidad_1->gramaje; }?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado3(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 3da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina3" id="ancho_seleccionado_de_bobina3"  value="<?php if ($control_cartulina->ancho_seleccionado_de_bobina3>0) { echo $control_cartulina->ancho_seleccionado_de_bobina3; }else {echo 0;}//if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="//validacion_ancho_bobina_seleccionada_control_cartulina3();" onchange="/*validacion_ancho_bobina_seleccionada_control_cartulina3();*/ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina3"></span>
        </div>
      </div> 

      <div class="control-group">
        <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 3da Bobina</label>
        <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada3"  max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada3"  value="<?php if ($control_cartulina->kilos_bobina_seleccionada3>0) { echo $control_cartulina->kilos_bobina_seleccionada3; } else { echo 0; }//if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto3_metros"></span><span class="" id="resto3"></span>
        </div>
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
  			<input type="text" id="numero_de_bobina" name="numero_de_bobina" placeholder="Número de Bobina" value="<?php if($control_cartulina->numero_de_bobina == null){echo 1;}else{echo set_value_input($control_cartulina,'numero_de_bobina',$control_cartulina->numero_de_bobina);}?>" />
  		</div>
  	</div>
    
    <div class="control-group" hidden="true" id="numero_bobina2_div">
  		<label class="control-label" for="usuario">Número de Bobina 2 <strong style="color: red;">(*)</strong></label>
  		<div class="controls">
  			<input type="text" id="numero_de_bobina2" name="numero_de_bobina2" placeholder="Número de Bobina2" value="<?php if($control_cartulina->numero_bobina2 == null){echo 2;}else{ echo set_value_input($control_cartulina,'numero_de_bobina2',$control_cartulina->numero_de_bobina2);}?>" />
  		</div>
  	</div>

    <div class="control-group" hidden="true" id="numero_bobina3_div">
      <label class="control-label" for="usuario">Número de Bobina 3 <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <input type="text" id="numero_de_bobina3" name="numero_de_bobina3" placeholder="Número de Bobina3" value="<?php if($control_cartulina->numero_bobina3 == null){echo 3;}else{ echo set_value_input($control_cartulina,'numero_de_bobina3',$control_cartulina->numero_de_bobina3);}?>" />
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
            <option value="2" <?php echo "selected"; ?>><?php echo $usuario->nombre?></option>
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

      <input type="hidden" id="input_restante" name="input_restante" value="<?php if ($control_cartulina->input_restante>0){ echo $control_cartulina->input_restante; } else {echo '';} ?>">
      
      <input type="hidden" id="total_kilos_restantes"  name="total_kilos_restantes"  value="<?php if ($control_cartulina->total_kilos_restantes>0){ echo $control_cartulina->total_kilos_restantes; } else {echo '';} ?>">
      <input type="hidden"   id="total_kilos_ingresados" name="total_kilos_ingresados" value="<?php if ($control_cartulina->total_kilos_ingresados>0){ echo $control_cartulina->total_kilos_ingresados; } else {echo '';} ?>">

      <input type="hidden" id="total_metros_restantes" name="total_metros_restantes">
      <input type="hidden" id="total_metros_ingresados" name="total_metros_ingresados" value="<?php echo $control_cartulina->total_metros_ingresados; ?>">
      <?php

        // Comprar Total
        if ($control_cartulina->existencia=='Comprar Total' && ($control_cartulina->FechaRecepcion_CompraTotal==null || $control_cartulina->FechaRecepcion_CompraTotal=='0000-00-00')) {
          $modal='#myModal_no_liberar';
        }elseif($control_cartulina->existencia=='Comprar Total' && ($control_cartulina->FechaRecepcion_CompraTotal!=null || $control_cartulina->FechaRecepcion_CompraTotal!='0000-00-00')){
          $modal='#myModal_liberar';
        }

        // Stock parcial
        if ($control_cartulina->existencia == 'Stock Parcial' && $control_cartulina->Opciones_StockParcial =="Comprar Saldo" && ($control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial==null || $control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial=='0000-00-00')) {
          $modal='#myModal_no_liberar';
        }elseif($control_cartulina->existencia == 'Stock Parcial' && $control_cartulina->Opciones_StockParcial =="Comprar Saldo" && ($control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial!=null || $control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial!='0000-00-00')){
          $modal='#myModal_liberar';
        }elseif($control_cartulina->existencia == 'Stock Parcial' && $control_cartulina->Opciones_StockParcial =="Se produce parcial" && ($control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial==null || $control_cartulina->FechaRecepcion_ComprarSaldo_StockParcial=='0000-00-00')){
          $modal='#myModal_liberar';
        }

        //Comprar parcial
        if ($control_cartulina->existencia == 'Comprar Parcial' && ($control_cartulina->FechaRecepcion_ComprarParcial==null || $control_cartulina->FechaRecepcion_ComprarParcial=='0000-00-00')) {
          $modal='#myModal_no_liberar';
        }elseif($control_cartulina->existencia == 'Comprar Parcial' && ($control_cartulina->FechaRecepcion_ComprarParcial!=null || $control_cartulina->FechaRecepcion_ComprarParcial!='0000-00-00')){

          //Comprar parcial --> Comprar saldo total
          if ($control_cartulina->Opciones_ComprarParcial == 'Comprar saldo total' && ($control_cartulina->FechaRecepcion_ComprarSaldo_ComprarParcial==null || $control_cartulina->FechaRecepcion_ComprarSaldo_ComprarParcial=='0000-00-00')) {
            $modal='#myModal_no_liberar';
          }else{
            $modal='#myModal_liberar';
          }

        }

        // Hay Stock Total
      /*  if ($control_cartulina->existencia=='Hay stock total') {
          $modal='#myModal_liberar';
        }*/
        
      ?>
      
      
			<?php 
        $bobinado=$this->produccion_model->getBobinadoCartulinaPorTipo(1,$datos->id);
        $ccartulina=$this->produccion_model->getCorteCartulinaPorTipo(1,$datos->id);
                          
  			if($produccionFotomecanica->estado == 1){
  				if($control_cartulina->estado !=1)
  				{   
			?>
			
			<!--<input type="button" value="Parcial" class="btn <?php if($control_cartulina->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial' />-->
			<input type="button" value="Guardar" class="btn <?php if($control_cartulina->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');forma.submit()"/>
      
      <input type="button" value="Liberar" class="btn <?php if($control_cartulina->estado==1){echo 'btn-warning';}?> boton_liberar_normal liberar_boton_class" id='btnliberar'/>


			<input type="button" value="Liberar" style="display: none;" id="boton_liberar_parcial" class="liberar_boton_class btn" style="background-color: #ffcc33; border-radius: 5px; border-style: none" data-toggle="modal" data-target="<?php echo $modal; ?>">
      <input type="button" value="Reversar" class="btn <?php if($control_cartulina->estado==4){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('4');" data-toggle="modal" data-target="#myModal_reversar" onclick="reversar(<?php echo $dato->id ?>)" />
      <?php if($control_cartulina->estado==3) {
        echo "<b>Esta orden ha sido liberada parcialmente</b>";
      } ?>
      

      <!-- Modal CONTRASENA REVERSAR -->
       <div class="modal fade" id="myModal_reversar" role="confirm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Reversar la orden <b id="nro_orden_modal"></b></h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group">    
                        <label>Password</label>
                        <input type="password" name="pass_reversar" />
                        <input id="numero_op" type="hidden" name="numero_op" />
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="submit" name="" class="btn btn-default">Si, quiero revisar</button>
                <button id="cerrar_modal_orden" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
              </form>
          </div>
        </div>
      </div>

      <!-- Modal - LIBERACION PARCIAL -->
      <div class="modal fade" id="myModal_liberar" role="confirm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">¿ Desea liberar la orden de producción N° <b id="nro_orden_modal"><?php echo $ordenDeCompra->id?> </b>?</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">    
                        <div id="aviso_liberar"><?php echo "Faltan ".$control_cartulina->input_restante." Kgs" ?></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" onclick="guardarFormularioAdd('3');">Liberar parcial y Produce Parcial</button>
                <button type="submit" class="btn btn-default" onclick="guardarFormularioAdd('1');">Liberar total (incompleto) y liberar la orden</button>
                <button id="cerrar_modal_orden" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
              </form>
          </div>
        </div>
      </div>
			
      <!-- Modal - NO PUEDE LIBERAR -->
      <div class="modal fade" id="myModal_no_liberar" role="confirm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">¡No puede liberar porque el material no ha llegado!</h4>
            </div>
            <?php if ($control_cartulina->existencia=='Comprar Parcial') {?>
              <div class="modal-body">
                <div class="form-group">    
                    <div id="aviso_liberar"><?php echo "Faltan ".$resultado_faltante." Kgs para completar la orden" ?></div>
                </div>
              </div>
            <?php } ?>
            
            <div class="modal-footer">
                <button id="cerrar_modal_orden" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


			<?php
				}else{
          if(count($bobinado) == 0 && count($ccartulina) == 0){?>
            <!--<input type="button" value="Parcial" class="btn <?php if($control_cartulina->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial' />-->
            <input type="button" value="Guardar" class="btn <?php if($control_cartulina->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');forma.submit()" />
            <input type="button" value="Liberar" class="btn <?php if($control_cartulina->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
            <input type="button" value="Reversar" class="btn <?php if($control_cartulina->estado==4){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('4');" data-toggle="modal" data-target="#myModal_reversar" onclick="reversar(<?php echo $dato->id ?>)" />
            <?php
            echo '&nbsp;&nbsp;&nbsp;<span style="background-color:green; color:white;">&nbsp;&nbsp;Control Cartulina Liberado (Pendiente en bobinado y corte cartulina)&nbsp;&nbsp;<span>';
          }else{    
            echo 'Control Cartulina Liberado';
          }
        }
			}else{
				echo '<span>Debe liberar en FOTOMECÁNICA antes de guardar todos los datos de Control Cartulina</span>';
				?>
				<br>
				<br>
				<br>
        <input type="button" value="Guardar"  id="boton_guardar_sin_liberar_fotomeca" class="btn <?php if($control_cartulina->estado===0){echo 'btn-warning';}?>" onclick="forma.submit()" />
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
</div>
<div id="menu_pliego"><h1><center>MENU PLIEGO</center></h1></div>

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

    //Inhabilita el la tecla Enter para guardar del formulario, solo se puede guardar presionando en el boton
    function stopRKey(evt) {
      var evt = (evt) ? evt : ((event) ? event : null);
      var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
      if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
    }
    document.onkeypress = stopRKey; 

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

    $(document).ready(function() {
        $("form").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
    });

    //MOSTRAR MENU BOBINA-PLIEGO
    $('#menu_bobina_pliego').change(function() {  
      if($('#menu_bobina_pliego option:selected').val() == 'Menu Bobina') {
        $('#menu_pliego').hide();
        $('#menu_bobina').show();
      }else if($('#menu_bobina_pliego option:selected').val() == 'Menu Pliego') {
        $('#menu_pliego').show();
        $('#menu_bobina').hide();
      }else{
        $('#menu_pliego').hide();
        $('#menu_bobina').hide();
      }
    });

    $('#ancho_seleccionado_de_bobina').blur(function() {  
        if ($('#ancho_seleccionado_de_bobina').val() < 600 ) {
          alert('El ancho de la bobina debe ser mayor que 600');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina').focus();}, 1);
        }else if($('#ancho_seleccionado_de_bobina').val() > 2500){
          alert('El ancho de la bobina debe ser menor que 2500');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina').focus();}, 1);
        }
    });

    /*$('#kilos_bobina_seleccionada').blur(function() {  
        if ($('#kilos_bobina_seleccionada').val() < 200 ) {
          alert('Los kilos de la bobina debe ser mayor que 200');
          setTimeout(function(){$('#kilos_bobina_seleccionada').focus();}, 1);
        }
    });*/




    // INICIO - Script para validar el minimo aceptado de los kilos que se compraran
    $('#Kilos_CompraTotal').blur(function() {
        if (parseInt($('#Kilos_CompraTotal').val()) < parseInt($('#total_kilos').val()) ) {
          alert('Los kilos a comprar deben ser mayor o igual al total de kilos de cartulina cotizada ('+$('#total_kilos').val()+' Kgs)');
          setTimeout(function(){$('#Kilos_CompraTotal').focus();}, 1);
        }
    });
    $('#Kilos_ComprarSaldo_StockParcial').blur(function() {
        if (parseInt($('#Kilos_ComprarSaldo_StockParcial').val()) < parseInt($('#total_kilos').val()) ) {
          alert('Los kilos a comprar deben ser mayor o igual al total de kilos de cartulina cotizada ('+$('#total_kilos').val()+' Kgs)');
          setTimeout(function(){$('#Kilos_ComprarSaldo_StockParcial').focus();}, 1);
        }
    });
    $('#Kilos_ComprarParcial').blur(function() {
        if ((parseInt($('#Kilos_ComprarParcial').val()) < 200)) {
          alert('Los kilos a comprar deben ser mayor o igual a 200 Kgs');
          setTimeout(function(){$('#Kilos_ComprarParcial').focus();}, 1);
        }
    });
    // FIN - Script para validar el minimo aceptado de los kilos que se compraran




    //Si no ha liberado de fotomecanica e intenta guardar los datos de las bobinas
    $('#boton_guardar_sin_liberar_fotomeca').click(function() {
      if ($("#kilos_bobina_seleccionada").val() != null && $("#kilos_bobina_seleccionada").val() != 0) {
        alert('Debe Liberar de Fotomecanica para poder guardar los datos de las bobinas.');
      }else if ($("#kilos_bobina_seleccionada2").val() != null && $("#kilos_bobina_seleccionada2").val() != 0) {
        alert('Debe Liberar de Fotomecanica para poder guardar los datos de las bobinas.');
      }else if ($("#kilos_bobina_seleccionada3").val() != null && $("#kilos_bobina_seleccionada3").val() != 0) {
        alert('Debe Liberar de Fotomecanica para poder guardar los datos de las bobinas.');
      }else{
        guardarFormularioAdd('1');
      }
    });

   

    //Si no ha llenado los campos de bobina 1 no puede llenar la segunda
    $('#kilos_bobina_seleccionada2').click(function() {
      if ($('#kilos_bobina_seleccionada').val() == "" || $('#kilos_bobina_seleccionada').val() == 0) {
        alert('Debe llenar todos los campos de la Primera Bobina para poder llenar la Segunda Bobina.');
        setTimeout(function(){$('#kilos_bobina_seleccionada').focus();}, 1);
        return;
      }
    });

    $('#kilos_bobina_seleccionada2').blur(function() {
      if ($('#kilos_bobina_seleccionada').val() > 0) {
        if (parseInt($('#kilos_bobina_seleccionada2').val()) < 200) {
          alert('Los kilos seleccionados de la Segunda Bobina deben ser mayor que 200 Kgs');
          setTimeout(function(){$('#kilos_bobina_seleccionada2').focus();}, 1);
        }
        if (parseInt($('#kilos_bobina_seleccionada2').val()) > 2500) {
          alert('Los kilos seleccionados de la Segunda Bobina deben ser menor que 2500 Kgs');
          setTimeout(function(){$('#kilos_bobina_seleccionada2').focus();}, 1);
        }
      }
    });


    $('#ancho_seleccionado_de_bobina2').blur(function() {
      if ($('#kilos_bobina_seleccionada').val() > 0) {
        if (parseInt($('#ancho_seleccionado_de_bobina2').val()) < 800) {
          alert('El ancho seleccionado de la Segunda Bobina debe ser mayor que 800 Kgs');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina2').focus();}, 1);
        }
        if (parseInt($('#ancho_seleccionado_de_bobina2').val()) > 2500) {
          alert('El ancho seleccionado de la Segunda Bobina debe ser menor que 2500 Kgs');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina2').focus();}, 1);
        }
      }
    });

    //Si no ha llenado los campos de bobina 2 no puede llenar la tercera
    $('#kilos_bobina_seleccionada3').click(function() {
      if ($('#kilos_bobina_seleccionada2').val() == "" || $('#kilos_bobina_seleccionada2'== 0)) {
        alert('Debe llenar todos los campos de la Segunda Bobina para poder llenar la Tercera Bobina.');
        setTimeout(function(){$('#kilos_bobina_seleccionada2').focus();}, 1);
      }
      if ($('#ancho_seleccionado_de_bobina2').val() == "" || $('#ancho_bobina_seleccionada2'== 0)) {
        alert('Debe llenar todos los campos de la Segunda Bobina para poder llenar la Tercera Bobina.');
        setTimeout(function(){$('#ancho_seleccionado_de_bobina2').focus();}, 1);
      }
    });



    $('#kilos_bobina_seleccionada3').blur(function() {
      if ($('#kilos_bobina_seleccionada2').val() > 0) {
        if (parseInt($('#kilos_bobina_seleccionada3').val()) < 200) {
          alert('Los kilos seleccionados de la Tercera Bobina deben ser mayor que 200 Kgs');
          setTimeout(function(){$('#kilos_bobina_seleccionada3').focus();}, 1);
        }
        if (parseInt($('#kilos_bobina_seleccionada3').val()) > 2500) {
          alert('Los kilos seleccionados de la Tercera Bobina deben ser menor que 2500 Kgs');
          setTimeout(function(){$('#kilos_bobina_seleccionada3').focus();}, 1);
        }
      }
    });

    $('#ancho_seleccionado_de_bobina3').blur(function() {
      if ($('#kilos_bobina_seleccionada2').val() > 0) {
        if (parseInt($('#ancho_seleccionado_de_bobina3').val()) < 600) {
          alert('El ancho seleccionado de la Tercera Bobina debe ser mayor que 600 Kgs');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina3').focus();}, 1);
        }
        if (parseInt($('#ancho_seleccionado_de_bobina3').val()) > 2500) {
          alert('El ancho seleccionado de la Tercera Bobina debe ser menor que 2500 Kgs');
          setTimeout(function(){$('#ancho_seleccionado_de_bobina3').focus();}, 1);
        }
      }
    });


    //Si modifica el campo existencia, debe guardar primero antes de liberar
    $('#existencia').change(function() {  
      $('.liberar_boton_class').click(function() {  
        alert('Debe Guardar primero antes de poder liberar');
        /*
          $(".modal-title").text('Debe Guardar primero antes de poder liberar');
          $(".btn-default").hide();
          $(".modal-body").hide();
        */
      });
    });

    //Si presiona el boton de liberar y Kilos seleccionado bobina 1 esta vacio
    $('#btnliberar').click(function() {
      if ($("#existencia").val() == "") {
        alert('Debe seleccionar algun elemento en Existencia');
      }else if ($("#kilos_bobina_seleccionada").val() == '' || $("#kilos_bobina_seleccionada").val() == null || $("#kilos_bobina_seleccionada").val() == 0) {
          alert('Debe ingresar la cantidad de kilos en la bobina');
      }else if ($("#numero_de_bobina").val() == '') {
          alert('Debe llenar el campo: Numero de Bobina');
      }else if ($("#quien_sabe_ubicacion_de_la_bobina").val() == 0) {
          alert('Debe llenar el campo: Quien sabe la ubicación de la bobina');
      }else{
        //$('#btnliberar').submit(function(){return true;});
        //alert('guarda');
      }
    });

    //Si no ha llenado los campos de bobina 1 no deja liberar
    $('.liberar_boton_class').click(function() {
      if ($("#kilos_bobina_seleccionada").val() == 0 || $("#kilos_bobina_seleccionada").val() == '' || $("#kilos_bobina_seleccionada").val() == null) {
        $(".modal-title").text('Debe llenar todos los campos de la PRIMERA BOBINA para poder liberar');
        $(".btn-default").hide();
        $(".modal-body").hide();
      }else{
        $(".modal-title").html('¿ Desea liberar la orden de producción N° <b id="nro_orden_modal"><?php echo $ordenDeCompra->id?> </b>?');
        $(".btn-default").show();
        $(".modal-body").show();
      }
    });


    //Si no ha llenado los campos de bobina 2 no puede llenar la tercera
    $('.liberar_boton_class').click(function() {
      if ($("#kilos_bobina_seleccionada").val() == 0 || $("#kilos_bobina_seleccionada").val() == '' || $("#kilos_bobina_seleccionada").val() == null) {
        $(".modal-title").text('Debe llenar todos los campos de la PRIMERA BOBINA para poder liberar');
        $(".btn-default").hide();
        $(".modal-body").hide();
      }else{
        $(".modal-title").html('¿ Desea liberar la orden de producción N° <b id="nro_orden_modal"><?php echo $ordenDeCompra->id?> </b>?');
        $(".btn-default").show();
        $(".modal-body").show();
      }
    });


    
    

    

    

    

    $('#Opciones_ComprarParcial').change(function() {  
      if($('#Opciones_ComprarParcial option:selected').val() != 'Comprar saldo total') {
        $('#ComprarSaldoTotal_ComprarParcial_opciones1').hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones2').hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones3').hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones6').hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones4').hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones5').hide();
      }else{
        $('#ComprarSaldoTotal_ComprarParcial_opciones1').show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones2').show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones3').show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones6').show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones4').show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones5').show();
      }
    });

     if($('#input_restante').val() >0) {
      $('#boton_liberar_parcial').show();
      $(".boton_liberar_normal").hide();
    }else{
      $('#boton_liberar_parcial').hide();
      $(".boton_liberar_normal").show();
    }

    if($('#menu_bobina_pliego').val() == 'Menu Bobina') {
      $('#menu_bobina').show();
      $('#menu_pliego').hide();
    }else if($('#menu_bobina_pliego').val() == 'Menu Pliego'){
      $('#menu_pliego').show();
      $('#menu_bobina').hide();
    }

    if($('#existencia').val() == 'Comprar Total') {
      $('#comprar_total_opciones1').show();
      $('#comprar_total_opciones2').show();
      $('#comprar_total_opciones3').show();
      $('#comprar_total_opciones6').show();
      $('#comprar_total_opciones4').show();
      $('#comprar_total_opciones5').show();

      $("#comprar_parcial_opciones6").hide();
    }else{
      $('#comprar_total_opciones1').hide();
      $('#comprar_total_opciones2').hide();
      $('#comprar_total_opciones3').hide();
      $('#comprar_total_opciones6').hide();
      $('#comprar_total_opciones4').hide();
      $('#comprar_total_opciones5').hide();
    }

    if($('#Opciones_StockParcial').val() == 'Comprar Saldo') {
      $('#comprar_saldo_opciones0').show();
      $('#comprar_saldo_opciones1').show();
      $('#comprar_saldo_opciones2').show();
      $('#comprar_saldo_opciones3').show();
      $('#comprar_saldo_opciones6').show();
      $('#comprar_saldo_opciones4').show();
      $('#comprar_saldo_opciones5').show();

      $("#comprar_parcial_opciones6").hide();
    }else{
      $('#comprar_saldo_opciones0').hide();
      $('#comprar_saldo_opciones1').hide();
      $('#comprar_saldo_opciones2').hide();
      $('#comprar_saldo_opciones3').hide();
      $('#comprar_saldo_opciones6').hide();
      $('#comprar_saldo_opciones4').hide();
      $('#comprar_saldo_opciones5').hide();
    }

    if($('#existencia').val() == 'Comprar Parcial') {
      $('#comprar_parcial_opciones1').show();
      $('#comprar_parcial_opciones2').show();
      $('#comprar_parcial_opciones3').show();
      $('#comprar_parcial_opciones4').show();
      $('#comprar_parcial_opciones5').show();
      $('#comprar_parcial_opciones7').show();
      $(".KilosFaltantes_ComprarParcial").show();

      if ($("#FechaEstimada_ComprarParcial").val() == '') {
        $("#comprar_parcial_opciones6").hide();
      } else {
        $("#comprar_parcial_opciones6").show();
      }

      if ($('#existencia').val() == 'Comprar Parcial' && $('#Opciones_ComprarParcial').val() == 'Comprar saldo total') {
        $("#ComprarSaldoTotal_ComprarParcial_opciones1").show();
        $("#ComprarSaldoTotal_ComprarParcial_opciones2").show();
        $("#ComprarSaldoTotal_ComprarParcial_opciones3").show();
        $('#ComprarSaldoTotal_ComprarParcial_opciones6').show();
        $("#ComprarSaldoTotal_ComprarParcial_opciones4").show();
        $("#ComprarSaldoTotal_ComprarParcial_opciones5").show();
        $(".KilosFaltantes_ComprarParcial").show();
      }else{
        $("#ComprarSaldoTotal_ComprarParcial_opciones1").hide();
        $("#ComprarSaldoTotal_ComprarParcial_opciones2").hide();
        $("#ComprarSaldoTotal_ComprarParcial_opciones3").hide();
        $('#ComprarSaldoTotal_ComprarParcial_opciones6').hide();
        $("#ComprarSaldoTotal_ComprarParcial_opciones4").hide();
        $("#ComprarSaldoTotal_ComprarParcial_opciones5").hide();
      }

    }else{
      $('#comprar_parcial_opciones1').hide();
      $('#comprar_parcial_opciones2').hide();
      $('#comprar_parcial_opciones3').hide();
      $('#comprar_parcial_opciones4').hide();
      $('#comprar_parcial_opciones7').hide();
      $('#comprar_parcial_opciones5').hide();
    }


    

    if($('#existencia').val() == 'Stock Parcial') {
      $('#stock_parcial_opciones1').show();
    }else{
      $('#stock_parcial_opciones1').hide();
    }

    $('#existencia').change(function() {                
        if($('#existencia option:selected').val() != 'Stock Parcial') {
          $('#stock_parcial_opciones1').hide();
          $('#stock_parcial_opciones2').hide();

          $('#comprar_saldo_opciones0').hide();
          $('#comprar_saldo_opciones1').hide();
          $('#comprar_saldo_opciones2').hide();
          $('#comprar_saldo_opciones3').hide();
          $('#comprar_saldo_opciones6').hide();
          $('#comprar_saldo_opciones4').hide();
          $('#comprar_saldo_opciones5').hide();
          $('#Opciones_StockParcial').val("");
        }else{
          $("#stock_parcial_opciones1").show();
          $("#stock_parcial_opciones2").show();

          $("#comprar_parcial_opciones6").hide();
        }

        if($('#existencia option:selected').val() != 'Comprar Parcial') {
          $('#comprar_parcial_opciones1').hide();
          $('#comprar_parcial_opciones2').hide();
          $('#comprar_parcial_opciones3').hide();
          $('#comprar_parcial_opciones7').hide();
          $('#comprar_parcial_opciones4').hide();
          $('#comprar_parcial_opciones5').hide();
          $(".KilosFaltantes_ComprarParcial").hide();
        }else{
          $("#comprar_parcial_opciones1").show();
          $("#comprar_parcial_opciones2").show();
          $("#comprar_parcial_opciones3").show();
          $('#comprar_parcial_opciones7').show();
          $("#comprar_parcial_opciones4").show();
          $("#comprar_parcial_opciones5").show();
          $(".KilosFaltantes_ComprarParcial").show();

          if ($("#FechaEstimada_ComprarParcial").val() == '') {
            $("#comprar_parcial_opciones6").hide();
          } else {
            $("#comprar_parcial_opciones6").show();
          }


          
        }

        if($('#existencia option:selected').val() == 'Hay stock total' || $('#existencia option:selected').val() == 'Comprar Total' || $('#existencia option:selected').val() == 'Stock Parcial') {
          $("#comprar_parcial_opciones6").hide();
          $(".KilosFaltantes_ComprarParcial").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones1").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones2").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones3").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones4").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones5").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones6").hide();
        }

        /*if($('#existencia option:selected').val() == 'Comprar Total') {
          $("#comprar_parcial_opciones6").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones1").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones2").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones3").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones4").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones5").hide();
          $("#ComprarSaldoTotal_ComprarParcial_opciones6").hide();
        }*/

        if($('#existencia option:selected').val() != 'Comprar Total') {
          $('#comprar_total_opciones1').hide();
          $('#comprar_total_opciones2').hide();
          $('#comprar_total_opciones3').hide();
          $('#comprar_total_opciones6').hide();
          $('#comprar_total_opciones4').hide();
          $('#comprar_total_opciones5').hide();

          //remover campo required a las opciones de ¨Comprar Total¨
          
          $('#comprar_total_opciones1').prop('required',false);
          $('#comprar_total_opciones2').prop('required',false);
          $('#comprar_total_opciones3').prop('required',false);
          $('#comprar_total_opciones6').prop('required',false);
          $('#comprar_total_opciones4').prop('required',false);
          $('#comprar_total_opciones5').prop('required',false);



        }else{
          $("#comprar_total_opciones1").show();
          $("#comprar_total_opciones2").show();
          $("#comprar_total_opciones3").show();
          $('#comprar_total_opciones6').show();
          $("#comprar_total_opciones4").show();
          $("#comprar_total_opciones5").show();

          $("#comprar_parcial_opciones6").hide();


          //agregar campo required a las opciones de ¨Comprar Total¨

          $('#comprar_total_opciones1').prop('required',true);
          $('#comprar_total_opciones2').prop('required',true);
          $('#comprar_total_opciones3').prop('required',true);
          $('#comprar_total_opciones6').prop('required',true);
          $('#comprar_total_opciones4').prop('required',true);
          $('#comprar_total_opciones5').prop('required',true);

        }
    });

    $('#Opciones_StockParcial').change(function() {                
        if($('#Opciones_StockParcial option:selected').val() != 'Comprar Saldo') {
          $('#comprar_saldo_opciones0').hide();
          $('#comprar_saldo_opciones1').hide();
          $('#comprar_saldo_opciones2').hide();
          $('#comprar_saldo_opciones3').hide();
          $('#comprar_saldo_opciones6').hide();
          $('#comprar_saldo_opciones4').hide();
          $('#comprar_saldo_opciones5').hide();
        }else{
          $('#comprar_saldo_opciones0').show();
          $("#comprar_saldo_opciones1").show();
          $("#comprar_saldo_opciones2").show();
          $("#comprar_saldo_opciones3").show();
          $('#comprar_saldo_opciones6').show();
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

  //Si el ancho de existencia es igual al ancho de la primera bobina, el select "Hay que bobinar" = NO.   En caso contrario: SI
  $('#ancho_seleccionado_de_bobina').blur(function() {  
    if ($('#Ancho_CompraTotal').val() == $('#ancho_seleccionado_de_bobina').val()) {
      $("#hay_que_bobinar option[value=No]").attr("selected",true);
    }else {
      $("#hay_que_bobinar option[value=Si]").attr("selected",true);
    }
    if ($('#Ancho_ComprarSaldo_StockParcial').val() == $('#ancho_seleccionado_de_bobina').val()) {
      $("#hay_que_bobinar option[value=No]").attr("selected",true);
    }else {
      $("#hay_que_bobinar option[value=Si]").attr("selected",true);
    }
    if ($('#Ancho_ComprarParcial').val() == $('#ancho_seleccionado_de_bobina').val()) {
      $("#hay_que_bobinar option[value=No]").attr("selected",true);
    }else {
      $("#hay_que_bobinar option[value=Si]").attr("selected",true);
    }
    if ($('#Ancho_ComprarSaldo_ComprarParcial').val() == $('#ancho_seleccionado_de_bobina').val()) {
      $("#hay_que_bobinar option[value=No]").attr("selected",true);
    }else{
      $("#hay_que_bobinar option[value=Si]").attr("selected",true);
    }
  });


//--------------------PRIMERA BOBINA-----------------//
  //-------------Si cambia un valor en el select -------//
  $("#select_bobina1").change(function(){

      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //----------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());

      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());

      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        var resto_metros1 = Math.round(parseInt(bob1)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000);
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }


      
      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros1<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");   
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1); 
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }

      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        if (resto_cotizado<0) {
          $("#resto1").removeClass("label label-danger-mio padding");    
          $("#resto1").addClass("label label-success padding");    
          $("#resto1").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }else{
          $("#resto1").addClass("label label-danger-mio padding");    
          $("#resto1").removeClass("label label-success padding");    
          $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }

        if (bob3>0) {        
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }
        $("#numero_de_bobina2").val(0);

        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
      }else{
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina2_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
      }
      ba();
  });
  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());

      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      //calcula el total de kilos restantes
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);

      if(ancho_seleccionado_de_bobina1==0){
        var resto_metros_ingresados1=0;
      }else{
        var resto_metros1 = Math.round(parseInt(bob1)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000);        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        var resto_metros_ingresados2=0;
      }else{
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        var resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      //alert(resta_de_metros);
      if(resto_metros1<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");  
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1);  
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }


      //IMPRIMIR KILOS 
      
      var total_kilos_ingresados = parseInt(bob1+bob2+bob3); 
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<=0){
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        if (resto_cotizado<=0) {
          $("#resto1").removeClass("label label-danger-mio padding");    
          $("#resto1").addClass("label label-success padding");    
          $("#resto1").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }else{
          $("#resto1").addClass("label label-danger-mio padding");    
          $("#resto1").removeClass("label label-success padding");    
          $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }
        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }

        if (bob3>0) {        
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }
        $("#numero_de_bobina2").val(0);

        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();    
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);  

      }else{
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if(bob2>0){
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }
        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina2_div").show();

        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
      }

      
      ba();
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());


      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());

      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}


      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}

      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      //var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      //var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());

      //--------------------------METROS--------------------------------//
     
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        var resto_metros1 = Math.round(parseInt(bob1)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000);
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));

      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros1<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina1").text("Metros ingresados: "+resto_metros1);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }
      //------------------------- IMPRIMIR KILOS ---------------------------/

      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      if(resto<0){
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        if (resto_cotizado<0) {
          $("#resto1").removeClass("label label-danger-mio padding");    
          $("#resto1").addClass("label label-success padding");    
          $("#resto1").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }else{
          $("#resto1").addClass("label label-danger-mio padding");    
          $("#resto1").removeClass("label label-success padding");    
          $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }

        if (bob3>0) {        
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto_cotizado*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado1+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina1);
        }

        $("#numero_de_bobina2").val(0);
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
        
      }else{
        var resto_cotizado = Math.round((parseInt(resta_de_metros)*parseInt(bob_ancho)*parseInt(bob_gramaje)) / 1000000);
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto_cotizado+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        $('#input_restante').val(resto);

        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $("#numero_bobina2_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
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
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        var resto_metros2 = Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000);
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros2<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }


      //IMPRIMIR KILOS
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }
        $("#numero_de_bobina2").val(0);
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina2_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
      }
      ba();

      if ($('#kilos_bobina_seleccionada2').val()==0 || $('#kilos_bobina_seleccionada2').val() == null) {
        $("#numero_bobina2_div").hide();
      }

  });

  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada2").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        var resto_metros2 = Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000);
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }
      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros2<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }


      //IMPRIMIR KILOS
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3);
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }
        $("#numero_de_bobina2").val(0);
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina2_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
      }
      ba();

      if ($('#kilos_bobina_seleccionada2').val()==0 || $('#kilos_bobina_seleccionada2').val() == null) {
        $("#numero_bobina2_div").hide();
      }
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada2").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());

      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}


      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado2+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina2);
        }
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
        $("#numero_de_bobina2").val(0);
        $("#numero_bobina2_div").hide();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }
        $('#input_restante').val(resto);
        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $("#numero_bobina2_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
      }

      

      //--------------------------METROS--------------------------------//
      
      
     
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        var resto_metros2 = Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000);
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }
      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros2<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina2").text("Metros ingresados: "+resto_metros2);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }
      ba();

      if ($('#kilos_bobina_seleccionada2').val()==0 || $('#kilos_bobina_seleccionada2').val() == null) {
        $("#numero_bobina2_div").hide();
      }else{
        $("#numero_bobina2_div").show();
      }
});


//-----------TERCERA BOBINA --------------------//
//-------------Si cambia un valor en el select -------//
 $("#select_bobina3").change(function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros3 = Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000);
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }

      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros3<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {

          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }
        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }



      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }
        $("#numero_de_bobina2").val(0);
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina3_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
      }
      ba();
      if ($('#kilos_bobina_seleccionada3').val()==0 || $('#kilos_bobina_seleccionada3').val() == null) {
        $("#numero_bobina3_div").hide();
      }
      
  });

  //-------------Si ingresa algun dato en KG -----------//
  $("#kilos_bobina_seleccionada3").on("keyup",function(){
      //------------------KILOS------------------------//
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      
      //--------------------------METROS--------------------------------//
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());
      
      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      
      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros3 = Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000);
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }
      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = Math.round(parseInt(total_metros)-parseInt(total_metros_ingresados));
      if(resto_metros3<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) { 
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }



      //IMPRIMIR KILOS 
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      var resto_prueba = Math.round((parseInt(resta_de_metros)*parseInt(bob_gramaje)*parseInt(bob_ancho))/parseInt(1000000));
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");    
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }
        $("#numero_de_bobina2").val(0);
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
        $("#boton_liberar_parcial").hide();
        $(".boton_liberar_normal").show();
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");    
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }
        $("#aviso_liberar").html("<span>Faltan "+resto+" Kgs");
        $("#boton_liberar_parcial").show();
        $(".boton_liberar_normal").hide();
        $('#input_restante').val(resto);
        $("#numero_bobina3_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados);
      }
      ba();
      if ($('#kilos_bobina_seleccionada3').val()==0 || $('#kilos_bobina_seleccionada3').val() == null) {
        $("#numero_bobina3_div").hide();
      }
      
  });
  //-------------- CALCULO QUE SE MUESTRA AL DESELECCIONAR EL INPUT --------------//
  $("#kilos_bobina_seleccionada3").on("blur",function(){
      var bob1  = parseInt($("#kilos_bobina_seleccionada").val()); 
      var bob2  = parseInt($("#kilos_bobina_seleccionada2").val());
      var bob3  = parseInt($("#kilos_bobina_seleccionada3").val());
      var total_kilos_ingresados_parcial_1 = parseInt($("#total_kilos_ingresados_parcial_1").val());
      var total_kilos_ingresados_parcial_2 = parseInt($("#total_kilos_ingresados_parcial_2").val());
      var total_kilos_ingresados_parcial_3 = parseInt($("#total_kilos_ingresados_parcial_3").val());
      var total_metros_restantes_parcial_1 = parseInt($("#total_metros_restantes_parcial_1").val());
      var total_metros_restantes_parcial_2 = parseInt($("#total_metros_restantes_parcial_2").val());
      var total_metros_restantes_parcial_3 = parseInt($("#total_metros_restantes_parcial_3").val());

      var ancho_seleccionado_de_bobina1  = parseInt($("#ancho_seleccionado_de_bobina").val());
      var ancho_seleccionado_de_bobina2  = parseInt($("#ancho_seleccionado_de_bobina2").val());
      var ancho_seleccionado_de_bobina3  = parseInt($("#ancho_seleccionado_de_bobina3").val());
      var gramaje_seleccionado1  = parseInt($("#gramaje_seleccionado").val());
      var gramaje_seleccionado2  = parseInt($("#gramaje_seleccionado2").val());
      var gramaje_seleccionado3  = parseInt($("#gramaje_seleccionado3").val());

      var bob_kilos  = parseInt($("#total_kilos").val());
      var bob_ancho  = parseInt($("#ancho_de_bobina").val());
      var bob_gramaje= parseInt($("#gramaje").val());

      if($("#total_kilos_ingresados_parcial_1").val()=="" || $("#total_kilos_ingresados_parcial_1").val()==null){total_kilos_ingresados_parcial_1=0;}
      if($("#total_kilos_ingresados_parcial_2").val()=="" || $("#total_kilos_ingresados_parcial_2").val()==null){total_kilos_ingresados_parcial_2=0;}
      if($("#total_kilos_ingresados_parcial_3").val()=="" || $("#total_kilos_ingresados_parcial_3").val()==null){total_kilos_ingresados_parcial_3=0;}

      if($("#total_metros_restantes_parcial_1").val()=="" || $("#total_metros_restantes_parcial_1").val()==null){total_metros_restantes_parcial_1=0;}
      if($("#total_metros_restantes_parcial_2").val()=="" || $("#total_metros_restantes_parcial_2").val()==null){total_metros_restantes_parcial_2=0;}
      if($("#total_metros_restantes_parcial_3").val()=="" || $("#total_metros_restantes_parcial_3").val()==null){total_metros_restantes_parcial_3=0;}



      //--------------------------METROS--------------------------------//

      var bobt  = parseInt($("#total_kilos").val());
      if($("#kilos_bobina_seleccionada").val()==""){bob1=0;}
      if($("#kilos_bobina_seleccionada2").val()==""){bob2=0;}
      if($("#kilos_bobina_seleccionada3").val()==""){bob3=0;}
      var resto = parseInt(bobt)-parseInt(bob1+bob2+bob3+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3);
      var total_kilos_ingresados=parseInt(bob1+bob2+bob3); 
      if(resto<0){
        $("#resto1").removeClass("label label-danger-mio padding");    
        $("#resto1").addClass("label label-success padding");    
        $("#resto1").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);

        if(bob2>0){
          $("#resto2").removeClass("label label-danger-mio padding");    
          $("#resto2").addClass("label label-success padding");    
          $("#resto2").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }

        if (bob3>0) {
          $("#resto3").removeClass("label label-danger-mio padding");
          $("#resto3").addClass("label label-success padding");    
          $("#resto3").text(" Sobrepasa por: "+(resto*-1)+" Kilos. Proviene de la Bobina Selecc.: Gramaje Seleccionado = "+gramaje_seleccionado3+" y del Ancho Seleccionado = "+ancho_seleccionado_de_bobina3);
        }
        $('#total_kilos_restantes').val(resto*-1);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
        $("#numero_de_bobina2").val(0);
      
      }else{
        $("#resto1").addClass("label label-danger-mio padding");    
        $("#resto1").removeClass("label label-success padding");    
        $("#resto1").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)

        if (bob2>0) {
          $("#resto2").addClass("label label-danger-mio padding");    
          $("#resto2").removeClass("label label-success padding");
          $("#resto2").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }

        if (bob3>0) {
          $("#resto3").addClass("label label-danger-mio padding");    
          $("#resto3").removeClass("label label-success padding");    
          $("#resto3").text(" Restante: "+resto+" Kilos. Proviene de la Bobina Selecc.: Gramaje Cotizado: "+bob_gramaje+" y del Ancho Cotizado: "+bob_ancho)
        }
        $("#numero_bobina2_div").show();
        $('#input_restante').val(resto);
        $("#numero_bobina3_div").show();
        $('#total_kilos_restantes').val(resto);
        $('#total_kilos_ingresados').val(total_kilos_ingresados); 
      }

      if ($('#kilos_bobina_seleccionada3').val()==0 || $('#kilos_bobina_seleccionada3').val() == null) {
        $("#numero_bobina3_div").hide();
      }
      
      //--------------------------METROS--------------------------------//
     
     
      
      
      
      var total_metros = Math.round(parseInt(bob_kilos)/(parseInt(bob_ancho)*parseInt(bob_gramaje))*1000000);
      
      if(ancho_seleccionado_de_bobina1==0){
        resto_metros_ingresados1=0;
      }else{
        
        var resto_metros_ingresados1 = (Math.round(parseInt(bob1+total_kilos_ingresados_parcial_1+total_kilos_ingresados_parcial_2+total_kilos_ingresados_parcial_3)/(parseInt(ancho_seleccionado_de_bobina1)*parseInt(gramaje_seleccionado1))*1000000));
      }

      if(ancho_seleccionado_de_bobina2==0){
        resto_metros_ingresados2=0;
      }else{
        
        var resto_metros_ingresados2 = (Math.round(parseInt(bob2)/(parseInt(ancho_seleccionado_de_bobina2)*parseInt(gramaje_seleccionado2))*1000000));
      }

      if(ancho_seleccionado_de_bobina3==0){
        resto_metros_ingresados3=0;
      }else{
        var resto_metros3 = Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000);
        var resto_metros_ingresados3 = (Math.round(parseInt(bob3)/(parseInt(ancho_seleccionado_de_bobina3)*parseInt(gramaje_seleccionado3))*1000000));
      }
      var total_metros_ingresados = Math.round(parseInt(resto_metros_ingresados1)+parseInt(resto_metros_ingresados2)+parseInt(resto_metros_ingresados3));
      
      var resta_de_metros = parseInt(total_metros)-parseInt(total_metros_ingresados);
      if(resto_metros3<0){
        $("#resto1_metros").removeClass("label label-danger-mio padding");    
        $("#resto1_metros").addClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");

        if (bob2>0) {
          $("#resto2_metros").removeClass("label label-danger-mio padding");    
          $("#resto2_metros").addClass("label label-success padding");    
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        if (bob3>0) {
          $("#resto3_metros").removeClass("label label-danger-mio padding");    
          $("#resto3_metros").addClass("label label-success padding");    
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Sobrepasa por: "+(resta_de_metros*-1)+" Metros");
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }else{
        $("#resto1_metros").addClass("label label-danger-mio padding");    
        $("#resto1_metros").removeClass("label label-success padding");    
        $("#metros_ingresados_bobina3").text("Metros ingresados: "+resto_metros3);
        $("#resto1_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)

        if (bob2>0) {
          $("#resto2_metros").addClass("label label-danger-mio padding");
          $("#resto2_metros").removeClass("label label-success padding");
          $("#resto2_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        if (bob3>0) {
          $("#resto3_metros").addClass("label label-danger-mio padding");
          $("#resto3_metros").removeClass("label label-success padding");
          $("#resto3_metros").text("Total de metros ingresados (3 bobinas) "+total_metros_ingresados+". Metros Restantes: "+resta_de_metros)
        }

        $('#total_metros_restantes').val(resta_de_metros);
        $('#total_metros_ingresados').val(total_metros_ingresados);
      }
      ba();
});



 // SI hay stock total --> el total de kilos de las 3 bobinas ingresadas, deben se mayor que la cantidad de kilos cotizadas
    $('#boton_liberar_parcial').click(function() {
      var total_metros_cotizados = parseInt($('#total_metros_cotizados').val());
      var total_metros_ingresados_input = parseInt($('#total_metros_ingresados').val());
      if ($('#existencia').val() == 'Hay stock total') {
        if ((total_metros_ingresados_input <= total_metros_cotizados)) {
           
          alert('Estado de Materia Prima: "Hay stock total" \n\n El total de metros ingresados de las bobinas ('+$('#total_metros_ingresados').val()+' Mts) debe ser mayor o igual que la cantidad total de metros cotizada ('+$('#total_metros_cotizados').val()+' Mts)')

        }else{
          
          guardarFormularioAdd('1');
        }
        

       

        //setTimeout(function(){$('#kilos_bobina_seleccionada').focus();}, 1);
      }
    });

function ba(){
if($("#bobina_adicional").is(":visible")){
    $("#total_de_bobinas").val(2);
    $("#numero_bobina2_div").show();
    //$("#numero_de_bobina2").val(0);
}else{
    $("#total_de_bobinas").val(1);
    
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
function restringe_bobinas(){
    if($("#existencia").val()!=""){
       $("#primera_bobina").show(); 
       $("#segunda_bobina").show(); 
       $("#tercera_bobina").show(); 
       /*$("#bobinasAdicionales").show(); */
    }else{
        $("#primera_bobina").hide(); 
       $("#segunda_bobina").hide(); 
       $("#tercera_bobina").hide(); 
       /*$("#bobinasAdicionales").hide(); */
    }
}

if($("#existencia").val()!=""){
       $("#primera_bobina").show(); 
       $("#segunda_bobina").show(); 
       $("#tercera_bobina").show(); 
       /*$("#bobinasAdicionales").show(); */
    }else{
        $("#primera_bobina").hide(); 
       $("#segunda_bobina").hide(); 
       $("#tercera_bobina").hide(); 
       /*$("#bobinasAdicionales").hide(); */
    }

$('.limitvalue').on('keyup',function(){
        if($(this).val()>4000){
            $(this).after("<label id='limitvalue' style='color:red'>El valor del peso es erroneo porque no puede pesar mas de 4000</label>");
            $(this).val('');
            $(this).focus();
        }else{
            $('#limitvalue').remove();
        }
});

$('#KilosEnStock_ComprarSaldo_StockParcial').on('keyup',function(){
        var cotizados = $('#total_kilos').val();
        var stock = $('#KilosEnStock_ComprarSaldo_StockParcial').val();
        var minimo = $('#Kilos_ComprarSaldo_StockParcial').val();
        $('#Kilos_ComprarSaldo_StockParcial').val(cotizados - stock);
});
$('#total_kilos').on('keyup',function(){
        var cotizados = $('#total_kilos').val();
        var stock = $('#KilosEnStock_ComprarSaldo_StockParcial').val();
        var minimo = $('#Kilos_ComprarSaldo_StockParcial').val();
        $('#Kilos_ComprarSaldo_StockParcial').val(cotizados - stock);
});
$('#Kilos_ComprarSaldo_StockParcial').on('blur',function(){
        var cotizados = $('#total_kilos').val();
        var stock = $('#KilosEnStock_ComprarSaldo_StockParcial').val();
        if((cotizados-stock)<$(this).val()){
        var minimo = $('#Kilos_ComprarSaldo_StockParcial').val();
        $('#Kilos_ComprarSaldo_StockParcial').val(cotizados - stock);
        $(this).after("<label id='minimovalue' style='color:red'>El valor minimo debe ser de: "+ minimo +"</label>");
        }else{
            $('#minimovalue').remove();
        }
});


</script>
</div>
