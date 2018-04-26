<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Procesos de Empresa ( <?php echo $cuantos?> en total)</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Procesos de Empresa ( <?php echo $cuantos?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>procesos/add">Agregar</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th>Proceso</th>
		      <th>Descripción</th>
              <th>Precio</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       // debug_backtrace();
    ?>
            <td><?php echo $dato->nombre;?></td>
			<td><?php echo $dato->descripcion;?></td>
            <td><?php echo number_format($dato->precio);?></td>
            
			<td>
               <a href="<?php echo base_url()?>procesos/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>procesos/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="7" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
