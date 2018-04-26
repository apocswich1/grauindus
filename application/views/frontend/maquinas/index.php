<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Máquinas</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Máquinas</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>maquinas/add">Agregar</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			  <th>Nombre</th>
              <th>Descripción</th>
              <th>Tamaño Máximo</th>
              <th>Velocidad</th>
              <th>Tiempo de Postura</th>
              <th>Colores</th>
              <th>Tamaño Mínimo</th>
              <th>Procesos</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       $procesos=$this->maquinas_model->getProcesosPorMaquina($dato->id);
    ?>
           <td><?php echo $dato->nombre?></td>
           <td><?php echo $dato->descripcion?></td>
           <td><?php echo $dato->tamano_maximo?> <hr /> <?php echo $dato->tamano_minimo?></td>
           <td><?php echo $dato->velocidad?></td>
           <td><?php echo $dato->tiempo_de_postura?></td>
           <td><?php echo $dato->colores?></td>
           <td><?php echo $dato->ancho_maximo?> <hr /> <?php echo $dato->ancho_minimo?></td>
           <td style="width: 250px;">
                <ul>
                    <?php
                    foreach($procesos as $proceso)
                    {
                        ?>
                        <li><?php echo $proceso->nombre?></li>
                        <?php
                    }
                    ?>
                </ul>
            </td>
           <td><?php echo fecha($dato->fecha)?></td>
	       <td>
                <?php
                if($dato->estado==0)
                {
                    ?>
                    <span style="color: green;">Activa</span>
                    <?php
                }else
                {
                     ?>
                    <span style="color: red;">No Activa</span>
                    <?php
                }
                ?>
            </td>
            <td>
               <a href="<?php echo base_url()?>maquinas/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>maquinas/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="12" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
