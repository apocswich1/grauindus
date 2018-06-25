<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
			<select name="fot_lleva_barniz" style="width: 150px;" onchange="llevaBarnizFotomecanica();">
<!--                <option value="NO" <?php //if($fotomecanica->lleva_barniz=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php //if($fotomecanica->lleva_barniz=="SI"){echo 'selected="selected"';}?>>SI</option>-->
                <option value="Barniz Acuoso Brillante (Standar)" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                <option value="Barniz Acuoso Mate" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                <option value="Barniz Sobre Impresion" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre Impresión</option>                    
                <option value="Laca UV" <?php if($fotomecanica->fot_lleva_barniz=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>                    
                <option value="Nada" <?php if($fotomecanica->fot_lleva_barniz=="Nada"){echo 'selected="selected"';}?>>Nada</option>     
            </select> 
        
		</div>
	</div>
    
    <div class="control-group" id="reserva_barniz" style="display: <?php if($fotomecanica->lleva_barniz=='SI'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Reserva Barniz</label>
		<div class="controls">
			<select name="fot_reserva_barniz" style="width: 150px;">
                <option value="Con Reserva" <?php if($fotomecanica->fot_reserva_barniz=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                <option value="Sin Reserva" <?php if($fotomecanica->fot_reserva_barniz=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
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