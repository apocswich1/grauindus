<h3>Reasignar Vendedor en Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    <?php //echo $datos->id_vendedor ?>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedores</label>
		<div class="controls">
			<select name="id_vendedor">
                            <?php
                            foreach ($vendedores as $value) {
                                ?>
                                <option value="<?php echo $value->id ?>" <?php if ($datos->id_vendedor == $value->id) {
                                echo 'selected="selected"';
                            } ?>><?php echo $value->nombre ?></option>
                                <?php
                            }
                            ?>
                
                
            </select>
            <?php //echo $datos->impresion_colores ?>
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Justifique el cambio</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Justificación"></textarea>
		</div>
	</div>
    <hr />
      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos2/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>