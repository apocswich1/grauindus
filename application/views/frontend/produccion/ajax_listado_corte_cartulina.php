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
			$datos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccioncorte_cartulina';
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
//->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,
//ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado")
?>
<div class="page-header"><h3>Listado de Producción Corte Cartulina( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Producto</th>
              <th>Operador</th>
              <th>Total pliegos a cortar</th>             
              <th>Total Kilo</th>
			  <th>Numero de Tarimas</th>
			  <th>Total pliegos cortados</th>
			  <th>Ancho realmente cortados</th>
			  <th>Largo realmente cortado</th>
			  <th>Parcial 1</th>
			  <th>Parcial 2</th>
			  <th>Parcial 3</th>
			  
			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
//->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,
//ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
		
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 20px;"><?php echo $dato->nombre?></td>
		 <td style="width: 20px;"><?php echo $dato->total_pliegos_a_cortar?></td>
		 <td style="width: 20px;"><?php echo $dato->total_kilos?></td>
		 <td style="width: 20px;"><?php echo $dato->numero_de_tarimas?></td>
		 <td style="width: 20px;"><?php echo $dato->total_pliegos_cortados?></td>
		 <td style="width: 20px;"><?php echo $dato->ancho_realmente_cortado?></td>
		 <td style="width: 20px;"><?php echo $dato->largo_realmente_cortado?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_1?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_2?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_3?></td>
		 
		 
		 

       

       
       
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