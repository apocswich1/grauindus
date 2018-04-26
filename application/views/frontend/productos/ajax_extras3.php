<?php ?>
<div class="control-group">
<div class="controls">
    <!--<table border='1' style="text-align: center; width: 1300px">-->
<!--                <tr>
                    <th>Id</th>
                    <th>Ot</th>
                    <th>Ot Migrada</th>
                    <th>Cantidad</th>
                    <th>Precio Migrado</th>
                    <th>Precio Actual</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                </tr>-->
    <?php // foreach ($extras as $key => $value) { $cliente = $value->razon_social;?>
<!--                <tr>
                    <td><?php //echo $value->id ?></td>
                    <td><?php //echo $value->ot ?></td>
                    <td><?php //echo $value->ot_migrada ?></td>
                    <td><?php //echo $value->cantidad_1 ?></td>
                    <td><?php //echo $value->precio_migrado ?></td>
                    <td><?php //echo $value->precio ?></td>
                    <td><?php //echo $value->producto ?></td>
                    <td><?php// echo $value->nombre_producto ?></td>
                    <td><?php// echo $value->fecha ?></td>
                </tr>-->
    <?php// } ?>
            <!--</table>-->
   
    <?php //print_r($cli) //my code is here ?>
    <h4 class="modal-title">Datos Cotizaciones Sistema Viejo Con Productos Registrados </h4><br />
    <table>
        <tr>
            <th>Cliente: </th>
            <th><?php echo $cli->razon_social; ?></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>Nro:<?php echo $idcliente; ?></th>
        </tr>
    </table><br />
    <table border='1' style="text-align: center; font-size: 12px;  width: 1250px">
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Ot</th>
                    <th>Fecha</th>
                    <th>Trabajo</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
    <?php 
 
    if(sizeof($viejos_sin_productos)>0){
    foreach ($viejos_sin_productos as $key => $value) {?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->id_antiguo ?></td>
                    <td><?php echo $value->ot_migrada ?></td>
                    <td><?php echo invertirFecha2($value->fecha) ?></td>
                    <td><?php echo $value->producto ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio_migrado ?></td>
                </tr>
    <?php }}else{
        echo "<tr><td colspan='7'>Este cliente no tiene cotizaciones del sistema viejo con productos</td></tr>";
    } ?>
            </table>
    <br />
        <h4 class="modal-title">Datos Cotizaciones Sistema Viejo Sin Productos Registrados</h4><br />
    <table>
        <tr>
            <th>Cliente: </th>
            <th><?php echo $cli->razon_social; ?></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>Nro:<?php echo $idcliente; ?></th>
        </tr>
    </table><br />
    <table border='1' style="text-align: center; font-size: 12px;  width: 1250px">
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Ot</th>
                    <th>Fecha</th>
                    <th>Trabajo</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
    <?php 
 
    if(sizeof($viejos)>0){
    foreach ($viejos as $key => $value) {?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->id_antiguo ?></td>
                    <td><?php echo $value->ot_migrada ?></td>
                    <td><?php echo invertirFecha2($value->fecha) ?></td>
                    <td><?php echo $value->producto ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio_migrado ?></td>
                </tr>
    <?php }}else{
        echo "<tr><td colspan='7'>Este cliente no tiene cotizaciones del sistema viejo sin productos</td></tr>";
    } ?>
            </table>
    <br />
    <h4 class="modal-title">Datos Cotizaciones Sistema Nuevo</h4><br />
    <table>
        <tr>
            <th>Cliente: </th>
            <th><?php echo $cli->razon_social; ?></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>Nro:<?php echo $idcliente; ?></th>
        </tr>
    </table><br />
    <table border='1' style="text-align: center; font-size: 12px;  width: 1250px">
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Fecha</th>
                    <th>Trabajo</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
     <?php 
 
    if(sizeof($solocotizadas)>0){
    foreach ($solocotizadas as $key => $value) {?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->codigo ?></td>
                    <td><?php echo invertirFecha2($value->fecha) ?></td>
                    <td><?php echo $value->producto ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio ?></td>
                </tr>
    <?php }}else{
        echo "<tr><td colspan='7'>Este cliente no tiene cotizaciones del sistema nuevo</td></tr>";
    } ?>
            </table>
    <br />
    <h4 class="modal-title">Datos Cotizaciones Sistema Nuevo Con OT</h4><br />
    <table>
        <tr>
            <th>Cliente: </th>
            <th><?php echo $cli->razon_social; ?></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>Nro:<?php echo $idcliente; ?></th>
        </tr>
    </table><br />
    <table border='1' style="text-align: center; font-size: 12px;  width: 1250px">
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Ot Migrada</th>
                    <th>Ot</th>
                    <th>Fecha</th>
                    <th>Trabajo</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
     <?php 
 
    if(sizeof($nuevosot)>0){
    foreach ($nuevosot as $key => $value) {?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->codigo ?></td>
                    <td><?php echo $value->ot_migrada ?></td>
                    <td><?php echo $value->ot ?></td>
                    <td><?php echo invertirFecha2($value->fecha) ?></td>
                    <td><?php echo $value->producto ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio ?></td>
                </tr>
    <?php }}else{
        echo "<tr><td colspan='7'>Este cliente no tiene cotizaciones del sistema nuevo</td></tr>";
    } ?>
            </table>
</div>
</div>