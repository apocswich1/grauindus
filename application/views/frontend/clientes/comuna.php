<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
			<select name="comuna2" id="comuna2">
                <option value="0">Seleccione</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->id?>"<?php echo set_value_select(array(),'comuna2','comuna2',$dato->id);?>><?php echo $dato->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>