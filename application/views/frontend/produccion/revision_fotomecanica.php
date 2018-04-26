<?php $this->layout->element('admin_mensaje_validacion'); 
//exit(print_r($tapa)."holaa");
?>

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
   <div class="control-group">
    <label class="control-label" for="usuario">Comentarios Fotomecanica</label>
    <div class="controls">
        <textarea id="comentario_fot" style="width: 350px" name="comentario_fotomecanica" placeholder="Comentarios"><?php echo set_value_input($fotomecanica,'comentario_fotomecanica',$fotomecanica->comentario_fotomecanica);?></textarea>     
    </div>
  </div>
  
    <div class="control-group">
    <label class="control-label" for="usuario">Recepcion OT</label>
    <div class="controls">
      <select name="preparacion_de_archivos">
                <option value="Rechazada" <?php echo set_value_select($fotomecanica,'preparacion_de_archivos',$fotomecanica->preparacion_de_archivos,'Rezadada');?>>Rezadada</option>
                <option value="Aprobada" <?php echo set_value_select($fotomecanica,'preparacion_de_archivos',$fotomecanica->preparacion_de_archivos,'Aprobada');?>>Aprobada</option>
            </select>            
    </div>
  </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Revisión Trazado</label>
		<div class="controls">
			<select name="revision_trazado">
          <?php
          
          ?>
          <option value="Modificando" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Modificando');?>>Modificando</option>
          <option value="Aprobada" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Aprobada');?>>Aprobada</option>
      </select>
    </div>
	  </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Recepcion de Maqueta</label>
    <div class="controls">
      <select name="revision_trazado">
          <?php
          
          ?>
          <option value="En Espera" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'En Espera');?>>En Espera</option>
          <option value="Confeccion o Fabricacion" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Confeccion o Fabricacion');?>>Confeccion o Fabricacion</option>
          <option value="Recepcionado Con Observaciones Del Cliente" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Recepcionado Con Observaciones Del Cliente');?>>Recepcionado Con Observaciones Del Cliente</option>
          <option value="Pendiente (Falta Material)" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Pendiente (Falta Material)');?>>Pendiente (Falta Material)</option>
          <option value="Enviada a Cliente (1er Visto)" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Enviada a Cliente (1er Visto)');?>>Enviada a Cliente (1er Visto)</option>
          <option value="Enviada a Cliente (2do Visto)" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Enviada a Cliente (2do Visto)');?>>Enviada a Cliente (2do Visto)</option>
          <option value="Enviada a Cliente (3er Visto)" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Enviada a Cliente (3er Visto)');?>>Enviada a Cliente (3er Visto)</option>
          <option value="Aprobada (Espera de Maqueta Fisica)" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Aprobada (Espera de Maqueta Fisica)');?>>Aprobada (Espera de Maqueta Fisica)</option>                    
          <option value="Recepcion Aprobada" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Recepcion Aprobada');?>>Recepcion Aprobada</option>                    
      </select>
    </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Revisión de Imagen</label>
		<div class="controls">
			<select name="revision_de_imagen">
          <option value="En Espera de Informacion" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'En Espera de Informacion');?>>En Espera de Informacion</option>
          <option value="En Consulta del Cliente" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'En Consulta del Cliente');?>>En Consulta del Cliente</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'Aprobado');?>>Aprobado</option>
      </select>            
		</div>
	  </div>
        
    <div class="control-group">
    <label class="control-label" for="usuario">Montaje Digital</label>
    <div class="controls">
      <select name="revision_de_imagen">
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'En Proceso');?>>En Proceso</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'Aprobado');?>>Aprobado</option>
      </select>            
    </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Prueba de Color</label>
    <div class="controls">
      <select name="revision_de_imagen">
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'En Proceso');?>>En Proceso</option>
          <option value="Enviado (Visto Bueno)" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'Enviado (Visto Bueno)');?>>Enviado (Visto Bueno)</option>
          <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
          <option value="Aprobado" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'Aprobado');?>>Aprobado</option>
      </select>            
    </div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Arte y Diseño</label>
		<div class="controls">
			<select name="envio_vb_cliente">
                <option value="En Proceso" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Proceso');?>>En Proceso</option>
                <option value="En Espera" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Espera');?>>En Espera</option>
                <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
                <option value="Aprobado" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'Aprobado');?>>Aprobado</option>
            </select>
		</div>
	  </div>
        
    <div class="control-group">
    <label class="control-label" for="usuario">Confeccion Salida de Pelicula</label>
    <div class="controls">
      <select name="envio_vb_cliente">
                <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
                <option value="En Proceso" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Proceso');?>>En Proceso</option>
                <option value="Entregado" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'Entregado');?>>Entregado</option>
            </select>
    </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Sobre de Desarrollo</label>
    <div class="controls">
      <select name="envio_vb_cliente">
                <option value="Montaje" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'Montaje');?>>Montaje</option>
                <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
                <option value="Entregado" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'Entregado');?>>Entregado</option>
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
  ++++==++++==++++==++++==++++==++++==++++==++++==++++==++++==++++==++++==++++==++++==
        <div class="control-group">
		<label class="control-label" for="usuario">Imagen de Impremsión<?php if($orden->tiene_molde=='NO'){echo '<br />MOLDE A REVISION';}?></label>
		<div class="controls">
            <select name="entrega_a_fabricacion_a_linea_de_troquel">
                <?php
                //if (sizeof($orden)>0) {   
                if($orden->tiene_molde<>'CO' || $orden->tiene_molde<>'CE'){ 
                ?>
                                <option value="CO" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'CO');?>>Al Corte</option>
                                <option value="CE" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'CE');?>>Al Centro</option>
                                <option value="NO" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'NO');?>>No se Sabe</option>
                        <?php } else {?>                    
                                <option value="CO" <?php if(isset($_POST["entrega_a_fabricacion_a_linea_de_troquel"])=="CO"){echo 'selected="selected"';}?>>Al Corte</option>
                                <option value="CE" <?php if(isset($_POST["entrega_a_fabricacion_a_linea_de_troquel"])=="CE"){echo 'selected="selected"';}?>>Al Centro</option>
                                <option value="NO" <?php if(isset($_POST["entrega_a_fabricacion_a_linea_de_troquel"])=="NO"){echo 'selected="selected"';}?>>No se Sabe</option>
                        <?php }                  
                /*********Fin de Codigo añadido por ehndz******/
                ?>
                
            </select>
                    <!--Codigo Añadido por ehndz-->
                    <a onclick="ver_informacion('que_es_esto');">Que es esto?</a>
                    <!--Fin de codigo Añadido por ehndz-->
		</div>
	</div>
        <!--codigo Añadido por ehndz-->
        <div class="control-group">
		<?php //echo "<h1>".$orden->tiene_molde."</h1>";?>
	</div>
        <!--codigo Añadido por ehndz-->
        <div id="que_es_esto" name="que_es_esto" class="control-group" style="display:none;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="<?php echo base_url().$this->config->item('direccion_pdf')."que_es_esto.png" ?>" alt="Smiley face" height="60%" width="60%">

         </div>
        <!--Fin de codigo Añadido por ehndz-->
	<?php
    //$op=$this->orden_model->getOrdenesPorId($orden->id);
	?>
    <div class="control-group">
		<label class="control-label" for="usuario">Películas para imprimir</label>
		
		<div class="controls">
            <select name="peliculas_para_imprimir">
                <option value="por revés" <?php echo set_value_select($fotomecanica,'peliculas_para_imprimir',$fotomecanica->peliculas_para_imprimir,'por revés');?>>por revés</option>
                <option value="por derecho" <?php echo set_value_select($fotomecanica,'peliculas_para_imprimir',$fotomecanica->peliculas_para_imprimir,'por derecho');?>>por derecho</option>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Fondo Negro</label>
		<div class="controls">
			<input type="text" name="tiene_fondo_negro" value="<?php echo $fotomecanica2->lleva_fondo_negro?>" readonly="true" />
		</div>
	</div>
    
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
		<label class="control-label" for="usuario"><strong>PDF imagen a imprimir</strong></label>
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
        //document.form.cliente.focus();
        }
    );
    
    
</script>
</div>
