<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Resultados para cotizaciones : <?php echo $buscar?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para cotizaciones : <?php echo $buscar?></h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onchange="enviaSelect('cotizaciones',this.value);">
                <option value="0">Seleccione.....</option>
                <option value="1" <?php if($buscar=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="2" <?php if($buscar=="Repetición con cambios"){echo 'selected="true"';}?>>Repetición con cambios</option>
                <option value="3" <?php if($buscar=="Repetición sin cambios"){echo 'selected="true"';}?>>Repetición sin cambios</option>
                <option value="4" <?php if($buscar=="Producto Genérico"){echo 'selected="true"';}?>>Producto Genérico</option>
                <option value="6" <?php if($buscar=="Cotizaciones Rechazadas"){echo 'selected="true"';}?>>Cotizaciones Rechazadas</option>
                <option value="5" <?php if($buscar==""){echo 'selected="true"';}?>>Todos</option>
                
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>cotizaciones/add">Agregar Solicitud de Cotización</a>
    <br /><br />
<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."cotizaciones/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
            <th>Número</th>
            <th>Fecha solicitud</th>
			<th>Cliente</th>
             <th>Producto</th>
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
        
        
           $archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($dato->id);
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
	   
        <td style="text-align: right; width: 200px;">
            <?php
            if(sizeof($archivo_cliente)==0)
            {
                ?>
                 <a href="<?php echo base_url()?>cotizaciones/archivo_cliente/<?php echo $dato->id?>/<?php echo $pagina?>" title="Agregar Archivo Cliente"><span style="font-size: 10px; ">Archivo Cliente</span><i class="icon-picture"></i></a>
                <?php
            }else
            {
                ?>
                 <a href="<?php echo base_url()?>cotizaciones/edit_archivo_cliente/<?php echo $dato->id?>/<?php echo $archivo_cliente->id?>/<?php echo $pagina?>" title="Ver o Editar Archivo Cliente"><span style="font-size: 10px;color:#ff0000; font-weight: bold;">Archivo Cliente</span><i class="icon-picture"></i></a>
                <?php
            }
            ?>
           <br />
            
            <a href="<?php echo base_url()?>cotizaciones/revision_ingenieria/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería"><span style="font-size: 10px;<?php if(sizeof($ing)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Revisión Ingeniería</span><i class="icon-asterisk"></i></a>	
           <br />
           <a href="<?php echo base_url()?>cotizaciones/revision_fotomecanica/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Fotomecánica"><span style="font-size: 10px;<?php if(sizeof($fotomecanica)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Revisión Fotomecánica</span><i class="icon-film"></i></a>
           <br />
            <?php  $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($dato->id);?>
   <a href="<?php echo base_url()?>cotizaciones/presupuesto/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emisión de Presupuesto"><span style="font-size: 10px;<?php if(sizeof($presupuesto)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Emisión de Presupuesto</span><i class="icon-lock"></i></a>
    <br />
    <?php $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($dato->id);?>
    <a href="<?php echo base_url()?>cotizaciones/impresion_presupuesto/<?php echo $dato->id?>/<?php echo $pagina?>" title="Impresión de Presupuesto"><span style="font-size: 10px;<?php if(sizeof($impresionPresupuesto)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Impresión de Presupuesto</span><i class="icon-road"></i></a>
         <br />
         <?php $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);?>
            <a href="<?php echo base_url()?>cotizaciones/orden_de_compra/<?php echo $dato->id?>/<?php echo $pagina?>" title="Orden de Compra"><span style="font-size: 10px;<?php if(sizeof($orden)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Orden de Compra</span><i class="icon-shopping-cart"></i></a>
            
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
               <a href="<?php echo base_url()?>cotizaciones/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>cotizaciones/eliminar/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
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
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

