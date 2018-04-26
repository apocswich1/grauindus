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
			$datos=$this->produccion_model->getServicioPostImprentaCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getServicioPostImprentaCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_servicios_post_imprenta';
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
// ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,
//ppp.descripcion_trabajo_externo,ppp.tamano_cartulina,ppp.cantidad_de_pliegos,ppp.fecha_recepcion_pedido,ppp.total_o_parcial,
//ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
?>
<div class="page-header"><h3>Listado de Servicios Post Imprenta( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Producto</th>
              <th>Trbajo Externo</th>
              <th>Tamaño cartulina</th>             
              <th>Cantidad Pliegos</th>
			  <th>Fecha Recepcion</th>
			  <th>Total o Parcial</th>
			  <th>Parcial 1</th>
			  <th>Parcial 2</th>
			  <th>Parcial 3</th>
			  
			  <th>Cuando</th>

		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 20px;"><?php echo $dato->descripcion_trabajo_externo?></td>
		 <td style="width: 20px;"><?php echo $dato->tamano_cartulina?></td>
		 <td style="width: 20px;"><?php echo $dato->cantidad_de_pliegos?></td>
		 <td style="width: 20px;"><?php echo $dato->fecha_recepcion_pedido?></td>
		 <td style="width: 20px;"><?php echo $dato->total_o_parcial?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_1?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_2?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_3?></td>
	
		 <td style="width: 20px;"><?php echo $dato->cuando?></td>
		
		 
		 
		 

       

       
       
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