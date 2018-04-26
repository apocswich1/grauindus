<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php //              print_r($datos); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>productos/index">Productos &gt;&gt;</a></li>
      <li>Editar Producto</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Producto</h3></div>
	
    
    
   
	<div class="control-group">
		<label class="control-label" for="usuario">Cotización </label>
		<div class="controls">
                    <input type="text" readonly="readonly" id="id_cotizacion" name="id_cotizacion" value="<?php echo $datos->id_cotizacion?>"/>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Código del Producto</label>
		<div class="controls">
			<input type="text" readonly="readonly" id="codigo" name="codigo" value="<?php echo $datos->codigo?>" placeholder="Código del Producto" />
		</div>
	</div>
        
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre del Producto</label>
		<div class="controls">
			<input style="width: 500px;" readonly="readonly"  type="text" id="nombre" name="nombre" value="<?php echo $datos->nombre?>" placeholder="Nombre del Producto" />
		</div>
	</div>
        
     
        
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente Asignado al Producto</label>
		<div class="controls">
			<input style="width: 500px;" readonly="readonly"  type="text" id="nombre" name="nombre" value="<?php echo $cliente->razon_social?>" placeholder="Nombre del Cliente" />
		</div>
	</div>        
        
	<div class="control-group" id="sub_comuna2">
		<label class="control-label" for="usuario">Tipo de Producto</label>
		<div class="controls">
		<select name="tipo">
                <option value="0">Seleccione</option>
                <?php
                foreach($productos_tipo as $productos) { ?>
                    <option value="<?php echo $productos->id?>" <?php if ($datos->tipo==$productos->id) { ?> selected="selected" <?php } ?>><?php echo $productos->productos_tipo?></option>
                <?php } ?>
            </select>
		</div>
	</div>        
    
        <?php if (sizeof($emision_orden)>0){?>
        <div class="control-group">
		<label class="control-label" for="usuario">Emisión de Orden</label>
		<div class="controls">
                    <a href="<?php echo base_url();?>ordenes/pdf_orden/<?php echo $emision_orden->id_cotizacion."/".$emision_orden->id?>" target="_blank"><img src="<?php echo base_url();?>public/backend/img/pdf.png" alt="PDF Orden de Producción" title="PDF Orden de Producción"></a>
		</div>
	</div>     
        <?php } ?>
        <?php if ($datos->tipo==1) { ?>
        <div class="control-group">
		<label class="control-label" for="usuario">¿Asignar este Producto Como Generico?</label>
		<div class="controls">
                    <select name="asignar" onchange="asignar_producto();">
                        <option value="">Selecciona</option>
                        <option value="SI" <?php if($orden->tipo_entrega=="despachos mensuales"){echo 'selected="true"';}?>>SI</option>
                        <option value="NO" <?php if($orden->tipo_entrega=="despachos bimensuales"){echo 'selected="true"';}?>>NO</option>
                    </select> 		
                </div>
	</div>       
        <?php } ?>        
        
<!--        <div class="control-group" id="combo_cliente" style="display: none;">
                    <label class="control-label" for="usuario">Cliente <strong style="color: red;">(*)</strong></label>
                    <div class="controls">
                        <select name="cliente_nuevo" onchange="BuscarFormaPagoCliente(this.value,'sub_forma_pago');BuscarBuscarVendedorCliente(this.value,'sub_vendedor');" class="chosen-select" style="width: 500px;">
                            <option value="0">Seleccione.....</option>
                            <?php
                            //$clientes=$this->clientes_model->getClientesNormalTodo();
                            //foreach($clientes as $cliente)
                            //{ ?>
                                <option value="<?php //echo $cliente->id?>" <?php //if(isset($_POST["cliente"]) and $_POST["cliente"]==$cliente->id){echo 'selected="true"';}?>><?php //echo $cliente->razon_social?> <?php //if($cliente->estado==2){echo '(BLOQUEADO)';} if($cliente->id_region==0){echo '( Info. Incompleta)';}?></option>
                            <?php //} ?>
                        </select>
                    </div>
        </div>        -->
        
	<div class="control-group">
		<div class="form-actions">
                        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
                        <input type="hidden" name="id_cliente" value="<?php echo $cliente->id?>" />                        
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
</form>

<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.titulo.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas"
	});
</script>
</div>
