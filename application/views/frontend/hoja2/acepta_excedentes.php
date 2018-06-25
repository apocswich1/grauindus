<h3>Acepta Excedentes en Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>
<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
		<select name="acepta_excedentes" style="width: 100px;" onchange="aceptaExcedentes();">
                            <option value="">Seleccione.....</option>
                      <?php  if (sizeof($datos)>0) {   ?>
                            <option value="SI" <?php if($datos->acepta_excedentes=="SI"){echo 'selected="true"';}?>>SI</option>
                            <option value="NO" <?php if($datos->acepta_excedentes=="NO"){echo 'selected="true"';}?>>NO</option>
                      <?php } else {?>                    
                            <option value="SI" <?php if(($_POST["acepta_excedentes"]) && $_POST["acepta_excedentes"]=='SI'){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO" <?php if(($_POST["acepta_excedentes"]) && $_POST["acepta_excedentes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    <?php } ?>                       

                </select> 
            <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span><br>
            <label class="control-label" for="usuario">Valor Excedentes</label><br>
            <input type="input" name="valor_acepeta_exce" value="<?php $hoja->valor_acepeta_exce ?>" />
            <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" />
            
        
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