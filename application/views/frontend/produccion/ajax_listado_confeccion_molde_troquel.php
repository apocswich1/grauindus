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
			$datos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_confeccion_molde_troquel';
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
<div class="page-header"><h3>Listado de Producción Confeccion Molde Troquel ( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
		prioridad	fecha liberacion fotomecanica	numero orde	cliente	detalle	fecha OP	vendedor	estado
		
              <th>Prioridad</th>
              <th>Fecha Leberacion Fotomecanica</th>
              <th>Número Orden</th>
              <th>Cliente</th>
              <th>Detalle</th>
              <th>Fehca OP</th>           
              <th>Vendedor</th>             
              <th>Total o Parcial</th>             
                      

			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo('1',$dato->id_cotizacion);

		
    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 20px;"><?php echo $fotomecanica->fecha_liberada?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 20px;"><?php echo $dato->razon_social?></td>
         <td style="width: 20px;"><?php echo $dato->descripcion_del_trabajo?></td>
         <td style="width: 20px;"><?php echo $dato->opcuando?></td>
         
		 
		 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
		 <td style="width: 20px;"><?php echo $dato->situacion?></td>
		 

		 
		 
		 

       

       
       
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
				
				<hr />
</div>