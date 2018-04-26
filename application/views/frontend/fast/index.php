<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Fast Track</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Fast Track</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>fast/add">Agregar</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		      <th>N°</th>
			  <th>Cliente que solicita</th>
              <th>Contacto</th>
              <th>Procesos</th>
		      <th>Cantidad</th>
              <th>Materiales Cliente</th>
              <th>Empresa ejecutante</th>
              <th>Quién Autoriza</th>
              <th>Qué cliente externo es</th>
              <th>Descripción</th>
              <th>Fecha</th>
              <th>Imprimir</th>
              <th>Estado</th>
              <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $procesos=$this->fast_track_model->getProcesosPorFastTrack($dato->id);
        $cliente=$this->clientes_model->getClientePorId($dato->cliente);
        $quien_solicita=$this->clientes_model->getClientePorId($dato->quien_solicita);
        $quien_externo=$this->clientes_model->getClientePorId($dato->quien_externo);
    ?>
           <td><?php echo $dato->id?></td>
           <td><?php echo $cliente->razon_social?></td>
           <td><?php echo $dato->contacto?></td>
           <td>
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
            <td><?php echo $dato->cantidad?></td>
            <td><?php echo $dato->materiales_cliente?></td>
            <td><?php echo $quien_solicita->razon_social?></td>
            <td>
                <?php
                if($dato->estado==1)
                {
                     $quien_autoriza=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
                     echo $quien_autoriza->nombre;
                }else
                {
                   // echo "Pendiente por autorización";
				?>
					
					<div>
					<a class="btn btn-warning pull-left" href="<?php echo base_url()?>fast/autorizar/<?php echo $dato->id ?>">Autorizar</a>
					</div>
					
				<?php
                }
                ?>
            </td>
            <td><?php echo $quien_externo->razon_social?></td>
            <td style="width: 300px;"><div style=" text-align: justify;"><?php echo strip_tags($dato->descripcion,'p')?></div></td>
            <td><?php echo $dato->fecha?></td>
            <td style="text-align: center;">
                <?php
                if($dato->estado==1)
                {
                    ?>
                    <a href="<?php echo base_url()?>fast/imprimir/<?php echo $dato->id?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
                    <?php   
                }else
                {
                    ?>
                    <a href="javascript:void(0);" title="Imprimir" onclick="alert('Este Fast Track debe estar autorizado para poder imprimirse');"><i class="icon-file"></i></a>
                    <?php  
                }
                ?>
                
            </td>
            <td>
            <?php
            switch($dato->estado)
            {
                case '0':
                    ?>
                    <span style="color: red; font-weight: bold;">Pendiente</span>
                    <?php
                break;
                case '1':
                    ?>
                    <span style="color: green; font-weight: bold;">Liberada</span>
                    <?php
                break;
            }
            ?>
            </td>
			<td>
               <a href="<?php echo base_url()?>fast/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>fast/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
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
