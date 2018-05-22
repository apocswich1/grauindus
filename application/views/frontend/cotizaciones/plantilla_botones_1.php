<?php $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde); ?>

    <?php if (($ing->archivo != "") && ($ing->tamano_cuchillo_1 > 0) && ($ing->tamano_cuchillo_2 > 0)) { ?>  
            <input id="guardar" type="button" value="Guardar" class="btn <?php if ($ing->estado == 0) { echo 'btn-warning'; } ?>" <?php if (sizeof($hoja) > 0 && $hoja->impreso==1) {echo 'disabled="disabled"';}else{echo '';} ?>  
            <?php if ($datos->existe_trazado == 'SI' && $datos->estan_los_moldes == 'NO LLEVA') {
            echo "onclick='guardarFormularioAdd2(0);'";    
            } else if($datos->estan_los_moldes == 'NO LLEVA' && $datos->existe_trazado == 'NO'){
            echo "onclick='guardarFormularioAdd2(0);'";    
            }else{ 
            echo "data-toggle='modal' onclick='comparacion(0)';";        
            } ?>
            data-target="#comparativa_molde"/>
            <input  id="liberar" type="button" value="Liberar" <?php  echo $bloquear; ?> class="btn <?php if ($ing->estado == 1) { echo 'btn-warning'; } ?>"                     
            <?php if ($datos->existe_trazado == 'SI' && $datos->estan_los_moldes == 'NO LLEVA') {
            echo "onclick='guardarFormularioAdd2(1);'";    
            } else if($datos->estan_los_moldes == 'NO LLEVA' && $datos->existe_trazado == 'NO'){
            echo "onclick='guardarFormularioAdd2(1);'";    
            }else{ 
            echo "data-toggle='modal' onclick='comparacion(1)';";        
            } ?>
            data-target="#comparativa_molde"/>
            <?php echo $trazadoarchivo; ?>
<?php } else {  ?>        
    <?php if (sizeof($hoja) > 0 && $ing->archivo != "" && ($ing->tamano_cuchillo_1 > 0) && ($ing->tamano_cuchillo_2 > 0)) { ?>  
            <input id="guardar" type="button" value="Guardar" class="btn <?php if ($ing->estado == 0) { echo 'btn-warning'; } ?>" <?php if($hoja->impreso==1){echo 'disabled="disabled"';}?> onclick="alert()" data-target="#comparativa_molde"/>
    <?php } else { ?>  
        <input id="guardar" type="button" value="Guardar" class="btn <?php if ($ing->estado == 0) { echo 'btn-warning'; } ?>" <?php if ($datos->existe_trazado == 'SI' && $datos->estan_los_moldes == 'NO') {
            echo "onclick='guardarFormularioAdd2(0);'";
        } else if((($datos->estan_los_moldes == 'NO LLEVA') || ($datos->estan_los_moldes == 'NO')) && $datos->existe_trazado == 'NO'){
            echo "onclick='guardarFormularioAdd2(0);'";    
            }else{ 
            echo "data-toggle='modal' onclick='comparacion(0)';";        
            } ?> data-target="#comparativa_molde"/>
        <input  id="liberar"  type="button" value="Liberar"  <?php  echo $bloquear; ?> class="btn <?php if ($ing->estado == 1) { echo 'btn-warning'; } ?>"  
            <?php if ($datos->existe_trazado == 'SI' && $datos->estan_los_moldes == 'NO') {
            echo "onclick='guardarFormularioAdd2(1);'";
        } else if((($datos->estan_los_moldes == 'NO LLEVA') || ($datos->estan_los_moldes == 'NO')) && $datos->existe_trazado == 'NO'){
            echo "onclick='guardarFormularioAdd2(1);'";    
            }else{
            echo "data-toggle='modal' onclick='comparacion(1)';";        
            } ?> data-target="#comparativa_molde" />
        <?php echo $trazadoarchivo; ?>
    <?php } ?>
    <?php if ($molde->archivo!="" && $molde->numero!=1 && $molde->numero!=21) { ?>  
        <input id="liberar" type="button" value="Liberar"  <?php  echo $bloquear; ?> class="btn <?php if ($ing->estado == 1) { echo 'btn-warning'; } ?>"  <?php if ($datos->existe_trazado == 'SI' && $datos->estan_los_moldes == 'NO') {
            echo "onclick='guardarFormularioAdd2(0);'";
        } else {
            echo "data-toggle='modal' onclick='comparacion(1)';"; } ?> data-target="#comparativa_molde"/>
        <?php echo $trazadoarchivo; ?>
    <?php } } ?>   
        <input id="liberar" type="button" value="Liberar" class="btn btn-warning" <?php if($datos->numero_molde=="21"){ ?> data-target="" data-toggle='modal' onclick='guardarFormularioAdd2(1);' <?php }else{ ?> data-target="#comparativa_molde" data-toggle='modal' onclick='comparacion(1);<?php } ?>'/>   
        
        
