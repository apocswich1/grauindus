<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Vendedores ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>vendedores/add">Agregar Vendedor</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Nombre</th>
		      <th>RUT</th>
              <th>E-Mail</th>
              <th>Teléfonos</th>
              <th>Dirección</th>
              <th>Comisión</th>
              <th>Situación Laboral</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->nombre?></td>
		<td><?php echo esRut($dato->rut)?></td>	
        <td><?php echo $dato->correo?></td>
        <td><?php echo $dato->telefono?> - <?php echo $dato->celular?></td>
        <td><?php echo $dato->direccion?>, <?php echo $dato->comuna?>, <?php echo $dato->ciudad?>, <?php echo $dato->region?></td>
        <td><?php echo $dato->comision?>%</td>
        <td><?php echo $dato->situacion_laboral?></td>
			<td>
               <a href="<?php echo base_url()?>vendedores/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>vendedores/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="8" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
