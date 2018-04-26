<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Datos Técnicos</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Datos Técnicos</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>datos_tecnicos/add">Agregar</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			  <th>Nombre</th>
			  <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       
    ?>
            <td><?php echo $dato->datos_tecnicos?></td>
			<td>
               <a href="<?php echo base_url()?>datos_tecnicos/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>datos_tecnicos/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     
</table>
