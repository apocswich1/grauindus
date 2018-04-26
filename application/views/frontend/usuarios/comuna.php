<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
			<select name="comuna">
                <option value="0">Seleccione</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->id?>"><?php echo $dato->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>