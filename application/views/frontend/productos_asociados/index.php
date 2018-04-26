<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Productos Asociados a Clientes ( <?php echo sizeof($datos)?> en total)</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onclick="enviaClientesProductos(this.value);">
                <option value="0">Seleccione.....</option>
                 <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>productos_asociados/add">Agregar producto</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		    <th>Cliente</th>  
			<th>Producto</th>
		    <th>Descripción</th>  
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $cliente=$this->clientes_model->getClientePorId($dato->id_cliente);
    ?>
        <td><?php echo $cliente->razon_social?></td>
        <td><?php echo $dato->nombre?></td>
			<td><?php echo $dato->descripcion?></td>
			<td>
               <a href="<?php echo base_url()?>productos_asociados/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>productos_asociados/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
    
</table>
