<h3>Cambios de Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<thead>
    <th>Sección</th>
    <th>Glosa</th>
    <th>Responsable</th>
    <th>Fecha</th>
</thead>
<tbody>
    <?php
    foreach($datos as $dato)
    {
        ?>
    <tr>
        <td><?php echo $dato->seccion?></td>
        <td><?php echo $dato->glosa?></td>
        <td><?php echo $dato->nombre?></td>
        <td><?php echo fecha($dato->cuando)?></td>
    </tr>    
        <?php        
    }
    ?>
</tbody>

</table>
