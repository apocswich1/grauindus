<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Mantenedor Financiero</h3></div>



<div>
	<!--
<a class="btn btn-success pull-left" href="<?php echo base_url()?>finanzas/add">Agregar</a>
-->
    <br /><br />
	<?php //echo $this->layout->element('admin_buscador'); ?>
</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
			<th>Dólar</th>
			<th>Unidad de Fomento ( UF )</th>
            <th>Última Modificación</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $usuario=$this->usuarios_model->getUsuariosPorId($dato->quien);
    ?>
        <td>$<?php echo number_format($dato->dolar,0,"",".")?></td>
        <td>$<?php echo $dato->uf?></td>
        <td>Modificado el <?php echo fecha($dato->cuando)?> por <?php echo $usuario->nombre?></td>
        <td>
               <a href="<?php echo base_url()?>finanzas/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           	<!--
	<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>finanzas/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>
-->	
            </td>
    </tbody>
    <?php
    }
    ?>
</table>
<?php //echo $this->layout->element('admin_paginador'); ?>
