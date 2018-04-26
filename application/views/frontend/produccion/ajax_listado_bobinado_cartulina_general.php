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
			$datos=$this->produccion_model->getCCartulinaPendientesConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCCartulinaPendientesConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina';
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
<div class="page-header"><h3>Listado de Producción Bobinado Cartulina ( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
				
             
              <th>Prioridad</th>
              <th>Fecha Liberacion de</th>
              <th>Número Orden</th>
              <th>Cliente</th>
			  <th>Vendedor</th> 
              <th>Detalle</th>
              <th>Fehca OP</th>
              <th>Descripcion de la tapa</th>
              <th>Gramaje</th>
              <th>Ancho</th>                      
              <th>Estado</th> 
              <th>Kilos Pendientes</th> 
			
			           
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		//$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo('1',$dato->id_cotizacion);
		$Bobinado_cartulina=$this->produccion_model->getBobinadoCartulinaPorTipo('1',$dato->id_cotizacion);
		//$Bobinado_cartulina_parcial=$this->produccion_model->getControlCartulinaParcialPorTipo('1',$dato->id_op);
		$Bobinado_cartulina_parcial=$this->produccion_model->getParcialBobinadoCartulina($dato->id_cotizacion);
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id_cotizacion);
		 $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id_cotizacion);
		$tapas=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
		
						  //Foto liberada				Si Cartulina ingresada	
						if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
						{
						?>	
						
						
						
							<?php		
										if(sizeof($nop) >=1 and $dato->id_op == $nop and $Buscar_estado == 'Pendiente' and $dato->id_vendedor == $vendedor)
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero: <strong><?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td> 
								 <td style="width: 20px;"><?php echo $Buscar_estado ?></td>
								 <td style="width: 20px;"><?php echo '0' ?></td>
								 
							<?php
										}
							?>

					
					
							<?php		
										if($nop == null and $Buscar_estado == 'Pendiente' and $dato->id_vendedor == $vendedor)
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
								 <td style="width: 20px;"><?php echo $Buscar_estado ?></td>
								 <td style="width: 20px;"><?php echo '0' ?></td>
								 
							<?php
										}
							?>
							
							

							
					<?php					
						}	
					?>
					
					<?php
					  //Tiene proceso en cartulina: Liberada, Parcial,
					if(sizeof($Bobinado_cartulina) >=1)
						{
					?>		
							
							
							<?php		
										if(sizeof($nop) >=1 and $Bobinado_cartulina->id_nodo == $nop and $Bobinado_cartulina->situacion == $Buscar_estado and $dato->id_vendedor == $vendedor)
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 
								 
								 <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 {
								?>
								<td style="width: 20px;"><?php echo 'C. Cartulina: No Liberada'?></td>
								
								<?php
										 }else{
								?>
							   <td style="width: 20px;"><?php echo 'Control Catulina: '.$Bobinado_cartulina->fecha_liberada?></td>
								<?php
										 }
								?>
								 
								 
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>
								 <td style="width: 20px;"><?php echo $Buscar_estado ?></td>
										 <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 {
										?>
										
								<td style="width: 20px;"><?php echo 'Parcial' ?></td>
										 
										 <?php
										 }
										 ?>
								
										 
							<?php
										}
							?>
							
							
							
							<?php		
										if($nop == null and $Bobinado_cartulina->situacion == $Buscar_estado and $dato->id_vendedor == $vendedor)
										{	
							?>
								<td style="width: 20px;"><?php echo 'Prioridad'?></td>
								
								
								
								<?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 {
								?>
								<td style="width: 20px;"><?php echo 'C. Cartulina: No Liberada'?></td>
								
								<?php
										 }else{
								?>
							   <td style="width: 20px;"><?php echo 'Control Catulina: '.$Bobinado_cartulina->fecha_liberada?></td>
								<?php
										 }
								?>
								
								 
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								  <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>
								 <td style="width: 20px;"><?php echo $Buscar_estado ?></td>
								 
								 
										<?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 {
											 
											 
										?>
										
								<td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }
										 ?>
							   
								 
								 
							<?php
										}
							?>
							
							
							
					
					<?php
						}
					?>
					
					
					
					
					
					
					<!------------------------------------------------------------------------------------------------------------------------------------------->
					
					<?php
					  //TODO
					if($Buscar_estado == 'Todos' or $vendedor == 'Todos')
						{
					?>	
					
					
					
												
							<!--Sin OP, Buscar = Todos , Vendedores =  todos -->
							<?php		
										if($nop == null and $Buscar_estado == 'Todos' and $vendedor == 'Todos')
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>	

								 <?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>
								 
								 
								 <?php
								 if(sizeof($Bobinado_cartulina) >=1)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo $Bobinado_cartulina->situacion ?></td>
								 <?php
									}
								 ?>
								 
								 
								       <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
								 
							<?php
										}
							?>
							
							
							
								<!-- Sin Op, Buscar = Todos , Vendedores =  Vendedor -->
							<?php		
										if($nop == null and $Buscar_estado == 'Todos'  and $vendedor == $dato->id_vendedor)
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
																
								 <?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>
								 							 
								 <?php
								 if(sizeof($Bobinado_cartulina) >=1)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo $Bobinado_cartulina->situacion ?></td>
								 <?php
									}
								 ?>							
								
										<?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
							<?php
										}
							?>
							
							
							
								<!-- Sin Op, Buscar = Pendiente , Vendedores =  Vendedor -->
							<?php		
										if($nop == null and $Buscar_estado == 'Pendiente'  and $vendedor == 'Todos'  and sizeof($Bobinado_cartulina)== 0)
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
																
								 <?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>

									  <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
							<?php
										}
							?>
							
							
							
							
							
								<!-- Sin Op, Buscar = estado , Vendedores =  Todos -->
							<?php		
										if($nop == null and $Buscar_estado == $Bobinado_cartulina->situacion  and $vendedor == 'Todos')
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
								
								<?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>
								 							 
								 <?php
								 if(sizeof($Bobinado_cartulina) >=1)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo $Bobinado_cartulina->situacion ?></td>
								 <?php
									}
								 ?>		
								
								
									 <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
							<?php
										}
							?>
							
							
							
							
							<!-- Con Op, Buscar = Todos , Vendedores =  todos -->
							<?php		
										if($nop == $dato->id_op and $Buscar_estado == 'Todos' and $vendedor == 'Todos')
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
								
								<?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>
								 							 
								 <?php
								 if(sizeof($Bobinado_cartulina) >=1)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo $Bobinado_cartulina->situacion ?></td>
								 <?php
									}
								 ?>		
								
								
										 <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
							<?php
										}
							?>
							
							
							
								<!-- Con Op, Buscar = Estado , Vendedores =  todos -->
							<?php		
										if($nop == $dato->id_op and $Buscar_estado == $Bobinado_cartulina->situacion  and $vendedor == 'Todos')
										{	
							?>
								 <td style="width: 20px;"><?php echo 'Prioridad'?></td>
								 <td style="width: 20px;"><?php echo 'Fotomecanica :'.$dato->fecha_liberada?></td>
								 <td style="width: 20px;">Numero:<strong> <?php echo $dato->id_op?></strong></td>
								 <td style="width: 20px;"><?php echo $dato->razon_social?></td>
								 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
								 <td style="width: 20px;"><?php echo $dato->nombre_producto_normal?></td>
								 <td style="width: 20px;"><?php echo $dato->opcuando?></td>
								 <td style="width: 6000px;"><?php echo $tapas->nombre?></td>
								 <td style="width: 20px;"><?php echo $tapas->gramaje?></td>
								 <td style="width: 20px;"><?php echo $ing->tamano_a_imprimir_1?></td>								 
								 
								 <?php
								 if($dato->estado == 1 and sizeof($Bobinado_cartulina)== 0)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo 'Pendiente' ?></td>
								 <?php
									}
								 ?>
								 							 
								 <?php
								 if(sizeof($Bobinado_cartulina) >=1)
									{
								 ?>	
								 <td style="width: 20px;"><?php echo $Bobinado_cartulina->situacion ?></td>
								 <?php
									}
								 ?>		
								 
								 
										 <?php 
										 if($Bobinado_cartulina->situacion == 'Parcial')
										 { 
										?>
										
								               <td style="width: 20px;"><?php echo $Bobinado_cartulina->total_kilos - $Bobinado_cartulina_parcial->sum ?></td>
										 
										 <?php
										 }else{
										 ?>								 
												<td style="width: 20px;"><?php echo '0' ?></td>
								         <?php
										 }
										 ?>
								 
								 
							<?php
										}
							?>
					
					
						
						
							
					
					<?php
						}
					?>	
					<!------------------------------------------------------------------------------------------------------------------------------------------->

					
					
					
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