<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Listado de Producción Por Proceso</h3></div>

<table>
	<tr>
	<td>
					<div style="text-align: lef;">
					 <div class="control-group">
							<label class="control-label" for="usuario">Filtrar modulo</label>
							<div class="controls">
								<select name="modulo_lista" onchange="validar_listado2(this.value);" id="modulo_lista">
									<option value="0">Seleccione.....</option>
									  <option value="Fotomecanica">Fotomecanica</option>
									  <option value="Listado Control Cartulina">Listado Control Cartulina</option>
									 <!-- <option value="Control Cartulina">Control Cartulina</option> -->
									 <!--<option value="Control Cartulina Estado">Control Cartulina Estado</option>-->
									  <option value="Listado Bobinado Cartulina">Listado Bobinado Cartulina</option>
									  <!--<option value="Bobinado Cartulina">Bobinado Cartulina</option> -->
									  <!--<option value="Bobinado Cartulina Estado">Bobinado Cartulina Estado</option> -->
									  <option value="Listado Control Onda">Listado Control Onda</option>
									  <option value="Control Onda">Control Onda</option>
									  <option value="Control Onda Estado">Control Onda Estado</option>
									  <option value="Bobinado Onda">Bobinado Onda</option>
									  <option value="Bobinado Onda Estado">Bobinado Onda Estado</option>
									  <option value="Listado Control Liner">Listado Control Liner</option>
									  <option value="Control Liner">Control Liner</option>
									  <option value="Control Liner Estado">Control Liner Estado</option>
									  <option value="Bobinado Liner">Bobinado Liner</option>
									  <option value="Bobinado Liner Estado">Bobinado Liner Estado</option>
									  <option value="Confeccion Molde Troquel">Confeccion Molde Troquel</option>
									  <option value="Corte Cartulina">Corte Cartulina</option>
									  <option value="Corte Cartulina Estado">Corte Cartulina Estado</option>
									  <option value="Imprenta Programacion">Imprenta Programacion</option>
									  <option value="Imprenta Produccion">Imprenta Produccion</option>
									  <option value="Imprenta Produccion Estado">Imprenta Produccion Estado</option>
									  <option value="Servicios Post Imprenta">Servicios Post Imprenta</option>
									  <option value="Servicios Post Imprenta Estado">Servicios Post Imprenta Estado</option>
									  <option value="Corrugado">Corrugado</option>
									  <option value="Corrugado Estado">Corrugado Estado</option>
									  <option value="Emplacado">Emplacado</option>
									  <option value="Emplacado Estado">Emplacado Estado</option>
									  <option value="Troquelado">Troquelado </option>
									  <option value="Troquelado Estado">Troquelado Estado</option>
									  <option value="Desgajado">Desgajado</option>
									  <option value="Desgajado Estado">Desgajado Estado</option>
									  <option value="Taller Pegado Externo">Taller Pegado Externo</option>                
									  <option value="Taller Pegado Externo Estado">Taller Pegado Externo Estado</option>                
									  <option value="Pegado">Pegado</option>
									  <option value="Pegado Estado">Pegado Estado</option>
									  <option value="Bodega Ingreso Parciales">Bodega Ingreso Parciales</option>
									  <option value="Bodega Trato pegado">Bodega Trato pegado</option>
									  <option value="Bodega Estado">Bodega Estado</option>
								</select>
							</div>
						</div>
					</div>
					
					<!--
					<div style="text-align: lef;">
						 <div class="control-group">
								<label class="control-label" for="usuario">Filtro por Cliente</label>
								<div class="controls">
									<select name="cliente_lista" onchange="enviaSelect('clientes',this.value);">
										<option value="0">Seleccione.....</option>
										  <option value="1">Fotomecanica</option>
										  <option value="2">aa</option>
										  <option value="3">bb</option>
									</select>
								</div>
							</div>
						</div>

						<div style="text-align: lef;">
						 <div class="control-group">
								<label class="control-label" for="usuario">Filtrar por Estado</label>
								<div class="controls">
									<select name="estado_lista" onchange="enviaSelect('clientes',this.value);">
										<option value="0">Seleccione.....</option>
										  <option value="1">Fotomecanica</option>
										  <option value="2">aa</option>
										  <option value="3">bb</option>
									</select>
								</div>
							</div>
						</div>
						-->
						
						    
					
		</td>	

		<td>
		
		</td>
		
		
		
		
		<td>	
			
				<div  class="control-group">
				 <div class="control-group">
						<label class="control-label" for="usuario"><strong>Numero Orden</strong></label>
						<div class="controls">
									<input type="text" id="nop" name="nop" onchange="validar_listado(this.value);"/>  
						</div>
					</div>
				</div>
			
				
				 <div style="text-align: center; display:none;" id="Buscar_estado1" >
						<label class="control-label" for="usuario"><strong>Estado</strong></label>
						<div class="controls">
						
									<select name="Buscar_estado" id="Buscar_estado" onchange="validar_listado(this.value);">
										<option value="Pendiente">Pendiente</option>
										<option value="Liberada">Liberada</option>
										<option value="Parcial">Parcial</option>
										<option value="Todos">Todos</option>
								    </select>
						</div>
					</div>
				
				
	<div style="text-align: center; display:none;" id="vendedor1" >
		<label class="control-label" for="usuario"><strong>Vendedor</strong></label>
		<div class="controls">
			<select name="vendedor" id="vendedor" onchange="validar_listado(this.value);" >
                    <?php
					$vendedores=$this->usuarios_model->getVendedores();
                    foreach($vendedores as $vendedor)
                    {
                        ?>
                        <option value="<?php echo $vendedor->id?>" <?php if($vendedor->nombre=="OFICINA"){echo 'selected="selected"';}?>  ><?php echo $vendedor->nombre?></option>
                        <?php
                    }
                ?>
				<option value="Todos">Todos</option>
            </select>
		</div>
	</div>
			
			
				<div style="text-align: center; display:none;" id="titulo1" >
				 <div class="control-group">
						<label class="control-label" for="usuario">Filtrar Desde Hasta </label>
						
					</div>
				</div>


				<div style="text-align: center; display:none;" id="desde" >
				 <div class="control-group">
						<label class="control-label" for="usuario"><strong>Desde</strong></label>
						<div class="controls">
									<input type="date" id="fecha1" name="fecha1" value="<?php echo date("Y-m-d")?>" />  
						</div>
					</div>
				</div>


				<div style="text-align: center; display:none;" id="hasta" >
				 <div class="control-group">
						<label class="control-label" for="usuario"><strong>Hasta</strong></label>
						<div class="controls">
									<input type="date" id="fecha2" name="fecha2" value="<?php echo date("Y-m-d")?>" ; />  
						</div>
					</div>
				</div>
				
				
				<div class="control-group" style="display:none;" id="operadores">
							<label class="control-label" for="usuario">Operador</strong></label>
							<div class="controls">
								<select name="operador" id="operador" onchange="validar_fechas_bodega();">
									<option value="Todos">Todos</option>
									<?php
									$usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
									foreach($usuarios as $usuario)
									{
										?>
										<option value="<?php echo $usuario->id?>" <?php if($control->maestro==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
										<?php
									}
									?>
								</select>
							</div>
							</div>
			
		</td>	
		</tr>
		
</table>
<!--
<table>
	<tr>
	<td>


		</td>	
		</tr>
</table>
-->




	 <!--cuerpo_listado--> 
   <div id="cuerpo_listado">


   </div>
   <!--cuerpo_listado--> 





<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});

document.getElementById("fecha1").onchange = function(e){
    document.getElementById("fecha2").focus();
    


</script>