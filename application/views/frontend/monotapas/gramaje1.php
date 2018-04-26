	<label class="control-label" for="usuario">Gramaje Onda</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo $datos->gramaje?>" placeholder="Gramaje Onda" readonly="readonly" onkeypress="return soloNumeros(event)" />
            <input type="hidden" name="precio_onda" value="<?php echo $datos->precio?>" />
		</div>