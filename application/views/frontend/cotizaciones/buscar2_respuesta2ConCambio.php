<?php $this->layout->element('admin_mensaje_validacion'); ?>
<script>
window.onload = function() {
			ValidarNombreProducto();
		};

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
			// <select name="cliente" onchange="carga_ajax3('<?php echo base_url();?>cotizaciones/ultimas_referencias',this.value,'1','referencia');">
              
                 // <option value="3000">Otro</option>
                // <?php
                // $clientes=$this->clientes_model->getClientesNormal();
                // foreach($clientes as $cliente)
                // {
                    // ?>
                    // <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    // <?php
                // }
                // ?>
               
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
function verificaCampos2()
{
    document.form.submit();
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
 
<?php echo form_open(null, array('onsubmit'=>'verificaCampos()','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
     <!--
 <li><a href="<?php echo base_url()?>cotizaciones/buscar2_respuesta/<?php echo $cliente->id?>/<?php echo $pagina?>">Solicitud de Cotizaciones para cliente : <?php echo $cliente->razon_social?> &gt;&gt;</a></li>
-->
      <li>Completar Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Completar Cotización (Repetición Con Cambios)</h3></div>
	<p>
        <?php
        if(sizeof($orden)==0)
        {
            ?>
            Esta cotización <strong>NO</strong> tiene órden de producción asociada
            <?php
        }else
        { ?>
            Esta cotización <strong>SI</strong> tiene órden de producción asociada N° <?php echo $orden->id?>
            <?php
            
        }
        ?>
    </p>
    <hr />
     

        
	 <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<!-- <select name="cliente" > -->
              
                 
                <?php
              $clientes=$this->clientes_model->getClientesNormal();
			 
                foreach($clientes as $cliente)
                {
                  //  if($datos->id_cliente==3000)
                 //   {
                    ?>
                    <!--<option value="<?php //echo $cliente->id?>"><?php //echo $cliente->razon_social?></option> -->
                    <?php
                   // }else
                    //{
						if($datos->id_cliente==$cliente->id)
						{
                        ?>
                    <!-- <option value="<?php //echo $cliente->id?>" <?php // if($datos->id_cliente==$cliente->id){echo 'selected="true"';}?>><?php //echo $cliente->razon_social?></option> -->
					
					<input type="text" name="cliente1" value="<?php if($datos->id_cliente==$cliente->id){echo trim($cliente->razon_social);} ?>" readonly="true"/>
					
                     <?php
						}
                   // }
                    
                }
                ?>
               
           <!-- </select> -->
            <input type="hidden" id="link" name="nombre_cliente" value="<?php echo $datos->nombre_cliente?>" placeholder="Nombre Cliente" />
		</div>
	</div>
    
    <!--
<div class="control-group">
		<label class="control-label" for="id_antiguo">Id Sistema Antiguo</label>
		<div class="controls">
		    <input  type="hidden" id="id_antiguo" placeholder="id sistema anterior (si hay)" name="id_antiguo"  value="<?php echo $datos->id_antiguo?>"/>
	
		</div>
	</div> 
--> <input  type="hidden" id="id_antiguo" placeholder="id sistema anterior (si hay)" name="id_antiguo"  value="<?php echo $datos->id_antiguo?>"/>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedor</label>
		<div class="controls">
			<select name="vendedor">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($vendedores as $vendedor)
                {
                    ?>
                    <option value="<?php echo $vendedor->id?>" <?php if($vendedor->id==$datos->id_vendedor){echo 'selected="selected"';}?>><?php echo $vendedor->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
 <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
			<select name="condicion_del_producto" onchange="llamarDetalleCondicion(this.value);" readonly="true">

                <option value="2" <?php if($datos->condicion_del_producto=="Repetición Con Cambios"){echo 'selected="selected"';}?>>Repetición Con Cambios</option>
                
            </select>
		</div>
	</div>
    
    <div id="div_condicion" style="display: none;">
     <div class="control-group">

	</div>
   </div>
    
	   <!--productos asociados--> 
   <div id="productos_asociados">


   </div>
   <!--productos asociados--> 

	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Descripción del Producto</label>
		<div class="controls">
			<input style="width: 500px;" onkeypress="nextOnEnter(this,event);" type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo $ing->producto ?>" onblur="ValidarNombreProducto();"/>
            <input type="hidden" name="producto2" onkeypress="nextOnEnter(this,event);" />
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Cotizar</label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
			<input onkeypress="nextOnEnter(this,event);" type="text" name="can1" style="width: 100px;" id="can1" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->cantidad_1?>" /> - <input type="text" name="can2" id="can2" style="width: 100px;" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->cantidad_2?>" /> - <input type="text" name="can3" id="can3" style="width: 100px;" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->cantidad_3?>" /> - <input type="text" value="<?php echo $datos->cantidad_4?>" name="can4" id="can4" style="width: 100px;" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" />
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
			<select name="acepta_excedentes">
                    <option value="NO" <?php if($datos->acepta_excedentes=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->acepta_excedentes=="SI"){echo 'selected="true"';}?>>SI</option>
            </select>
            <select name="acepta_excedentes_extra">
                <option value="NO" <?php if($datos->acepta_excedentes=="NO"){echo 'selected="true"';}?>>Acepta pagar extra por cantidad extra</option>
                <option value="NO" <?php if($datos->acepta_excedentes_extra=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->acepta_excedentes_extra=="SI"){echo 'selected="true"';}?>>SI</option>
            </select>
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Comentarios de Medidas</label>
		<div class="controls">
			<textarea id="contenidos4" name="obs" placeholder="Observaciones"><?php echo $datos->comentario_medidas; echo '  '.$ing->comentario_piezas_adicionales; ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<select name="piezas_adicionales" disabled>
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$ing->piezas_adicionales){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2</label>
		<div class="controls">
			<select name="piezas_adicionales" disabled>
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$ing->piezas_adicionales2){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
			<select name="piezas_adicionales" disabled>
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$ing->piezas_adicionales3){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $ing->comentario_piezas_adicionales; ?></textarea>
		</div>
	</div>
    
    
    <div id="referencia">
        
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			
			 <input type="text" name="estan_los_moldes" value="<?php if($ing->estan_los_moldes == 'NO'){ echo "SI";}else{echo $ing->estan_los_moldes;} ?>"  readonly="true"/>
			 
            
			  <?php
			  
			  
			  if(sizeof($estado) >= 1)
			  {
				?>  
				<input type="text" name="molde" value="<?php echo $produccion->id_molde,"-",$produccion->nombre_molde?>"  readonly="true"/>		
				<?php
			  }
		      else{
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
					if($ing->numero_molde==$molde->id){
                    ?>
					  <br>
					Numero: <input type="text" name="molde" value="<?php if($ing->numero_molde==$molde->id){ echo $ing->numero_molde;} ?>"  readonly="true"/>		
					<br>
					Nombre Molde: <input type="text" name="moldeNombrre" value="<?php if($ing->numero_molde==$molde->id){ echo $molde->nombre;} ?>"  readonly="true"/>		
                  <!--  <option value="<?php //echo $molde->id?>" <?php //if($datos->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php// echo $molde->nombre?> (N° <?php //echo $molde->numero?>)</option> -->
					<!--<input type="text" name="molde" value="<?php if($ing->numero_molde==$molde->id){ echo $ing->numero_molde,"-",$molde->nombre;} ?>"  readonly="true"/>-->
                    <?php
					}
                }
			  }
                ?>
			
            <span id="div_moldes"></span>
		</div>
	</div>
	
    <h3>Materialidad</h3>
    
    
    
    <!--materialidad-->
     <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
            <?php
            $materialidads=$this->datos_tecnicos_model->getDatosTecnicos();
            $datos_tecnicos=$datos->materialidad_datos_tecnicos;
            ?>

	<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
               


			   <?php
					foreach($materialidads as $key => $materialidad)
						{
								if($datos->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									if($datos->materialidad_datos_tecnicos == $materialidad->datos_tecnicos)
									{
										?>
										<option value="<?php echo $materialidad->id?>" <?php if($datos->materialidad_datos_tecnicos == $materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php if($datos->materialidad_datos_tecnicos == $materialidad->datos_tecnicos){echo $materialidad->datos_tecnicos; break;} ?></option>
										<?php
										if($datos->materialidad_datos_tecnicos==$materialidad->datos_tecnicos)
										{break;}
								
									}
								}else{
									
									
									?>
									<option value="<?php echo $materialidad->id?>" <?php if($datos->materialidad_datos_tecnicos == $materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
									<?php	
									
								}
						
						}	
		
                ?>
             
               
             
            </select>
			
		</div>
	</div>
    
	
    <div id="materialidad">
        <?php
        switch($datos->materialidad_datos_tecnicos)
        {
            case 'Microcorrugado'://1
			
			
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
				<input type="hidden" name="materialidad_4" value="No Aplica" />         
				<input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
				
            break;
            case 'Corrugado'://2
                 ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Cartulina-cartulina'://3
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" /> 
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Sólo Cartulina'://4
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_2" value="No Aplica" />   
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Onda a la Vista ( Micro/Micro )'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
            case 'Otro'://6
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">MonoTapa</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                   <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Se solicita proposición'://7
                ?>
                <input type="hidden" name="materialidad_1" value="No Aplica" /> 
                <input type="hidden" name="materialidad_2" value="No Aplica" /> 
                <input type="hidden" name="materialidad_3" value="No Aplica" /> 
                <input type="hidden" name="materialidad_4" value="No Aplica" /> 
                <?php
            break;
            
        }
        ?>    
    </div>
    <!--/materialidad-->
    
   <div class="control-group">
		<label class="control-label" for="usuario">Solicita Muestra</label>
		<div class="controls">
				<select name="solicita_muestra" style="width: 100px;" onchange="detalleDeMuestra();">
                <option value="SI" <?php if($datos->materialidad_solicita_muestra=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->materialidad_solicita_muestra=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
		</div>
	</div>
    
     <div id="div_muestra" style="display: none;">
     <div class="control-group">
		<label class="control-label" for="usuario">Detalle de Muestra</label>
		<div class="controls">
			<textarea id="contenidos4" name="detalle_de_muestra" placeholder="Detalle de Muestra"><?php echo set_value('detalle_de_muestra'); ?></textarea>
		</div>
	</div>
   </div>
    
    <h3>Impresión</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores">
                <?php
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($fotomecanica->colores==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
					
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
                    <option value="<?php echo $i?>" <?php if($datos->impresion_metalicos==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
		</div>
	</div>
    



    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
		<div class="controls">
			<select name="acabado_impresion_1">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $acabado1=$datos->impresion_acabado_impresion_1;
                    $acabado2=$datos->impresion_acabado_impresion_2;
                    $acabado3=$datos->impresion_acabado_impresion_3;
                    $acabado4=$datos->impresion_acabado_impresion_4;
                    $acabado5=$datos->impresion_acabado_impresion_5;
                    $acabado6=$datos->impresion_acabado_impresion_6;
                }else
                {
                    $acabado1=$fotomecanica->acabado_impresion_1;
                    $acabado2=$fotomecanica->acabado_impresion_2;
                    $acabado3=$fotomecanica->acabado_impresion_3;
                    $acabado4=$fotomecanica->acabado_impresion_4;
                    $acabado5=$fotomecanica->acabado_impresion_5;
                    $acabado6=$fotomecanica->acabado_impresion_6;
                }
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($acabado1==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
			<select name="acabado_impresion_2">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($acabado2==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
			<select name="acabado_impresion_3">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($acabado3==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
		<div class="controls">
			<select name="acabado_impresion_4">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($acabado4==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
			<select name="acabado_impresion_5">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($acabado5==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
			<select name="acabado_impresion_6">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($acabado6==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    
    <div class="control-group">
		<label class="control-label" for="usuario">Hacer Cromalín</label>
		<div class="controls">
			<input type="checkbox" id="dir" name="hacer_cromalin" value="si" <?php if($datos->impresion_hacer_cromalin=="SI"){echo 'checked="true"';}else{echo 'checked="false"';}?> />
			
		</div>
	</div>
    
    <h3>Procesos Especiales</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
			<select name="folia" style="width: 100px;" onchange="cambiaFolia();">
                <option value="SI" <?php if($datos->procesos_especiales_folia=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_folia=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="folia_se">
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_folia_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
			<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2();">
                <option value="SI" <?php if($datos->procesos_especiales_folia_2=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_folia_2=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="folia_se_2">
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_folia_2_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Folia 3</label>
		<div class="controls">
			<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3();">
                <option value="SI" <?php if($datos->procesos_especiales_folia_3=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_folia_3=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="folia_se_3">
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_folia_3_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;" onchange="cambiaCuno();">
                <option value="SI" <?php if($datos->procesos_especiales_cuno=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_cuno=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="cuno_se">
                <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_cuno_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
			<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2();">
                <option value="SI" <?php if($datos->procesos_especiales_cuno_2=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_cuno_2=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="cuno_se_2">
                <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_cuno_2_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
    <h3>Instrucciones de Terminación</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Producto se entrega armado</label>
		<div class="controls">
            <select name="producto_se_entrega_armado">
                <option value="SI" <?php if($datos->producto_se_entrega_armado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO"  <?php if($datos->producto_se_entrega_armado=="NO"){echo 'selected="selected"';}?>>No</option>
            </select>
        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tiene desgajado especial ( Pieza chica )</label>
		<div class="controls">
            <select name="tiene_desgajado">
                <option value="SI" <?php if($datos->tiene_desgajado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->tiene_desgajado=="NO"){echo 'selected="selected"';}?>>No</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Montaje Pieza Especial</label>
		<div class="controls">
            <select name="montaje_pieza_especial">
                <option value="SI" <?php if($datos->montaje_pieza_especial=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->montaje_pieza_especial=="NO"){echo 'selected="selected"';}?>>No</option>
            </select>
            <br />
            <input type="text" onkeypress="nextOnEnter(this,event);" />
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Instrucciones para la terminación y pegado</label>
		<div class="controls">
			<textarea id="contenido6" name="pegado_instrucciones" onkeypress="nextOnEnter(this,event);"  placeholder="Observaciones"><?php echo $datos->pegado_instrucciones; ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica</label>
		<div class="controls"><!--onkeypress="nextOnEnter(this,event);" -->
            
            <input type="text" name="cantidad_especifica" id="cantidad_especifica" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->cantidad_especifica?>" />
        
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Envasado</label>
		<div class="controls">
            <select name="envasado">
                <option value="Paletizado" <?php if($datos->envasado=="Paletizado"){echo 'selected="selected"';}?>>Paletizado</option>
                <option value="Paquetes" <?php if($datos->envasado=="Paquetes"){echo 'selected="selected"';}?>>Paquetes</option>
                <option value="Cartón Corrugado" <?php if($datos->envasado=="Cartón Corrugado"){echo 'selected="selected"';}?>>Cartón Corrugado</option>
            </select>
        
		</div>
	</div>
    
    <h3>Detalles de Despacho</h3>
    
      
      <div class="control-group">
		<label class="control-label" for="usuario">Despacho Fuera de Santiago</label>
		<div class="controls">
            <select name="despacho_fuera_de_santiago">
                <option value="SI" <?php if($datos->despacho_fuera_de_santiago=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->despacho_fuera_de_santiago=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
        
		</div>
	</div>
      
      <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente">
                <option value="SI" <?php if($datos->retira_cliente=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->retira_cliente=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
        
		</div>
	</div>
    

    
      <div class="control-group">
		<label class="control-label"  for="usuario">Total o Parcial</label>
		<div class="controls">
                    <select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial()">
                <option value="Total" <?php if($datos->tota_o_parcial=="Total"){echo 'selected="selected"';}?>>Total</option>
                <option value="Parcial" <?php if($datos->tota_o_parcial=="Parcial"){echo 'selected="selected"';}?>>Parcial</option>
                <option value="despachos semanales" <?php if($datos->tota_o_parcial=="despachos semanales"){echo 'selected="selected"';}?>>despachos semanales</option>
                <option value="despachos mensuales" <?php if($datos->tota_o_parcial=="despachos mensuales"){echo 'selected="selected"';}?>>despachos mensuales</option>
                <option value="despachos bimensuales" <?php if($datos->tota_o_parcial=="despachos bimensuales"){echo 'selected="selected"';}?>>despachos bimensuales</option>
                <option value="despachos trimestrales" <?php if($datos->tota_o_parcial=="despachos trimestrales"){echo 'selected="selected"';}?>>despachos trimestrales</option>
            </select>
        
		</div>
	</div>
    
       <div class="control-group" id="producto">
           <div id="cantidadesDespacho" style="display: <?php if($datos->tota_o_parcial=="Total"){echo 'none';}else{echo 'block';}?>;">
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                    
			<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->can_despacho_1?>" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->can_despacho_2?>" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->can_despacho_3?>" />
                </div>
                </div>
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
                    <option value="<?php echo $forma->forma_pago?>" <?php if($datos->forma_pago==$forma->forma_pago){echo 'selected="selected"';}?>><?php echo $forma->forma_pago?></option>
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
                <option value="SI" <?php if($datos->comision_agencia=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->comision_agencia=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costo Comercial %</label>
		<div class="controls">
            
            <input type="text" name="costo_comercial" id="costo_comercial"  onkeypress="nextOnEnter(this,event);return soloNumeros(event)" value="<?php echo $datos->costo_comercial?>" />
        
		</div>
	</div>
    
    <h3>Cliente Entrega</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Cliente Entrega</label>
		<div class="controls">
            <select name="cliente_entrega" size="5" multiple="multiple">
                <option value="Información Digital" <?php if($datos->cliente_entrega_1=="Información Digital"){echo 'selected="selected"';}?>>Información Digital</option>
                <option value="Muestra de Color" <?php if($datos->cliente_entrega_1=="Muestra de Color"){echo 'selected="selected"';}?>>Muestra de Color</option>
                <option value="Producto a Contener" <?php if($datos->cliente_entrega_1=="Producto a Contener"){echo 'selected="selected"';}?>>Producto a Contener</option>
                <option value="Muestra Producto a Fabricar" <?php if($datos->cliente_entrega_1=="Muestra Producto a Fabricar"){echo 'selected="selected"';}?>>Muestra Producto a Fabricar</option>
                <option value="Otro" <?php if($datos->cliente_entrega_1=="Otro"){echo 'selected="selected"';}?>>Otro</option>
            </select>
            
		</div>
	</div>
    
    
    <div class="control-group">
		<div class="form-actions">
			<!--
<button  class="btn" onclick="verificaCampos2()">Guardar</button>
-->

        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
        <button type="submit" class="btn" title="Guardar">Guardar</button>
		</div>
	</div>
    
</div>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
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

<script type="text/javascript">

function nameFormatter(value, row) {
	var icon = row.id % 2 === 0 ? 'glyphicon-star' : 'glyphicon-star-empty'

	return '<i class="glyphicon ' + icon + '"></i> ' + value;
}

function priceFormatter(value) {
	// 16777215 == ffffff in decimal
	var color = '#'+Math.floor(Math.random() * 6777215).toString(16);
	return '<div  style="color: ' + color + '">' +
			'<i class="glyphicon glyphicon-usd"></i>' +
			value.substring(1) +
			'</div>';
}



$(document).ready(function(){

		var $result = $('#events-result');

		$('#table-javascript').bootstrapTable({
		 onClickRow: function (row) {
                    $result.text('Seleccionado: ' +' id Cliente: ' + row.id + '\n - ' +row.razon_social);
					
					$("#cliente").val(row.id);
					var datonuevocli=$("#link").val();
					
					//$("#link").val(row.razon_social);
					if(row.rut!=null && row.rut!='NULL'   ){
					$("#link").val("");
					
					$("#TablaClientes").html('	<table class="table table-striped table-hover">'+
													'<tr>'+'<td>Id Cliente'
														+'</td>'
														+'<td>'+row.id
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>Rut Cliente'
														+'</td>'
														+'<td>'+row.rut
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>Cliente'
														+'</td>'
														+'<td>'+row.razon_social
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>nombre Fantasia'
														+'</td>'
														+'<td>'+row.nombre_fantasia
														+'</td>'
													+'</tr>'
												+'</table>');
					}else{
					row.id=0;
					$("#cliente").val("3000");
						$("#TablaClientes").html('	<table class="table table-striped table-hover">'+
													'<tr>'+'<td>Id Cliente'
														+'</td>'
														+'<td>'+row.id
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>Rut Cliente'
														+'</td>'
														+'<td>SIN RUT'
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>Cliente'
														+'</td>'
														+'<td>'+datonuevocli
														+'</td>'
													+'</tr>'+
													'<tr>'+'<td>nombre Fantasia'
														+'</td>'
														+'<td>'+datonuevocli
														+'</td>'
													+'</tr>'
												+'</table>');					
					}
					
					
					document.getElementById("TablaClientes").style.display="block";
                },
                method: 'get',
                url: '/grau/cotizaciones/obtenerclientes',
                cache: false,
                height: 400,
                striped: true,
                pagination: true,
                pageSize: 50,
                pageList: [10, 25, 50, 100, 200],
                search: true,
                showColumns: true,
                showRefresh: true,
                minimumCountColumns: 2,
                clickToSelect: true,
                columns: [{
						field: 'state',
						radio: true
					},{ 			
                    field: 'id',
                    title: 'Id Cliente',
                    align: 'center',
                    valign: 'middle',
                    sortable: true
                }, {
                    field: 'rut',
                    title: 'Rut',
                    align: 'center',
                    valign: 'middle',
                    sortable: true,
                    formatter: nameFormatter
                }, {
                    field: 'razon_social',
                    title: 'Cliente',
                    align: 'left',
                    valign: 'top',
                    sortable: true,
                    formatter: nameFormatter
                }, {
                    field: 'nombre_fantasia',
                    title: 'nombre Fantasia',
                    align: 'center',
                    valign: 'middle',
                    clickToSelect: false,
                    formatter: nameFormatter
                }]
            });

	});
// $(document).ready(function() {
	// $(".fancybox").fancybox({
		// openEffect	: 'none',
		// closeEffect	: 'none'
	// });
    
// });

	
</script>
