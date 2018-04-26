	<div class="control-group">
<hr />
<?php 

 if($this->session->userdata('id'))
        {
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			
			
			
			$cuantosCerrados=$this->produccion_model->getpaguinacionBodegaCerrados();
			
		  // echo $cuantos;
		  // echo  $cuantosCerrados;
		
		    $cuantos = $cuantos - $cuantosCerrados;
			
			$config['base_url'] = base_url().'produccion/listadoproduccionFotomecanica';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
            //$this->layout->view('listadoproduccion',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }

?>
<div class="page-header"><h3>Listado de Producción Fotomecanica( <?php echo sizeof($datos)?> en total)</h3></div>

<table class="table table-bordered table-striped indice">
<tr>
<td>
<div class="page-header"><a href="<?php echo base_url();?>produccion/ListadoFotomecanica/" target="_blank" title="Listar P. Fotomecanica"><img src="<?php echo base_url();?>public/frontend/images/ico-PDF.png">Pendientes - activas </a></div>
</td>
<td>
<div class="page-header"><a href="<?php echo base_url();?>produccion/ListadoFotomecanica/" target="_blank" title="Listar P. Fotomecanica"><img src="<?php echo base_url();?>public/frontend/images/ico-PDF.png">Pendientes - activas prueba</a></div>
</td>
<tr>
 
</table>


<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th>Prioridad</th>
              <th>Número Orden</th>

             
    
              <th>Cliente</th>
              <th>Detallle</th>

			<th>Fecha Emisión</th>
			<th>Vendedor</th>
			<th>Estado</th>



              <th>Imprimir OP</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		
		$bodega=$this->produccion_model->getBodegaPorTipo(1,$dato->id);
		
		
		
			
        $f=$this->clientes_model->getFormasPagoPorId($dato->id_forma_pago);
        $quien=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
		$estadoFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($dato->id);
		
		//if($bodega->estado != '4')
		//{
				?>
					 <td style="width: 20px;">Prioridad</td>
					 <td style="width: 150px;"><?php echo $dato->id_op?></td>

					 
				   
					 <td><?php echo $dato->razon_social?></td>
					 <td><?php echo $dato->nombre_producto_normal?></td>
					 <td><?php echo fecha($dato->fecha)?></td>
					 <td><?php echo $dato->nombre?></td>
					 <td><?php if($estadoFotomecanica->estado == 0){echo 'Activa';}else{echo $estadoFotomecanica->situacion;}?></td>


					<td style="text-align: center;">
					<a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $dato->id?>/<?php echo $dato->id_op?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
					</td> 
				   
				</tbody>
				<?php
		}
	
 //   }
    ?>
	
	   <?php
	   //Fast  track
	   /*
	$fast_track=$this->fast_track_model->getProcesosPorFastTrackFotomecanica('Produccion Fotomecanica');
    foreach($fast_track as $fast_tracks)
    {		
       if($fast_tracks->estado == 1) 
	   {

    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 150px;"><strong><?php echo 'Fast Track N:'.$fast_tracks->id_fast_track?></strong></td>

         
	   
         <td><strong><?php echo $fast_tracks->razon_social?></strong></td>
         <td><strong><?php if($fast_tracks->descripcion == ''){echo 'Sin Detalles en Fast Track';}else{echo $fast_tracks->descripcion;}?></td>
         <td><strong><?php echo fecha($fast_tracks->fecha)?></td>
         <td><strong><?php echo 'Contacto Solicita: '.$fast_tracks->contacto?></td>
         <td><strong><?php if($fast_tracks->estado == 0){echo 'Pendiente';}else{echo 'Liberada';}?></td>


        <td style="text-align: center;">
        
		<a href="<?php echo base_url()?>fast/imprimir/<?php echo $fast_tracks->id_fast_track?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
        </td> 
       <?php
	   }
	   ?>
    </tbody>
    <?php
    }*/
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
				
				<hr />
</div>