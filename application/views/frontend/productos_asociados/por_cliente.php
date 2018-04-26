<label class="control-label" for="usuario">Producto</label>
		<div class="controls">
			<select name="producto">
                <option value="0">Seleccione......</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->id?>"><?php echo $dato->nombre?></option>
                    <?php
                }
                ?>
                <option value="2000">Otro</option>
            </select>
		</div>