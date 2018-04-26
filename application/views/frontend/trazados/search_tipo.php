<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Moldes Grau</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Moldes Grau</h3></div>
<div class="control-group">
	<div class="control-group">
		<label class="control-label" for="usuario">Filtrar Por </label>
		<div class="controls">
		<select name="molde" onchange="enviaSelect('molde_tipo',this.value);">
                 <option value="">Seleccione</option>
                 <option value="Normal">Normal</option>
                 <option value="Generico">Generico</option>
            </select>
            
		</div>
	</div>
</div>  

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>moldes/add">Agregar Molde</a>
    <br /><br />
<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."moldes/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
</div>
<input type="hidden" name="ruta" id="ruta" value="<?php echo base_url();?>">

<table class="table table-bordered table-striped indice" id="DataMolde">
	<thead>
	<tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Cliente 1</th>
                <!--<th>Cliente 2</th>-->
                <th>Tamaño Caja</th>
                <th>Cuchillo/Cuchillo</th>
                <th>Ancho Bobina</th>
                <th>Largo Bobina</th>
                <th>Archivo</th>
                <!--<th>V+</th>-->                
                <th>Estado</th>
                <th>Acciones</th>
        </tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       $cliente=$this->clientes_model->getClientePorId($dato->nombrecliente);
       //$cliente2=$this->clientes_model->getClientePorId($dato->nombrecliente2);
       $historial_archivos=$this->moldes_model->getHistorialArchivosMoldes($dato->id);

       
       
    ?>
            <tr>
            <td><?php echo $dato->numero?></td>
            <td><?php echo $dato->tipo?></td>
            <td><?php echo $dato->nombre?></td>
            <!--<td><?php //echo $dato->razon_social?></td>-->
            <td><?php echo $cliente->razon_social?></td>
            <td><?php echo $dato->tamano_caja?></td>
            <td><?php echo $dato->cuchillocuchillo?> x <?php echo $dato->cuchillocuchillo2?></td>
            <td><?php echo $dato->ancho_bobina?></td>
            <td><?php echo $dato->largo_bobina?></td>
            <td style="text-align: center;">
                <?php
                     if ($dato->archivo!=""){ ?>
                        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$dato->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="Molde Actual" title="Molde Actual"></i></a>
                    <?php } else { ?>    
                        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe archivo PDF del Molde" title="No existe archivo PDF del Molde">
                     <?php }                         
                ?>
               
            </td>
            <?php //   print_r($historial_archivos);  ?>
            <!--<td>  -->   <?php  
                        //foreach($historial_archivos as $historia)    {  
                            ?>
                        <!--<a href='<?php //echo base_url().$this->config->item('direccion_pdf').$historia->archivo; ?>' target="_blank"><img src="<?php //echo base_url()."public/backend/img/"?>pdf.png" alt="Molde  Fecha <?php //echo $historia->fecha; ?>" title="Molde Fecha <?php //echo $historia->fecha; ?>"><?php //echo $historia->fecha; ?></br></a>-->
                   <?php //}  ?>
            <!--</td>  -->          
            <td>
                <?php
                switch($dato->estado)
                {
                    case '0':
                        ?>
                        <span style="font-weight: bold;color:green">Activo</span>
                        <?php
                    break;
                     case '1':
                        ?>
                        <span style="font-weight: bold;color:red">No Activo</span>
                        <?php
                    break;
                }
                ?>
            </td>
			<td>
               <a href="<?php echo base_url()?>moldes/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>moldes/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            
            </tr>
    
    <?php
    }
    ?>
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
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
            
     
        <!--</tbody>
</table>
<script type="text/javascript">

CargarDataMolde();

</script>    -->