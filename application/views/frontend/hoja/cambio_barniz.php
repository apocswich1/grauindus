<h3>Cambio de Barniz en Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>
<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
                    <select id="fot_lleva_barniz" name="fot_lleva_barniz" style="width: 300px;">
                    <option value="">Seleccione.....</option>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>                    
                                <option value="Barniz Sobre Impresion" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre Impresión</option>                    
                                <option value="Laca UV" <?php if($fotomecanica->fot_lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($fotomecanica->fot_lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($fotomecanica->fot_lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                                
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
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos_propia/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>