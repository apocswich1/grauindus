<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Insumos ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>insumos/add">Agregar Insumo</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Código</th>
             <th>Material</th>
		      <th>Proveedor 1</th>
              <th>Precio 1</th>
             <th>Detalle</th>
			<th>Fecha Última Actualización</th>
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
        <td><?php echo $dato->codigo?></td>
        <td><?php echo $dato->material?></td>
			<td><?php echo $proveedor1?></td>
            <td>$<?php echo number_format($dato->precio1,0,"",".")?></td>
            
          <td style="text-align: center;">
            <a href="<?php echo base_url()?>insumos/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            <td>
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
              if($this->session->userdata('perfil')==1)
              {
                ?>
			<td>
               <a href="<?php echo base_url()?>insumos/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>insumos/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            <?php
            }
            ?>
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


