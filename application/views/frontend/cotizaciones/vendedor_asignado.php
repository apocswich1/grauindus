        <label class="control-label" for="usuario">Vendedor</label>
            <div class="controls">
		<select name="vendedor">
                    <?php
                    if($this->session->userdata('perfil')==1) { ?>
                        <option value="0">Seleccione.....</option>
                        <?php foreach($vendedores as $vendedor) { ?>
                            <option value="<?php echo $vendedor->id; ?>" <?php if($vendedor->id==$datos->id_vendedor){echo 'selected="selected"';}?>  ><?php echo $vendedor->nombre; ?></option>
                        <?php  } 
                    }else
                    { ?>
                            <option value="<?php echo $this->session->userdata('id')?>"><?php echo $this->session->userdata('nombre')?></option>
                    <?php } ?>
                </select>
            </div>


