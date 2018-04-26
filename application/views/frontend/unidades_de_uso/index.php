<?php if ( $this->session->flashdata('ControllerMessage') != '' ) :  ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Unidades de Uso</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>unidades_de_uso/add">Agregar Unidad de Uso</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Unidad de Compra</th>
			<th>Unidad de Venta</th>
                        <th>Factor de Conversión</th>
                        <th>Unidad de Uso</th>                        
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->unidades_de_compra; ?></td>
        <td><?php echo $dato->unidad_venta; ?></td>
        <td><?php echo $dato->factor_conv; ?></td>
        <td><?php echo $dato->unidad_uso; ?></td>               
			<td>
               <a href="<?php echo base_url()?>unidades_de_uso/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>unidades_de_uso/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
    
</table>
