<h3>Detalle</h3>
<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Dato</th>
    <th>Valor</th>
</tbody>
<tr>
    <td>Descripción</td>
    <td><?php echo $datos->nombre?></td>
</tr>
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
    <td><?php $procedencia=$this->materiales_model->getMaterialesProcedenciaPorId($datos->id_materiales_procedencia);echo $procedencia->procedencia?></td>
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
    <td>Unidad de Compra</td>
    <!--<td><?php // $u=$this->unidades_de_compra_model->getUnidadesDeCompraPorId($datos->unidad_de_compra);echo $u->unidades_de_compra?></td>-->
    <td><?php $u=$this->unidades_de_uso_model->getUnidadesDeUsoPorId($datos->unidad_de_compra); echo $u->unidad_uso?></td>
</tr>
<tr>
    <td>Precio</td>
    <td>
         <?php 
                    if($datos->divisa=="Pesos")
                    {
                        echo "$".number_format($datos->precio,0,"",".");
                    }else
                    {
                        echo number_format($datos->precio,0,"",".")." USD";
                    }
                    
                ?>
    </td>
</tr>
<tr>
    <td>Fecha Última Actualización</td>
    <td><?php echo fecha($datos->fecha_ultima_actualizacion)?></td>
</tr>
</table>