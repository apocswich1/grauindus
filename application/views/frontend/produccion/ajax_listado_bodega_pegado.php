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
			$datos=$this->produccion_model->getPegadoConCotizacionPaginacionPorFecha($pagina,$porpagina,"limit",$desde,$hasta,$operador1);
			$cuantos=$this->produccion_model->getPegadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionPegado';
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




<div class="page-header"><h3>Listado de Producción Pegado por trato( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número</th>
              <th>Número Orden</th>
              <th>Operador</th>
              <th>Cliente</th>
              <th>Descripcion Trabajo</th>
              <th>Fecha</th>
			  <th>Cajas Buenas</th>
			  <th>Costo Pegado</th>
		



              <th>Total parcial</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
	 
	 $operador1 = $dato->nombre;
		//->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando")
    ?>
         <td style="width: 20px;"><?php echo $dato->id_bodega?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
		 <td style="width: 150px;"><?php echo $dato->nombre?></td>
		 <td style="width: 150px;"><?php echo $dato->razon_social?></td>
		 <td style="width: 150px;"><?php echo $dato->descripcion_del_trabajo?></td>
		 <td style="width: 150px;"><?php echo $dato->cuando?></td>
		 <td style="width: 150px;"><?php echo $dato->cantidad_cajas_buenas?></td>
		 
		 <?php $cant_cajas += $dato->cantidad_cajas_buenas;?>
		 
		 <td style="width: 150px;"><?php echo '$ <strong>'.$dato->pegado.'</strong> Pesos'?></td>
		 
		 
		 <?php $total_parcial = $dato->pegado *$dato->cantidad_cajas_buenas;?>
		 <td style="width: 150px;"><?php echo '$ <strong>'.$total_parcial.'</strong> Pesos'?></td>
		 
		 <?php $total_parcial_total += $total_parcial;?>

        
       
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



<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th></th>  
			  <th>Total Cajas</th>
              <th>Total</th>
		</tr>
	</thead>
	<tbody>
         <td style="width: 400px;"></td>
         <td style="width: 20px;"><?php echo $cant_cajas;?></td>        
		 <td style="width: 20px;"><?php echo '$ <strong>'.$total_parcial_total.'</strong> Pesos'?></td>
    </tbody>
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