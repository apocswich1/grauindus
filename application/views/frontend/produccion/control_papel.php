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
            <li>Control Papel - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Control Papel - Fast Track N° <?php echo $id?></li>
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
            <div class="page-header"><h3>Control Papel - Orden de Producción N° <?php echo $id?></h3></div>
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
                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);
                ?>
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica2->troquel_por_atras?></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
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
                        if(sizeof($fotomecanica2)==0)
                           {
                               ?>
                               Situación : <strong>Pendiente</strong>
                               <?php
                                
                           }else
                           {
                             switch($control_papel->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    Situación : <strong>Liberada el <?php echo fecha_con_hora($control_papel->fecha_liberada);?></strong>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    Situación : <strong>Activa el <?php echo fecha_con_hora($control_papel->fecha_activa);?></strong>
                                    <?php
                                break;
                             }
                           }
                        ?>
                    </li>
                    <?php
                    if($fotomecanica->estado==1)
                    {
                        ?>
                        <li>Fecha liberación fotomecánica : <strong><?php echo fecha($fotomecanica->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <li>Descripción de la onda : <strong><?php echo $materialidad_2->nombre?></strong></li>
                     <li>Gramaje de la onda : <strong><?php echo $materialidad_2->gramaje?></strong></li>
                     <li>Descripción liner : <strong><?php echo $materialidad_3->nombre?></strong></li>
                     <li>Gramaje liner : <strong><?php echo $materialidad_3->gramaje?></strong></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Control Papel - Fast Track N° <?php echo $id?></h3></div>
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
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control_papel,'descripcion_del_trabajo',$control_papel->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho corte final a usar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_a_usar_onda" value="<?php echo $materialidad_2->ancho?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho seleccionado de bobina</label>
		<div class="controls">
            <input type="text" name="ancho_seleccionado_de_bobina" value="<?php echo $materialidad_2->ancho?>" placeholder="Ancho seleccionado de bobina" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Para Bobinado</label>
		<div class="controls">
            <select name="para_bobinado">
                <option value="Para Bobinado" <?php echo set_value_select($control_papel,'para_bobinado',$control_papel->para_bobinado,'Para Bobinado');?>>Para Bobinado</option>
                <option value="Directo para Producción" <?php echo set_value_select($control_papel,'para_bobinado',$control_papel->para_bobinado,'Directo para Producción');?>>Directo para Producción</option>
            </select>
		</div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Onda</label>
		<div class="controls">
			<input type="text" name="gramaje_onda" placeholder="Gramaje Onda" value="<?php echo $materialidad_2->gramaje?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje seleccionado</label>
		<div class="controls">
            <input type="text" name="gramaje_seleccionado" value="<?php echo $materialidad_1->gramaje?>" placeholder="Gramaje seleccionado" />
       </div>
	</div>
    
    
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ubicación Onda <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ubicacion_onda" placeholder="Ubicación Onda" value="<?php echo set_value_input($control_papel,'ubicacion_onda',$control_papel->ubicacion_onda);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Preguntar a (Onda) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="preguntar_a_onda" placeholder="Preguntar a (Onda)" value="<?php echo set_value_input($control_papel,'preguntar_a_onda',$control_papel->preguntar_a_onda);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Bobina Onda <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_bobina_onda" placeholder="Número de Bobina Onda" value="<?php echo set_value_input($control_papel,'numero_bobina_onda',$control_papel->numero_bobina_onda);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Para Bobinado onda</label>
		<div class="controls">
            <select name="para_bobinado2">
                <option value="Para Bobinado" <?php echo set_value_select($control_papel,'para_bobinado2',$control_papel->para_bobinado2,'Para Bobinado');?>>Para Bobinado</option>
                <option value="Directo para Producción" <?php echo set_value_select($control_papel,'para_bobinado2',$control_papel->para_bobinado2,'Directo para Producción');?>>Directo para Producción</option>
            </select>
		</div>
	</div> 
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho a usar liner</label>
		<div class="controls">
			<input type="text" name="ancho_a_usar_liner" value="<?php echo $materialidad_3->ancho?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Bobina Liner seleccionado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina" placeholder="Ancho de Bobina liner seleccionado" value="<?php echo set_value_input($control_papel,'ancho_de_bobina',$control_papel->ancho_de_bobina);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje liner</label>
		<div class="controls">
			<input type="text" name="gramaje_liner" placeholder="Gramaje liner" value="<?php echo $materialidad_3->gramaje?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje seleccionado liner</label>
		<div class="controls">
            <input type="text" name="gramaje_seleccionado_liner" value="<?php echo set_value_input($control_papel,'gramaje_seleccionado_liner',$control_papel->gramaje_seleccionado_liner);?>" placeholder="Gramaje seleccionado liner" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ubicación Liner <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ubicacion_liner" placeholder="Ubicación Liner" value="<?php echo set_value_input($control_papel,'ubicacion_liner',$control_papel->ubicacion_liner);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Preguntar a (Liner) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="preguntar_a_liner" placeholder="Preguntar a (Liner)" value="<?php echo set_value_input($control_papel,'preguntar_a_liner',$control_papel->preguntar_a_liner);?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Bobina Liner <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_bobina_liner" placeholder="Número de Bobina Liner" value="<?php echo set_value_input($control_papel,'numero_bobina_liner',$control_papel->numero_bobina_liner);?>" />
		</div>
	</div>
    
    <?php
    if($ing->tamano_a_imprimir_1==60)
    {
        $ancho_bobina=$ing->tamano_a_imprimir_1*3;    
    }else
    {
        $ancho_bobina=$ing->tamano_a_imprimir_1*2;
    }
    
    ?>
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Ancho de Bobina 2</label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina2" value="<?php echo $ancho_bobina?>" readonly="true" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hay que comprar onda</label>
		<div class="controls">
			<input type="text" name="hay_que_comprar_onda" value="<?php echo set_value_input($control_papel,'hay_que_comprar_onda',$control_papel->hay_que_comprar_onda);?>" /> 
        </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
            <select name="proveedor">
                <?php
                $proves=$this->proveedores_model->getProveedores();
                foreach($proves as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php echo set_value_select($control_papel,'proveedor',$control_papel->proveedor,$prove->id);?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Fecha estimada de entrega</label>
		<div class="controls">
			<input type="date" name="fecha_estimada_de_entrega" value="<?php echo set_value_input($control_papel,'fecha_estimada_de_entrega',$control_papel->fecha_estimada_de_entrega);?>" /> 
        </div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control_papel->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control_papel->glosa?></textarea>
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
			<input type="button" value="Guardar" class="btn <?php if($control_papel->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
   		 <input type="button" value="Rechazar" class="btn <?php if($control_papel->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <input type="button" value="Liberar" class="btn <?php if($control_papel->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
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
