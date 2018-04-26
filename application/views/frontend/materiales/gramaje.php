	<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
			<select name="gramaje">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->id?>"><?php echo $dato->gramaje?></option>
                    <?php
                }
                ?>
            </select>
		</div>