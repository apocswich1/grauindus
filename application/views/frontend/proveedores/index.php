<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Proveedores ( <?php echo $cuantos?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>proveedores/add">Agregar Proveedor</a>
    <br /><br />

</div>
<div>
    <br /><br />
	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."proveedores/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
</div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Proveedor</th>
		      <th>Teléfono</th>
              <th>E-Mail</th>
              <th>Rubro 1</th>
              <th>Rubro 2</th>
              <th>Contacto</th>
              <th>Rut</th>
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
	    <td><?php echo $dato->telefono;?></td>
            <td><?php echo $dato->correo;?></td>
            <td><?php echo $dato->rubro;?></td>
            <td><?php echo $dato->rubro2;?></td>
            <td><?php echo $dato->contacto;?></td>
            <td><?php echo $dato->rut;?></td>
			<td>
               <a href="<?php echo base_url()?>proveedores/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>proveedores/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
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
