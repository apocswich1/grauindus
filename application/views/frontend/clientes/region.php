<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
			<select id="ciudad2" name="ciudad2" onchange="carga_ajax('<?php echo base_url();?>clientes/comuna',this.value,'1','sub_comuna2');">
                <option value="0">Seleccione</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->id?>"<?php echo set_value_select(array(),'ciudad2','ciudad2',$dato->id);?>><?php echo $dato->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>