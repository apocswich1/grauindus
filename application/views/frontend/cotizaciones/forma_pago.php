<label class="control-label" for="usuario" >Forma de Pago <strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="forma_pago">
                <?php
                $formas=$this->clientes_model->getFormasPago();
                foreach($formas as $forma)
                {
                    ?>
                        <option value="<?php echo $forma->id; ?>"<?php if($datos->id_forma_pago==$forma->id ){ echo ' selected'; } ?>><?php echo $forma->forma_pago; ?></option>                
                    <?php
                }
                ?>                    
            </select>
	</div>


