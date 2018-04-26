<div>
<div class="control-group" class="<?php echo 'elemento_div'.$id;?>">
		<label class="control-label" for="usuario">Proveedor Parcial <?php echo $id;?></label>
		<div class="controls">
                    <select id="<?php echo 'proveedor'.$id;?>" name="<?php echo 'proveedor'.$id;?>" class="adicional" onchange="llenar_etiquetas_proveedor(this.value,<?php echo $id;?>);">
                        <option value="">Seleccione.....</option>
                <?php
                foreach($datos as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($paquete[$id]["p".$id]==$prove->id){echo 'selected="true"';}?>><?php echo $paquete[$id]["p".$id]; echo $prove->nombre?></option>
                    <?php
                }
                ?>
                    </select>&nbsp;&nbsp;<input disabled="true" numero="<?php echo $id;?>" class="cantidad" id="<?php echo 'cantidad'.$id;?>" type="text" onblur="comprobar_monto(this)" name="<?php echo 'cantidad'.$id;?>" value="0" placeholder="Cantidad a pegar"/>
                    <input type="button" id="<?php echo 'eliminar'.$id;?>" class="btn-primary" name="eliminar" onclick="eliminar_elemento($(this))" value="-" />
		</div>
	</div>
 <div class="<?php echo 'control-group elemento_div'.$id;?>">
     <label class="control-label" for="usuario">Direccion: </label>
     <div class="controls">    
     <label accesskey="" id="<?php echo 'direccion'.$id;?>"></label>
     <input type="hidden" value="0" id="<?php echo 'idireccion'.$id;?>" name="<?php echo 'idireccion'.$id;?>"/>
     </div>
	</div>
 <div class="<?php echo 'control-group elemento_div'.$id;?>">
   <label class="control-label" for="usuario">Horario: </label>
   <input type="hidden"  value="0" id="<?php echo 'ihorario'.$id;?>" name="<?php echo 'ihorario'.$id;?>"/>
     <div class="controls">    
     <label accesskey="" id="<?php echo 'horario'.$id;?>"></label>
     </div>
</div>