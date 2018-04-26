<?php $this->layout->element('admin_mensaje_validacion'); ?>
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
            <li>Fotomecánica Orden de Producción N° <?php echo $orden->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Fotomecánica Fast Track N° <?php echo $id?></li>
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
            <div class="page-header"><h3>Fotomecánica Orden de Producción N° <?php echo $orden->id?></h3></div>
            <p style="text-align: center;"><strong>Para liberar deben estar en SI : VB Maqueta, VB Color, VB Estructura, Entrega a fabricación a línea de troquel y Confección de Planchas</strong><hr /></p>
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
                ?>
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $fotomecanica2->numero_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica2->troquel_por_atras?></li>
                    <?php if(!empty($ing->archivo))
                    {
                    $archivoIng='NO';
                    ?> 
                    <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                    <li>PDF imagen <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_fotomecanica/<?php echo $fotomecanica2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
                <hr />
            <?php
        break;
      }
      ?>
	<p>
         
    </p>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Revisión Trazado</label>
		<div class="controls">
			<select name="revision_trazado">
                <?php
                
                ?>
                <option value="NO" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'revision_trazado',$fotomecanica->revision_trazado,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->revision_trazado=="SI")
                {
                    $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->revision_trazado_id_usuario);
                
                    ?>
                    Modificado por <?php echo $user1->nombre?> el <?php echo invierte_fecha($fotomecanica->revision_trazado_fecha)?>
                    <?php
                }
                ?>
          	</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Revisión de Imagen</label>
		<div class="controls">
			<select name="revision_de_imagen">
                <option value="NO" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'revision_de_imagen',$fotomecanica->revision_de_imagen,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->revision_de_imagen=="SI")
                {
                    $user2=$this->usuarios_model->getUsuariosPorId($fotomecanica->revision_de_imagen_id_usuario);
                 ?>
                    Modificado por <?php echo $user2->nombre?> el <?php echo invierte_fecha($fotomecanica->revision_de_imagen_fecha)?>
                    <?php
                }
            ?>
             
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Preparación de Archivos</label>
		<div class="controls">
			<select name="preparacion_de_archivos">
                <option value="NO" <?php echo set_value_select($fotomecanica,'preparacion_de_archivos',$fotomecanica->preparacion_de_archivos,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'preparacion_de_archivos',$fotomecanica->preparacion_de_archivos,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->preparacion_de_archivos=="SI")
                {
                    $user3=$this->usuarios_model->getUsuariosPorId($fotomecanica->preparacion_de_archivos_id_usuario);
                 ?>
                    Modificado por <?php echo $user3->nombre?> el <?php echo invierte_fecha($fotomecanica->preparacion_de_archivos_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Cliente</label>
		<div class="controls">
			<select name="envio_vb_cliente">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_cliente',$fotomecanica->envio_vb_cliente,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_cliente=="SI")
                {
                    $user4=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_id_usuario);
                 ?>
                    Modificado por <?php echo $user4->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_cliente_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Envío VB Cliente</label>
		<div class="controls">
			<textarea id="contenido4" name="recepcion_vb_cliente_1" placeholder="Observaciones"><?php echo set_value_input($fotomecanica,'recepcion_vb_cliente_1',$fotomecanica->recepcion_vb_cliente_1);?></textarea>
            <?php 
               if(!empty($fotomecanica->recepcion_vb_cliente_1))
               {
                $user12=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_vb_cliente_1_id_usuario);
                ?>
                Modificado por <?php echo $user12->nombre?> el <?php echo invierte_fecha($fotomecanica->recepcion_vb_cliente_1_fecha)?>
                <?php
               }
                    
                 ?>
                    
                
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Cliente 2</label>
		<div class="controls">
			<select name="envio_vb_cliente_2">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_cliente_2',$fotomecanica->envio_vb_cliente_2,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_cliente_2',$fotomecanica->envio_vb_cliente_2,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_cliente_2=="SI")
                {
                    $user5=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_2_id_usuario);
                 ?>
                    Modificado por <?php echo $user5->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_cliente_2_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Cliente 3</label>
		<div class="controls">
			<select name="envio_vb_cliente_3">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_cliente_3',$fotomecanica->envio_vb_cliente_3,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_cliente_3',$fotomecanica->envio_vb_cliente_3,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_cliente_3=="SI")
                {
                    $user6=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_3_id_usuario);
                 ?>
                    Modificado por <?php echo $user6->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_cliente_3_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Vendedor</label>
		<div class="controls">
			<select name="envio_vb_vendedor">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor',$fotomecanica->envio_vb_vendedor,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor',$fotomecanica->envio_vb_vendedor,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_vendedor=="SI")
                {
                    $user5=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_id_usuario);
                 ?>
                    Modificado por <?php echo $user5->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_vendedor_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Envío VB Vendedor</label>
		<div class="controls">
			<textarea id="contenido4" name="recepcion_vb_vendedor_1" placeholder="Observaciones"><?php echo set_value_input($fotomecanica,'recepcion_vb_vendedor_1',$fotomecanica->recepcion_vb_vendedor_1);?></textarea>
            <?php 
               if(!empty($fotomecanica->recepcion_vb_vendedor_1))
               {
                $user11=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_vb_vendedor_1_id_usuario);
                ?>
                Modificado por <?php echo $user11->nombre?> el <?php echo invierte_fecha($fotomecanica->recepcion_vb_vendedor_1_fecha)?>
                <?php
               }
                    
                 ?>
                    
                
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Vendedor 2</label>
		<div class="controls">
			<select name="envio_vb_vendedor_2">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor_2',$fotomecanica->envio_vb_vendedor_2,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor_2',$fotomecanica->envio_vb_vendedor_2,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_vendedor_2=="SI")
                {
                    $user7=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_2_id_usuario);
                 ?>
                    Modificado por <?php echo $user7->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_vendedor_2_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Envío VB Vendedor 3</label>
		<div class="controls">
			<select name="envio_vb_vendedor_3">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor_3',$fotomecanica->envio_vb_vendedor_3,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_vendedor_3',$fotomecanica->envio_vb_vendedor_3,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_vendedor_3=="SI")
                {
                    $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_3_id_usuario);
                 ?>
                    Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_vendedor_3_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">VB Maqueta</label>
		<div class="controls">
			<select name="envio_vb_maqueta">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_maqueta',$fotomecanica->envio_vb_maqueta,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_maqueta',$fotomecanica->envio_vb_maqueta,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_maqueta=="SI")
                {
                    $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_maqueta_id_usuario);
                 ?>
                    Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_maqueta_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">VB Color</label>
		<div class="controls">
			<select name="envio_vb_color">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_color',$fotomecanica->envio_vb_color,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_color',$fotomecanica->envio_vb_color,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_color=="SI")
                {
                    $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_color_id_usuario);
                 ?>
                    Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_color_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">VB Estructura</label>
		<div class="controls">
			<select name="envio_vb_estructura">
                <option value="NO" <?php echo set_value_select($fotomecanica,'envio_vb_estructura',$fotomecanica->envio_vb_estructura,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'envio_vb_estructura',$fotomecanica->envio_vb_estructura,'SI');?>>SI</option>
            </select>
            <?php 
                if($fotomecanica->envio_vb_color=="SI")
                {
                    $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_estructura_id_usuario);
                 ?>
                    Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->envio_vb_estructura_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Confección de Películas</label>
		<div class="controls">
			<select name="confeccion_de_peliculas">
                <option value="NO" <?php echo set_value_select($fotomecanica,'confeccion_de_peliculas',$fotomecanica->confeccion_de_peliculas,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'confeccion_de_peliculas',$fotomecanica->confeccion_de_peliculas,'SI');?>>SI</option>
            </select>
             <?php 
                if($fotomecanica->confeccion_de_peliculas=="SI")
                {
                    $user6=$this->usuarios_model->getUsuariosPorId($fotomecanica->confeccion_de_peliculas_id_usuario);
                 ?>
                    Modificado por <?php echo $user6->nombre?> el <?php echo invierte_fecha($fotomecanica->confeccion_de_peliculas_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Confección de Planchas</label>
		<div class="controls">
			<select name="confeccion_de_planchas">
                <option value="NO" <?php echo set_value_select($fotomecanica,'confeccion_de_planchas',$fotomecanica->confeccion_de_planchas,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'confeccion_de_planchas',$fotomecanica->confeccion_de_planchas,'SI');?>>SI</option>
            </select>
             <?php 
                if($fotomecanica->confeccion_de_planchas=="SI")
                {
                    $user7=$this->usuarios_model->getUsuariosPorId($fotomecanica->confeccion_de_planchas_id_usuario);
                 ?>
                    Modificado por <?php echo $user7->nombre?> el <?php echo invierte_fecha($fotomecanica->confeccion_de_planchas_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Recepción Parcial</label>
		<div class="controls">
			<select name="recepcion_parcial">
                <option value="NO" <?php echo set_value_select($fotomecanica,'recepcion_parcial',$fotomecanica->recepcion_parcial,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'recepcion_parcial',$fotomecanica->recepcion_parcial,'SI');?>>SI</option>
            </select>
             <?php 
                if($fotomecanica->recepcion_parcial=="SI")
                {
                    $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_parcial_id_usuario);
                 ?>
                    Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->recepcion_parcial_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Recepción Total</label>
		<div class="controls">
			<select name="recepcion_total">
                <option value="NO" <?php echo set_value_select($fotomecanica,'recepcion_total',$fotomecanica->recepcion_total,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($fotomecanica,'recepcion_total',$fotomecanica->recepcion_total,'SI');?>>SI</option>
            </select>
             <?php 
                if($fotomecanica->recepcion_total=="SI")
                {
                    $user9=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_total_id_usuario);
                 ?>
                    Modificado por <?php echo $user9->nombre?> el <?php echo invierte_fecha($fotomecanica->recepcion_total_fecha)?>
                    <?php
                }
            ?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios</label>
		<div class="controls">
			<textarea id="contenido4" name="correcciones" placeholder="Observaciones"><?php echo set_value_input($fotomecanica,'correcciones',$fotomecanica->correcciones);?></textarea>
            <?php 
               if(!empty($fotomecanica->correcciones))
               {
                $user8=$this->usuarios_model->getUsuariosPorId($fotomecanica->correcciones_id_usuario);
                ?>
                Modificado por <?php echo $user8->nombre?> el <?php echo invierte_fecha($fotomecanica->correcciones_fecha)?>
                <?php
               }
                    
                 ?>
                    
                
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Entrega para fabricación de línea de troquel<?php if($orden->tiene_molde=='NO'){echo '<br />MOLDE A REVISION';}?></label>
		<div class="controls">
            <select name="entrega_a_fabricacion_a_linea_de_troquel">
                <?php
                //si el molde es antiguo, Entrega para fabricación de línea de troquel es NO o Molde a Revisión, y si es nuevo es NO o SI
                if($orden->tiene_molde=='NO')
                {
                    ?>
                     <option value="NO" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'NO');?>>NO</option>
                    <option value="Molde a Revisión" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'Molde a Revisión');?>>SI</option>
               
                    <?php
                }else
                {
                    ?>
                     <option value="NO" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'NO');?>>NO</option>
                    <option value="SI" <?php echo set_value_select($fotomecanica,'entrega_a_fabricacion_a_linea_de_troquel',$fotomecanica->entrega_a_fabricacion_a_linea_de_troquel,'SI');?>>SI</option>
               
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
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
		<label class="control-label" for="usuario">Es para máquina?</label>
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
		<label class="control-label" for="usuario"><strong>PDF Fotomecánica</strong></label>
		<div class="controls">
			<?php if ($fotomecanica->pdf_imagen==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url(); ?>public/uploads/produccion/fotomecanica/<?php echo $fotomecanica->pdf_imagen ?>' target="_blank"><i class="icon-search"></i></a>
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
		    <input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
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
