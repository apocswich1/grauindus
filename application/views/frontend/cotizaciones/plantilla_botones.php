<?php 
$molde=$this->moldes_model->getMoldesPorId($datos->numero_molde); 
$bloqueo="";
if(sizeof($hoja) > 0 && $hoja->impreso==1){
   $bloqueo='disabled="disabled"';
}
?>

<?php if(sizeof($ing)>0){ ?>
<!--//Funcion-->
<?php  
if($ing->estan_los_moldes == 'NO LLEVA' && $ing->hay_que_troquelar == 'NO'){
    $functiong='onclick="guardarFormularioAdd2(0);"';
    $functionl='onclick="guardarFormularioAdd2(1);"';
}else{
    $functiong='data-target="#comparativa_molde" data-toggle="modal" onclick="comparacion(0);"';
    $functionl='data-target="#comparativa_molde" data-toggle="modal" onclick="comparacion(1);"';
}
?>
<!--//con ingenieria-->    
<input id="guardar" type="button" value="Guardar" class="btn btn-success" <?php echo $functiong; $bloqueo?>/>    
<input id="liberar" type="button" value="Liberar" class="btn btn-warning" <?php echo $functionl; $bloqueo?>/>    
<?php }else{ ?>
<!--//Funcion-->
<?php  
if($datos->estan_los_moldes == 'NO LLEVA' && $datos->hay_que_troquelar == 'NO'){
    $functiong='onclick="guardarFormularioAdd2(0);"';
    $functionl='onclick="guardarFormularioAdd2(1);"';
}else{
    $functiong='data-target="#comparativa_molde" data-toggle="modal" onclick="comparacion(0);"';
    $functionl='data-target="#comparativa_molde" data-toggle="modal" onclick="comparacion(1);"';
}?>
<!--//sin Ingenieria-->
<input id="guardar" type="button" value="Guardar" class="btn btn-success" <?php echo $functiong; $bloqueo?>/>    
<input id="liberar" type="button" value="Liberar" class="btn btn-warning" <?php echo $functionl; $bloqueo?>/>

<?php } ?>