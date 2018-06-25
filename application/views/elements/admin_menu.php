<style>
	.confeccion {
    border: solid rgba(0,0,0,0.7);
    border-width: 0 2px 2px 0;
    float: left;
    margin-left: -15px;
    margin-top: 5px;
    padding: 3px;
    width: 1px;
    height: 1px;
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
    transition: 0.5s;
}
	.dropdown-menu li ul {
		display:none;		
		transition: 0.5s;
		vertical-align: top;
	}
	.dropdown-menu li ul li {		
		float: left;
		width: 100%;
		vertical-align: top;
	}
	.dropdown-menu li ul li:first-child {		
		margin-top: -15px;
	}
	.dropdown-menu li:hover > ul {
		display:inline-block;
		transition: 0.5s;

	}
	.dropdown-menu li:hover a > .confeccion{
		transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transition: 0.5s;
	}
</style>
<div class="navbar admin-menu">
	<div class="navbar-inner">
		<ul class="nav">
			
<!--
<a class="brand" href="<?php echo  base_url(); ?>" title="Alto Maipo" style="padding:15px 20px 15px;margin-left:-20px;"><img src="<?php echo base_url()?>public/backend/img/home.png" style="width: 35px; height: 35px;" /></a>
-->
<?php
if( $this->session->userdata('perfil')==1 or $this->session->userdata('perfil')==2)
{
    ?>
    <li class="dropdown <?php echo (in_array($this->router->class, array('clientes','proveedores','formas_pago','usuarios','vendedores','variables_cotizador','servicios','finanzas','unidades_de_venta','Procesos Epeciales','Acabados')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Configuración <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                  
					<?php
					if( $this->session->userdata('perfil')==1 or $this->session->userdata('perfil')==2)
					{
					?>
					<li><a href="<?php echo  base_url(); ?>clientes" id="dropdown_ususarios" title="Clientes">Clientes</a></li>                   
					<?php
					}
					?>
					
					<?php
					if( $this->session->userdata('perfil')==1 )
					{
					?>	
					<li><a href="<?php echo  base_url(); ?>variables_cotizador" id="dropdown_ususarios" title="Variables Cotizador">Variables Cotizador</a></li>
					<li><a href="<?php echo  base_url(); ?>finanzas" id="dropdown_ususarios" title="Mantenedor Financiero">Mantenedor Financiero</a></li>
                    <li><a href="<?php echo  base_url(); ?>proveedores" id="dropdown_ususarios" title="Proveedores">Proveedores</a></li>
                    <li><a href="<?php echo  base_url(); ?>formas_pago" id="dropdown_ususarios" title="Formas de Pago">Formas de Pago</a></li>
                    <li><a href="<?php echo  base_url(); ?>unidades_de_uso" id="dropdown_ususarios" title="Unidades de Uso">Unidades de Uso</a></li>
                    <li><a href="<?php echo  base_url(); ?>unidades_de_venta" id="dropdown_ususarios" title="Unidades de Venta">Unidades de Venta</a></li>
                    <li><a href="<?php echo  base_url(); ?>piezas_adicionales" id="dropdown_ususarios" title="Piezas Adicionales">Piezas Adicionales</a></li>
                    <li><a href="<?php echo  base_url(); ?>usuarios" id="dropdown_ususarios" title="Usuarios">Usuarios</a></li>                                       
                    <li><a href="<?php echo  base_url(); ?>acabados" id="dropdown_ususarios" title="Acabados">Otros Procesos Externos y Acabados</a></li>
                    <!--<li><a href="<?php //echo  base_url(); ?>procesos_especiales" id="dropdown_ususarios" title="Procesos Especiales">Procesos Especiales</a></li>-->
                    <li><a href="<?php echo  base_url(); ?>procesos" id="dropdown_ususarios" title="Procesos de Empresa">Procesos de Empresa</a></li>
                    <li><a href="<?php echo  base_url(); ?>moldes" id="dropdown_ususarios" title="Moldes">Moldes</a></li>
                    <li><a href="<?php echo  base_url(); ?>rubros" id="dropdown_ususarios" title="Rubros">Rubros</a></li>
                    <li><a href="<?php echo  base_url(); ?>datos_tecnicos" id="dropdown_ususarios" title="Datos Técnicos">Datos Técnicos</a></li>
                    <li><a href="<?php echo  base_url(); ?>adhesivos" id="dropdown_ususarios" title="Adhesivos">Adhesivos</a></li>
                    <li><a href="<?php echo  base_url(); ?>productos" id="dropdown_ususarios" title="Productos">Productos</a></li>
                    <li><a href="<?php echo  base_url(); ?>trazados" id="dropdown_ususarios" title="Trazados">Trazados</a></li>
                    <li><a href="<?php echo  base_url(); ?>migracion" id="dropdown_ususarios" title="Migraciòn de Datos">Migraciòn de Datos</a></li>                    
					<?php
					}
					?>
				</ul>
	</li>
    <?php    
}
?>
 <?php
if( $this->session->userdata('perfil')==1)
{
    ?>
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
            <?php
            }
            ?>
            
            <li class="dropdown <?php echo (in_array($this->router->class, array('ordenes','cotizaciones')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Trabajo <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo  base_url(); ?>cotizaciones" id="dropdown_ususarios" title="Cotizaciones">Cotizaciones</a></li>
					<li><a href="<?php echo  base_url(); ?>grupos" id="dropdown_ususarios" title="Cotizaciones Grupales">Cotizaciones Grupales</a></li>
                    <li><a href="<?php echo  base_url(); ?>cotizaciones/solicitan_muestra" id="dropdown_ususarios" title="Solicitan Muestra">Solicitan Muestra</a></li>
                   <!--
 <li><a href="<?php echo  base_url(); ?>cotizaciones/buscar" id="dropdown_ususarios" title="Buscar Última Cotización">Buscar Última Cotización</a></li>
-->
                    <li><a href="<?php echo  base_url(); ?>cotizaciones/buscar2" id="dropdown_ususarios" title="Buscar Cotizaciones">Buscar Cotizaciones</a></li>
                   <!--
 <li><a href="<?php echo  base_url(); ?>cotizaciones/agregar" id="dropdown_ususarios" title="Agregar Cotización por última">Agregar Cotización por última</a></li>
-->
                    <li><a href="<?php echo  base_url(); ?>ordenes" id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a></li>
					
					
					
					 <?php
						//Usuario 
							if( $this->session->userdata('perfil')!=2)
								{
					  ?>
                    <li><a href="<?php echo  base_url(); ?>fast" id="dropdown_ususarios" title="Fast Track">Fast Track</a></li>
					<?PHP
								}
					?>
					
                   <li><a href="<?php echo  base_url(); ?>productos" id="dropdown_ususarios" title="Productos">Productos</a></li> 
				   <!-- Cotizaciones grupales  (Muebles) -->
				   <li><a href="<?php echo  base_url(); ?>grupos" id="dropdown_ususarios" title="Productos">Cotizaciones Grupales</a></li> 
				</ul>
			</li>
             <?php
if( $this->session->userdata('perfil')==1)
{
    ?>	
            <li class="dropdown <?php echo (in_array($this->router->class, array('maquinas')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Mantenedores Producción <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo  base_url(); ?>maquinas" id="dropdown_ususarios" title="Máquinas">Máquinas</a></li>
				</ul>
			</li>
            <li class="dropdown <?php echo (in_array($this->router->class, array('produccion')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Producción <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo  base_url(); ?>produccion/cotizaciones" 									id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a></li>
					<!--<li><a href="<?php echo  base_url(); ?>produccion/listadoproduccion" id="dropdown_ususarios" title="Listado de Producción">Listado de Producción</a></li>-->
					<li><a href="<?php echo  base_url(); ?>produccion/cotizaciones_vendedor" 					id="dropdown_ususarios" title="Listado de Producción por Vendedor">Listado de Producción por Vendedor</a></li>
					<li><a href="<?php echo  base_url(); ?>produccion/cotizaciones_cerradas" 					id="dropdown_ususarios" title="Listado de Producción Cerradas">Listado de Ordenes Cerradas</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_fotomecanica" 	id="dropdown_ususarios" title="Listado de Programa de Fotomecanica">Listado de Programa de Fotomecanica</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/cotizaciones_cartulina_liberar" id="dropdown_ususarios" title="Listado de Control de Cartulina por Liberar">Listado de Corte Cartulina por Liberar</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/resumen_control_liner" 					id="dropdown_ususarios" title="RESUMEN CONTROL LINER">Resumen Control Liner</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/resumen_control_onda" 					id="dropdown_ususarios" title="RESUMEN CONTROL ONDA">Resumen Control Onda</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_emplacado" 		id="dropdown_ususarios" title="Listado de Programa de Corrugado">Listado de Programa de Corrugado</a></li>          
          <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_emplacado" 		id="dropdown_ususarios" title="Listado de Programa de Emplacado">Listado de Programa de Emplacado</a></li>
          <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_troquelado" 		id="dropdown_ususarios" title="Listado de Programa de Troquelado">Listado de Programa de Troquelado</a></li>
          <li>
          	<a><i class="confeccion"></i>Listado de Programa de Confeccion de Molde</a>
          	<ul>
            	<li><a href="<?php echo  base_url(); ?>produccion/listado_programa_confeccion_revision_sin_liberar_fotomecanica" 	id="dropdown_ususarios">Revision sin liberar fotomecanica			</a></li>
              <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_confeccion_revision_liberada_fotomecanica" 		id="dropdown_ususarios">Revision liberada fotomecanica				</a></li>
              <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_confeccion_fabricar_sin_liberar_fotomecanica" 	id="dropdown_ususarios">Por fabricar sin liberar fotomecanica </a></li>
              <li><a href="<?php echo  base_url(); ?>produccion/listado_programa_confeccion_fabricar_liberada_fotomecanica" 		id="dropdown_ususarios">Por fabricar liberada fotomecanica		</a></li>
	          </ul>
          </li>

          <li>
          	<a><i class="confeccion"></i>Listado Control Cartulina</a>
          	<ul>
            	<li><a href="<?php echo  base_url(); ?>produccion/listado_control_cartulina_liberadas" 	 					 id="dropdown_ususarios">Ordenes liberadas		</a></li>
              <li><a href="<?php echo  base_url(); ?>produccion/listado_control_cartulina_por_liberar" 				   id="dropdown_ususarios">Ordenes por liberar	</a></li>
							<li><a href="<?php echo  base_url(); ?>produccion/listado_control_cartulina_mercaderia_comprada" 	 id="dropdown_ususarios">Mercaderia ya comprada por llegar</a></li>
	          </ul>
          </li>

          <li>
          	<a><i class="confeccion"></i>Listado Corte Cartulina</a>
          	<ul>
            	<li><a href="<?php echo  base_url(); ?>produccion/listado_corte_cartulina_por_cortar" id="dropdown_ususarios">Por cortar (Activo)</a></li>
              <li><a href="<?php echo  base_url(); ?>produccion/listado_corte_cartulina_ya_cortado" id="dropdown_ususarios">Ya cortado (Liberadas)</a></li>
	          </ul>
          </li>

				</ul>
			</li>
            <?php
            }
            ?>    		           
		
<ul class="nav pull-right">
			<li class="divider-vertical pull-right"></li>
			<li class=""><a href="<?php echo base_url(); ?>usuarios/logout" title="Salir">Salir</a></li>
		</ul>
</ul>
	</div>
</div>
