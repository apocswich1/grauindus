<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>variables_cotizador">Variables Cotizador &gt;&gt;</a></li>
      <li>Agregar Variables Cotizador</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Variables Cotizador</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Materias Primas</label>
		<div class="controls">
			<select name="materias_primas">
                <option value="Varios Papel">Varios Papel</option>
                
                
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Pre Impresión</label>
		<div class="controls">
			<select name="pre_impresion">
                <option value="Arte">Arte</option>
                <option value="Plancha Metal">Plancha Metal</option>
                <option value="Copiado">Copiado</option>
                <option value="Películas">Películas</option>
                <option  value="Montaje">Montaje</option>
            </select>
		</div>
	</div>
    
        <div class="control-group">
		<label class="control-label" for="usuario">Producción</label>
		<div class="controls">
			<select name="produccion">
                <option value="Tiraje Imprenta">Tiraje Imprenta</option>
                <option value="Corte">Corte</option>
                <option value="Emplacado">Emplacado</option>
                <option value="Molde Troquel">Molde Troquel</option>
                <option value="Montaje Molde T">Montaje Molde T</option>
                <option value="Troquelado">Troquelado</option>
                <option value="Troquelado">Desgajado</option>
                <option value="Pegado">Pegado</option>
                <option value="Despacho">Despacho</option>
            </select>
		</div>
	</div>
    
        <div class="control-group">
		<label class="control-label" for="usuario">Costos Varios</label>
		<div class="controls">
			<select name="costos_varios">
                <option value="Costo Venta">Costo Venta</option>
                <option value="Costo Administración">Costo Administración</option>
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
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
</script>
</div>
