<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
			<select name="ciudad" onchange="carga_ajax('<?php echo base_url();?>usuarios/comuna',this.value,'1','sub_comuna');">
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