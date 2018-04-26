<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Adhesivos</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Adhesivos</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>adhesivos/add">Agregar Acabado</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		      <th>Nombre</th>
              <th>Código</th>
			  <th>Proveedor 1</th>
              <th>Proveedor 2</th>
		      <th>Precio</th>
              <th>Fecha Compra</th>
              <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $p1=$this->proveedores_model->getProveedoresPorId($dato->proveedor1);
        $p2=$this->proveedores_model->getProveedoresPorId($dato->proveedor2);
    ?>
            <td><?php echo $dato->nombre?></td>
            <td><?php echo $dato->codigo?></td>
            <td><?php echo $p1->nombre;?></td>
			<td><?php echo $p2->nombre;?></td>
            <td>$<?php echo number_format($dato->precio,0,"",".")?></td>
            <td><?php echo fecha($dato->fecha_compra)?></td>
			<td>
               <a href="<?php echo base_url()?>adhesivos/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>adhesivos/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
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
