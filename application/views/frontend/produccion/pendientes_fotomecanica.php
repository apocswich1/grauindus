<h3>Detalle Fotomecánica->Producción de Cotización N° <?php echo number_format($id,0,'','.') ?></h3>
<hr style="width:1000px;" />
<table class="table table-bordered">
<thead>
    <th>Campo</th>
    <th>Valor</th>
    <th>Fecha</th>
    <th>Quién</th>
</thead>
<tr>
<tbody>
    <?php
    if($fotomecanica->revision_trazado=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->revision_trazado_id_usuario);
        ?>
        <tr>
            <td>Revisión trazado</td>
            <td><?php echo $fotomecanica->revision_trazado?></td>
            <td><?php echo fecha($fotomecanica->revision_trazado_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->revision_de_imagen=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->revision_de_imagen_id_usuario);
        ?>
        <tr>
            <td>Revisión Imagen</td>
            <td><?php echo $fotomecanica->revision_de_imagen?></td>
            <td><?php echo fecha($fotomecanica->revision_de_imagen_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->preparacion_de_archivos=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->preparacion_de_archivos_id_usuario);
        ?>
        <tr>
            <td>Revisión Imagen</td>
            <td><?php echo $fotomecanica->preparacion_de_archivos?></td>
            <td><?php echo fecha($fotomecanica->preparacion_de_archivos_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_cliente=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_id_usuario);
        ?>
        <tr>
            <td>Envío VB Cliente</td>
            <td><?php echo $fotomecanica->envio_vb_cliente?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_cliente_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if(!empty($fotomecanica->recepcion_vb_cliente_1))
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_vb_cliente_1_id_usuario);
        ?>
        <tr>
            <td>Comentarios Envío VB Cliente</td>
            <td><?php echo $fotomecanica->recepcion_vb_cliente_1?></td>
            <td><?php echo fecha($fotomecanica->recepcion_vb_cliente_1_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_cliente_2=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_2_id_usuario);
        ?>
        <tr>
            <td>Envío VB Cliente 2</td>
            <td><?php echo $fotomecanica->envio_vb_cliente_2?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_cliente_2_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_cliente_3=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_cliente_3_id_usuario);
        ?>
        <tr>
            <td>Envío VB Cliente 3</td>
            <td><?php echo $fotomecanica->envio_vb_cliente_3?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_cliente_3_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_vendedor=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_id_usuario);
        ?>
        <tr>
            <td>Envío VB Cliente 3</td>
            <td><?php echo $fotomecanica->envio_vb_vendedor?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_vendedor_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if(!empty($fotomecanica->recepcion_vb_vendedor_1))
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_vb_vendedor_1_id_usuario);
        ?>
        <tr>
            <td>Comentarios Envío VB Vendedor</td>
            <td><?php echo $fotomecanica->recepcion_vb_vendedor_1?></td>
            <td><?php echo fecha($fotomecanica->recepcion_vb_vendedor_1_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_vendedor_2=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_2_id_usuario);
        ?>
        <tr>
            <td>Envío VB Vendedor 2</td>
            <td><?php echo $fotomecanica->envio_vb_vendedor_2?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_vendedor_2_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_vendedor_3=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_vendedor_3_id_usuario);
        ?>
        <tr>
            <td>Envío VB Vendedor 3</td>
            <td><?php echo $fotomecanica->envio_vb_vendedor_3?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_vendedor_3_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_maqueta=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_maqueta_id_usuario);
        ?>
        <tr>
            <td>Envío VB Maqueta</td>
            <td><?php echo $fotomecanica->envio_vb_maqueta?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_maqueta_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_color=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_color_id_usuario);
        ?>
        <tr>
            <td>Envío VB Color</td>
            <td><?php echo $fotomecanica->envio_vb_color?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_color_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->envio_vb_estructura=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->envio_vb_estructura_id_usuario);
        ?>
        <tr>
            <td>Envío VB Estructura</td>
            <td><?php echo $fotomecanica->envio_vb_estructura?></td>
            <td><?php echo fecha($fotomecanica->envio_vb_estructura_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->confeccion_de_peliculas=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->confeccion_de_peliculas_id_usuario);
        ?>
        <tr>
            <td>Confección de películas</td>
            <td><?php echo $fotomecanica->confeccion_de_peliculas?></td>
            <td><?php echo fecha($fotomecanica->confeccion_de_peliculas_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->confeccion_de_planchas=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->confeccion_de_planchas_id_usuario);
        ?>
        <tr>
            <td>Confección de planchas</td>
            <td><?php echo $fotomecanica->confeccion_de_planchas?></td>
            <td><?php echo fecha($fotomecanica->confeccion_de_planchas_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->recepcion_parcial=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_parcial_id_usuario);
        ?>
        <tr>
            <td>Recepción parcial</td>
            <td><?php echo $fotomecanica->recepcion_parcial?></td>
            <td><?php echo fecha($fotomecanica->recepcion_parcial_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->recepcion_total=='SI')
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->recepcion_total_id_usuario);
        ?>
        <tr>
            <td>Recepción total</td>
            <td><?php echo $fotomecanica->recepcion_total?></td>
            <td><?php echo fecha($fotomecanica->recepcion_total_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if(!empty($fotomecanica->correcciones))
    {
        $user1=$this->usuarios_model->getUsuariosPorId($fotomecanica->correcciones_id_usuario);
        ?>
        <tr>
            <td>Comentarios</td>
            <td><?php echo $fotomecanica->correcciones?></td>
            <td><?php echo fecha($fotomecanica->correcciones_fecha);?></td>
            <td>Por <strong><?php echo $user1->nombre?></strong></td>     
        </tr>
        <?php
    }
    ?>
    <?php
    if($fotomecanica->entrega_a_fabricacion_a_linea_de_troquel=='SI')
    {
        
        ?>
        <tr>
            <td>Entrega para fabricación de línea de troquel
</td>
            <td><?php echo $fotomecanica->recepcion_total?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>     
        </tr>
        <?php
    }
    ?>
    
</tbody>
</table>