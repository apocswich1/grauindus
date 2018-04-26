<h3>Detalle Papeles</h3>
<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Dato</th>
    <th>Valor</th>
</tbody>
<tr>
    <td>Código</td>
    <td><?php echo $datos->codigo?></td>
</tr>
<tr>
    <td>Tipo</td>
    <td><?php echo $datos->materiales_tipo?></td>
</tr>

<tr>
    <td>Proveedor</td>
    <td><?php echo $datos->proveedor?></td>
</tr>
<tr>
    <td>Reverso</td>
    <td><?php echo $datos->reverso?></td>
</tr>
<tr>
    <td>Procedencia</td>
    <td><?php echo $datos->procedencia?></td>
</tr>
<tr>
    <td>Gramaje</td>
    <td><?php echo $datos->gramaje?></td>
</tr>
<tr>
    <td>Ancho</td>
    <td><?php echo $datos->ancho?></td>
</tr>
<tr>
    <td>Peso Kilos</td>
    <td><?php echo $datos->peso_kilos?></td>
</tr>
<tr>
    <td>Valor en Dólares</td>
    <td><?php echo $datos->valor_en_dolares?></td>
</tr>
<tr>
    <td>Características</td>
    <td><?php echo $datos->caracteristicas?></td>
</tr>
<tr>
    <td>Unidad de Compra</td>
    <td><?php echo $datos->unidad_de_compra?></td>
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
    <td>Prov 2</td>
    <td><?php echo $datos->prov_2?></td>
</tr>
<tr>
    <td>Precio 2</td>
    <td>$<?php echo number_format($datos->precio2,0,"",".")?></td>
</tr>
<tr>
    <td>Prov 3</td>
    <td><?php echo $datos->prov_3?></td>
</tr>
<tr>
    <td>Precio 3</td>
    <td>$<?php echo number_format($datos->precio3,0,"",".")?></td>
</tr>
<tr>
    <td>Tipo Onda</td>
    <td><?php echo $datos->tipo_onda?></td>
</tr>
<tr>
    <td>Onda</td>
    <td><?php echo $datos->onda?></td>
</tr>
<tr>
    <td>Liner</td>
    <td><?php echo $datos->liner?></td>
</tr>
</table>