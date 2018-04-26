<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Clientes ( <?php echo $cuantos?> en total)</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onchange="enviaSelect('clientes',this.value);">
                <option value="0">Seleccione.....</option>
                  <option value="1">Todos</option>
                  <option value="2">Activos</option>
                  <option value="3">No Activos</option>
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>clientes/add">Agregar Cliente</a>
    <br /><br />
	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."clientes/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
</div>

<table class="table table-bordered table-striped indice">
	<thead>
	<tr>
            <th>RUT</th>
            <th>E-Mail</th>
            <th>Vendedor</th>
            <th>Razón Social</th>
            <th>Nombre Fantasía</th>
            <th>Cupo Máximo</th>
            <th>Contactos</th>
            <th>Estado</th>
            <th>Productos</th>            
            <th>Fast Track</th>
   	    <th>Fecha Última Actualización</th>
              <?php
              if($this->session->userdata('perfil')==1 or $this->session->userdata('perfil')==2)
              {
                ?>
                <th>Acciones</th>
                <?php
              }
              ?>
	</tr>
	</thead>
	<tbody>
    <?php
    $i=1;
    foreach($datos as $dato)
    {
        $i++;
        $vendedor=$this->usuarios_model->getUsuariosPorId($dato->id_vendedor);
//        $productos_por_cliente=$this->productos_model->getProductosPorClienteVista($dato->id);
//        $productos_por_cliente_genericos=$this->productos_model->getProductos_Genericos_ClientesVista($dato->id);        

//        print_r($productos_por_cliente);
//        $productos_por_cliente=$this->productos_model->getProductosPorClienteVista(1150);        
        
    ?>
    <tr>
    
            <td><?php echo esRut($dato->rut)?></td>
            <td><a href="<?php echo base_url();?>clientes/mensaje/<?php echo $dato->id?>" class="fancybox fancybox.ajax"><?php echo $dato->correo?></a></td>
            <td><?php echo $vendedor->nombre?></td>
	    <td><?php echo $dato->razon_social?></td>
            <td><?php echo $dato->nombre_fantasia?></td>
            <td><?php echo $dato->cupo_maximo?></td>
            <td style="text-align: center;"><a href="<?php echo base_url()?>clientes/contactos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Contactos"><i class="icon-search"></i></td>
            	<!--
<td style="text-align: center;"><a href="<?php echo base_url()?>productos_asociados/clientes/<?php echo $dato->id?>/<?php echo $pagina?>" title="Productos" target="_blank"><i class="icon-barcode"></i></td>
-->
            
            <td style="text-align: center;">
                <?php
                switch($dato->estado)
                {
                    case '0':
                        ?>
                        <span style="color:green;font-weight: bold;">Activo</span>
                        <?php
                    break;
                    case '1':
                        ?>
                        <span style="color:red;font-weight: bold;">No Activo</span>
                        <?php
                    break;
                    case '2':
                        ?>
                        <span style="color:#000000;font-weight: bold;">Bloqueado</span>
                        <?php
                    break;
                }
                ?>
            </td>
            <td style="text-align: center;"> <?php if (count($productos_por_cliente)>0){ ?><a onclick="ver_informacion('producto_<?php echo $i; ?>')"><i class="icon-search"></i><?php } ?> </td> 
            <td style="text-align: center;">
                <?php
                switch($dato->fast)
                {
                    case '1':
                        ?>
                        SI
                        <?php
                    break;
                     case '0':
                        ?>
                        NO
                        <?php
                    break;
                }
                ?>
            </td>
            <td style="text-align: center;">
                <?php
                if($dato->quien>=1)
                {
                    $quien=$this->usuarios_model->getUsuariosPorId($dato->quien);
                    echo "<strong>".$quien->nombre."</strong><br />";
                }
                ?>
                <?php echo $dato->cuando?>
            </td>
            <?php
              if($this->session->userdata('perfil')==1 or $this->session->userdata('perfil')==2)
              {
            ?>
            <td style="text-align: center;">
               <a href="<?php echo base_url()?>clientes/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
	       <?php
                 if($this->session->userdata('perfil')!=2)
                 {
		?>
                    <a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>clientes/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
		<?php
                 }             
		?>
            </td>
            <?php
            }
            ?>
             
            </tr>
            <?php
    }
    ?>
    </tbody>
    
    
    <tr>
        <td colspan="12" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>