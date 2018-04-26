<h3>Detalle Cotización</h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Dato</th>
    <th>Valor</th>
</tbody>
<tr>
    <td>Fecha Ingreso</td>
    <td><?php echo fecha($datos->fecha_ingreso)?></td>
</tr>
<tr>
    <td>Fecha Entrega</td>
    <td><?php echo fecha($datos->fecha_entrega)?></td>
</tr>
<tr>
    <td>Usuario</td>
    <td><?php echo $datos->usuario?></td>
</tr>
<tr>
    <td>Cliente</td>
    <td><?php echo $datos->razon_social?></td>
</tr>

<tr>
    <td>Producto</td>
    <td><?php echo $datos->producto?></td>
</tr>
<tr>
    <td>Número Motivos</td>
    <td><?php echo $datos->numero_motivos?></td>
</tr>
<tr>
    <td>Cantidad Solicitada</td>
    <td><?php echo $datos->cantidad_solicitada?></td>
</tr>
<tr>
    <td>Medidas Extendido</td>
    <td><?php echo $datos->medidas_extendido?></td>
</tr>
<tr>
    <td>Medidas en Plano</td>
    <td><?php echo $datos->medidas_en_plano?></td>
</tr>
<tr>
    <td>Nuevo</td>
    <td>
    <?php
                switch($datos->nuevo)
                {
                    case '0':
                        ?>
                        <span style="color: green; font-weight: bold;">Nuevo</span>
                        <?php
                    break;
                     case '1':
                        ?>
                        <span style="color: #000000; font-weight: bold;">Sin Cambios</span>
                        <?php
                    break;
                     case '2':
                        ?>
                        <span style="color: blue; font-weight: bold;">Con Cambios</span>
                        <?php
                    break;
                }
            ?>
    </td>
</tr>
<tr>
    <td>Piezas Adicionales</td>
    <td><?php echo $datos->piezas_adicionales?></td>
</tr>
<tr>
    <td>Colores</td>
    <td><?php echo $datos->colores?></td>
</tr>

</table>
<h3>Referencia Última Venta</h3>
<table class="table table-bordered">
<tr>
    <td>HC</td>
    <td><?php echo $datos->referencia_hc?></td>
</tr>
<tr>
    <td>OT</td>
    <td><?php echo $datos->referencia_ot?></td>
</tr>
<tr>
    <td>Cantidad</td>
    <td><?php echo $datos->referencia_cantidad?></td>
</tr>
<tr>
    <td>Valor Neto</td>
    <td><?php echo $datos->referencia_valor_neto?></td>
</tr>
<tr>
    <td>Fecha</td>
    <td><?php echo fecha($datos->referencia_fecha)?></td>
</tr>
</table>
<h3>Datos Técnicos</h3>
<table class="table table-bordered">
<tr>
    <td>Corrugado</td>
    <td><?php echo $datos->corrugado?></td>
</tr>
<tr>
    <td>Descripción Materialidad</td>
    <td><?php echo $datos->descripcion_materialidad_1?></td>
</tr>
<tr>
    <td>Acabado Impresión 1</td>
    <td>
        <?php
            switch($datos->acabado_impresion_1)
            {
                case '1':
                    echo "Barniz";
                break;
                 case '2':
                    echo "Lavado UV";
                break;
                 case '3':
                    echo "Barniz";
                break;
            }
        ?>
    </td>
</tr>
<tr>
    <td>Acabado Impresión 2</td>
    <td>
        <?php
            switch($datos->acabado_impresion_2)
            {
                case '1':
                    echo "Brillante";
                break;
                 case '2':
                    echo "Opaco";
                break;
                break;
            }
        ?>
    </td>
</tr>
<tr>
    <td>Acabado Impresión 3</td>
    <td>
        <?php
            switch($datos->acabado_impresion_3)
            {
                case '1':
                    echo "Con Reserva";
                break;
                 case '2':
                    echo "Sin Reserva";
                break;
            }
        ?>
    </td>
</tr>
<tr>
    <td>Envasado de a</td>
    <td><?php echo $datos->envasado_numero?> unidades</td>
</tr>
<tr>
    <td>Envasado en</td>
    <td><?php echo $datos->envasado_tipo?></td>
</tr>
</table>

<?php
$procesos=$this->cotizaciones_model->getProcesosEspecialesPorCotizacion($id);
if(sizeof($procesos)>=1)
{
    ?>
    <h3>Procesos Especiales</h3>
<table class="table table-bordered">
    <?php
    foreach($procesos as $proceso)
    {
        ?>
        <tr>
   
    <td><?php echo $proceso->proceso?></td>
</tr>
        <?php
    }
    ?>
</table>
    <?php
}
?>
<h3>Materiales que entrega el Cliente</h3>
<table class="table table-bordered">
    <tr>
        <td><?php echo $datos->materiales_que_entrega_cliente?></td>
    </tr>
</table>

<h3>Forma de Pago y Costos Comerciales</h3>
<table class="table table-bordered">
<tr>
    <td>Forma de Pago</td>
    <td><?php echo $datos->forma_pago?></td>
</tr>
<tr>
    <td>Comisión Agencia</td>
    <td><?php echo $datos->comision_agencia?></td>
</tr>
</table>
