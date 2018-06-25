<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #3092C4 !important">
      <a class="navbar-brand" href="#">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item dropdown" onmouseover="return toggle1('toggle1');"  onmouseout="return toggle2('toggle1');">
               <a class="nav-link dropdown-toggle" href="<?php echo  base_url(); ?>usuarios" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuracion</a>
               <div class="dropdown-menu" aria-labelledby="dropdown05" id="toggle1">
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>variables_cotizador" id="dropdown_ususarios" title="Variables Cotizador">Variables Cotizador</a>
		    <a class="dropdown-item" href="<?php echo  base_url(); ?>finanzas" id="dropdown_ususarios" title="Mantenedor Financiero">Mantenedor Financiero</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>proveedores" id="dropdown_ususarios" title="Proveedores">Proveedores</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>formas_pago" id="dropdown_ususarios" title="Formas de Pago">Formas de Pago</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>unidades_de_uso" id="dropdown_ususarios" title="Unidades de Uso">Unidades de Uso</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>unidades_de_venta" id="dropdown_ususarios" title="Unidades de Venta">Unidades de Venta</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>piezas_adicionales" id="dropdown_ususarios" title="Piezas Adicionales">Piezas Adicionales</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>usuarios" id="dropdown_ususarios" title="Usuarios">Usuarios</a>                                       
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>acabados" id="dropdown_ususarios" title="Acabados">Acabados</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>procesos_especiales" id="dropdown_ususarios" title="Procesos Especiales">Procesos Especiales</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>procesos" id="dropdown_ususarios" title="Procesos de Empresa">Procesos de Empresa</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>moldes" id="dropdown_ususarios" title="Moldes">Moldes</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>rubros" id="dropdown_ususarios" title="Rubros">Rubros</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>datos_tecnicos" id="dropdown_ususarios" title="Datos Técnicos">Datos Técnicos</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>adhesivos" id="dropdown_ususarios" title="Adhesivos">Adhesivos</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>productos" id="dropdown_ususarios" title="Productos">Productos</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>trazados" id="dropdown_ususarios" title="Trazados">Trazados</a>
                    <a class="dropdown-item" href="<?php echo  base_url(); ?>migracion" id="dropdown_ususarios" title="Migraciòn de Datos">Migraciòn de Datos</a>                    
            </div>
          </li>
           <li class="nav-item dropdown" onmouseover="return toggle1('toggle2');"  onmouseout="return toggle2('toggle2');">
            <a class="nav-link dropdown-toggle" href="<?php echo  base_url(); ?>usuarios" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Materiales</a>
            <div class="dropdown-menu" aria-labelledby="dropdown06" id="toggle2">
                <a class="dropdown-item" href="<?php echo base_url(); ?>materiales" id="dropdown_ususarios" title="Tapas y Cartulinas">Tapas y Cartulinas</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>monotapas" id="dropdown_ususarios" title="Monotapas">Monotapas</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>insumos" id="dropdown_ususarios" title="Insumos">Insumos</a>     
            </div>
          </li>
           <li class="nav-item dropdown" onmouseover="return toggle1('toggle3');"  onmouseout="return toggle2('toggle3');">
            <a class="nav-link dropdown-toggle" href="<?php echo  base_url(); ?>usuarios" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trabajo</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07" id="toggle3">
                <a class="dropdown-item" href="<?php echo base_url(); ?>cotizaciones" id="dropdown_ususarios" title="Cotizaciones">Cotizaciones</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>grupos" id="dropdown_ususarios" title="Cotizaciones Grupales">Cotizaciones Grupales</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cotizaciones/solicitan_muestra" id="dropdown_ususarios" title="Solicitan Muestra">Solicitan Muestra</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cotizaciones/buscar2" id="dropdown_ususarios" title="Buscar Cotizaciones">Buscar Cotizaciones</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>cotizaciones/agregar" id="dropdown_ususarios" title="Agregar Cotización por última">Agregar Cotización por última</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>ordenes" id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a>   
            </div>
          </li>
           <li class="nav-item dropdown" onmouseover="return toggle1('toggle4');"  onmouseout="return toggle2('toggle4');">
            <a class="nav-link dropdown-toggle" href="<?php echo  base_url(); ?>usuarios" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mantenedores Produccion</a>
            <div class="dropdown-menu" aria-labelledby="dropdown08" id="toggle4">
                <a class="dropdown-item" href="<?php echo  base_url(); ?>maquinas" id="dropdown_ususarios" title="Máquinas">Máquinas</a>  
            </div>
          </li>
           <li class="nav-item dropdown" onmouseover="return toggle1('toggle5');"  onmouseout="return toggle2('toggle5');">
            <a class="nav-link dropdown-toggle" href="<?php echo  base_url(); ?>usuarios" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produccion</a>
            <div class="dropdown-menu" aria-labelledby="dropdown09" id="toggle5">
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/cotizaciones" id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/cotizaciones_vendedor" id="dropdown_ususarios" title="Listado de Producción por Vendedor">Listado de Producción por Vendedor</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/cotizaciones_cerradas" id="dropdown_ususarios" title="Listado de Producción Cerradas">Listado de Ordenes Cerradas</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_fotomecanica" id="dropdown_ususarios" title="Listado de Programa de Fotomecanica">Listado de Programa de Fotomecanica</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/cotizaciones_cartulina_liberar" id="dropdown_ususarios" title="Listado de Control de Cartulina por Liberar">Listado de Corte Cartulina por Liberar</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/resumen_control_liner" id="dropdown_ususarios" title="RESUMEN CONTROL LINER">Resumen Control Liner</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/resumen_control_onda" 	id="dropdown_ususarios" title="RESUMEN CONTROL ONDA">Resumen Control Onda</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_emplacado" id="dropdown_ususarios" title="Listado de Programa de Corrugado">Listado de Programa de Corrugado</a>          
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_emplacado" id="dropdown_ususarios" title="Listado de Programa de Emplacado">Listado de Programa de Emplacado</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_troquelado" id="dropdown_ususarios" title="Listado de Programa de Troquelado">Listado de Programa de Troquelado</a>
                <a class="dropdown-item" ><i class="confeccion"></i>Listado de Programa de Confeccion de Molde</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_confeccion_revision_sin_liberar_fotomecanica" 	id="dropdown_ususarios">Revision sin liberar fotomecanica			</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_confeccion_revision_liberada_fotomecanica" 		id="dropdown_ususarios">Revision liberada fotomecanica				</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_confeccion_fabricar_sin_liberar_fotomecanica" 	id="dropdown_ususarios">Por fabricar sin liberar fotomecanica </a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_programa_confeccion_fabricar_liberada_fotomecanica" 		id="dropdown_ususarios">Por fabricar liberada fotomecanica		</a>
                <a class="dropdown-item" ><i class="confeccion"></i>Listado Control Cartulina</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_control_cartulina_liberadas" 	 					 id="dropdown_ususarios">Ordenes liberadas		</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_control_cartulina_por_liberar" 				   id="dropdown_ususarios">Ordenes por liberar	</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_control_cartulina_mercaderia_comprada" 	 id="dropdown_ususarios">Mercaderia ya comprada por llegar</a>
                <a class="dropdown-item" ><i class="confeccion"></i>Listado Corte Cartulina</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_corte_cartulina_por_cortar" id="dropdown_ususarios">Por cortar (Activo)</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>produccion/listado_corte_cartulina_ya_cortado" id="dropdown_ususarios">Ya cortado (Liberadas)</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Salir</a>
          </li>
        </ul>
      </div>
    </nav>
<script>
function toggle1(x){
    $("#"+x).show();
}
function toggle2(x){
    $("#"+x).hide();
}
</script>
