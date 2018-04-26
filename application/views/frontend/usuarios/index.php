<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Usuarios</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onclick="enviaSelect('usuarios',this.value);">
                <option value="0">Seleccione.....</option>
                <option value="1">Todos</option>
                 <option value="2">Vendedores</option>
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>usuarios/add">Agregar usuario</a>
    <br /><br />
	<?php //echo $this->layout->element('admin_buscador'); ?>
</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
			<th>Perfil</th>
			<th>RUT</th>
			<th>Nombre</th>
			<th>E-Mail</th>
            <th>Teléfono</th>
            <th>Cargo</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->perfil?></td>
			<td><?php echo esRut($dato->rut)?></td>
            <td><?php echo $dato->nombre?></td>
			<td><a href="<?php echo base_url();?>usuarios/mensaje/<?php echo $dato->id?>" class="fancybox fancybox.ajax"><?php echo $dato->correo?></a></td>
            <td><?php echo $dato->telefono?></td>
            <td><?php echo $dato->cargo?></td>
			<td>
               <a href="<?php echo base_url()?>usuarios/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>usuarios/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
</table>
<?php //echo $this->layout->element('admin_paginador'); ?>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
