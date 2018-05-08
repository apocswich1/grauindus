<?php 
ob_start();
$this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Fotomecánica Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Fotomecánica Fast Track N° <?php echo $ordenDeCompra->id?></li>
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
            <div onclick="ver_informacion('informacion')"  class="page-header"><h3>Fotomecánica Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
            <p style="text-align: center;"><strong>Para liberar deben estar en SI : VB Maqueta, VB Color, VB Estructura, Entrega a fabricación a línea de troquel y Confección de Planchas</strong><hr /></p>
            <div id="informacion" style="margin-left: 0px;width:100%;float:left;height: 380px;">
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
                $cliente1=$this->clientes_model->getClientePorIdBasico($molde->nombrecliente);
                $cliente2=$this->clientes_model->getClientePorIdBasico($molde->nombrecliente2);

                ?>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php echo $cliente?></b></a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <?php if (!empty($molde->archivo)) {  ?>
                        <li>N° Molde : <?php echo $molde->nombre?>  <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <button type="button" class="btn" data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo $fotomecanica2->numero_molde?> <i class="icon-search"></i></button><strong>(<?php echo $moldeNuevo?>)</strong></li>
                    <?php } else {    ?>
                        <li><strong>NO ESTÁ EL PDF DEL MOLDE</strong></li>
                    <?php }?>                     
                    
                    
                    <!--
                    <?php //if (!empty($molde->archivo)) {  ?>
                        <li>Ver Modelo : <a href="<?php //echo base_url().$this->config->item('direccion_pdf').$molde->archivo; ?>" target="_blank">Archivo Pdf</a> (<?php //echo $moldeNuevo; ?>)</li> 
                    <?php //} else {    ?>
                        <li><strong>NO ESTÁ EL PDF DEL MOLDE</strong></li>
                    <?php //}?>         
                    -->

                    
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica2->troquel_por_atras?></li>
                    <?php if(!empty($ing->archivo))
                    {
                    $archivoIng='NO';
                    ?> 
                    <li><strong>PDF trazado de Ingeniería</strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        $archivoIng='NO';
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                    <?php if(!empty($fotomecanica2->archivo))
                    {
                    $archivoFotomecanica='SI';
                    ?> 
                    <li><strong>PDF imagen a imprimir</strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        $archivoFotomecanica='NO';
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    <li>
                        <?php
                        if(sizeof($fotomecanica)==0)
                           {
                               ?>
                               Situación : <strong>Pendiente</strong>
                               <?php
                                
                           }else
                           {
                             switch($fotomecanica->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    Situación : <strong>Liberada el <?php echo fecha_con_hora($fotomecanica->fecha_liberada);?></strong>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    Situación : <strong>Activa el <?php echo fecha_con_hora($fotomecanica->fecha_activa);?></strong>
                                    <?php
                                break;
                             }
                           }
                        ?>
                    </li>
                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;">
                <ul><?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><b>Placa :</b></li>
                            <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?> </li>                        
                    <?php } else { ?>
                           <li><b>Placa : </b></li>
                           <li><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>   </li>                        
                    <?php } ?>
                    <li><b><?php echo $fotomecanica2->materialidad_datos_tecnicos; ?></b>:</li>
                    <?php
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li>Onda : <b>Tapa (Respaldo) </b></li>                      
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
                     <li>Trazado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Prueba de Color: <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                  
                     <li>Colores : <strong><?php  echo $fotomecanica2->colores; ?></strong></li>
                     <li>Barniz : <strong><?php echo $fotomecanica2->fot_lleva_barniz; ?></strong></li>                     
                     <li>Reserva : <strong><?php echo $fotomecanica2->fot_reserva_barniz; ?></strong></li>        

                </ul>
            	</div>
		<div class="controls"  style="margin-left: 0px;width:30%;float:left;margin-top: 0%;">
                <ul>
                     <li>Total Solicitada : <strong><?php  echo $ordenDeCompra->cantidad_de_cajas; ?></strong></li>
                     <li>Total Merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                     <li>Cantidad a Imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>
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

                <input id="datohidden" type="hidden" value='<?php echo $ordenDeCompra->id_cotizacion; ?>' />
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="height: 300px; wi">
                 <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div style="margin-left: 100px;">
                        <h3>Detalle del Molde</h3>
                        <ul>
                            <li>Tipo: <strong><?php echo $molde->tipo; ?></strong></li>    
                            <li>Estado: <strong>
                                <?php 
                            if($molde->estado==0){
                                echo "Activo";
                            }else{
                                echo"Inactivo";
                            }
                               ?> 
                                </strong></li>    
                            <li>Nombre: <strong><?php echo $molde->nombre; ?></strong></li>    
                            <li>Cliente 1: <strong><?php echo $cliente1->razon_social; ?></strong></li>    
                            <li>Cliente 2: <strong><?php echo $cliente2->razon_social; ?></strong></li>    
                            <li>Tamaño de la Caja: <strong><?php echo $molde->tamano_caja; ?></strong></li>    
                            <li>Distancia Cuchillos: <strong><?php echo $molde->cuchillocuchillo."x".$molde->cuchillocuchillo2; ?></strong></li>    
                            <li>Bobina: <strong><?php echo $molde->ancho_bobina."x".$molde->largo_bobina; ?></strong></li>    
                            <?php if (!empty($molde->archivo)) {  ?>
                                <li>Ver Modelo : <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo; ?>" target="_blank">Archivo Pdf</a> (<?php echo $moldeNuevo; ?>)</li> 
                            <?php } else {    ?>
                                <li><strong>NO ESTÁ EL PDF DEL MOLDE</strong></li>
                            <?php }?>                                          
                        </ul>
                        </div>
                       </div>       
                 </div>
                </div>

                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Fotomecánica Fast Track N° <?php echo $id?></h3></div>
            <ul>
                <?php
                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                ?>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php $cliente->razon_social; ?></b></a></li>	                    
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
                <hr />
            <?php
        break;
      }
      ?>
	<p>
         
    </p>
    
    <br />
    <table>
        <tr>
            <td>
                
   <div class="control-group">
    <label class="control-label" for="usuario">Comentarios Fotomecanica</label>
    <div class="controls">
        <textarea id="comentario_fot" style="width: 350px" name="comentario_fotomecanica" placeholder="Comentarios"><?php echo set_value_input($fotomecanica,'comentario_fotomecanica',$fotomecanica->comentario_fotomecanica);?></textarea>     
    </div>
  </div>
            </td>
            <td style="width:200px">
            </td>
            <td>
        <div class="control-group">
                <label class="control-label" for="usuario">Lleva desgajado automatico:</label>
                <div class="controls">
                        <select name="desgajado_automatico" style="width: 150px;" onchange="">
<!--                        <option value="">Seleccione......</option>-->
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="NO" <?php if($ing->desgajado_automatico=="NO"){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if($ing->desgajado_automatico=="SI"){echo 'selected="selected"';}?>>SI</option>
                            <option value="POR DEFINIR" <?php if($ing->desgajado_automatico=="POR DEFINIR"){echo 'selected="selected"';}?>>POR DEFINIR</option>
                        <?php } else { ?>
                            <option value="NO" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="POR DEFINIR" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='NO'){echo 'selected="selected"';}?>>POR DEFINIR</option>
                        <?php }  ?>                                                    
                        </select> 			
                </div>
             </div>
                <div class="control-group" id="status_linea_confeccion" <?php if($ing->desgajado_automatico=="" || $ing->desgajado_automatico=="NO" || $ing->desgajado_automatico=="POR DEFINIR"){ echo "style='display:block'";} ?>>
                <label class="control-label" for="usuario">Status Linea Confeccion de Desgajado:</label>
                <div class="controls">
                        <select name="status_linea" style="width: 250px;" onchange="">
<!--                        <option value="">Seleccione......</option>-->
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="MODIFICAR" <?php if($fotomecanica->status_linea=="MODIFICAR"){echo 'selected="selected"';}?>>MODIFICAR</option>
                            <option value="LINEA DE DESGAJE HECHA" <?php if($fotomecanica->status_linea=="LINEA DE DESGAJE HECHA"){echo 'selected="selected"';}?>>LINEA DE DESGAJE HECHA</option>
                        <?php } else { ?>
                            <option value="MODIFICAR" <?php if(isset($_POST["status_linea"]) && $_POST["status_linea"]=='MODIFICAR'){echo 'selected="selected"';}?>>MODIFICAR</option>
                            <option value="LINEA DE DESGAJE HECHA" <?php if(isset($_POST["status_linea"]) && $_POST["status_linea"]=='APROBADO'){echo 'selected="selected"';}?>>LINEA DE DESGAJE HECHA</option> 
                        <?php }  ?>                                                    
                        </select><span id="fecha_conf_status" style="color:green"><?php if($fotomecanica->fecha_conf_desg!=="" && $fotomecanica->fecha_conf_desg!=="0000-00-00"){echo " Fecha: ". $fotomecanica->fecha_conf_desg;}  ?></span> 			
                </div>
             </div>
            </td>
        </tr>
    </table>
  
    <div class="control-group">
    <label class="control-label" for="usuario">Recepcion OT</label>
    <div class="controls">
      <select name="recepcion_ot" id="recepcion_ot">
                <option value="">Seleccione</option>
                <option value="Por Revisar" <?php echo set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot  ,'Por Revisar');?>>Por Revisar</option>        
                <option value="Aprobada" <?php echo set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot ,'Aprobada');?>>Aprobada</option>
                <option value="Rechazada" <?php echo set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot  ,'Rechazada');?>>Rechazada</option>
            </select>            
    </div>
  </div>

    <div class="control-group coment">

    <label class="control-label" for="usuario">Observacion <strong style="color: red;">(*)</strong></label>
    <div class="controls">             
        <textarea id="coment1" name="coment1" style="width: 350px" name="coment"><?php echo set_value_input($fotomecanica,'comentario_rechazo',$fotomecanica->comentario_rechazo);?></textarea>
        <input type="button" value="Guardar" class="btn btn-warning" onclick="carga_ajax_revision_fotomecanica('<?php echo base_url();?>produccion/ajaxguardar',$('#coment1').val(),'<?php echo $id;?>','mensaje')" />
    <div class="mensaje" id="mensaje"  style="color: white;
            background-color: blue;
            padding: 5px;
            padding-left: 20px;
            width: 97px;" >Guardado ...</div>
    </div>
    </div>


    <div class="control-group">
		<label class="control-label" for="usuario">Revisión Trazado</label>
		<div class="controls">
			<select name="revision_trazado">
          <?php
          
          ?>
          <option value="">Seleccione</option>          
          <option value="Modificando" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Modificando');?>>Modificando</option>
          <option value="Aprobada" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Aprobada');?>>Aprobada</option>
      </select>
    </div>
	  </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Recepcion de Maqueta</label>
    <div class="controls">
      <select name="recepcion_maqueta">
          <?php
          
          ?>
          <option value="">Seleccione</option>          
          <option value="En Espera" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'En Espera');?>>En Espera</option>
          <option value="Confeccion o Fabricacion" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Confeccion o Fabricacion');?>>Confeccion o Fabricacion</option>
          <option value="Recepcionado Con Observaciones Del Cliente" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Recepcionado Con Observaciones Del Cliente');?>>Recepcionado Con Observaciones Del Cliente</option>
          <option value="Pendiente (Falta Material)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Pendiente (Falta Material)');?>>Pendiente (Falta Material)</option>
          <option value="Enviada a Cliente (1er Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (1er Visto)');?>>Enviada a Cliente (1er Visto)</option>
          <option value="Enviada a Cliente (2do Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (2do Visto)');?>>Enviada a Cliente (2do Visto)</option>
          <option value="Enviada a Cliente (3er Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (3er Visto)');?>>Enviada a Cliente (3er Visto)</option>
          <option value="Aprobada (Espera de Maqueta Fisica)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Aprobada (Espera de Maqueta Fisica)');?>>Aprobada (Espera de Maqueta Fisica)</option>                    
          <option value="Recepcion Aprobada" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Recepcion Aprobada');?>>Recepcion Aprobada</option>                    
      </select>
    </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Revisión de Imagen</label>
		<div class="controls">
			<select name="revision_de_imagen">
          <option value="">Seleccione</option>                  
          <option value="En Espera de Informacion" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'En Espera de Informacion');?>>En Espera de Informacion</option>
          <option value="En Consulta del Cliente" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'En Consulta del Cliente');?>>En Consulta del Cliente</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'Aprobado');?>>Aprobado</option>
      </select>            
		</div>
	  </div>
        
    <div class="control-group">
    <label class="control-label" for="usuario">Montaje Digital</label>
    <div class="controls">
      <select name="montaje_digital">
          <option value="">Seleccione</option>                  
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'montaje_digital',$fotomecanica->montaje_digital,'En Proceso');?>>En Proceso</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'montaje_digital',$fotomecanica->montaje_digital,'Aprobado');?>>Aprobado</option>
      </select>            
    </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Prueba de Color</label>
    <div class="controls">
      <select name="prueba_color">
          <option value="">Seleccione</option>                  
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'En Proceso');?>>En Proceso</option>
          <option value="Enviado (Visto Bueno)" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'Enviado (Visto Bueno)');?>>Enviado (Visto Bueno)</option>
          <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'Aprobado');?>>Aprobado</option>
      </select>            
    </div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Arte y Diseño</label>
		<div class="controls">
			<select name="arte_diseno">
                <option value="">Seleccione</option>                  
                <option value="En Proceso" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Proceso');?>>En Proceso</option>
                <option value="En Espera" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Espera');?>>En Espera</option>
                <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
                <option value="Aprobado" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'Aprobado');?>>Aprobado</option>
            </select>
		</div>
	  </div>
        
    <div class="control-group">
    <label class="control-label" for="usuario">Confeccion Salida de Pelicula</label>
    <div class="controls">
      <select name="conf_sal_pel">
          <option value="">Seleccione</option>                  
                <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
                <option value="En Proceso" <?php echo set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'En Proceso');?>>En Proceso</option>
                <option value="Entregado" <?php echo set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'Entregado');?>>Entregado</option>
      </select><span id="fecha_conf_label" style="color:green"><?php if($fotomecanica->fecha_conf_sal_pel!=="" && $fotomecanica->fecha_conf_sal_pel!=="0000-00-00"){echo " Fecha: ". $fotomecanica->fecha_conf_sal_pel;}  ?></span>
    </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Sobre de Desarrollo</label>
    <div class="controls">
      <select name="sobre_desarrollo">
          <option value="">Seleccione</option>                  
                <option value="Montaje" <?php echo set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'Montaje');?>>Montaje</option>
                <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
                <option value="Entregado" <?php echo set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'Entregado');?>>Entregado</option>
            </select>
    </div>
    </div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Para Produccion</label>
		<div class="controls">
			<textarea id="correcciones" style="width: 350px" name="correcciones" placeholder="Observaciones"><?php echo set_value_input($fotomecanica,'correcciones',$fotomecanica->correcciones);?></textarea>              
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Imagen a Imprimir Obligatorio ???<?php //if($orden->tiene_molde=='NO'){echo '<br />MOLDE A REVISION';}?></label>
		<div class="controls">
            <select name="entrega_a_fabricacion_a_linea_de_troquel">
                <?php
                //si el molde es antiguo, Imagen a Imprimir Obligatorio es NO o Molde a Revisión, y si es nuevo es NO o SI
               if($orden->tiene_molde=='NO')
                {
                    ?>
                     <option value="NO" <?php //echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'NO');?>>NO</option>
                    <option value="Molde a Revisión" <?php// echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'Molde a Revisión');?>>SI</option>
                    <option value="SI" <?php //echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'SI');?>>SI</option>
               
                    <?php
                }else
                {
                    ?>
                     <option value="NO" <?php// echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'NO');?>>NO</option>
                    <option value="SI" <?php //echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'SI');?>>SI</option>
               
                    <?php
                } ?>
                /*********Codigo añadido por ehndz******/
                </select>
              </div>
	</div>-->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Pegado es para máquina?</label>
		<div class="controls">
			<input type="text" name="para_maquina" value="<?php echo $ing->es_una_maquina?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">PDF de imagen a imprimir</label>
		<div class="controls">
			<input type="file" id="file" name="file" value="file"/> 
			<label value="file"></label>
		</div>
	</div>
	
	 <div class="control-group">
		<label class="control-label" for="usuario">PDF imagen a imprimir</label>
		<div class="controls">
			<?php if ($fotomecanica->pdf_imagen==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else  { ?>
				  <a href='<?php echo base_url(); ?>public/uploads/<?php echo $fotomecanica->pdf_imagen ?>' target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($fotomecanica->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $fotomecanica->glosa?></textarea>
            <?php 
               
                    $user13=$this->usuarios_model->getUsuariosPorId($fotomecanica->quien);
                 ?>
		  Modificado por <?php echo $user13->nombre?> el <?php echo invierte_fecha($fotomecanica->cuando)?>
        </div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
			<input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			<input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
                    <input type="button" value="Rechazar" <?php if($fotomecanica->situacion=="Liberada"){echo "disabled=true";}?> class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <?php
           if($fotomecanica->estado==1)
           {
                ?>
                <input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="alert('Ya fué liberada');" />
                <?php
            }else
            {
                if($archivoFotomecanica=='SI' and $archivoIng='SI')
                {
                    ?>
                <input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
                <?php
                }else
                {
                    ?>
                <input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="alert('No están los archivos de Ingeniería y Fotomecánica');" />
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
            
            $('.mensaje').hide();

            if($('#recepcion_ot option:selected').val() == 'Rechazada') {
              $('.coment').show();                  
            }else{
              $('.coment').hide();  
            }

            $('#recepcion_ot').change(function() {                
                if($('#recepcion_ot option:selected').val() != 'Rechazada') {
                  $('.coment').hide();
                }else{
                  $('.coment').show();
                }
            });
        }
    );
    
    $('select[name=desgajado_automatico]').change(function() {                
            var dato = $("#datohidden").val(); 
            var conf = $(this).val(); 
                if($(this).val()=="SI"){
                    $.post('http://localhost/trabajo/produccion/desgajado_automatico',{dato:dato,conf:conf},(data) => {
                    $('#status_linea_confeccion').show();
                    });
                }else{
                    $.post(webroot+'produccion/desgajado_automatico',{dato:dato,conf:conf},(data) => {
                    $('#status_linea_confeccion').show();
                    });
                }
            });
    $('select[name=conf_sal_pel]').change(function() {
            var dato = $("#datohidden").val(); 
            var conf = $(this).val(); 
            var modo = ''; 
            if(conf=="Entregado"){
                modo=1;
            }else{
                modo=2;
            }
            $.post(webroot+'produccion/fecha_confeccion',{dato:dato,conf:conf,modo:modo},(data) => {
            $("#fecha_conf_label").html(data); 
            });
            });
            
            $('select[name=status_linea]').change(function() {                
            var dato = $("#datohidden").val(); 
            var conf = $(this).val(); 
            var modo = ''; 
            if(conf=="LINEA DE DESGAJE HECHA"){
                modo=1;
            }else{
                modo=2;
            }
            $.post(webroot+'produccion/fecha_status',{dato:dato,conf:conf,modo:modo},(data) => {
            $("#fecha_conf_status").html(data); 
            });
            });
    
</script>
</div>
