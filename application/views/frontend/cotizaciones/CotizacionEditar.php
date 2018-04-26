
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>..:: Control de Gestión - Empresas Grau ::..</title>
		<meta charset="utf-8" />
      	<link rel="shortcut icon" href="http://www.seleccionprofesional.cl/grau/public/backend/img/favicon.ico" />
       <meta name="language" content="Spanish" />
	<meta name="copyright" content="www.marcoarevalo.cl" />
      <meta name="designer" content="Marco Arevalo Zambrano" />
    <meta name="author" content="www.marcoarevalo.cl" />
	
		<link rel="stylesheet" href="http://www.seleccionprofesional.cl/grau/public/backend/css/bootstrap-cerulean.min.css" />
		<link rel="stylesheet" href="http://www.seleccionprofesional.cl/grau/public/frontend/tablebootstrap/dist/bootstrap-table.css" />

		<link rel="stylesheet" href="http://www.seleccionprofesional.cl/grau/public/backend/css/admin.css" />
         <link type="text/css" rel="stylesheet" href="http://www.seleccionprofesional.cl/grau/public/backend/css/calendario.css" />
<link type="text/css" rel="stylesheet" href="http://www.seleccionprofesional.cl/grau/public/backend/fancybox/jquery.fancybox.css" />
 
				<script src="http://www.seleccionprofesional.cl/grau/public/backend/js/jquery-1.8.1.min.js"></script>
        <!--
<script src="http://www.seleccionprofesional.cl/grau/public/backend/js/jquery-ui-1.9.0.custom.min.js"></script>
-->
		<script src="http://www.seleccionprofesional.cl/grau/public/backend/js/bootstrap.min.js"></script>
		<script src="http://www.seleccionprofesional.cl/grau/public/frontend/tablebootstrap/dist/bootstrap-table.js"> </script>
        <script src="http://www.seleccionprofesional.cl/grau/public/backend/js/reloj.js"></script>
         <script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/backend/js/calendar.js"></script>
<script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/backend/js/calendar-setup.js"></script>
<script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/backend/js/calendar-es.js"></script>
<script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/backend/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/frontend/js/dar_formato.js"></script>
<script type="text/javascript" src="http://www.seleccionprofesional.cl/grau/public/backend/fancybox/jquery.fancybox.js"></script>
 
        <script src="http://www.seleccionprofesional.cl/grau/public/frontend/js/funciones.js"></script>
         


		<!--[if IE 7]>
			<script src="http://www.seleccionprofesional.cl/grau/public/backend/js/backend/admin-ie7.js"></script>
		<![endif]-->		
		<script type="text/javascript">var webroot = 'http://www.seleccionprofesional.cl/grau/';</script>
		 
        	<script type="text/javascript">
			$(document).ready(function(){
				    $("#padre .input-xlarge").click(function (e) {
                		alert($(this).parent());
            		});
					
					
				
			});
			 jQuery(document).ready
                (
                    function()
                    {
                        muestraReloj();
                    }
                );
		</script>
                
                
                
                
    <!--            
                
       <style type = "text/css">       
        #a{
           border: 10px;
           background-color: #FF0000 !important;
        }
       </style>
                
     -->           
                
	</head>
	<body>
		<div class="container" id="contenedor">
            
	
<div class="page-header">
       <a class="logo" href="http://www.seleccionprofesional.cl/grau/" title="Empresas Grau"><img src="http://www.seleccionprofesional.cl/grau/public/backend/img/logo_grau.png" width="150" height="50" /></a>
      </div>
                 <p>
        <h5 style="text-align: right;">
        <span>Lunes 23 de Marzo del 2015</span> || <span id="spanreloj"></span> || 
                                Bienvenid@ <span class="label label-info">Enrique Grau</span>
                      <!--
 <a href="http://www.seleccionprofesional.cl/grau/backend/usuarios/logout" title="Cerrar Sesión"><i class="icon-off"></i></a>
-->
                                   
        </h5>
    </p>
	<div class="navbar admin-menu">
	<div class="navbar-inner">
		<ul class="nav">
			
<!--
<a class="brand" href="http://www.seleccionprofesional.cl/grau/" title="Alto Maipo" style="padding:15px 20px 15px;margin-left:-20px;"><img src="http://www.seleccionprofesional.cl/grau/public/backend/img/home.png" style="width: 35px; height: 35px;" /></a>
-->

 <li class="dropdown ">
				<a class="dropdown-toggle" data-toggle="dropdown" href="http://www.seleccionprofesional.cl/grau/usuarios">
					Configuración <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                    <li><a href="http://www.seleccionprofesional.cl/grau/vendedores" id="dropdown_ususarios" title="Vendedores">Vendedores</a></li>
					<li><a href="http://www.seleccionprofesional.cl/grau/clientes" id="dropdown_ususarios" title="Clientes">Clientes</a></li>
                    
<li><a href="http://www.seleccionprofesional.cl/grau/variables_cotizador" id="dropdown_ususarios" title="Variables Cotizador">Variables Cotizador</a></li>
<li><a href="http://www.seleccionprofesional.cl/grau/finanzas" id="dropdown_ususarios" title="Mantenedor Financiero">Mantenedor Financiero</a></li>
<li><a href="http://www.seleccionprofesional.cl/grau/servicios" id="dropdown_ususarios" title="Servicios Internos y Externos">Servicios Internos y Externos</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/proveedores" id="dropdown_ususarios" title="Proveedores">Proveedores</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/formas_pago" id="dropdown_ususarios" title="Formas de Pago">Formas de Pago</a></li>
				    <li><a href="http://www.seleccionprofesional.cl/grau/unidades_de_uso" id="dropdown_ususarios" title="Unidades de Uso">Unidades de Uso</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/unidades_de_venta" id="dropdown_ususarios" title="Unidades de Venta">Unidades de Venta</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/piezas_adicionales" id="dropdown_ususarios" title="Piezas Adicionales">Piezas Adicionales</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/usuarios" id="dropdown_ususarios" title="Usuarios">Usuarios</a></li>
                    
                    
                    <li><a href="http://www.seleccionprofesional.cl/grau/acabados" id="dropdown_ususarios" title="Acabados">Acabados</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/procesos_especiales" id="dropdown_ususarios" title="Procesos especiales">Procesos especiales</a></li>
				</ul>
			</li>
            <li class="dropdown ">
				<a class="dropdown-toggle" data-toggle="dropdown" href="http://www.seleccionprofesional.cl/grau/usuarios">
					Materiales<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                  
					<li><a href="http://www.seleccionprofesional.cl/grau/materiales" id="dropdown_ususarios" title="Tapas y Cartulinas">Tapas y Cartulinas</a></li>
                    	<li><a href="http://www.seleccionprofesional.cl/grau/monotapas" id="dropdown_ususarios" title="Monotapas">Monotapas</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/insumos" id="dropdown_ususarios" title="Insumos">Insumos</a></li>
                  
				</ul>
			</li>
            
            
<li class="dropdown active">
				<a class="dropdown-toggle" data-toggle="dropdown" href="http://www.seleccionprofesional.cl/grau/usuarios">
					Trabajo <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="http://www.seleccionprofesional.cl/grau/cotizaciones" id="dropdown_ususarios" title="Cotizaciones">Cotizaciones</a></li>
                    <li><a href="http://www.seleccionprofesional.cl/grau/ordenes" id="dropdown_ususarios" title="Órdenes de Producción">Órdenes de Producción</a></li>
                    
				</ul>
			</li>	
            		
   
   
           
		
<ul class="nav pull-right">
			<li class="divider-vertical pull-right"></li>
			<li class=""><a href="http://www.seleccionprofesional.cl/grau/usuarios/logout" title="Salir">Salir</a></li>
		</ul>
</ul>
	</div>
</div>
   
    <div id="contenidos">
			
<script>
  function  fn_cb_totalOparcial()  
{
    //debugger;
       var cb = $("#tota_o_parcial");
       var valor = cb.val();
        var total1=$("#can1").val();
        var total2=$("#can2").val();
        var total3=$("#can3").val();
        var total4=$("#can4").val();
         
       if(valor == "Total"){
         //  $("#lblCantidadesTotalParcial").css("display","none");
           $("#can_despacho1").val(total1);
         //  $("#can_despacho_2").val(total2);
         //  $("#can_despacho_3").val(total3);
           $("#cantidadesDespacho").css("display","none");
         //  $("#can_despacho_2").css("display","none");
          // $("#can_despacho_3").css("display","none");
           
       }
       else
       {
            $("#cantidadesDespacho").css("display","block");
       }
   }
   
   function copiaDirecionAdespachoCliente()
   {
       debugger;
       var regionDir = $("#regionDir");
       var valRegionDir = regionDir.val();

       var ciudadDir = $("#ciudadDir");
       var valCiudadDir = ciudadDir.val();
       
       var comunaDir = $("#comunaDir");
       var valComunaDir = comunaDir.val();
       
       var direccion = $("#dir");
       var valDireccion = direccion.val();
      
       var regionDesp = $("#regionDesp");
       regionDesp.val(valRegionDir);

       var ciudadDesp = $("#ciudadDesp");
       ciudadDesp.val(valCiudadDir);
       
       var comunaDesp = $("#comunaDesp");
       comunaDesp.val(valComunaDir);
       
       var dirDesp = $("#dirDesp");
       dirDesp.val(direccion);
  
     
       
   }
</script>
 <div id="TablaClientes" style="position:absolute;top:380px;left:800px;width:320px;border:1px solid;display:none">
 
 </div>
<div id="ventanaClientes">
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Clientes</h4>
		  </div>
		  <div class="modal-body">
				<div class="alert alert-success" id="events-result"></div>
				<table id="table-javascript"></table>			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<!-- <button type="button" class="btn btn-primary">Aceptar</button> -->
		  </div>
		</div>
	  </div>
	</div>
</div>

<div id="contenidos">

<script>
 
 //codigo 1
			// <select name="cliente" onchange="carga_ajax3('http://www.seleccionprofesional.cl/grau/cotizaciones/ultimas_referencias',this.value,'1','referencia');">
              
                 // <option value="3000">Otro</option>
                //                     // <option value=""></option>
                    //                
            // </select> 
 //--codigo 1
 
function nextOnEnter(obj,e){
    e = e || event;
    // we are storing all input fields with tabindex attribute in 
    // a 'static' field of this function using the external function
    // getTabbableFields
    nextOnEnter.fields = nextOnEnter.fields || getTabbableFields();
    if (e.keyCode === 13) {
        // first, prevent default behavior for enter key (submit)
        if (e.preventDefault){
            e.preventDefault();
        } else if (e.stopPropagation){    
          e.stopPropagation();
        } else {   
          e.returnValue = false;
        }
       // determine current tabindex
       var tabi = parseInt(obj.getAttribute('tabindex'),10);
       // focus to next tabindex in line
       if ( tabi+1 < nextOnEnter.fields.length ){
         nextOnEnter.fields[tabi+1].focus();
        }
    }
}

// returns an array containing all input text/submit fields with a
// tabindex attribute, in the order of the tabindex values
function getTabbableFields(){
    var ret = [],
        inpts = document.getElementsByTagName('input'), 
        i = inpts.length;
    while (i--){
        var tabi = parseInt(inpts[i].getAttribute('tabindex'),10),
            txtType = inpts[i].getAttribute('type');
            // [txtType] could be used to filter out input fields that you
            // don't want to be 'tabbable'
            ret[tabi] = inpts[i];
    }
    return ret;
}

function verificaCampos()
{
	var producto = $("#producto").val();
	var prod2=$("#producto2").val();
	if(prod2!="")
	{
		producto = $("#producto2").val();
	}
	var can1 = $("#can1").val();
	var can2 = $("#can2").val();
	var can3 = $("#can3").val();
	var can4 = $("#can4").val();
	var comentMedidas = $("#obs").val();
	var intrPagado = $("#pegado_instrucciones").val();
	var comPiezAdic = $("#comentario_piezas_adicionales").val();
	var cantidad_especifica = $("#cantidad_especifica").val();
	var can_despacho_1 = $("#can_despacho_1").val();
	var can_despacho_2 = $("#can_despacho_2").val();
	var can_despacho_3 = $("#can_despacho_3").val();
	var costo_comercial = $("#costo_comercial").val();
	
	var campos = (can1!="") && (can2!="") && (can3!="") && (can4!="") && (producto!="") && (comentMedidas!="");
	campos=campos && (intrPagado!="") && (comPiezAdic!="") && (cantidad_especifica!="") && (can_despacho_1!="");
	campos=campos && (can_despacho_2!="") && (can_despacho_3!="") && (costo_comercial!="");
	
	var cliente = $("#cliente").val();
	var nombreCliente = $("#nombre_cliente").val();
	
	if(cliente == "Otro")
	var campos = (can1!="") && (can2!="") && (can3!="") && (can4!="") && (producto!="") && (comentMedidas!="");
	campos=campos && (intrPagado!="") && (comPiezAdic!="") && (cantidad_especifica!="") && (can_despacho_1!="");
	campos=campos && (can_despacho_2!="") && (can_despacho_3!="") && (costo_comercial!="") && (nombreCliente!="");
	//	var campos = can1+can2+can3+can4+producto+comentMedidas+intrPagado+comPiezAdic+cantidad_especifica+can_despacho_1+can_despacho_2+can_despacho_3+costo_comercial+nombreCliente;
	
	if(!campos){
	  // alert("Hay campos vacios");
	   return false;
	}else
	{
	if(confirm("Generar Solicitud de Cotizacion?")){
		form.submit();
	}
	}
}
 
 function codificaNuevo()
 {
	var txt=document.getElementById("link");
	
	if (txt.length>0){
	
		$("#cliente").val("3000");

	}
 }
</script>
<?php $this->layout->element('admin_mensaje_validacion'); ?>

<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Solicitud de Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Solicitud de Cotización</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" onchange="carga_ajax3('<?php echo base_url();?>cotizaciones/ultimas_referencias',this.value,'1','referencia');">
              
                 <option value="3000">Otro</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
            <input type="text" id="link" name="nombre_cliente" value="<?php echo set_value("nombre_cliente")?>" placeholder="Nombre Cliente" />
		</div>
	</div>
    
  
     <div class="control-group">
		<label class="control-label" for="id_antiguo">Id Sistema Antiguo</label>
		<div class="controls">
		    <input  type="text" id="id_antiguo" placeholder="id sistema anterior (si hay)" name="id_antiguo"  value="<?php echo $cliente->id_antiguo?>"/>
	
		</div>
	</div>   
    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedor</label>
		<div class="controls">
			<select name="vendedor">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($vendedores as $vendedor)
                {
                    ?>
                    <option value="<?php echo $vendedor->id?>"><?php echo $vendedor->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
			<select name="condicion_del_producto" onchange="carga_ajax2('<?php echo base_url();?>cotizaciones/por_cliente',this.value,'producto');">
                <option value="0">Nuevo</option>
                <option value="1">Repetición Sin Cambios</option>
                <option value="2">Repetición Con Cambios</option>
                <option value="3">Producto Genérico</option>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Descripción del Producto</label>
		<div class="controls">
			<input type="text" name="producto" placeholder="Descripción del Producto" />
            <input type="hidden" name="producto2" />
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Cotizar</label>
		<div class="controls">
                    <input type="text" value="<?php echo $valores->cantidad_1 ?>" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" /> 
                        - <input type="text" value="<?php echo $valores->cantidad_2 ?>" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" /> 
                      - <input type="text" value="<?php echo $valores->cantidad_3 ?>" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" />
                      - <input type="text" value="<?php echo $valores->cantidad_4 ?>" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
                    
                    <?php
                    
                    
                    if($valores->acepta_excedentes == "SI")
                    {
                        ?>
                    <input type="checkbox" checked="true" id="dir" name="acepta_excedentes" value="si" />
                   <?php
                     }
                    if($valores->acepta_excedentes == "NO")
                    {
                        echo "ACEPTA EXCEDENTES".$valores->acepta_excedentes;
                     ?>
                    <input type="checkbox" checked="false" id="dir" name="acepta_excedentes" value="no" />
                   <?php
                    } 
                    ?>
			
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Comentarios de Medidas</label>
		<div class="controls">
			<textarea id="contenido4"  name="obs" placeholder="Observaciones"><?php echo $valores->comentario_medidas ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<select name="piezas_adicionales">
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>"><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $valores->comentario_piezas_adicionales ?></textarea>
		</div>
	</div>
    
    
    <div id="referencia">
        
    </div>
    
    
    <h3>Materialidad</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
                
                <option value="1">Microcorrugado</option>
                <option value="2">Corrugado</option>
                <option value="3">Cartulina-cartulina</option>
                <option value="4">Sólo Cartulina</option>
                <option value="5">Onda a la Vista ( Micro/Micro )</option>
                <option value="6">Otro</option>
             
            </select>
		</div>
	</div>
    
    <div id="materialidad">
    
         
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas</label>
    		<div class="controls">
    			<select name="materialidad_1">
                    
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">MonoTapa</label>
    		<div class="controls">
    			<select name="materialidad_2">
                    
                    <?php
                    $monotapas=$this->monotapas_model->getMonotapasSelect();
                    foreach($monotapas as $monotapa)
                    {
                        ?>
                        <option value="<?php echo $monotapa->nombre?>" title="<?php echo $monotapa->gramaje_onda?> (<?php echo $monotapa->nombre?>)"><?php echo $monotapa->gramaje_onda?> (<?php echo $monotapa->nombre?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
    </div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Solicita Maqueta</label>
		<div class="controls">
			<input type="checkbox" id="dir" name="muestra_materialidad" value="si" />
		</div>
	</div>-->
    
    <h3>Impresión</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores">
                <?php
                for($i=1;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Metálicos o Fluor</label>
		<div class="controls">
			<select name="colores_metalicos">
                <?php
                for($i=0;$i<3;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
		<div class="controls">
			<select name="acabado_impresion_1">
                <?php
                $internos=$this->servicios_model->getServiciosPorTipo("Interno");
                foreach($internos as $interno)
                {
                    ?>
                    <option value="<?php echo $interno->servicio?>"><?php echo $interno->servicio?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>-->





<!--<input type="checkbox" name="technologies" value="jQuery" /> jQuery <br/>
<input type="checkbox" name="technologies" value="JavaScript" />JavaScript <br/>
<input type="checkbox" name="technologies" value="Prototype" /> Prototype<br/>
<input type="checkbox" name="technologies" value="Dojo" /> Dojo<br/>
<input type="checkbox" name="technologies" value="Mootools" /> Mootools <br/>-->

<!--    <div class="control-group">-->

<!--	</div>-->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno</label>
		<div class="controls">
			
            <?php
            foreach($acInternos->result() as $intern)
            {
            ?>
            <input type="checkbox" name="acInternos[]" value=<?php echo $intern->id_acabado?> /> <?php echo $intern->nombre_acabado?> <br/>
            <?php
            }
            ?>
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión externo </label>
		<div class="controls">
			
              <?php
            foreach($acExternos->result() as $extern)
            {
               if(in_array($extern->nombre_acabado,$acExternosReg->result()))
               {
                    ?>
                    <input type="checkbox" checked="true" name="acExternos[]" value=<?php echo $extern->id_acabado?> /> <?php echo $extern->nombre_acabado?> <br/>
                    <?php
               }
               else
               {
                   ?>
                <input type="checkbox" checked="false" name="acExternos[]" value=<?php echo $extern->id_acabado?> /> <?php echo $extern->nombre_acabado?> <br/>
                 <?php
              }
            }
            ?>
           
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
			<select name="acabado_impresion_2">
                <option value="Con Reserva">Con Reserva</option>
                <option value="Sin Reserva">Sin Reserva</option>
            </select>
		</div>
	</div>
    -->
<!--    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión externo 1</label>
		<div class="controls">
			<select name="acabado_impresion_3">
               <?php
                $externos=$this->servicios_model->getServiciosPorTipo("Externo");
                foreach($Externos as $externo)
                {
                    ?>
                    <option value="<?php echo $externo->servicio?>"><?php echo $externo->servicio?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    -->
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión externo 2</label>
		<div class="controls">
			<select name="acabado_impresion_4">
                <option value="Con Reserva">Con Reserva</option>
                <option value="Sin Reserva">Sin Reserva</option>
            </select>
		</div>
	</div>-->
    
    <div class="control-group">
		<label class="control-label" for="usuario">Hacer Cromalin</label>
		<div class="controls">
			<input type="checkbox" id="dir" name="hacer_cromalin" value="si" />
		</div>
	</div>
    
    <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
			<select name="folia" style="width: 100px;">
                <option value="NO">SI</option>
                <option value="NO">NO</option>
            </select> 
            <select name="folia_se">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
                <option value="No Lleva">No Lleva</option>
            </select>
        
		</div>
	</div>
       <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;">
                <option value="NO">SI</option>
                <option value="NO">NO</option>
            </select> 
            <select name="cuno_se">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
                <option value="No Lleva">No Lleva</option>
            </select>
        
		</div>
	</div>
    
    <h3>Instrucciones de Terminación</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Producto se entrega armado</label>
		<div class="controls">
            <select name="producto_se_entrega_armado">
                <option value="SI">SI</option>
                <option value="NO">No</option>
            </select>
        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tiene desgajado especial ( Pieza chica )</label>
		<div class="controls">
            <select name="tiene_desgajado">
                <option value="SI">SI</option>
                <option value="NO">No</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Montaje Pieza Especial</label>
		<div class="controls">
            <select name="montaje_pieza_especial">
                <option value="SI">SI</option>
                <option value="NO">No</option>
            </select>
            <br />
            <input type="text" />
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Instrucciones para la terminación y pegado</label>
		<div class="controls">
			<textarea id="contenido6" name="pegado_instrucciones" placeholder="Observaciones"><?php echo $valores->pegado_instrucciones ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica</label>
		<div class="controls">
            
                    <input type="text" value="<?php echo $valores->cantidad_especifica ?>" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" />
        
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Envasado</label>
		<div class="controls">
            <select name="envasado">
                <option value="Paletizado">Paletizado</option>
                <option value="Paquetes">Paquetes</option>
                <option value="Cartón Corrugado">Cartón Corrugado</option>
            </select>
        
		</div>
	</div>
    
    <h3>Detalles de Despacho</h3>
    
      
      <div class="control-group">
		<label class="control-label" for="usuario">Despacho Fuera de Santiago</label>
		<div class="controls">
            <select name="despacho_fuera_de_santiago">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        
		</div>
	</div>
      
      <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Total o Parcial</label>
		<div class="controls">
            <select name="tota_o_parcial">
                <option value="Total">Total</option>
                <option value="Parcial">Parcial</option>
                <option value="despachos semanales">despachos semanales</option>
                <option value="despachos mensuales">despachos mensuales</option>
                <option value="despachos bimensuales">despachos bimensuales</option>
                <option value="despachos trimestrales">despachos trimestrales</option>
            </select>
        
		</div>
	</div>
    
       <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades (Sin es Parcial)</label>
		<div class="controls">
                    <input type="text" value="<?php echo $valores->can_despacho_1 ?>" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" /> 
                        - <input type="text" value="<?php echo $valores->can_despacho_2 ?>" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" /> 
                        - <input type="text" value="<?php echo $valores->can_despacho_3 ?>" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" />
	</div>
    
    <h3>Comercial</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Forma de Pago</label>
		<div class="controls">
			<select name="forma_pago">
                <option value="0">Seleccione.....</option>
                <?php
                $formas=$this->clientes_model->getFormasPago();
                foreach($formas as $forma)
                {
                    ?>
                    <option value="<?php echo $forma->forma_pago?>"><?php echo $forma->forma_pago?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comisión Agencia</label>
		<div class="controls">
            <select name="comision_agencia">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costo Comercial</label>
		<div class="controls">
            
                    <input type="text" name="costo_comercial" value="<?php echo $valores->costo_comercial?>" id="costo_comercial"  onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" />
        
		</div>
	</div>
    
    <h3>Cliente Entrega</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Cliente Entrega</label>
		<div class="controls">
            <select name="cliente_entrega" size="5" multiple="multiple">
                <option value="Información Digital">Información Digital</option>
                <option value="Muestra de Color">Muestra de Color</option>
                <option value="Producto a Contener">Producto a Contener</option>
                <option value="Muestra Producto a Fabricar">Muestra Producto a Fabricar</option>
                <option value="Otro">Otro</option>
            </select>
            
		</div>
	</div>
    
    
    <div class="control-group">
		<div class="form-actions">
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
    
</div>
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
