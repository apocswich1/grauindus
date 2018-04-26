<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Planchas ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>insumos/add_plancha">Agregar Planchas</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
             <th>Material</th>
     		 <th>Onda</th>
     		 <th>Ancho</th>
     		 <th>Largo</th>
     		 <th>Stock</th>
     		 <th>Código</th>
		                   <?php
              if($this->session->userdata('perfil')==1)
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
    //print_r($datos);
    foreach($datos as $dato)
    {
        if($dato->proveedor_1==0)
        {
            $proveedor1="";
        }else
        {
            $prov_1=$this->proveedores_model->getProveedoresPorId($dato->proveedor_1);  
            $proveedor1=$prov_1->nombre;
        }
          
    ?>
    <tr>
        <td><?php echo $dato->codigo_gramaje ?></td>
        <td><?php echo $dato->onda_id ?></td>
		<td><?php echo $dato->ancho?></td>
		<td><?php echo $dato->largo?></td>
		<td><?php echo $dato->stock?></td>
		<td><?php echo $dato->codigo_plancha?></td>
		<td>
           		<a href="<?php echo base_url()?>insumos/delete_plancha/<?php echo $dato->id_plancha?>/planchas_hechas" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
		
   </tr>
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


