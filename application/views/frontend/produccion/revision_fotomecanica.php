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
                    <input type="hidden" id="id_cotizacion" name="id_cotizacion" value="<?php echo $ordenDeCompra->id_cotizacion; ?>"/>
                    <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Revisión Ingeniería"><b><?php echo $cliente?></b></a></li>	                    
                    <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <!--<li>Condición del Producto : <strong><?php// echo $fotomecanica2->condicion_del_producto?><?php// if($fotomecanica2->condicion_del_producto=="Nuevo"){echo " ( Molde por Fabricar )";}?></strong></li>-->
                    <?php 
                    $condin="";
                    $condic="";
                    $condis="";
                    if(sizeof($especiales>0)){
                     if($especiales->condicion_del_producto=="Nuevo"){
                        $condin="selected='selected'";
                    }else if($especiales->condicion_del_producto=="Repetición Con Cambios"){
                        $condic="selected='selected'";
                    }else if($especiales->condicion_del_producto=="Repetición Sin Cambios"){
                        $condis="selected='selected'";
                    }   
                    }else{
                    if($fotomecanica2->condicion_del_producto=="Nuevo"){
                        $condin="selected='selected'";
                    }else if($fotomecanica2->condicion_del_producto=="Repetición Con Cambios"){
                        $condic="selected='selected'";
                    }else if($fotomecanica2->condicion_del_producto=="Repetición Sin Cambios"){
                        $condis="selected='selected'";
                    }}?>
                    <li>Condición del Producto : 
                        <select id="condicion_del_producto" name="condicion_del_producto">
                            <option value="Nuevo" <?php echo $condin; ?>>Nuevo</option>
                            <option value="Repetición Con Cambios" <?php echo $condic; ?>>Repetición Con Cambios</option>
                            <option value="Repetición Sin Cambios" <?php echo $condis; ?>>Repetición Sin Cambios</option>
                        </select>    
                    <?php echo $fotomecanica2->condicion_del_producto?><?php if($fotomecanica2->condicion_del_producto=="Nuevo"){echo " ( Molde por Fabricar )";}?></strong></li>
                    
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
                                    Situación : <h4 style="display: inline-block;"><strong>Liberada el <?php echo fecha_con_hora($fotomecanica->fecha_liberada);?></strong></h4>
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
                    <li><strong>Nro Molde: </strong><?php if($orden->id_molde!=""){echo $orden->id_molde;}else{echo "";}?></li>
                    <!--<li><strong>VB en Maquina: </strong><?php // if($datos->vb_maquina=="SI"){echo "SI";}else{echo "NO";}?></li>-->
                    <?php 
                    $vbs="";
                    $vbn=""; 
                    if(sizeof($especiales)>0){
                     if($especiales->vb_en_maquina=="SI"){
                        $vbs="selected='selected'";
                    }else if($especiales->vb_en_maquina=="NO"){
                        $vbn="selected='selected'";
                    }else if($especiales->vb_en_maquina==""){
                        $vbn="selected='selected'";
                    }   
                    }else{
                    if($datos->vb_maquina=="SI"){
                        $vbs="selected='selected'";
                    }else if($datos->vb_maquina=="NO"){
                        $vbn="selected='selected'";
                    }else if($datos->vb_maquina==""){
                        $vbn="selected='selected'";
                    }}?>
                    <li><strong>VB en Maquina: </strong> 
                        <select id="vb_en_maquina" name="vb_en_maquina">
                            <option value="SI" <?php echo $vbs; ?>>SI</option>
                            <option value="NO" <?php echo $vbn; ?>>NO</option>
                        </select>
                    <?php 
                    $impresions="";
                    $impresionn="";
                    if(sizeof($especiales)>0){
                        if($especiales->contra_la_fibra=="SI"){
                            $impresions="selected='selected'";
                        }else if($especiales->contra_la_fibra=="NO"){
                            $impresionn="selected='selected'";
                        }else{
                            $impresionn="selected='selected'";
                        }
                    }else{
                    if($ing->imprimir_contra_la_fibra == "SI"){
                        $impresions="selected='selected'";
                    }else if($ing->imprimir_contra_la_fibra == "NO"){
                        $impresionn="selected='selected'";
                    }else{
                        $impresionn="selected='selected'";
                    if($ing->tamano_a_impimir_1>$ing->tamano_a_impimir_2){
                        $impresions="selected='selected'";
                    }else if($ing->tamano_a_impimir_1<$ing->tamano_a_impimir_2){
                        $impresionn="selected='selected'";
                    }else if($ing->tamano_a_impimir_1==$ing->tamano_a_impimir_2){
                        $impresionn="selected='selected'";
                    }}}
                   // echo $impresionn.$ing->imprimir_contra_la_fibra;
                    ?>
                        
                    <li><strong>Impresion contra la fibra :</strong> 
                        <select id="contra_la_fibra" name="contra_la_fibra">
                            <option value="SI" <?php echo $impresions; ?>>SI</option>
                            <option value="NO" <?php echo $impresionn; ?>>NO</option>
                        </select>
                    <li><strong>Gato tiro o gato retiro?: </strong>
                    <?php 
                    $troquels="";
                    $tronqueln="";
                    if(sizeof($especiales)>0){
                     if($especiales->troquel_por_atras=="SI"){
                        $troquels="selected='selected'";
                    }else if($especiales->troquel_por_atras=="NO"){
                        $troqueln="selected='selected'";                        
                    }else{
                        $troqueln="selected='selected'";
                    }   
                    }else{
                    if($ing->troquel_por_atras=="SI"){
                        $troquels="selected='selected'";
                    }else if($ing->troquel_por_atras=="NO"){
                        $troqueln="selected='selected'";                        
                    }else{
                        $troqueln="selected='selected'";
                    }}?>
                    <select id="troquel_por_atras" name="troquel_por_atras">
                            <option value="SI" <?php echo $troquels; ?>>Por detrás, margen izquierdo, gato retiro</option>
                            <option value="NO" <?php echo $troqueln; ?>>Por delante, margen derecho, gato tiro</option>
                    </select>
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
                     <li>Repetición: <strong><?php  if($fotomecanica2->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
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
                     <li>Cantidad a Imprimir : <strong><?php echo ($ordenDeCompra->cantidad_de_cajas/$ing->unidades_por_pliego) + $hoja->total_merma; ?></strong></li>
                     <!--<li>Gato : <strong><?php //if($fotomecanica2->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        -->
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>CCAC1 : <strong><?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo (($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10) ?> Mms</strong></li>
                     <li>Lleva Fondo Negro : <strong><?php echo $ing->lleva_fondo_negro ?></strong></li> 
                      
                     <?php if($datos->trazado!="" && $datos->trazado!=0){ echo "<li>Trazado : <strong>".$datos->trazado."</strong></li>";} ?>
                     <?php if($molde->id_trazado!="" && $molde->id_trazado!=0){ echo "<li>Numero de Trazado : <strong>".$molde->id_trazado."</strong></li>";} ?>
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
                
                <div id="id01" class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="height: 150px; width: 500px">
                 <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div style="margin-left: 100px;">
                        <h3>Modificacion permanente?</h3>
                        <form>
                            <input id="btnsi" class="btn btn-success" type="button" name="btnsi" value="SI, permanente">
                            <input id="btnno"  class="btn btn-info" type="button" name="btnno" value="NO, solo por esta orden">
                            <input id="datatoda" type="hidden" name="datatoda" value="">
                        </form>
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
    <style>
      #coment1{
        float: left;
      }
      .div_fecha_aprobada{
        display: none;
        padding: 5px;
        vertical-align: top;          
      }
      .span_fecha_rechazado{
        padding: 15px;
      }
      .span_fecha_rechazado_verde{
        padding: 15px;
        background-color: #7bb33d;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        padding: 4px 14px;
        margin: 10px;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        width: 200px;
      }
      .text_notificado{
        border: 1px solid red;
        padding: 15px;
      }
      
      .boton_notificar,.boton_exito{
        margin: 10px;
        display: block;
      }
      .boton_exito{
        display: inline-block;
      }
    </style>   
    <input type="hidden" value="<?php echo $fotomecanica2->condicion_del_producto; ?>" id="hcondicion">
    <div class="control-group">
    <label class="control-label" for="usuario">Recepcion OT</label>
    <div class="controls"> 
      <select name="recepcion_ot" id="recepcion_ot">
          <option value="">Seleccione</option>
          <option value="Por Revisar" <?php echo set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot  ,'Por Revisar');?>>Por Revisar</option>        
          <option value="Aprobada" <?php echo $db_select_aprobada_ot = set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot ,'Aprobada');?>>Aprobada</option>
          <option value="Rechazada" <?php echo $db_select_rechazada = set_value_select($fotomecanica,'recepcion_ot',$fotomecanica->recepcion_ot  ,'Rechazada');?>>Rechazada</option>
      </select>    
      <input type="hidden" name="input_fecha_recepcion_ot_aprobado" value="<?php echo $db_fecha_recepcion_ot_aprobado = $fotomecanica->recepcion_ot_aprobado_fecha ?>">
      <?php      
          if ($db_fecha_recepcion_ot_aprobado != '0000-00-00' && $db_fecha_recepcion_ot_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_recepcion_ot_aprobado)).'</span>';
          }
        ?>
      <div id="div_fecha_recepcion_ot_aprobada" class="div_fecha_aprobada">
        <span><?php echo date("d-m-Y") ?></span>
      </div>     
    </div>
  </div>
  <script>
    //Seleccionar valor de Select option revision OT
    $('#recepcion_ot').on('change',function(){
        var valor_select = $(this).val();
        var fecha=$('#fecha_hoy').val();
        if (valor_select=='Rechazada') {
            $('#fecha_rechazada_recepcion_OT').val(fecha);
        }else{
             $('#fecha_rechazada_recepcion_OT').val('');
        }
    });
    

    
  </script>
    
    <div class="control-group coment">
      <label class="control-label" for="usuario">Observacion <strong style="color: red;">(*)</strong></label>
      <div class="controls">     
             
          <textarea id="coment1" style="width: 350px" name="comentario_rechazo"><?php echo set_value_input($fotomecanica,'comentario_rechazo',$fotomecanica->comentario_rechazo);?></textarea>
          <input type="hidden" id="id_nodo" value="<?php echo $fotomecanica->id_nodo; ?>">
          <input type="hidden" <?php $db_fecha_rechazada = set_value_input($fotomecanica,'fecha_rechazada_recepcion_OT',$fotomecanica->fecha_rechazada_recepcion_OT) ?>>
          <?php      

            if ($db_fecha_rechazada != '0000-00-00' && $db_fecha_rechazada != NULL) {
              //fecha base de datos
              echo '<span class="btn btn-success boton_exito" style="width:170px">Notificado el '.date("d-m-Y", strtotime($db_fecha_rechazada)).'</span>';
            } else {
                //fecha  diaria
                echo "<span id='texto_notificado' class='span_fecha_rechazado'>".date("d-m-Y")."</span>";
                echo '<input type="hidden" id="fecha_hoy" name="fecha_hoy" readonly value="'.date('Y-m-d').'">';
                echo '<input type="hidden" id="fecha_rechazada_recepcion_OT" name="fecha_rechazada_recepcion_OT" readonly value="">';
                echo '<input type="hidden" id="id_cotizacion_rechazo" name="id_cotizacion_rechazo" value="'.$datos->id.'">';
                echo '<input type="button" value="Notificar" id="id_boton_rechazar" class="btn btn-warning boton_notificar" onclick="revision_ot()" />';
            }

          ?>
          
          
          
          <div class="mensaje" id="mensaje"  style="color: white;
              background-color: blue;
              padding: 5px;
              padding-left: 20px;
              width: 97px;" ></div>
          </div>
    </div>


    <div class="control-group">
		<label class="control-label" for="usuario">Revisión Trazado</label>
		<div class="controls">
			<select name="revision_trazado" id="revision_trazado">
          <option value="">Seleccione</option>          
          <option value="Modificando" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Modificando');?>>Modificando</option>
          <option value="Aprobada" <?php echo $db_select_aprobada_trazado = set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'Aprobada');?>>Aprobada</option>
      </select>
      <input type="hidden" name="input_fecha_trazado_aprobado" value="<?php echo $db_fecha_trazado_aprobado = $fotomecanica->revision_trazado_fecha ?>">
        <?php      

          if ($db_fecha_trazado_aprobado != '0000-00-00' && $db_fecha_trazado_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_trazado_aprobado)).'</span>';
          }
        ?>
      <div id="div_fecha_revision_aprobada" class="div_fecha_aprobada">
        <span><?php echo date("d-m-Y") ?></span>
      </div>
    </div>
	  </div>


    <div class="control-group">
      <label class="control-label" for="usuario">Recepcion de Maqueta</label>
      <div class="controls">
        <select name="recepcion_maqueta" id="recepcion_maqueta">
            <option value="">Seleccione</option>          
            <option value="En Espera" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'En Espera');?>>En Espera</option>
            <option value="Confeccion o Fabricacion" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Confeccion o Fabricacion');?>>Confeccion o Fabricacion</option>
            <option value="Recepcionado Con Observaciones Del Cliente" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Recepcionado Con Observaciones Del Cliente');?>>Recepcionado Con Observaciones Del Cliente</option>
            <option value="Pendiente (Falta Material)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Pendiente (Falta Material)');?>>Pendiente (Falta Material)</option>
            <option value="Enviada a Cliente (1er Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (1er Visto)');?>>Enviada a Cliente (1er Visto)</option>
            <option value="Enviada a Cliente (2do Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (2do Visto)');?>>Enviada a Cliente (2do Visto)</option>
            <option value="Enviada a Cliente (3er Visto)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Enviada a Cliente (3er Visto)');?>>Enviada a Cliente (3er Visto)</option>
            <option value="Aprobada (Espera de Maqueta Fisica)" <?php echo set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Aprobada (Espera de Maqueta Fisica)');?>>Aprobada (Espera de Maqueta Fisica)</option>                    
            <option value="Recepcion Aprobada" <?php echo $db_select_aprobada_maqueta = set_value_select($fotomecanica,'recepcion_maqueta',$fotomecanica->recepcion_maqueta,'Recepcion Aprobada');?>>Recepcion Aprobada</option>                    
        </select>
        
        <input type="hidden" name="input_fecha_maqueta_aprobado" value="<?php echo $db_fecha_maqueta_aprobado = $fotomecanica->recepcion_maqueta_fecha ?>">
          <?php      
            if ($db_fecha_maqueta_aprobado != '0000-00-00' && $db_fecha_maqueta_aprobado != NULL) {
              //fecha base de datos
              echo '<span class="btn btn-success boton_exito" style="width:240px">Recepcion aprobada el '.date("d-m-Y", strtotime($db_fecha_maqueta_aprobado)).'</span>';
            }
          ?>
        <div id="div_fecha_recepcion_maqueta_aprobada" class="div_fecha_aprobada">
          <span><?php echo date("d-m-Y") ?></span>
        </div>
      </div>
    </div>
    
    <div class="control-group">
  		<label class="control-label" for="usuario">Revisión de Imagen</label>
  		<div class="controls">
  			<select name="revision_de_imagen" id="revision_de_imagen">
            <option value="">Seleccione</option>                  
            <option value="En Espera de Informacion" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'En Espera de Informacion');?>>En Espera de Informacion</option>
            <option value="En Consulta del Cliente" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'En Consulta del Cliente');?>>En Consulta del Cliente</option>
            <option value="Aprobado" <?php echo $db_fecha_imagen_aprobado = set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_imagen,'Aprobado');?>>Aprobado</option>
        </select>       
        <input type="hidden" name="input_fecha_imagen_aprobado" value="<?php echo $db_fecha_imagen_aprobado = $fotomecanica->revision_de_imagen_fecha ?>">
        <?php      

          if ($db_fecha_imagen_aprobado != '0000-00-00' && $db_fecha_imagen_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_imagen_aprobado)).'</span>';
          }
        ?>
        <div id="div_fecha_imagen_aprobada" class="div_fecha_aprobada">
          <span><?php echo date("d-m-Y") ?></span>
        </div>
  		</div>
	  </div>
        
    <div class="control-group">
    <label class="control-label" for="usuario">Montaje Digital</label>
    <div class="controls">
      <select name="montaje_digital" id="montaje_digital">
          <option value="">Seleccione</option>                  
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'montaje_digital',$fotomecanica->montaje_digital,'En Proceso');?>>En Proceso</option>
          <option value="Aprobado" <?php echo $db_fecha_montaje_aprobado= set_value_select($fotomecanica,'montaje_digital',$fotomecanica->montaje_digital,'Aprobado');?>>Aprobado</option>
      </select>
      <input type="hidden" name="input_fecha_montaje_aprobado" value="<?php echo $db_fecha_montaje_aprobado = $fotomecanica->montaje_digital_fecha ?>">
        <?php      

          if ($db_fecha_montaje_aprobado != '0000-00-00' && $db_fecha_montaje_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_montaje_aprobado)).'</span>';
          }
        ?>
        <div id="div_fecha_montaje_aprobada" class="div_fecha_aprobada">
          <span><?php echo date("d-m-Y") ?></span>
        </div>           
    </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Prueba de Color</label>
    <div class="controls">
      <select name="prueba_color" id="prueba_color">
          <option value="">Seleccione</option>                  
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'En Proceso');?>>En Proceso</option>
          <option value="Enviado (Visto Bueno)" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'Enviado (Visto Bueno)');?>>Enviado (Visto Bueno)</option>
          <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
          <option value="Aprobado" <?php echo $db_fecha_prueba_color_aprobado = set_value_select($fotomecanica,'prueba_color',$fotomecanica->prueba_color,'Aprobado');?>>Aprobado</option>
      </select>
      <input type="hidden" name="input_fecha_prueba_color_aprobado" value="<?php echo $db_fecha_prueba_color_aprobado = $fotomecanica->prueba_color_fecha ?>">
        <?php      

          if ($db_fecha_prueba_color_aprobado != '0000-00-00' && $db_fecha_prueba_color_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_prueba_color_aprobado)).'</span>';
          }
        ?>
        <div id="div_fecha_prueba_color_aprobada" class="div_fecha_aprobada">
          <span><?php echo date("d-m-Y") ?></span>
        </div>            
    </div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Arte y Diseño</label>
		<div class="controls">
			<select name="arte_diseno" id="arte_diseno">
          <option value="">Seleccione</option>                  
          <option value="En Proceso" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Proceso');?>>En Proceso</option>
          <option value="En Espera" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Espera');?>>En Espera</option>
          <option value="En Espera de Prueba de Color Fisica" <?php echo set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'En Espera de Prueba de Color Fisica');?>>En Espera de Prueba de Color Fisica</option>
          <option value="Aprobado" <?php echo $db_select_aprobado_arte_diseno = set_value_select($fotomecanica,'arte_diseno',$fotomecanica->arte_diseno,'Aprobado');?>>Aprobado</option>
      </select>
      <input type="hidden" name="input_fecha_arte_diseno_aprobado" value="<?php echo $db_fecha_arte_diseno_aprobado = $fotomecanica->arte_diseno_fecha ?>">
      <?php      
        if ($db_fecha_arte_diseno_aprobado != '0000-00-00' && $db_fecha_arte_diseno_aprobado != NULL) {
          //fecha base de datos
          echo '<span class="btn btn-success boton_exito" style="width:170px">Aprobado el '.date("d-m-Y", strtotime($db_fecha_arte_diseno_aprobado)).'</span>';
        }
      ?>
      <div id="div_fecha_arte_diseno_aprobada" class="div_fecha_aprobada">
        <span><?php echo date("d-m-Y") ?></span>
      </div> 
		</div>
	  </div>
        
    <div class="control-group">
      <label class="control-label" for="usuario">Confeccion Salida de Pelicula</label>
      <div class="controls">
        <select name="conf_sal_pel" id="conf_sal_pel">
            <option value="">Seleccione</option>                  
            <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
            <option value="En Proceso" <?php echo set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'En Proceso');?>>En Proceso</option>
            <option value="Entregado" <?php echo $db_select_entregado_conf = set_value_select($fotomecanica,'conf_sal_pel',$fotomecanica->conf_sal_pel,'Entregado');?>>Entregado</option>
        </select>
        <input type="hidden" name="input_fecha_conf_sal_pel_aprobado" value="<?php echo $db_fecha_conf_sal_pel_aprobado = $fotomecanica->conf_sal_pel_fecha ?>">
        <?php      
          if ($db_fecha_conf_sal_pel_aprobado != '0000-00-00' && $db_fecha_conf_sal_pel_aprobado != NULL) {
            //fecha base de datos
            echo '<span class="btn btn-success boton_exito" style="width:170px">Entregado el '.date("d-m-Y", strtotime($db_fecha_conf_sal_pel_aprobado)).'</span>';
          }
        ?>
        <div id="div_fecha_conf_sal_pel_aprobada" class="div_fecha_aprobada">
          <span><?php echo date("d-m-Y") ?></span>
        </div>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="usuario">Confeccion Salida de Pelicula para Desgajado Automatico</label>
      <div class="controls">
        <?php

          if ($ing->desgajado_automatico=='SI') { ?>
            <select name="conf_sal_pel_desgajado" id="conf_sal_pel_desgajado">
                <option value="">Seleccione</option>                  
                <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'conf_sal_pel_desgajado',$fotomecanica->conf_sal_pel_desgajado,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
                <option value="En Proceso" <?php echo set_value_select($fotomecanica,'conf_sal_pel_desgajado',$fotomecanica->conf_sal_pel_desgajado,'En Proceso');?>>En Proceso</option>
                <option value="Entregado" <?php echo $db_select_entregado_conf_desgajado = set_value_select($fotomecanica,'conf_sal_pel_desgajado',$fotomecanica->conf_sal_pel_desgajado,'Entregado');?>>Entregado</option>
            </select>
            <input type="hidden" name="input_fecha_conf_sal_pel_desgajado_aprobado" value="<?php echo $db_fecha_conf_sal_pel_desgajado_aprobado = $fotomecanica->conf_sal_pel_desgajado_fecha ?>">
            <?php      
              if ($db_fecha_conf_sal_pel_desgajado_aprobado != '0000-00-00' && $db_fecha_conf_sal_pel_desgajado_aprobado != NULL) {
                //fecha base de datos
                echo '<span class="btn btn-success boton_exito" style="width:170px">Entregado el '.date("d-m-Y", strtotime($db_fecha_conf_sal_pel_desgajado_aprobado)).'</span>';
              }
            ?>
            <div id="div_fecha_conf_sal_pel_desgajado_aprobada" class="div_fecha_aprobada">
              <span><?php echo date("d-m-Y") ?></span>
            </div>
          <?php } else { ?>
            <input type="text" readonly="readonly" value="No corresponde">
          <?php } ?>
      </div>
    </div>

    <div class="control-group">
    <label class="control-label" for="usuario">Sobre de Desarrollo</label>
    <div class="controls">
      <select name="sobre_desarrollo" id="sobre_desarrollo">
          <option value="">Seleccione</option>                  
          <option value="Montaje" <?php echo set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'Montaje');?>>Montaje</option>
          <option value="En Espera (Materiales)" <?php echo set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'En Espera (Materiales)');?>>En Espera (Materiales)</option>
          <option value="Entregado" <?php echo $db_select_entregado_sobre = set_value_select($fotomecanica,'sobre_desarrollo',$fotomecanica->sobre_desarrollo,'Entregado');?>>Entregado</option>
      </select>
      <input type="hidden" name="input_fecha_sobre_desarrollo_aprobado" value="<?php echo $db_fecha_sobre_desarrollo_aprobado = $fotomecanica->sobre_desarrollo_fecha ?>">
      <?php      
        if ($db_fecha_sobre_desarrollo_aprobado != '0000-00-00' && $db_fecha_sobre_desarrollo_aprobado != NULL) {
          //fecha base de datos
          echo '<span class="btn btn-success boton_exito" style="width:170px">Entregado el '.date("d-m-Y", strtotime($db_fecha_sobre_desarrollo_aprobado)).'</span>';
        }
      ?>
      <div id="div_fecha_sobre_desarrollo_aprobada" class="div_fecha_aprobada">
        <span><?php echo date("d-m-Y") ?></span>
      </div> 
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
            <input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
			      <input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			      <input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
            <input type="button" value="Rechazar" <?php if($fotomecanica->situacion=="Liberada"){echo "disabled=true";}?> class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <?php
            
              if($fotomecanica2->colores>0 && $fotomecanica->pdf_imagen==""){
                  echo "No puede Liberar porque no tiene el pdf de la imagen y posee colores";
              }else{
                  
              if($fotomecanica->estado==1)
              {
              ?>
                <input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="alert('Ya fué liberada');" />
                <?php
              }else
              {
                if($db_select_aprobada_ot && $db_select_aprobada_trazado && $db_select_aprobada_maqueta && $db_fecha_imagen_aprobado && $db_fecha_montaje_aprobado && $db_fecha_prueba_color_aprobado && $db_select_aprobado_arte_diseno && $db_select_entregado_conf && $db_select_entregado_sobre)
                {
                    ?>
                <input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
                <?php
                }else
                {
                    ?>
                <input type="hidden" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="alert('No están los archivos de Ingeniería y Fotomecánica');" />
                <?php
                }
                ?>

                
              <?php }}
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

            
            $('#recepcion_ot').change(function() {                
                if($('#recepcion_ot option:selected').val() != 'Aprobada') {
                  $('#div_fecha_recepcion_ot_aprobada').hide();

                   if($('#hcondicion').val()=="Repetición Sin Cambios"){
                    
                    $("#div_fecha_revision_aprobada").hide();
                    $("#div_fecha_recepcion_maqueta_aprobada").hide();
                    $("#div_fecha_imagen_aprobada").hide();
                    $("#div_fecha_montaje_aprobada").hide();
                    $("#div_fecha_prueba_color_aprobada").hide();
                    $("#div_fecha_arte_diseno_aprobada").hide();
                    $("#div_fecha_conf_sal_pel_aprobada").hide();
                    $("#div_fecha_conf_sal_pel_desgajado_aprobada").hide();
                    $("#div_fecha_sobre_desarrollo_aprobada").hide();
  
                    $("#revision_trazado option[value='']").attr("selected",true);
                    $("#recepcion_maqueta option[value='']").attr("selected",true);
                    $("#revision_de_imagen option[value='']").attr("selected",true);
                    $("#montaje_digital option[value='']").attr("selected",true);
                    $("#prueba_color option[value='']").attr("selected",true);
                    $("#arte_diseno option[value='']").attr("selected",true);
                    $("#conf_sal_pel option[value='']").attr("selected",true);
                    }
                }else{
                  
                  $("#div_fecha_recepcion_ot_aprobada").show().css("display", "inline-block");
                  
                  if($('#hcondicion').val()=="Repetición Sin Cambios"){
                    
                  $("#div_fecha_revision_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_recepcion_maqueta_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_imagen_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_montaje_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_prueba_color_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_arte_diseno_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_conf_sal_pel_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_conf_sal_pel_desgajado_aprobada").show().css("display", "inline-block");
                  $("#div_fecha_sobre_desarrollo_aprobada").show().css("display", "inline-block");

                  $("#revision_trazado option[value=Aprobada]").attr("selected",true);
                  $("#recepcion_maqueta option[value='Recepcion Aprobada']").attr("selected",true);
                  $("#revision_de_imagen option[value=Aprobado]").attr("selected",true);
                  $("#montaje_digital option[value=Aprobado]").attr("selected",true);
                  $("#prueba_color option[value=Aprobado]").attr("selected",true);
                  $("#arte_diseno option[value=Aprobado]").attr("selected",true);
                  $("#conf_sal_pel option[value=Entregado]").attr("selected",true);
                  }
                }
            });
           
           function cambiartodos(){
             alert();
           }

            $('#revision_trazado').change(function() {                
                if($('#revision_trazado option:selected').val() != 'Aprobada') {
                  $('#div_fecha_revision_aprobada').hide();
                }else{
                  $("#div_fecha_revision_aprobada").show().css("display", "inline-block");
                }
            });

            $('#recepcion_maqueta').change(function() {                
                if($('#recepcion_maqueta option:selected').val() != 'Recepcion Aprobada') {
                  $('#div_fecha_recepcion_maqueta_aprobada').hide();
                }else{
                  $("#div_fecha_recepcion_maqueta_aprobada").show().css("display", "inline-block");
                }
            });

            $('#revision_de_imagen').change(function() {                
                if($('#revision_de_imagen option:selected').val() != 'Aprobado') {
                  $('#div_fecha_imagen_aprobada').hide();
                }else{
                  $("#div_fecha_imagen_aprobada").show().css("display", "inline-block");
                }
            });
            
            $('#montaje_digital').change(function() {                
                if($('#montaje_digital option:selected').val() != 'Aprobado') {
                  $('#div_fecha_montaje_aprobada').hide();
                }else{
                  $("#div_fecha_montaje_aprobada").show().css("display", "inline-block");
                }
            });

            $('#prueba_color').change(function() {                
                if($('#prueba_color option:selected').val() != 'Aprobado') {
                  $('#div_fecha_prueba_color_aprobada').hide();
                }else{
                  $("#div_fecha_prueba_color_aprobada").show().css("display", "inline-block");
                }
            });

            $('#arte_diseno').change(function() {                
                if($('#arte_diseno option:selected').val() != 'Aprobado') {
                  $('#div_fecha_arte_diseno_aprobada').hide();
                }else{
                  $("#div_fecha_arte_diseno_aprobada").show().css("display", "inline-block");
                }
            });
            
            $('#conf_sal_pel').change(function() {                
                if($('#conf_sal_pel option:selected').val() != 'Entregado') {
                  $('#div_fecha_conf_sal_pel_aprobada').hide();
                }else{
                  $("#div_fecha_conf_sal_pel_aprobada").show().css("display", "inline-block");
                }
            });

            $('#conf_sal_pel_desgajado').change(function() {                
                if($('#conf_sal_pel_desgajado option:selected').val() != 'Entregado') {
                  $('#div_fecha_conf_sal_pel_desgajado_aprobada').hide();
                }else{
                  $("#div_fecha_conf_sal_pel_desgajado_aprobada").show().css("display", "inline-block");
                }
            });

            $('#sobre_desarrollo').change(function() {                
                if($('#sobre_desarrollo option:selected').val() != 'Entregado') {
                  $('#div_fecha_sobre_desarrollo_aprobada').hide();
                }else{
                  $("#div_fecha_sobre_desarrollo_aprobada").show().css("display", "inline-block");
                }
            });
        }
    );
    
    
    //nuevas modificaciones especiales
    $('#condicion_del_producto').change(function() {
        $('#id01').modal({
        show: 'false'
    }); 
    $('#datatoda').val($(this).attr('name')+','+$(this).val()+',');
    });
    
    $('#vb_en_maquina').change(function() {
        $('#id01').modal({
        show: 'false'
    }); 
    $('#datatoda').val($(this).attr('name')+','+$(this).val()+',');
    });
    
    $('#troquel_por_atras').change(function() {
        $('#id01').modal({
        show: 'false'
    }); 
    $('#datatoda').val($(this).attr('name')+','+$(this).val()+',');
    });
    
    $('#contra_la_fibra').change(function() {
        $('#id01').modal({
        show: 'false'
    }); 
    $('#datatoda').val($(this).attr('name')+','+$(this).val()+',');
    });
    
    $('#btnsi').on('click',function() {
        $('#id01').modal('hide');
        let valor = $('#datatoda').val();
        let id = $('#id_cotizacion').val();
        valor = valor.split(",").join("/");
        let arreglo = valor+'SI/'+id;
        
        var ruta = webroot + 'produccion/produccion_especiales_definitiva';
        //$.post(ruta,{data : arreglo},function(datos){
          //  alert("Valor modificado");
        //});
        window.location.href = ruta+"/"+arreglo;
    });
    
    $('#btnno').on('click',function() {
        $('#id01').modal('hide');
        let valor = $('#datatoda').val();
        let id = $('#id_cotizacion').val();
        let arreglo = valor+'NO,'+id;
        var ruta = webroot + 'produccion/produccion_especiales/';
        $.post(ruta,{data : arreglo},function(datos){
            alert("Valor modificado");
        });
    });
    //fin de nuevas modificaciones especiales
    
</script>
</div>
