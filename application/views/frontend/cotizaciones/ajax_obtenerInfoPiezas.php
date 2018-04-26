<?php echo $datos->unv." $".$datos->valor_venta;
if($datos->valor_venta<=0){
    echo "<span style='color:red'> No debe usarse esta pieza hasta que no se cambie su valor<span>";
}
?>