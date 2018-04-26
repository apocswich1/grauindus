<h3>Detalle</h3>
<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Dato</th>
    <th>Valor</th>
</tbody>
<tr>
    <td>Descripción</td>
    <td><?php echo $datos->material?></td>
</tr>
<tr>
    <td>Código</td>
    <td><?php echo $datos->codigo?></td>
</tr>
<tr>
    <td>Características</td>
    <td><?php echo $datos->caracteristicas?></td>
</tr>
<tr>
    <td>Unidad de Compra</td>
    <td><?php echo $datos->unidad?></td>
</tr>
<tr>
    <td>Unidad de Venta</td>
    <td><?php echo $datos->unidad_de_venta?></td>
</tr>
<tr>
    <td>Precio 1</td>
    <td>$<?php echo number_format($datos->precio1,0,"",".")?></td>
</tr>
<tr>
    <td>Precio 2</td>
    <td>$<?php echo number_format($datos->precio2,0,"",".")?></td>
</tr>
<tr>
    <td>Proveedor 1</td>
    <td>
        <?php
         if($datos->proveedor_1==0)
        {
            $proveedor1="";
        }else
        {
            $prov_1=$this->proveedores_model->getProveedoresPorId($datos->proveedor_1);  
            $proveedor1=$prov_1->nombre;
        }
        echo $proveedor1;
        ?>
    </td>
</tr>
<tr>
    <td>Proveedor 2</td>
    <td>
        <?php
         if($datos->proveedor_2==0)
        {
            $proveedor2="";
        }else
        {
            $prov_2=$this->proveedores_model->getProveedoresPorId($datos->proveedor_2);  
            $proveedor2=$prov_2->nombre;
        }
        echo $proveedor2;
        ?>
    </td>
</tr>
<tr>
    <td>Proveedor 1</td>
    <td>
        <?php
         if($datos->proveedor_3==0)
        {
            $proveedor3="";
        }else
        {
            $prov_3=$this->proveedores_model->getProveedoresPorId($datos->proveedor_3);  
            $proveedor3=$prov_3->nombre;
        }
        echo $proveedor3;
        ?>
    </td>
</tr>
<tr>
    <td>Fecha Última Actualización</td>
    <td><?php echo fecha($datos->fecha_ultima_actualizacion)?></td>
</tr>
</table>