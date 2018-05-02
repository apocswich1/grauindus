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
            <li>Desgajado - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Desgajado - Fast Track N° <?php echo $ordenDeCompra->id?></li>
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
            <div class="page-header"><h3>Desgajado - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
            <ul>
                <?php
                
                $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                //print_r($ing);exit();
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
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica->troquel_por_atras?></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                   <?php if(!empty($fotomecanica->archivo))
                    {
                    $archivoFotomecanica='SI';
                    ?> 
                    <li>PDF imagen <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_fotomecanica/<?php echo $fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        $archivoFotomecanica='NO';
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    <li>
                        <?php
                        if(sizeof($troquelado)==0)
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
                    if($troquelado->estado==1)
                    {
                        ?>
                        <li>Fecha liberación troquelado : <strong><?php echo fecha($troquelado->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <li>Cantidad de golpes : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                    <li>Corrugado o Microcorrugado : <strong><?php echo $fotomecanica->materialidad_datos_tecnicos?></strong></li>
                     <li>Total pliegos cortados : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                     <li>Total pliegos producidos : <strong><?php echo $corrugado->total_pliegos_producidos?></strong></li>
                    <li>Total pliegos buenos (Imprenta producción) : <strong><?php echo $imprenta->total_pliegos_buenos?></strong></li>
                    <li>Total pliegos buenos (Emplacado) : <strong><?php echo $emplacado->total_pliegos_buenos?></strong></li>
                    <li>Total pliegos buenos (Troquelado) : <strong><?php echo $control->total_pliegos_buenos ?></strong></li>
                    <li>Barniz : <strong><?php echo $fotomecanica->fot_lleva_barniz; ?></strong></li>                     
                     <li>Reserva : <strong><?php echo $fotomecanica->fot_reserva_barniz; ?></strong></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Desgajado - Fast Track N° <?php echo $id?></h3></div>
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
		<label class="control-label" for="usuario">Comentarios para una eventual repetición <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" placeholder="Descripción del trabajo" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Pliegos</label>
		<div class="controls">
            <input type="text" name="numero_de_pliegos" value="<?php echo $troquelado->total_pliegos_buenos; ?>" readonly="true" />
       </div>
	</div> 
   
    <div class="control-group">
		<label class="control-label" for="usuario">Unidades de caja por pliego <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <!--comentado por ehndz corrigiendo valor del input <input type="text" name="unidades_de_caja_por_pliego" value="<?php //echo set_value_input($control,'unidades_de_caja_por_pliego',$control->unidades_de_caja_por_pliego);?>" placeholder="Unidades de caja por pliego" />-->
            <input type="text" name="unidades_de_caja_por_pliego" value="<?php echo $ing->unidades_por_pliego;?>" placeholder="Unidades de caja por pliego" />
       </div>
	</div> 
    
    <div class="control-group">
<label class="control-label" for="usuario">Total piezas para desgajar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <!--comentado por ehndz corrigiendo valor del input <input type="text" name="total_piezas_por_pliego" value="<?php //echo set_value_input($control,'total_piezas_por_pliego',$control->total_piezas_por_pliego);?>" placeholder="Total piezas por pliego" />-->
            <input type="text" name="total_piezas_por_pliego" value="<?php echo $ing->piezas_totales_en_el_pliego;?>" placeholder="Total piezas por pliego" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total cajas a entregar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_cajas_a_entregar" value="<?php echo set_value_input($control,'total_cajas_a_entregar',$control->total_cajas_a_entregar);?>" placeholder="Total cajas a entregar" />
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
                    <option value="<?php echo $usuario->id?>" <?php if($control->maestro==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Merma <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="merma" value="<?php echo set_value_input($control,'merma',$control->merma);?>" placeholder="Merma" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total Pliegos troquelado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_pliegos_troquelado" value="<?php echo set_value_input($control,'total_pliegos_troquelado',$control->total_pliegos_troquelado);?>" placeholder="Total pliegos troquelado" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total piezas a desgajar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_piezas_a_desgajar" value="<?php echo set_value_input($control,'total_piezas_a_desgajar',$control->total_piezas_a_desgajar);?>" placeholder="Total piezas a desgajar" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total cajas a desgajar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_cajas_a_desgajar" value="<?php echo set_value_input($control,'total_cajas_a_desgajar',$control->total_cajas_a_desgajar);?>" placeholder="Total cajas a desgajar" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total desgajado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_desgajado" value="<?php echo set_value_input($control,'total_desgajado',$control->total_desgajado);?>" placeholder="Total desgajado" />
       </div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Total o parcial <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="total_o_parcial">
                <option value="Total" <?php echo set_value_select($control,'total_o_parcial',$control->total_o_parcial,'Total');?>>Total</option>
                <option value="Parcial" <?php echo set_value_select($control,'total_o_parcial',$control->total_o_parcial,'Parcial');?>>Parcial</option>
            </select>
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
