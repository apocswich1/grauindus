<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Papeles y/o Monotapas ( <?php echo sizeof($datos)?> en total)</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onchange="enviaSelect('materiales',this.value);">
                <option value="0">Seleccione.....</option>
               <?php
               foreach($tipos as $tipo)
               {
                    ?>
                    <option value="<?php echo $tipo->id?>"><?php echo $tipo->materiales_tipo?></option>
                    <?php
               }
               ?>   
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>papeles/add">Agregar Papeles</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Código</th>
             <th>Tipo</th>
		      <th>Material</th>
              <th>Proveedor</th>
             
              <th>Detalle</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->codigo?></td>
        <td><?php echo $dato->materiales_tipo?></td>
			<td><?php echo $dato->nombre?></td>
            <td><?php echo $dato->proveedor?></td>
            
            <td style="text-align: center;">
            <a href="<?php echo base_url()?>papeles/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            
			<td>
               <a href="<?php echo base_url()?>papeles/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>papeles/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

