<h3>Modificar Producto :  <?php echo $datos->nombre?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    <div class="control-group">
		<label class="control-label" for="usuario">Tipo producto</label>
		<div class="controls">
			<select name="tipo">
                    <?php
                    foreach($tipos as $tipo)
                    {
                        ?>
                        <option value="<?php echo $tipo->id?>" <?php if($tipo->id==$datos->tipo){echo 'selected="selected"';}?>><?php echo $tipo->productos_tipo?></option>
                        <?php
                    }
                    ?>
                    
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Justifique</label>
		<div class="controls">
			<textarea name="glosa"></textarea>
		</div>
	</div>
     
    <hr />
      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."productos/index/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>