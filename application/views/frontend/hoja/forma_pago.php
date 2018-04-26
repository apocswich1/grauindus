<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="forma_pago">
                <option value="0">Seleccione.....</option>
                <?php
                $formas=$this->clientes_model->getFormasPago();
                foreach($formas as $forma)
                {
                    ?>
                    <option value="<?php echo $forma->forma_pago?>"><?php echo $forma->forma_pago?></option>
                    <?php
                }
                ?>
                
            </select>
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
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>