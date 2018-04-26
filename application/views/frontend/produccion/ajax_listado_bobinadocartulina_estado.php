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
			$datos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina_estado';
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
// prioridad	fch lib selección cartulina	   numero orde	  cliente	detalle	fecha OP	descrip cartulina	gramaje 	ancho	largo a cortar	cantidad pliegos	kilos	tiene entregas parciales?	vendedor	estado

?>
<div class="page-header"><h3>Listado de Producción Bobinado Cartulina Estado( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
			  
			  <th>Prioridad</th>
			  <th>Fecha Liberacion</th>
			  <th>Número Orden</th>
			  <th>Cliente</th>
			  <th>Detalle</th>
			  <th>Fecha OP</th>
			  <th>Descripcion de la Cartulina</th>
			  <th>Gramaje</th>
			  <th>Ancho</th>   
			  <th>Largo a Cortar</th>   
			  <th>Cantidad Pliego</th>   
			  <th>Kilos Pendientes</th>   
			  <th>Entregas Parciales</th>   
			  <th>Vendedor</th>   
			  <th>Estado</th>   

		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		$control_cartulina=$this->produccion_model->getControlCartulinaPorTipo(1,$dato->id_nodo);
		
   $hayparcial=$this->produccion_model->getParcialBobinadoCartulina($dato->id_nodo);
   
   $hayparcial2=$this->produccion_model->getParcialControlCartulina($dato->id_nodo);
		$pendiente = $control_cartulina->total_kilos - $hayparcial2->sum;
		
	if($dato->estado == 0 or $dato->estado == 3 ){
				if($dato->id_op == $nop)
				{	
		
    ?>
		 <td style="width: 6000px;">Prioridad </td>
		 <td style="width: 20px;"><?php echo $dato->cuando?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
		 <td style="width: 6000px;"><?php echo $dato->razon_social?></td>
		 <td style="width: 6000px;"><?php echo $dato->descripcion_del_trabajo?></td>
		 <td style="width: 20px;"><?php echo $dato->opcuando?></td>	 
         <td style="width: 6000px;"><?php echo $dato->descripcion_cartulina?></td>
		 
		 <td style="width: 20px;"><?php echo $dato->gramaje_seleccionado?></td>
		 <td style="width: 20px;"><?php echo $dato->ancho_a_bobinar?></td>
		 <td style="width: 20px;"><?php echo $dato->medida_final_pliego_a_cortar?></td>
		 <td style="width: 20px;"><?php echo $dato->total_pliegos_para_la_orden?></td>
		 <td style="width: 20px;"><?php echo $pendiente?></td>
		 
		 <td style="width: 20px;"><?php if(sizeof($hayparcial) >= 1){echo 'SI';}else{echo 'NO';}?></td>
		 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
		 <td style="width: 20px;"><?php if($dato->estado == 0){echo 'Abierto';} if($dato->estado == 1){echo 'Liberado';} if($dato->estado == 2){echo 'Rechazado';} if($dato->estado == 3){echo 'Parcial por liberar';} ?></td>
	
		 
		 
		
		 
		 
		 

       

       
       
    </tbody>
    <?php
				}
	}
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
				
				<hr />
</div>