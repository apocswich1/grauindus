<h3>Cambio Visto Bueno en Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>
<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<div class="control-group">
		<label class="control-label" for="usuario">Visto Bueno <strong>(VB)</strong> en Maquina</label>
		<div class="controls">
		<select name="vb_maquina" style="width: 100px;" onchange="aceptaExcedentes123();">
                    <option value="">Seleccione.....</option>
                      <?php  if (sizeof($datos)>0) {   ?>
                            <option value="SI" <?php if($datos->vb_maquina=="SI"){echo 'selected="true"';}?>>SI</option>
                            <option value="NO" <?php if($datos->vb_maquina=="NO"){echo 'selected="true"';}?>>NO</option>
                      <?php } else {?>          
                            <option value="SI" <?php if(($_POST["vb_maquina"]) and $_POST["vb_maquina"]=='SI'){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO" <?php if(($_POST["vb_maquina"]) and $_POST["vb_maquina"]=='NO'){echo 'selected="selected"';}?>>NO</option>                            
                    <?php } ?>                       
                </select> 
           <!-- <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span> -->
           <!-- <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" /> -->
            
        
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