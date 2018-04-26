  <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Liner</label>
		<div class="controls">
			<input type="text" name="gramaje2" value="<?php echo $datos->gramaje?>" placeholder="Gramaje Liner" required="required" onkeypress="return soloNumeros(event)" readonly="readonly" /><input type="button" value="Calcular Gramaje" title="Calcular Gramaje" onclick="sumaGrameje();" />
            <input type="hidden" name="precio_liner" value="<?php echo $datos->precio?>" />
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Reverso Liner </label>
		<div class="controls">
				<select name="liner">
                <option value="0">Seleccione.....</option>
                <?php
                $b=array("Blanco","Café");
                for($i=0;$i<sizeof($b);$i++)
                {
                    ?>
                    <option value="<?php echo $b[$i]?>" <?php if($datos->reverso==$b[$i]){echo 'selected="selected"';}?> ><?php echo $b[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
   
     
    
     