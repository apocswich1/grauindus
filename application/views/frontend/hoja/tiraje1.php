<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>
<br />
<h3>Tamaño: <?php echo $ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.' cms' ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
    <hr />
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tiraje 1</label>
		<div class="controls">
			<input type="text" name="tiraje1" value="<?php echo $hoja->tiraje1?>" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
                    <select name="proveedor1" class="chosen-select">
                        <?php foreach ($proveedores as $value) { ?>
                        <option value="<?php echo $value->id; ?>" <?php if($value->id == $hoja->proveedor1){echo 'selected="selected"';} ?>><?php echo $value->nombre; ?></option>
                        <?php } ?>
                    </select>
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Justifique el cambio</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Justificación"></textarea>
		</div>
	</div>

      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos_propia/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>