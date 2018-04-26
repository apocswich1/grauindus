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
            <li>Talleres externos - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Talleres externos - Fast Track N° <?php echo $id?></li>
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
            <div class="page-header"><h3>Talleres externos - Orden de Producción N° <?php echo $id?></h3></div>
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
                    if($fotomecanica2->estado==1)
                    {
                        ?>
                        <li>Fecha liberación fotomecánica : <strong><?php echo fecha($fotomecanica2->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>Cantidad de golpes : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                     <li>Corrugado o Microcorrugado : <strong><?php echo $fotomecanica->materialidad_datos_tecnicos?></strong></li>
                    <li>Valor Cotizado por Pegado : <strong><?php echo $hoja->pegado?></strong></li>
                     <li>Cantidad de Troquelados Buenos : <strong><?php echo $pliegos->total_pliegos_buenos?></strong></li>
                     <li>Unidades por Pliego : <strong><?php echo $ing->unidades_por_pliego?></strong></li>
                     <li>Precio de Pegado : <strong><?php echo $hoja->pegado?></strong></li>
                     <li>Codigo de Producto : <strong><?php echo $producto->codigo?></strong></li>
                     <?php echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
                     
            </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Talleres externos - Fast Track N° <?php echo $id?></h3></div>
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
			<input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
  
<!--   <div class="control-group">
		<label class="control-label" for="usuario">Si o NO</label>
		<div class="controls">
            <select name="si_no">
                <option value="NO" <?php //echo set_value_select($control,'si_no',$control->si_no,'NO');?>>NO</option>
                <option value="SI" <?php //echo set_value_select($control,'si_no',$control->si_no,'SI');?>>SI</option>
            </select>
       </div>
	</div> -->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción trabajo externo</label>
		<div class="controls">
            <input type="text" name="descripcion_trabajo_externo" value="<?php echo set_value_input($control,'descripcion_trabajo_externo',$control->descripcion_trabajo_externo);?>" placeholder="Descripción trabajo externo" />
       </div>
	</div>  
    <div class="control-group">
		<label class="control-label" for="usuario">Despachador</label>
		<div class="controls">
            <!--<input type="text" name="despachador" value="<?php //echo set_value_input($control,'despachador',$control->despachador);?>" placeholder="Despachador" />-->
            	<select name="despachador"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarioscombo as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control,'despachador',$control->despachador,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Camión de despacho</label>
		<div class="controls">
            <input type="text" name="camion_de_despacho" value="<?php echo set_value_input($control,'camion_de_despacho',$control->camion_de_despacho);?>" placeholder="Camión de despacho" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Chofer</label>
		<div class="controls">
            <input type="text" name="chofer" value="<?php echo set_value_input($control,'chofer',$control->chofer);?>" placeholder="Chofer" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a pegar</label>
		<div class="controls">
                    <input type="text" id="cantidad_a_pegar" name="cantidad_a_pegar" value="<?php echo set_value_input($control,'cantidad_a_pegar',$control->cantidad_a_pegar);?>" placeholder="Cantidad a pegar" />
       </div>
	</div> 
    <div class="control-group">
		<label class="control-label" for="usuario">Unidades por paquete</label>
		<div class="controls">
                    <input type="text" id="unidades_por_paquete" name="unidades_por_paquete" value="<?php echo set_value_input($control,'unidades_por_paquete',$control->unidades_por_paquete);?>" placeholder="Unidades por paquete" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
            <input type="text" name="precio" value="<?php echo $hoja->pegado;?>" readonly="true" />
       </div>
    </div>
<input type="hidden" name="regla" value="" id="regla"/>
 <?php $proves=$this->proveedores_model->getProveedores(); ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Parcial / Total</label>
		<div class="controls">
            <!--<input type="text" name="despachador" value="<?php //echo set_value_input($control,'despachador',$control->despachador);?>" placeholder="Despachador" />-->
            <select name="parcial"  class="" onchange="btn_parcial(this.value)">
                <option value="0">Seleccione.....</option>
                <option value="parcial" <?php if($control->switch=='parcial'){echo "selected"; }?>>Parcial</option>   
                <option value="total" <?php if($control->switch=='total'){echo "selected"; }?>>Total</option>   
            </select>
                    <input class="btn btn-success" type="button" name="btnparcial" id="btnparcial" onclick="llenar_proveedor()" value="Agregar" style="display: none" />
                </div>
    </div>
<div id="total" style="<?php if($control->parcial!=""){echo "display:none";}?>">
     <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
                    <select name="proveedor" onchange="llenar_datos_proveedor(this.value);">
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
    
    <div class="control-group">
		<label class="control-label" for="usuario">Dirección proveedor</label>
		<div class="controls">
                    <textarea id="direccion_proveedor" name="direccion_proveedor" value="<?php echo set_value_input($control,'direccion_proveedor',$control->direccion_proveedor);?>" placeholder="Dirección proveedor" ><?php echo set_value_input($control,'direccion_proveedor',$control->direccion_proveedor);?></textarea>
       </div>
	</div> 
    <div class="control-group">
		<label class="control-label" for="usuario">Horario proveedor</label>
		<div class="controls">
                    <textarea id="horario_proveedor" name="horario_proveedor" value="<?php echo set_value_input($control,'horario_proveedor',$control->horario_proveedor);?>" placeholder="Horario proveedor" ><?php echo set_value_input($control,'horario_proveedor',$control->horario_proveedor);?></textarea>
       </div>
	</div>
    </div>
    <div id="adicionales">
        
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
			<!--<input type="button" value="Parcial" class="btn <?php //if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" />-->
                        <?php if(!empty($control)){?>
                        <a href="<?php echo base_url()?>produccion/oc_produccion_talleres/<?php echo $datos->id ?>"><img src="../../../../public/frontend/images/ico-PDF.png"></a>
                                <?php } ?>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
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
 <?php
if($this->input->post('parcial')=='parcial'){ ?>
<script>btn_parcial("parcial");</script>         
<?php } 
$task_array = json_decode($control->parcial,true);
if(count($task_array)!='' || count($task_array)!='0'){ ?>
<script>btn_parcial("parcial");</script>         
<?php } ?>
<?php

if($this->input->post('parcial')=='parcial'){
                for($i=1;$i<=$reglas;$i++){
                    $x=$paquete[$i]['p'.$i];
                    $c=$paquete[$i]['c'.$i];
                    echo "<script>llenar_proveedor2($i,$x,$c);</script>";
                }              
}

$task_array = json_decode($control->parcial,true);
if(count($task_array)!='' || count($task_array)!='0'){
                for($i=1;$i<=count($task_array);$i++){
                    $x=$task_array[$i]['p'.$i];
                    $c=$task_array[$i]['c'.$i];
                    echo "<script>llenar_proveedor2($i,$x,$c);</script>";
                }              
}else{
                    echo "<script>$('#total').attr('display','block');</script>";
}
if($control->switch != "parcial"){ ?>
    <script>btn_parcial("total");</script>  
<?php }
?>
</div>