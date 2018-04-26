<h3>Detalle Cotización</h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Dato</th>
    <th>Valor</th>
</tbody>
<tr>
    <td>Descripción</td>
    <td><?php echo $datos->producto?> (<?php if($datos->generico=="1"){echo 'genérico';}?>) </td>
</tr>
<tr>
    <td>Fecha</td>
    <td><?php echo fecha($datos->fecha)?></td>
</tr>

</table>
