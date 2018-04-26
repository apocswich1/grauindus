   <?php 
                        if(($ing->archivo!="") && ($ing->tamano_cuchillo_1>0) && ($ing->tamano_cuchillo_2>0)){ ?>  
                        <?php if(sizeof($hoja)>0){ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>" disabled="disabled"  data-toggle="modal" data-target="#comparativa_molde" onclick="comparacion(0);"/>
                        <?php }else{ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>"  data-toggle="modal" data-target="#comparativa_molde" onclick="comparacion(0);"/>
                        <?php }?>  
                        <!--<input type="button" value="Rechazar" class="btn <?php// if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="rechazarFormularioAdd(<?php //echo $id ?>);" />-->
                        <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>"  data-toggle="modal" data-target="#comparativa_molde" onclick="comparacion(1);" />
                    <?php  } else { ?>        
                        <?php if(sizeof($hoja)>0 && $ing->archivo!="" && ($ing->tamano_cuchillo_1>0) && ($ing->tamano_cuchillo_2>0)){ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>" disabled="disabled" data-target="#comparativa_molde"/>
                        <?php }else{ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>"  <?php if($datos->existe_trazado=='SI' && $datos->estan_los_moldes=='NO'){echo "onclick='guardarFormularioAdd2(0);'";}else{echo "data-toggle='modal' onclick='comparacion(0)';"; } ?> data-target="#comparativa_molde"/>
                        <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>"  <?php if($datos->existe_trazado=='SI' && $datos->estan_los_moldes=='NO'){echo "onclick='guardarFormularioAdd2(0);'";}else{echo "data-toggle='modal' onclick='comparacion(1)';"; } ?> data-target="#comparativa_molde" />
                        <?php }?>
                        <?php if($molde->archivo!=""){ ?>  
                        <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>"  <?php if($datos->existe_trazado=='SI' && $datos->estan_los_moldes=='NO'){echo "onclick='guardarFormularioAdd2(0);'";}else{echo "data-toggle='modal' onclick='comparacion(1)';"; } ?> data-target="#comparativa_molde"/>
                    <?php  }} ?>        