<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
            <th>Número</th>
            <th>Fecha solicitud</th>
			<th>Cliente</th>
             <th>Producto</th>
		      <th>Estado</th>
             <th>Revisión</th>
             <th>Hoja de Costos</th>
             <th>Cotización de Cliente</th>
             <th>Crear OP</th>
              <th>Detalle</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        if($dato->id_cliente==3000)
        {
            $cliente=$dato->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
            $cliente=$cli->razon_social;
        }
         switch($dato->estado)
        {
            case '1':
                $estado="Abierto";
            break;
             case '2':
                $estado="en proceso pendiente ingeniería";
            break;
             case '3':
                $estado="en proceso pendiente fotomecánica";
            break;
             case '4':
                $estado="información ratificada pendiente de cotización";
            break;
             case '5':
                $estado="cotización generada";
            break;
        }
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id);
    ?>
    <tr>
        <td><?php echo $dato->id?></td>
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?></td>
        <td><?php echo $dato->producto?></td>
        <td><?php echo $estado?></td>
	   
        <td>
            <a href="<?php echo base_url()?>cotizaciones/revision_ingenieria/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería"><i class="icon-asterisk"></i></a>	
           <a href="<?php echo base_url()?>cotizaciones/revision_fotomecanica/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Fotomecánica"><i class="icon-film"></i></a>
           
        
   <a href="<?php echo base_url()?>cotizaciones/presupuesto/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emisión de Presupuesto"><i class="icon-lock"></i></a>
<a href="<?php echo base_url()?>cotizaciones/impresion_presupuesto/<?php echo $dato->id?>/<?php echo $pagina?>" title="Impresión de Presupuesto"><i class="icon-road"></i></a>
            
            
        </td>
         <td style="text-align: center;">
            <?php
            if(sizeof($ing)==0 or sizeof($fotomecanica)==0)
            {
                ?>
                <a href="javascript:void(0);" onclick="alert('Debe completar los formularios de Ingeniería y Foto-Mécánica');" title="Hoja de Costos" target="_blank"><i class="icon-file"></i></a>
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>cotizaciones/pdf/<?php echo $dato->id?>" title="Hoja de Costos" target="_blank"><i class="icon-file"></i></a>
                <?php
            }
            ?>
            	
         
         </td>
          <td style="text-align: center;">
            <?php
            if(sizeof($ing)==0 or sizeof($fotomecanica)==0)
            {
                ?>
                <a href="javascript:void(0);" onclick="alert('Debe completar los formularios de Ingeniería y Foto-Mécánica');" title="Cotización de Cliente" target="_blank"><i class="icon-file"></i></a>
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>cotizaciones/cotizacion_de_cliente/<?php echo $dato->id?>" title="Cotización de Cliente" target="_blank"><i class="icon-file"></i></a>
                <?php
            }
            ?>
            	
         
         </td>
         <td style="text-align: center;">
            <?php
            $ordenes=$this->orden_model->getOrdenesPorCotizacion($dato->id);
            if(sizeof($ordenes)==0)
            {
                ?>
               
                <a href="<?php echo base_url()?>ordenes/add/<?php echo $dato->id?>/<?php echo $pagina?>" title="Ingresar Orden de Producción"><i class="icon-cog"></i></a>
                <?php
            }else
            {
                ?>
                <a href="javascript:void(0);" onclick="alert('Ya existe una orden creada para esta cotización');" title="Ingresar Orden de Producción" target="_blank"><i class="icon-cog"></i></a>
                <?php
            }
            ?>
            	
         
         </td>
        <td style="text-align: center;">
            <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            
			<td>
               <a href="<?php echo base_url()?>cotizaciones/edit" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>cotizaciones/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            <?php 
            }
            ?>
    </tbody>
   
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>

