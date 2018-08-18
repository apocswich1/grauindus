<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuantos Colores Cambia</label>
		<div class="controls">
			<select name="colores">
                <?php
                
                    $colores=$fotomecanica->numero_color_modificado;
                
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($colores==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
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