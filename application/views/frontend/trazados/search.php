<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>moldes">Moldes &gt;&gt;</a></li>
      <li>Resultados para el término <strong><?php echo $buscar?></strong></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para el término <strong><?php echo $buscar?></strong></h3></div>



<div>
	<!--
<a class="btn btn-success pull-left" href="<?php echo base_url()?>moldes/add">Agregar</a>
    <br /><br />
-->
<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."trazados/search", array('class' => 'form-search pull-right')); ?>
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
	      <th>Nombre</th>
              <th>Nombre Cliente</th>
              <th>Tamaño Caja</th>
              <th>Unidades (P/C) por Pliego</th>
              <th>Piezas Totales en el Pliego para Desgajado</th>
              <th>Cuchillo/Cuchillo</th>
              <th>Ancho Bobina</th>
              <th>Largo Bobina</th>
              <th>Fecha</th>
              <th>Archivo</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       $cliente=$this->clientes_model->getClientePorId($dato->nombrecliente);
    ?>
            <td><?php echo $dato->numero?></td>
            <td><?php echo $dato->nombre?></td>
            <td><?php echo $cliente->razon_social?></td>
            <td><?php echo $dato->tamano_caja?></td>
            <td><?php echo $dato->unidades_productos_completos?></td>
            <td><?php echo $dato->piezas_totales?></td>
            <td><?php echo $dato->cuchillocuchillo?></td>
            <td><?php echo $dato->ancho_bobina?></td>
            <td><?php echo $dato->largo_bobina?></td>
            <td><?php echo fecha($dato->fecha)?></td>
            <!--<td style="text-align: center;"><a href="<?php// echo base_url().$this->config->item('direccion_pdf').$dato->archivo; ?>" title="Archivo" target="_blank"><img src="<?php //echo base_url()."public/backend/img/"?>pdf.png" alt="Molde Actual" title="Molde Actual"></a>	</td>-->
             <td style="text-align: center;">
                <?php
                     if ($dato->archivo!=""){ ?>
                        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$dato->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="Molde Actual" title="Molde Actual"></i></a>
                    <?php } else { ?>    
                        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe archivo PDF del Molde" title="No existe archivo PDF del Molde">
                     <?php }                         
                ?>
               
            </td>
            <td>
                <?php
                switch($dato->estado)
                {
                    case '0':
                        ?>
                        <span style="font-weight: bold;color:green">Activo</span>
                        <?php
                    break;
                     case '1':
                        ?>
                        <span style="font-weight: bold;color:red">No Activo</span>
                        <?php
                    break;
                }
                ?>
            </td>
			<td>
               <a href="<?php echo base_url()?>trazados/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>trazados/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="17" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
