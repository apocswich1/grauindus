<div class="navbar admin-menu">
	<div class="navbar-inner">
		<ul class="nav">
			
<!--
<a class="brand" href="<?php echo  base_url(); ?>" title="Alto Maipo" style="padding:15px 20px 15px;margin-left:-20px;"><img src="<?php echo base_url()?>public/backend/img/home.png" style="width: 35px; height: 35px;" /></a>
-->

	<li class="dropdown <?php echo (in_array($this->router->class, array('clientes','proveedores','formas_pago','usuarios','vendedores','variables_cotizador','servicios','finanzas','unidades_de_venta','Procesos especiales','Acabados')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Configuración <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                    <li><a href="<?php echo  base_url(); ?>vendedores" id="dropdown_ususarios" title="Vendedores">Vendedores</a></li>
					<li><a href="<?php echo  base_url(); ?>clientes" id="dropdown_ususarios" title="Clientes">Clientes</a></li>
                    
					<li><a href="<?php echo  base_url(); ?>variables_cotizador" id="dropdown_ususarios" title="Variables Cotizador">Variables Cotizador</a></li>
					<li><a href="<?php echo  base_url(); ?>finanzas" id="dropdown_ususarios" title="Mantenedor Financiero">Mantenedor Financiero</a></li>
					<li><a href="<?php echo  base_url(); ?>servicios" id="dropdown_ususarios" title="Servicios Internos y Externos">Servicios Internos y Externos</a></li>
                    <li><a href="<?php echo  base_url(); ?>proveedores" id="dropdown_ususarios" title="Proveedores">Proveedores</a></li>
                    <li><a href="<?php echo  base_url(); ?>formas_pago" id="dropdown_ususarios" title="Formas de Pago">Formas de Pago</a></li>
				    <li><a href="<?php echo  base_url(); ?>unidades_de_uso" id="dropdown_ususarios" title="Unidades de Uso">Unidades de Uso</a></li>
                    <li><a href="<?php echo  base_url(); ?>unidades_de_venta" id="dropdown_ususarios" title="Unidades de Venta">Unidades de Venta</a></li>
                    <li><a href="<?php echo  base_url(); ?>piezas_adicionales" id="dropdown_ususarios" title="Piezas Adicionales">Piezas Adicionales</a></li>
                    <li><a href="<?php echo  base_url(); ?>usuarios" id="dropdown_ususarios" title="Usuarios">Usuarios</a></li>
                    
                    
                    <li><a href="<?php echo  base_url(); ?>acabados" id="dropdown_ususarios" title="Acabados">Acabados</a></li>
                    <li><a href="<?php echo  base_url(); ?>procesos_especiales" id="dropdown_ususarios" title="Procesos especiales">Procesos especiales</a></li>
				</ul>
	</li>
	
    <li class="dropdown <?php echo (in_array($this->router->class, array('materiales','insumos','monotapas')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Materiales<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                  
					<li><a href="<?php echo  base_url(); ?>materiales" id="dropdown_ususarios" title="Tapas y Cartulinas">Tapas y Cartulinas</a></li>
                    	<li><a href="<?php echo  base_url(); ?>monotapas" id="dropdown_ususarios" title="Monotapas">Monotapas</a></li>
                    <li><a href="<?php echo  base_url(); ?>insumos" id="dropdown_ususarios" title="Insumos">Insumos</a></li>
                  
				</ul>
	</li>
            
            
	<li class="dropdown <?php echo (in_array($this->router->class, array('ordenes','cotizaciones')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Trabajo hola <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo  base_url(); ?>cotizaciones" id="dropdown_ususarios" title="Cotizaciones">Cotizaciones</a></li>
                    <li><a href="<?php echo  base_url(); ?>ordenes" id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a></li>
                    
				</ul>
	</li>	
            		
   
   
           
		
<ul class="nav pull-right">
			<li class="divider-vertical pull-right"></li>
			<li class=""><a href="<?php echo base_url(); ?>usuarios/logout" title="Salir">Salir</a></li>
		</ul>
</ul>
	</div>
</div>