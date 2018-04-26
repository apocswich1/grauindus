<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Formas de Pago ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>formas_pago/add">Agregar Forma de Pago</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Forma de Pago</th>
            <th>Días</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->forma_pago?></td>
			<td><?php echo $dato->dias?></td>
			<td>
               <a href="<?php echo base_url()?>formas_pago/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>formas_pago/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
    
</table>
