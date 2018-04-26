<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Rubros ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>rubros/add">Agregar Rubro</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Id</th>
			<th>Rubro</th>
                        <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
			<td><?php echo $dato->id?></td>
                        <td><?php echo $dato->rubro?></td>
			<td>
               <a href="<?php echo base_url()?>rubros/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>rubros/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
    
</table>
