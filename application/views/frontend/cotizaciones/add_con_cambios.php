<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php // print_r($expression);  ?>
<?php if ($msg_error!='') { ?>
<div class="well well-small">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <ul><li>El campo <strong>Archivo PDF</strong> tiene un error.</li></ul>
</div>
<?php } ?>
<style type="text/css">
    #instrucciones{
        height: 280px;
        width: 250px;
        background-color: #006699;
        position: fixed;
        z-index: 1000;
        left: 1200px;
        top: 350px;
        opacity: 0.4;
        color: white;
        padding: 10px 10px 10px 10px;
        font-size: 20px;
        }
        #instrucciones span{
        text-align: center;
        }
        #instrucciones ul{
        padding-top: 30px;
        }
        
        </style>
<div id="instrucciones">
    <span>Solo se pueden cambiar en Repeticion con Cambios</span><br />
    <ul>
        <li>Cantidad
        <li>Colores
        <li>Barniz
        <li>Reserva Barniz
        <li>Cala Caucho
    </ul>
</div>
<div id="contenidos">

<?php echo form_open_multipart(null, array('onsubmit'=>'comprueba_extension(this.form, this.form.file.value)','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Solicitud de Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Solicitud de Cotización con Cambios</h3>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="cliente" onchange="BuscarMoldesRegistradosCliente(this.value,'molde_select_cliente');BuscarFormaPagoCliente(this.value,'sub_forma_pago');BuscarBuscarVendedorCliente(this.value,'sub_vendedor');" class="chosen-select" style="width: 500px;">
                        <option value="0">Seleccione.....</option>
                        <?php
                        $clientes=$this->clientes_model->getClientesNormalTodo();
                        if (sizeof($datos_cotizacion)>0)
                        {
                            foreach($clientes as $cliente){ ?>
                                <option value="<?php echo $cliente->id?>" <?php if ($datos_cotizacion->id_cliente==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?> <?php if($cliente->estado==2){echo '(BLOQUEADO)';} if($cliente->id_region==0){echo '( Info. Incompleta)';}?></option>
                            <?php }                            
                        }
                        else 
                        { 
                            foreach($clientes as $cliente){ ?>
                                <option value="<?php echo $cliente->id?>" <?php if(isset($_POST["cliente"]) and $_POST["cliente"]==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?> <?php if($cliente->estado==2){echo '(BLOQUEADO)';} if($cliente->id_region==0){echo '( Info. Incompleta)';}?></option>
                            <?php } 
                        } ?>

                    </select>
		</div>
    </div>
    
   <!--
 <div class="control-group">
		<label class="control-label" for="id_antiguo">Id Sistema Antiguo</label>
		<div class="controls">
		    <input  type="text" id="id_antiguo" placeholder="id sistema anterior (si hay)" name="id_antiguo"  value="<?php echo set_value("id_antiguo")?>"/>
	
		</div>
	</div>  
-->
    
    
    <div class="control-group">
        <div id="sub_vendedor">
		<label class="control-label" for="usuario">Vendedor</label>
		<div class="controls">
		<select name="vendedor">
                    <?php
                      if (sizeof($datos_cotizacion)>0)
                      {
                           foreach($vendedores as $vendedor) { ?>
                                <option value="<?php echo $vendedor->id?>" <?php if($vendedor->id==$datos_cotizacion->id_vendedor){echo 'selected="selected"';}?>  ><?php echo $vendedor->nombre?></option>
                            <?php  }                           
                      }
                      else {
                        if($this->session->userdata('perfil')==1) { ?>
                            <option value="0">Seleccione.....</option>
                            <?php foreach($vendedores as $vendedor) { ?>
                                <option value="<?php echo $vendedor->id?>" <?php if($vendedor->nombre=="OFICINA"){echo 'selected="selected"';}?>  ><?php echo $vendedor->nombre?></option>
                            <?php  } 
                           } else { ?>
                                <option value="<?php echo $this->session->userdata('id')?>"><?php echo $this->session->userdata('nombre')?></option>
                     <?php } 
                      }?>
                </select>
		</div>
        </div>            
    </div>
    <?php echo "<h1>" . $datos_cotizacion->condicion_del_producto . "</h1>"; //my code is here ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
                    <select name="condicion_del_producto" onchange="llamarDetalleCondicion(this.value);condicionParaMoldes(this.value);llamarlink(this.value);">
                    <option value="">Seleccione.....</option>
                    <?php  if (sizeof($datos_cotizacion)>0)
                      {  
                               switch($datos_cotizacion->condicion_del_producto)
                               {
                                    case 'Nuevo': $condicion=0; break;
                                    case 'Repetición Sin Cambios': $condicion=1; break;
                                    case 'Repetición Con Cambios': $condicion=2; break;
                                    case 'Producto Genérico': $condicion=3; break;
                               }                        
                        ?>
                            <option value="0">Nuevo</option>
                            <option value="1" style="font-weight:bold" selected="true">Buscar Repetición?</option>
                            <option value="3">Producto Genérico</option>                      
                      <?php } else { ?>
                            <option value="0" <?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="0"){echo 'selected="true"';}?> style="font-weight:bold">Nuevo</option>
                            <option value="1"<?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="1"){echo 'selected="true"';}?>>Buscar Repetición?</option>
                     <!--   <option value="2"<?php //if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="2"){echo 'selected="true"';}?>>Repetición Con Cambios</option> -->
                            <option value="3"<?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="3"){echo 'selected="true"';}?>>Producto Genérico</option>                          
                    <?php } ?>

                    </select>
		</div>
    </div>
    <input type="hidden" name="pegado_migrado" value="<?php echo $datos_cotizacion->pegado_migrado; ?>"/>
    <input type="hidden" name="margen_migrado" value="<?php echo $datos_cotizacion->margen_migrado; ?>"/>
    
   <div id="div_condicion" style="display: none;">
     <div class="control-group">
		<!--<label class="control-label" for="usuario">Detalle de Cambios</label> -->
		<div class="controls">
			<!--<textarea id="contenido4" name="detalle_cambios" placeholder="Observaciones"><?php //echo set_value('detalle_cambios'); ?></textarea>-->
			
		</div>
	</div>
   </div>
   

   <!--productos asociados--> 
   <div id="productos_asociados">


   </div>
   <!--productos asociados--> 

   

   
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción del Producto <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <input style="width: 500px;" readonly="readonly" type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo $datos_cotizacion->producto; ?>"  onblur="ValidarNombreProducto();"/>
                      <?php } else {?>
                    <input style="width: 500px;" readonly="readonly" type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo set_value("producto")?>"  onblur="ValidarNombreProducto();"/>
                    <?php } ?>
                    <input type="hidden" name="producto" value="<?php echo $datos_cotizacion->producto; ?>" />                        
                    <input type="hidden" name="producto_id" value="<?php echo $datos_producto->id; ?>" />                        
		</div>
	</div>
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Cotizar <strong style="color: red;">(*)</strong></label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
                    <?php  if (sizeof($datos_cotizacion)>0) {   ?>
			<input type="text" id="can1" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo $datos_cotizacion->cantidad_1?>" /> - <input type="text" id="can2" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo $datos_cotizacion->cantidad_2?>" /> - <input type="text" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo $datos_cotizacion->cantidad_3?>" /> - <input type="text" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo $datos_cotizacion->cantidad_4?>" />
                      <?php } else {?>                    
                        <input type="text" id="can1"  name="can1" onblur="habiltarCaja('can1','can2');" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo $_POST["can1"]; ?>" /> - <input type="text" readonly="true" id="can2" name="can2" onblur="habiltarCaja('can2','can3');" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo $_POST["can2"];?>" /> - <input type="text" readonly="true" onblur="habiltarCaja('can3','can4');" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo $_POST["can3"];?>" /> - <input readonly="true" type="text" value="0" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo $_POST["can4"];?>" />
                    <?php } ?>                        
		</div>
	</div>
    
   
    
     <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
		<select name="acepta_excedentes" style="width: 100px;" onchange="aceptaExcedentes();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="">Seleccione.....</option>
                      <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                            <option value="SI" <?php if($datos_cotizacion->acepta_excedentes=="SI"){echo 'selected="true"';}?>>SI</option>
                            <option value="NO" <?php if($datos_cotizacion->acepta_excedentes=="NO"){echo 'selected="true"';}?>>NO</option>
                      <?php } else {?>                    
                            <option value="SI" <?php if(isset($_POST["acepta_excedentes"]) and $_POST["acepta_excedentes"]=='SI'){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO" <?php if(isset($_POST["acepta_excedentes"]) and $_POST["acepta_excedentes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    <?php } ?>                       

                </select> 
            <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span>
            <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" />
            
        
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Visto Bueno <strong>(VB)</strong> en Maquina</label>
		<div class="controls">
		<select name="vb_maquina" style="width: 100px;" onchange="aceptaExcedentes123();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                    <option value="">Seleccione.....</option>
                      <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                            <option value="SI" <?php if($datos_cotizacion->vb_maquina=="SI"){echo 'selected="true"';}?>>SI</option>
                            <option value="NO" <?php if($datos_cotizacion->vb_maquina=="NO"){echo 'selected="true"';}?>>NO</option>
                      <?php } else {?>          
                            <option value="SI" <?php if(isset($_POST["vb_maquina"]) and $_POST["vb_maquina"]=='SI'){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO" <?php if(isset($_POST["vb_maquina"]) and $_POST["vb_maquina"]=='NO'){echo 'selected="selected"';}?>>NO</option>                            
                    <?php } ?>                       
                </select> 
           <!-- <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span> -->
           <!-- <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" /> -->
            
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Generales</label>
		<div class="controls">
                      <?php  if (sizeof($datos_cotizacion)>0) {   ?>
			<textarea id="contenido4s" name="obs" placeholder="Observaciones"><?php echo $datos_cotizacion->comentario_medidas;?></textarea>
                      <?php } else {?>                    
			<textarea id="contenido4s" name="obs" placeholder="Observaciones"><?php if(isset($_POST["obs"])){echo $_POST["obs"];}?></textarea>
                    <?php } ?>                        
		</div>
	</div>
    
    <h3>Piezas Adicionales</h3>
   
   
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
		<select name="piezas_adicionales" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoNueva');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                        <option value="0">No lleva.....</option>
                      <?php  
                      $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                      if (sizeof($datos_cotizacion)>0) {   
                            foreach($piezas as $pieza)
                            {
                                ?>
                                <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos_cotizacion->piezas_adicionales){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }                      
                        } else {                    
                            foreach($piezas as $pieza)
                            {
                                ?>
                                <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$_POST["piezas_adicionales"]){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }
                        } ?>  
                </select><a href="#" id="infoNueva"></a>
		</div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2 </label>
		<div class="controls">
		<select name="piezas_adicionales2" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoNueva2');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                    <option value="0">No lleva.....</option>
                      <?php  
                      $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                      if (sizeof($datos_cotizacion)>0) {   
                            foreach($piezas as $pieza)
                            {
                                ?>
                                <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos_cotizacion->piezas_adicionales2){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }                      
                        } else {                    
                            foreach($piezas as $pieza)
                            {
                                ?>
                                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$_POST["piezas_adicionales2"]){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }
                        } ?>                      
            </select><a href="#" id="infoNueva2"></a>
		</div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
		<select name="piezas_adicionales3" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoNueva3');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="0">No lleva.....</option>
                      <?php  
                      $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                      if (sizeof($datos_cotizacion)>0) {   
                            foreach($piezas as $pieza)
                            {
                                ?>
                                <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos_cotizacion->piezas_adicionales3){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }                      
                        } else {                    
                            foreach($piezas as $pieza)
                            {
                                ?>
                                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$_POST["piezas_adicionales3"]){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                                <?php
                            }
                        } ?>                  
                </select><a href="#" id="infoNueva3"></a>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
                    <?php                      
                      if (sizeof($datos_cotizacion)>0) {  ?>                     
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $datos_cotizacion->comentario_piezas_adicionales;?></textarea>
                    <?php } else { ?>  
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php if(isset($_POST["comentario_piezas_adicionales"])){echo $_POST["comentario_piezas_adicionales"];}?></textarea>
                    <?php }  ?>  
		</div>
	</div>
    
    <h3>Moldes <strong style="color: red;">(*)</strong></h3>
    
    <div id="referencia">
        
    </div>
    
        <div class="control-group" id="div_estan_los_moldes" <?php if (($_POST["select_estan_los_moldes_genericos"]=='SI') or ($_POST["select_estan_los_moldes_no_genericos_clientes"]=='SI') or ($datos_cotizacion->estan_los_moldes=='SI') or ($datos_cotizacion->estan_los_moldes=='MOLDE GENERICO') or  ($datos_cotizacion->estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE')) {  ?>  style="display: none;" <?php } else { ?> style="display: block;" <?php } ?>>
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			<!--<select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
                        <select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <?php  if (sizeof($datos_cotizacion)>0) {  ?>                      
                                <option value="">Seleccione.....</option>
                                <option value="NO" <?php if($datos_cotizacion->estan_los_moldes=="NO"){echo 'selected="selected"';}?>>NO</option>
                                <option value="NO LLEVA"<?php if($datos_cotizacion->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
                                <option value="CLIENTE LO APORTA" <?php if($datos_cotizacion->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
                                <option value="MOLDE GENERICO" <?php if($datos_cotizacion->estan_los_moldes=="MOLDE GENERICO"){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
                                <option value="MOLDE REGISTRADOS DEL CLIENTE" <?php if($datos_cotizacion->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE"){echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
                            <?php } else { ?>  
                                <option value="">Seleccione.....</option>
                                <option value="NO" <?php if(isset($_POST["select_estan_los_moldes"]) and $_POST["select_estan_los_moldes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                                <option value="NO LLEVA" <?php if(isset($_POST["select_estan_los_moldes"]) and $_POST["select_estan_los_moldes"]=='NO LLEVA'){echo 'selected="selected"';}?>>NO LLEVA</option>
                                <option value="CLIENTE LO APORTA" <?php if(isset($_POST["select_estan_los_moldes"]) and $_POST["select_estan_los_moldes"]=='CLIENTE LO APORTA'){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
                                <option value="MOLDE GENERICO" <?php if(isset($_POST["select_estan_los_moldes"]) and $_POST["select_estan_los_moldes"]=='MOLDE GENERICO'){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
                                <option value="MOLDE REGISTRADOS DEL CLIENTE" <?php if(isset($_POST["select_estan_los_moldes"]) and $_POST["select_estan_los_moldes"]=='MOLDE REGISTRADOS DEL CLIENTE'){echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
                            <?php }  ?>                                 
                        </select> 
                    
		</div>
	</div>
	<?php 
        if(($datos_cotizacion->estan_los_moldes=="NO") or ($datos_cotizacion->estan_los_moldes=="NO LLEVA"))
        {
            $ver_molde_generico='style="display: none;"'; 
            $ver_molde_cliente='style="display: none;"';
        }            
        else
        {
            if ($datos_cotizacion->numero_molde!='')
            {
//                echo 0;
                $moldes_seleccionado=$this->moldes_model->getMoldesPorId($datos_cotizacion->numero_molde);
            }
            elseif (($_POST["select_estan_los_moldes_genericos"]=='SI') and ($_POST["select_estan_los_moldes_no_genericos_clientes"]=='NO'))
            {    
//                echo 1;
                $moldes_seleccionado=$this->moldes_model->getMoldesPorId($_POST["molde_generico"]);              
            }    
            elseif (($_POST["select_estan_los_moldes_no_genericos_clientes"]=='SI') and ($_POST["select_estan_los_moldes_genericos"]=='NO'))
            {
//                echo 2;
                $moldes_seleccionado=$this->moldes_model->getMoldesPorId($_POST["molde_registrado"]);                
            }
//            print_r($moldes_seleccionado);
            if (sizeof($moldes_seleccionado)>0)
            {
                if ($moldes_seleccionado->tipo=="Genérico") 
                { 
                    $ver_molde_generico='style="display: block;"'; 
                    $ver_molde_cliente='style="display: none;"'; 
                }
                else 
                { 
                    $ver_molde_generico='style="display: none;"'; 
                    $ver_molde_cliente='style="display: block;"'; 
                }
            }
            else 
            {
                $ver_molde_generico='style="display: none;"'; 
                $ver_molde_cliente='style="display: none;"';
            }
        }

            
        ?>
	<div class="control-group" id="div_estan_los_moldes_generico" <?php echo $ver_molde_generico; ?>
		<label class="control-label" for="usuario">Moldes Genéricos</label>
		<div class="controls">
                    <!--<select name="select_estan_los_moldes_genericos" style="width: 100px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
		    <select name="select_estan_los_moldes_genericos" style="width: 300px;" onchange="estanLosMoldes(this.value);" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                    <option value="">Seleccione.....</option>
                    <?php if (sizeof($datos_cotizacion)>0)  { ?>
                        <option value="SI" <?php if(($datos_cotizacion->estan_los_moldes=='SI') or ($datos_cotizacion->estan_los_moldes=='MOLDE GENERICO')){echo 'selected="true"';}?>>SI</option> 
                        <option value="NO" <?php if($datos_cotizacion->estan_los_moldes=="NO"){echo 'selected="true"';}?>>NO</option>
                    <?php } else { ?>
                        <option value="SI" <?php if(isset($_POST["select_estan_los_moldes_genericos"]) and $_POST["select_estan_los_moldes_genericos"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php if(isset($_POST["select_estan_los_moldes_genericos"]) and $_POST["select_estan_los_moldes_genericos"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    <?php }  ?>                  
                    </select> 
                    <div id="molde_select">
                        <select name="molde_generico" class="chosen-select" id="molde_generico" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="0">Seleccione.....</option>
                              <?php
                                $moldes=$this->moldes_model->getMoldes2();
                                foreach($moldes as $molde)
                                {
                                    if (sizeof($datos_cotizacion)>0) {  ?>
                                        <option value="<?php echo $molde->id?>" <?php if($datos_cotizacion->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $molde->id?>" <?php if($_POST["molde_generico"]==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                    <?php }
                                }
                          
                              ?>
                          </select> 
                          <span id="div_moldes"></span>
                    </div>
		</div>
        </div>
    
    <?php $tienenombre=$this->moldes_model->getComprobarMolde($datos_cotizacion->numero_molde); 
    if(sizeof($tienenombre)<1){
        $msgmolde="Presenta Error en Molde";
    }else{
        $msgmolde="";
    }
    
    //print_r($tienenombre);
    ?>
	<div class="control-group" id="div_estan_los_moldes_clientes" <?php echo $ver_molde_cliente; ?>>
		<label class="control-label" for="usuario">Moldes del Cliente</label>
		<div class="controls">
                    <!--<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 100px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
			<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 300px;" onchange="estanLosMoldes(this.value);" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                        <option value="">Seleccione.....</option>
                        <?php if (sizeof($datos_cotizacion)>0)  { ?>
                            <option value="SI" <?php if(($datos_cotizacion->estan_los_moldes=='SI') or  ($datos_cotizacion->estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE')){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($datos_cotizacion->estan_los_moldes=="NO"){echo 'selected="true"';}?>>NO</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["select_estan_los_moldes_no_genericos_clientes"]) and $_POST["select_estan_los_moldes_no_genericos_clientes"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(isset($_POST["select_estan_los_moldes_no_genericos_clientes"]) and $_POST["select_estan_los_moldes_no_genericos_clientes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                        <?php }  ?>   
                    </select> 
                    <a href="#" for="usuario" style="color:red"><?php echo $msgmolde ?></a>
                    <?php // $moldes=$this->moldes_model->getMoldesClientes($datos_cotizacion->id_cliente); ?>

                    <div id="molde_select_cliente">
                        <select name="molde_registrado" class="chosen-select" id="molde_registrado" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="0">Seleccione......</option>
                              <?php
                              $error_molde=false;
                              if (sizeof($datos_cotizacion)>0) 
                                $moldes=$this->moldes_model->getMoldesClientes($datos_cotizacion->id_cliente);
                              else
                                $moldes=$this->moldes_model->getMoldesClientes($_POST["cliente"]);
                            
                              if (sizeof($moldes)>0) 
                              {
                                foreach($moldes as $molde)
                                {   echo $molde->id."<br />";
                                      if (sizeof($datos_cotizacion)>0) {  ?>
                                          <option value="<?php echo $molde->id?>" <?php if($datos_cotizacion->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                      <?php } else { ?>
                                          <option value="<?php echo $molde->id?>" <?php if($_POST["molde_registrado"]==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                      <?php }
                                }
                              }  else { $error_molde=true; }?>
                          </select> 
                          <span id="div_moldes2"></span>
                          <?php if ($error_molde) { ?>
                                    <div style="background-color: #b13b28; color:white; width: 100%;">&nbsp;&nbsp;Error en el Molde Pertenece a otro Cliente, o no esta activo, no se grabaran los moldes!!</div>
                          <?php } ?>                          
                    </div>                    
		</div>
        </div>    
   
	
    <h3>Datos Técnicos Materialidad <strong style="color: red;">(*)</strong></h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
		<select style="width: 400px;" name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
                <option value="">Seleccione.....</option>
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                if (sizeof($datos_cotizacion)>0) {  
                    switch($datos_cotizacion->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                else 
                {
                    switch($_POST["datos_tecnicos"])
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                foreach($datosTecnicos as $datosTecnico){
                    if (sizeof($datos_cotizacion)>0) {  ?>                
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos_tecnicos==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                    <?php } else { ?>
                    <option value="<?php echo $datosTecnico->id?>" <?php if(isset($_POST["datos_tecnicos"]) and $_POST["datos_tecnicos"]==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                    <?php }
                }
                ?>
                </select>
		</div>
	</div>
    
    <div id="materialidad">
    
          <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
                    <select name="materialidad_1" class="chosen-select" style="width: 400px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($datos_cotizacion)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($datos_cotizacion->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php //echo $tapa->nombre?>" <?php //if($datos_cotizacion->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>"<?php if($tapa->id==$_POST["materialidad_1"]){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php //echo $tapa->nombre?>"<?php //if($tapa->nombre==$_POST["materialidad_1"]){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php }
                    }
                    ?>
                </select>
    		</div>
    	</div>
        <?php 
            if (sizeof($datos_cotizacion)>0) {  
               if ($datos_cotizacion->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($datos_cotizacion->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            else
            {
               if ($_POST["datos_tecnicos"]==3) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                 
            }
        ?>
                <div class="control-group" id="div_materialidad_2" <?php echo $div_materialidad2; ?>>
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
                    <select name="materialidad_2" class="chosen-select" style="width: 400px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos_cotizacion)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($datos_cotizacion->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>"<?php if($tapa->id==$_POST["materialidad_2"]){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
        <?php 
            if (sizeof($datos_cotizacion)>0) {  
               if ($datos_cotizacion->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            else
            {
               if ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
        ?>        
                <div class="control-group" id="div_materialidad_3" <?php echo $div_materialidad3; ?>>
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
                    <select name="materialidad_3" class="chosen-select" style="width: 400px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos_cotizacion)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($datos_cotizacion->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>"<?php if($tapa->id==$_POST["materialidad_3"]){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>                    
                </select>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
        
        
        
    </div>
    
   <div class="control-group">
		<label class="control-label" for="usuario">Solicita Muestra (Maqueta)</label>
		<div class="controls">
		<select name="solicita_muestra" style="width: 100px;" onchange="detalleDeMuestra();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="SI" <?php if($datos_cotizacion->materialidad_solicita_muestra=="SI"){echo 'selected="true"';}?>>SI</option>
                        <option value="NO" <?php if($datos_cotizacion->materialidad_solicita_muestra=="NO"){echo 'selected="true"';}?>>NO</option>
                <?php } else {?>                    
                        <option value="SI" <?php if(isset($_POST["solicita_muestra"]) and $_POST["solicita_muestra"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php if(isset($_POST["solicita_muestra"]) and $_POST["solicita_muestra"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                <?php } ?>                   
            </select> 
		</div>
	</div>
    
    <div id="div_muestra" style="display: none;">
     <div class="control-group">
		<label class="control-label" for="usuario">Detalle de Muestra</label>
		<div class="controls">
                    <?php                      
                      if (sizeof($datos_cotizacion)>0) {  ?>  
			<textarea id="contenidos4" name="detalle_de_muestra" placeholder="Detalle de Muestra"><?php echo $datos_cotizacion->detalle_de_muestra;?></textarea>
                    <?php } else { ?>  
			<textarea id="contenidos4" name="detalle_de_muestra" placeholder="Detalle de Muestra"><?php echo $_POST["detalle_de_muestra"] ?></textarea>
                    <?php }  ?>                      
		</div>
	</div>
   </div>
    
    <h3>Impresión con Cambios</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
		<select name="colores" onchange="cromalin(this.value);">
                <option value="">Seleccione.....</option>
                <?php
                for($i=0;$i<9;$i++)
                { 
                    if (sizeof($datos_cotizacion)>0) {  ?>                
                        <option value="<?php echo $i?>" <?php if($datos_cotizacion->impresion_colores==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i?>" <?php if(isset($_POST["colores"]) and $_POST["colores"]==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                    <?php }
                }
                ?>
            </select><div id="notificacion_colores"></div>
		</div>
	</div>
    <div class="control-group">
        <label class="control-label" for="usuario">Tiene Algun Color Modificado<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="tiene_color_modificado">
            <option value="" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'');?>>Seleccione</option>
            <option value="NO" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'NO');?>>NO</option>
            <option value="SI" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'SI');?>>SI</option>
            </select>
        </div>
    </div>
    <div class="control-group" <?php if($fotomecanica->tiene_color_modificado<>'SI'){echo 'hidden=true'; }?> id="numero_color_modificado">
        <label class="control-label" for="usuario">Numero de Colores<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="numero_color_modificado">
            <option value="" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'');?>>Seleccione</option>
            <option value="1" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'1');?>>1</option>
            <option value="2" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'2');?>>2</option>
            <option value="3" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'3');?>>3</option>
            <option value="4" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'4');?>>4</option>
            <option value="5" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'5');?>>5</option>
            <option value="6" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'6');?>>6</option>
            </select>
        </div>
    </div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Metálicos o Fluor</label>
		<div class="controls">
		<select name="colores_metalicos" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php
                    for($i=0;$i<3;$i++)
                    { 
                        if (sizeof($datos_cotizacion)>0) {  ?>                
                            <option value="<?php echo $i?>" <?php if($datos_cotizacion->impresion_metalicos==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i?>" <?php if(isset($_POST["colores_metalicos"]) and $_POST["colores_metalicos"]==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                        <?php }
                    }
                ?>                
                </select>
		</div>
	</div>
    
 <div class="control-group">
		<label class="control-label" for="usuario">Tiene Fondo</label>
		<div class="controls">
		<select id="tiene_fondo" name="tiene_fondo" style="width: 100px;" onchange="llevaFondoCotizacion(this.value);" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                    <option value="">Seleccione</option>
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="SI" <?php if($datos_cotizacion->tiene_fondo=="SI"){echo 'selected="true"';}?>>SI</option>
                        <option value="NO" <?php if(($datos_cotizacion->tiene_fondo=="NO") or ($datos_cotizacion->tiene_fondo=="")){echo 'selected="true"';}?>>NO</option>
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["tiene_fondo"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["tiene_fondo"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>                       
            </select> 
        
		</div>
	</div>    
    
<!--        <div class="control-group">
		<label class="control-label" for="usuario">Imagen Impresión</label>
		<div class="controls">
		<select name="imagen_impresion" style="width: 100px;" onchange="msg_fondo();">
                    <option value="">Seleccione......</option>                            
                    <option value="Al CENTRO" <?php // if($ing->imagen_impresion=="Al CENTRO"){echo 'selected="selected"';}?>>Al CENTRO</option>
                    <option value="AL CORTE" <?php // if($ing->imagen_impresion=="AL CORTE"){echo 'selected="selected"';}?>>AL CORTE</option>
                    <option value="NO SE SABE" <?php // if($ing->imagen_impresion=="NO SE SABE"){echo 'selected="selected"';}?>>NO SE SABE</option>
                </select> 

		</div>
	</div>-->
   
        <div class="control-group"  <?php if(($datos_cotizacion->tiene_fondo=="NO") or ($datos_cotizacion->tiene_fondo=="")){echo 'style="display: block;"';} else {echo 'style="display: none;"';}?> id="fondo_select">
		<label class="control-label" for="usuario">Imagen de Impresión</label>
		<div class="controls">
                    <select id="proceso_fondo" name="proceso_fondo" style="width: 100px;" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                        <option value="">Seleccione.....</option>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="CO" <?php if($datos_cotizacion->proceso_fondo=="CO"){echo 'selected="true"';}?>>Al Corte</option>
                                <option value="CE" <?php if($datos_cotizacion->proceso_fondo=="CE"){echo 'selected="true"';}?>>Al Centro</option>
                                <option value="NO" <?php if($datos_cotizacion->proceso_fondo=="NO"){echo 'selected="true"';}?>>No se Sabe</option>                                
                        <?php } else {?>                    
                                <option value="CO" <?php if(($_POST["proceso_fondo"])=="CO"){echo 'selected="selected"';}?>>Al Corte</option>
                                <option value="CE" <?php if(($_POST["proceso_fondo"])=="CE"){echo 'selected="selected"';}?>>Al Centro</option>
                                <option value="NO" <?php if(($_POST["proceso_fondo"])=="NO"){echo 'selected="selected"';}?>>No se Sabe</option>
                        <?php } ?>                           

                    </select> 
                    <a onclick="ver_informacion('que_es_esto');">Que es esto?</a>
		</div>
	</div>    
        <div id="que_es_esto" name="que_es_esto" class="control-group" style="display:none;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="<?php echo base_url().$this->config->item('direccion_pdf')."que_es_esto.png" ?>" alt="Smiley face" height="60%" width="60%">

         </div>     
    
        <div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
		<select name="lleva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($datos_cotizacion->lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($datos_cotizacion->lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if($datos_cotizacion->lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre ImpresiÃ³n</option>                    
                                <option value="Laca UV" <?php if($datos_cotizacion->lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($datos_cotizacion->lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($datos_cotizacion->lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                    
                        <?php } else {?>                    
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if(($_POST["lleva_barniz"])=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if(($_POST["lleva_barniz"])=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if(($_POST["lleva_barniz"])=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre ImpresiÃ³n</option>
                                <option value="Laca UV" <?php if(($_POST["lleva_barniz"])=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>
                                <option value="No Se" <?php if(($_POST["lleva_barniz"])=="No Se"){echo 'selected="selected"';}?>>No SE</option>
                                <option value="Nada" <?php if(($_POST["lleva_barniz"])=="Nada"){echo 'selected="selected"';}?>>Nada</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group" id="reserva_barniz" <?php if($datos_cotizacion->reserva_barniz=="" || $datos_cotizacion->reserva_barniz=="NO" || $datos_cotizacion->reserva_barniz=="SI"){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Reserva</label>
		<div class="controls">
                    <select name="reserva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="Con Reserva" <?php if($datos_cotizacion->reserva_barniz=="Con Reserva"){echo 'selected="true"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if($datos_cotizacion->reserva_barniz=="Sin Reserva"){echo 'selected="true"';}?>>Sin Reserva</option>                    
                        <?php } else {?>                    
                                <option value="Con Reserva" <?php if(($_POST["reserva_barniz"])=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if(($_POST["reserva_barniz"])=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
                        <?php } ?>                        
            </select> 
    
		</div>
	</div>
<div class="control-group"  id="cala_caucho" <?php if($datos_cotizacion->cala_caucho==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Cala Caucho</label>
		<div class="controls">
		<select name="cala_caucho" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="Si" <?php if($datos_cotizacion->cala_caucho=="Si"){echo 'selected="true"';}?>>Si</option>
                                <option value="No" <?php if($datos_cotizacion->cala_caucho=="No"){echo 'selected="true"';}?>>No</option>                    
                        <?php } else {?>                    
                                <option value="Si" <?php if(($_POST["cala_caucho"])=="Si"){echo 'selected="selected"';}?>>Si</option>
                                <option value="No" <?php if(($_POST["cala_caucho"])=="No"){echo 'selected="selected"';}?>>No</option>
                        <?php } ?>                      
                </select> 
        
		</div>
	</div>
<!--        <div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
		<select name="lleva_barniz" style="width: 100px;">
                    <option value="">Seleccione.....</option>
                        <?php  //if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="NO" <?php //if($datos_cotizacion->lleva_barniz=="NO"){echo 'selected="true"';}?>>NO</option>
                                <option value="SI" <?php// if($datos_cotizacion->lleva_barniz=="SI"){echo 'selected="true"';}?>>SI</option>                    
                        <?php// } else {?>                    
                                <option value="NO" <?php// if(isset($_POST["lleva_barniz"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                                <option value="SI" <?php/// if(isset($_POST["lleva_barniz"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <?php //} ?>                        
            </select> 

		</div>
	</div>
    
    
        <div class="control-group" id="reserva_barniz" style="display: <?php// if($datos_cotizacion->impresion_acabado_impresion_1=='100'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Reserva Barniz</label>
		<div class="controls">
		<select name="reserva_barniz" style="width: 100px;">
                    <option value="">Seleccione.....</option>
                        <?php /// if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="NO" <?php //if($datos_cotizacion->reserva_barniz=="NO"){echo 'selected="true"';}?>>NO</option>
                                <option value="SI" <?php //if($datos_cotizacion->reserva_barniz=="SI"){echo 'selected="true"';}?>>SI</option>                    
                        <?php// } else {?>                    
                                <option value="NO" <?php //if(isset($_POST["reserva_barniz"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                                <option value="SI" <?php //if(isset($_POST["reserva_barniz"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <?php //} ?>                      
                </select> 
        
		</div>
	</div>-->

    
    <h3>Trabajos Internos</h3>    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
		<div class="controls">
		<select name="acabado_impresion_1" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php
                foreach($internos as $interno) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $interno->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_1==$interno->id){echo 'selected="true"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $interno->id?>" <?php if($interno->id==$_POST["acabado_impresion_1"]){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } ?>                    
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
		<select name="acabado_impresion_2" onchange="procesosInternos();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php
                foreach($internos as $interno) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $interno->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_2==$interno->id){echo 'selected="true"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $interno->id?>" <?php if($interno->id==$_POST["acabado_impresion_2"]){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } ?>                    
                <?php
                }
                ?>                
            </select>
            
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
		<select name="acabado_impresion_3" onchange="procesosInternos();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php
                foreach($internos as $interno) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $interno->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_3==$interno->id){echo 'selected="true"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $interno->id?>" <?php if($interno->id==$_POST["acabado_impresion_3"]){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                        <?php } ?>                    
                <?php
                }
                ?>   
                </select>
		</div>
	</div>
    
    <h3>Trabajos Externos</h3>    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
		<div class="controls">
		<select name="acabado_impresion_4" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                <?php
                foreach($externos as $externo) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $externo->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_4==$externo->id){echo 'selected="true"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $externo->id?>" <?php if($externo->id==$_POST["acabado_impresion_4"]){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } ?>                    
                <?php
                }
                ?>                  
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
		<select name="acabado_impresion_5" onchange="procesosExternos();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                    
                <?php
                foreach($externos as $externo) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $externo->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_5==$externo->id){echo 'selected="true"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $externo->id?>" <?php if($externo->id==$_POST["acabado_impresion_5"]){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } ?>                    
                <?php
                }
                ?>  
            </select>
            
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
		<select name="acabado_impresion_6" onchange="procesosExternos();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                    
                <?php
                foreach($externos as $externo) { ?>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="<?php echo $externo->id?>" <?php if($datos_cotizacion->impresion_acabado_impresion_6==$externo->id){echo 'selected="true"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } else {?>                    
                                <option value="<?php echo $externo->id?>" <?php if($externo->id==$_POST["acabado_impresion_6"]){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas.' - '.$externo->unv.' - '.$externo->valor_venta.'$' ?></option>
                        <?php } ?>                    
                <?php
                }
                ?>  
            </select>
            
		</div>
	</div>

    <!--
    <div class="control-group" >
		<label class="control-label" for="usuario">Hacer Cromalín</label>
		<div class="controls">
			<input type="checkbox" id="dir" name="hacer_cromalin" value="NO"/>
		</div>
	</div>
	-->
	
	<div class="control-group">
		<label class="control-label" for="usuario">Hacer Cromalín</label>
		<div class="controls">
                <select name="hacer_cromalin" style="width: 100px;" id="dir" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="NO" <?php if($datos_cotizacion->impresion_hacer_cromalin=="NO"){echo 'selected="true"';}?>>NO</option>
                                <option value="SI" <?php if($datos_cotizacion->impresion_hacer_cromalin=="SI"){echo 'selected="true"';}?>>SI</option>                    
                        <?php } else {?>                    
                                <option value="NO" <?php if(($_POST["hacer_cromalin"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                                <option value="SI" <?php if(($_POST["hacer_cromalin"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <?php } ?>                       
                </select>
		</div>
	</div>
    
    
     <!--/materialidad-->
     <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
                    <select name="folia" style="width: 100px;" onchange="cambiaFolia_Cotizacion(); cambiaFolia();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                        <?php
                        if(sizeof($datos_cotizacion)==0)
                        {
                            $procesos_especiales=$_POST["folia"];
                            ?>
                            <option value="NO" <?php if(($_POST["folia"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if(($_POST["folia"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                            <?php
                        }else
                        {
                            $procesos_especiales=$datos_cotizacion->procesos_especiales_folia;
                            ?>
                            <option value="NO" <?php if($datos_cotizacion->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($datos_cotizacion->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                            <?php            
                        }
                        ?>
                    </select> 
                    <span id="folia_se_a" style="display: <?php if($procesos_especiales=='SI'){echo 'block';}else{echo 'none';}?>;" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                    <select name="folia_se" id="folia_se">
                        <?php
                        if(sizeof($datos_cotizacion)==0)
                        {
                        ?>
                            <option value="Nuevo" <?php if(($_POST["folia_se"])=="NO"){echo 'selected="selected"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if(($_POST["folia_se"])=="SI"){echo 'selected="selected"';}?>>Repetición</option>                        
                        <?php
                        }else
                        {
                        ?>
                        <option value="Nuevo" <?php if($datos_cotizacion->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($datos_cotizacion->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                        <?php
                        }
                        ?>
                    </select>
                    </span><div id="folia1_proceso" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (golpe): &nbsp;</strong>                      
                        <select name="folia1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt1');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div><a id="pt1"></a><br>            
                    <div id="folia1_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm1');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div><a id="ptm1"></a>            
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
		<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2_Cotizacion(); cambiaFolia2();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <?php
                if(sizeof($datos_cotizacion)==0)
                {
                    $procesos_especiales2=$_POST["folia_2"];
                    ?>
                        <option value="NO" <?php if(($_POST["folia_2"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["folia_2"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales2=$datos_cotizacion->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($datos_cotizacion->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos_cotizacion->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                </select> 
                <span id="folia_se_2_a" style="display: <?php if($procesos_especiales2=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_2">
                <?php
                    if(sizeof($datos_cotizacion)==0)
                    {
                    ?>
                            <option value="Nuevo" <?php if(($_POST["folia_se_2"])=="NO"){echo 'selected="selected"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if(($_POST["folia_se_2"])=="SI"){echo 'selected="selected"';}?>>Repetición</option>                                            
                    <?php
                    }else
                    {
                    ?>
                    <option value="Nuevo" <?php if($datos_cotizacion->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos_cotizacion->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia2_proceso" style="display:<?php if($procesos_especiales2=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                   
                        <select name="folia2_proceso_seletec"  style="width: 500px;"  onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select><a id="pt2"></a></div><br>
                    <div id="folia2_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div><a id="ptm2"></a>            
		</div>                
	</div>
    
    <div class="control-group">
            <label class="control-label" for="usuario">Folia 3</label>
            <div class="controls">
		<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3_Cotizacion(); cambiaFolia3();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <?php
                if(sizeof($datos_cotizacion)==0)
                {
                    $procesos_especiales3=$_POST["folia_3"];
                ?>
                    <option value="NO" <?php if(($_POST["folia_3"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <option value="SI" <?php if(($_POST["folia_3"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales3=$datos_cotizacion->procesos_especiales_folia_3;
                ?>
                    <option value="NO" <?php if($datos_cotizacion->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos_cotizacion->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                </select> 
                <span id="folia_se_3_a" style="display: <?php if($procesos_especiales3=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_3">
                <?php
                    if(sizeof($datos)==0)
                    {
                    ?>
                        <option value="Nuevo" <?php if(($_POST["folia_se_3_a"])=="NO"){echo 'selected="selected"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if(($_POST["folia_se_3_a"])=="SI"){echo 'selected="selected"';}?>>Repetición</option>                                            
                    <?php
                    }else
                    {
                    ?>
                    <option value="Nuevo" <?php if($datos_cotizacion->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos_cotizacion->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia3_proceso" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="folia3_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select><a id="pt3"></a></div><br>
                    <div id="folia3_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia3_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div><a id="ptm3"></a>            
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
		<select name="cuno" style="width: 100px;" onchange="cambiaCuno_Cotizacion();cambiaCuno();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <?php
                if(sizeof($datos_cotizacion)==0)
                {
                $procesos_especiales4=$_POST["cuno"];                    
                ?>
                    <option value="NO" <?php if(($_POST["cuno"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <option value="SI" <?php if(($_POST["cuno"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales4=$datos_cotizacion->procesos_especiales_cuno;
                ?>
                <option value="NO" <?php if($datos_cotizacion->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($datos_cotizacion->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_a" style="display: <?php if($procesos_especiales4=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se">
                <?php
                if(sizeof($datos_cotizacion)==0)
                {
                ?>
                        <option value="Nuevo" <?php if(($_POST["cuno_se"])=="NO"){echo 'selected="selected"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if(($_POST["cuno_se"])=="SI"){echo 'selected="selected"';}?>>Repetición</option>                                            
                <?php
                }else
                {
                ?>
                    
                <option value="Nuevo" <?php if($datos_cotizacion->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos_cotizacion->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno1_proceso" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                        
                        <select name="cuno1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($datos)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt4"></a>            
                    </div><br>
                    <div id="cuno1_molde_selected" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($datos)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm4"></a>            
                    </div>
                 
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
		<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2_Cotizacion(); cambiaCuno2();" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <?php
                if(sizeof($datos_cotizacion)==0)
                {
                    $procesos_especiales5=$_POST["cuno_2"];
                    ?>
                    <option value="NO" <?php if(($_POST["cuno_2"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <option value="SI" <?php if(($_POST["cuno_2"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales5=$datos_cotizacion->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($datos_cotizacion->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos_cotizacion->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_2_a" style="display: <?php if($procesos_especiales5=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se_2">
            <?php
                if(sizeof($datos_cotizacion)==0)
                {
                ?>
                        <option value="Nuevo" <?php if(($_POST["cuno_se_2"])=="NO"){echo 'selected="selected"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if(($_POST["cuno_se_2"])=="SI"){echo 'selected="selected"';}?>>Repetición</option>                                            
                <?php
                }else
                {
                ?>
                <option value="Nuevo" <?php if($datos_cotizacion->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos_cotizacion->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno2_proceso" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="cuno2_proceso_seletec" style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($datos)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt5"></a>            
                    </div><br>
                    <div id="cuno2_molde_selected" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($datos)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm5"></a>            
                    </div>
                 
		</div>
	</div>
    
    <h3>Instrucciones de Terminación</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Producto se entrega armado</label>
		<div class="controls">
            <select name="producto_se_entrega_armado" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>  
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="NO" <?php if($datos_cotizacion->producto_se_entrega_armado=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos_cotizacion->producto_se_entrega_armado=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["producto_se_entrega_armado"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["producto_se_entrega_armado"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>                     
            </select>
        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tiene desgajado especial ( Pieza chica )</label>
		<div class="controls">
            <select name="tiene_desgajado" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>        
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="NO" <?php if($datos_cotizacion->tiene_desgajado=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos_cotizacion->tiene_desgajado=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["tiene_desgajado"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["tiene_desgajado"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>                  
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Montaje Pieza Especial</label>
		<div class="controls">
                    <select name="montaje_pieza_especial" onchange="mostrarTextoPiezaEspecial(this.value,'mostrar_texto_pieza_especial');" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                        <option value="">Seleccione.....</option>                
                        <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                                <option value="NO" <?php if($datos_cotizacion->montaje_pieza_especial=="NO"){echo 'selected="true"';}?>>NO</option>
                                <option value="SI" <?php if($datos_cotizacion->montaje_pieza_especial=="SI"){echo 'selected="true"';}?>>SI</option>                    
                        <?php } else {?>                    
                                <option value="NO" <?php if(($_POST["montaje_pieza_especial"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                                <option value="SI" <?php if(($_POST["montaje_pieza_especial"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <?php } ?>   
                    </select>
                    <br />
                    <div id="mostrar_texto_pieza_especial" style="display: <?php if($datos_cotizacion->comentarios_montaje_pieza_especial==''){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" id="comentarios_montaje_pieza_especial" name="comentarios_montaje_pieza_especial" value="<?php echo $datos_cotizacion->comentarios_montaje_pieza_especial?>" />
                    </div>
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Instrucciones para la terminación y pegado</label>
		<div class="controls">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
			<textarea id="pegado_instrucciones" name="pegado_instrucciones" onkeypress="nextOnEnter(this,event);"  placeholder="Observaciones"><?php echo $datos_cotizacion->pegado_instrucciones; ?></textarea>
                <?php } else {?>                    
			<textarea id="pegado_instrucciones" name="pegado_instrucciones" onkeypress="nextOnEnter(this,event);"  placeholder="Observaciones"><?php echo $_POST["pegado_instrucciones"]; ?></textarea>
                <?php } ?>                       
		</div>
	</div>
    
    <div class="control-group" style="display:none;">
		<label class="control-label" for="usuario">Empaquetar</label>
		<div class="controls">
            <select name="cantidad_especifica_sino" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="NO" <?php if($datos_cotizacion->cantidad_especifica_sino=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos_cotizacion->cantidad_especifica_sino=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["cantidad_especifica_sino"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["cantidad_especifica_sino"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>   
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica</label>
		<div class="controls">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <input type="text" readonly="readonly" value="<?php echo $datos_cotizacion->cantidad_especifica?>" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" placeholder="0" onblur="invalidarCheck();"/><br>
                <?php } else {?>                    
                    <input type="text" readonly="readonly" value="<?php echo $_POST["cantidad_especifica"]?>" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" placeholder="0" onblur="invalidarCheck();"/><br>
                <?php } ?>       
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <input readonly="readonly" <?php if($datos_cotizacion->cantidad_especifica==0) echo "checked" ?> onClick="if(this.checked == true){invalidarCantidadaEmpaquetar();}" type="checkbox"  id="cantidad_a_empaquetar_a_criterio" name="cantidad_a_empaquetar_a_criterio" value="cantidad_a_empaquetar_a_criterio">Cantidad a Empaquetar a Criterio de Empresa
                <?php } else {?>                    
                    <input readonly="readonly" <?php if($_POST["cantidad_especifica"]==0) echo "checked" ?> onClick="if(this.checked == true){invalidarCantidadaEmpaquetar();}" type="checkbox"  id="cantidad_a_empaquetar_a_criterio" name="cantidad_a_empaquetar_a_criterio" value="cantidad_a_empaquetar_a_criterio">Cantidad a Empaquetar a Criterio de Empresa
                <?php } ?>                       
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Envasado</label>
		<div class="controls">
            <select name="envasado" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <option value="">Seleccione.....</option>                
                    <option value="Paletizado" <?php if($datos_cotizacion->envasado=="Paletizado"){echo 'selected="true"';}?>>Paletizado</option>
                    <option value="Paquetes" <?php if($datos_cotizacion->envasado=="Paquetes"){echo 'selected="true"';}?>>Paquetes</option>
                    <option value="Cartón Corrugado" <?php if($datos_cotizacion->envasado=="Cartón Corrugado"){echo 'selected="true"';}?>>Cartón Corrugado</option>                
                <?php } else {?>                    
                    <option value="" <?php if(($_POST["envasado"])==""){echo 'selected="selected"';}?>>Seleccione.....</option>                
                    <option value="Paletizado" <?php if(($_POST["envasado"])=="Paletizado"){echo 'selected="selected"';}?> >Paletizado</option>
                    <option value="Paquetes" <?php if(($_POST["envasado"])=="Paquetes"){echo 'selected="selected"';}?>>Paquetes</option>
                    <option value="Cartón Corrugado" <?php if(($_POST["envasado"])=="Cartón Corrugado"){echo 'selected="selected"';}?>>Cartón Corrugado</option>
                <?php } ?>                   

            </select>
        
		</div>
	</div>
    
    <h3>Detalles de Despacho</h3>
    
      
      <div class="control-group">
		<label class="control-label" for="usuario">Despacho Fuera de Santiago</label>
		<div class="controls">
            <select name="despacho_fuera_de_santiago" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="NO" <?php if($datos_cotizacion->despacho_fuera_de_santiago=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos_cotizacion->despacho_fuera_de_santiago=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["despacho_fuera_de_santiago"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["despacho_fuera_de_santiago"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>   
            </select>
        
		</div>
	</div>
      
      <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <option value="NO" <?php if($datos_cotizacion->retira_cliente=="NO"){echo 'selected="true"';}?>>SI, Retira Cliente</option>
                    <option value="SI" <?php if($datos_cotizacion->retira_cliente=="SI"){echo 'selected="true"';}?>>Despacho Empresa</option>                    
                <?php } else {?>                    
                    <option value="SI" <?php if($_POST["retira_cliente"]=="SI"){echo 'selected="true"';}?>>SI, Retira Cliente</option>
                    <option value="NO" <?php if($_POST["retira_cliente"]=="NO"){echo 'selected="true"';}?>>Despacho Empresa</option>
                <?php } ?>                  
            </select>
        
		</div>
	</div>
    

    
      <div class="control-group">
		<label class="control-label"  for="usuario">Total o Parcial</label>
		<div class="controls">
                <select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>       
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <option value="Total" <?php if($datos_cotizacion->tota_o_parcial=="Total"){echo 'selected="true"';}?>>Total</option>
                    <option value="Parcial" <?php if($datos_cotizacion->tota_o_parcial=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
                    <option value="despachos semanales" <?php if($datos_cotizacion->tota_o_parcial=="despachos semanales"){echo 'selected="true"';}?>>despachos semanales</option>
                    <option value="despachos mensuales" <?php if($datos_cotizacion->tota_o_parcial=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                    <option value="despachos bimensuales" <?php if($datos_cotizacion->tota_o_parcial=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>
                    <!--<option value="despachos trimestrales" <?php// if($datos_cotizacion->tota_o_parcial=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>-->                        
                <?php } else {?>                    
                    <option value="Total" <?php if($_POST["tota_o_parcial"]=="Total"){echo 'selected="true"';}?>>Total</option>
                    <option value="Parcial" <?php if($_POST["tota_o_parcial"]=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
                    <option value="despachos semanales" <?php if($_POST["tota_o_parcial"]=="despachos semanales"){echo 'selected="true"';}?>>despachos semanales</option>
                    <option value="despachos mensuales" <?php if($_POST["tota_o_parcial"]=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                    <option value="despachos bimensuales" <?php if($_POST["tota_o_parcial"]=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>
                    <!--<option value="despachos trimestrales" <?php// if($_POST["tota_o_parcial"]=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>-->
                <?php } ?>                     

            </select>
        
		</div>
	</div>
    
       <div class="control-group" id="producto">
           <div id="cantidadesDespacho" style="display: none;">
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <input readonly="readonly" type="text" value="<?php echo $datos_cotizacion->can_despacho_1?>" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $datos_cotizacion->can_despacho_2?>" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $datos_cotizacion->can_despacho_3?>" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" />
                <?php } else {?>                    
                    <input readonly="readonly" type="text" value="<?php echo $_POST["can_despacho_1"]?>" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $_POST["can_despacho_2"]?>" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input value="<?php echo $_POST["can_despacho_3"]?>" type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" />
                <?php } ?>                       
                </div>
                </div>
        </div>
    <h3>Comercial</h3>

     <div class="control-group">
         <div id="sub_forma_pago">
		<label class="control-label" for="usuario" >Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls" >
                    <select name="forma_pago" class="chosen-select" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->clientes_model->getFormasPago();
                            $cliente_forma_pago_id=$this->clientes_model->getClientePorIdBasico($datos_cotizacion->id_cliente);
                            foreach($formas as $forma)
                            {
                                if ($cliente_forma_pago_id->id_forma_pago>0) {   ?>
                                    <option value="<?php echo $forma->id; ?>" <?php if($cliente_forma_pago_id->id_forma_pago==$forma->id){echo 'selected="true"';}?>><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago; ?></option>
                                <?php } else {?>                                      
                                    <option value="<?php echo $forma->id; ?>" <?php if($_POST["forma_pago"]==$forma->id){echo 'selected="selected"';}?>><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago; ?></option>
                                <?php } 
                            }
                            ?>
                       </select>
		</div>
	</div>                
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comisión Agencia</label>
		<div class="controls">
            <select name="comision_agencia" onfocus="t=this.innerHTML;if(window.ActiveXObject)o=this.outerHTML;this.blur()" onchange="this.innerHTML=t;if(window.ActiveXObject)this.outerHTML=o">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <option value="NO" <?php if($datos_cotizacion->comision_agencia=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos_cotizacion->comision_agencia=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["comision_agencia"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["comision_agencia"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>   
            </select>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costo Comercial %</label>
		<div class="controls">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                    <input readonly="readonly" type="text" value="<?php echo $datos_cotizacion->costo_comercial?>" name="costo_comercial" id="costo_comercial"  onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" />
                <?php } else {?>                    
                    <input type="text" readonly="readonly" value="<?php echo $_POST["costo_comercial"]?>" name="costo_comercial" id="costo_comercial"  onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" />
                <?php } ?>                 
        
		</div>
	</div>
	
	    <h3>Cliente Entrega</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Cliente Entrega</label>
		<div class="controls">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
                        <?php  if ($datos_cotizacion->cliente_entrega_1!=null) {  $chequeado_entrega_1='checked="true"'; } else { $chequeado_entrega_1=''; } ?>
                           <input type="checkbox" <?php echo $chequeado_entrega_1; ?> id="cliente_entrega_1" onclick="ver_archivo_cliente();" name="cliente_entrega_1" value="Información Digital">Información Digital<br>
                        <?php  if (($datos_cotizacion->cliente_entrega_2!='') or ($datos_cotizacion->cliente_entrega_2!=null)) {  $chequeado_entrega_2='checked="true"'; } else { $chequeado_entrega_2=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_2; ?> name="cliente_entrega_2" value="Muestra de Color">Muestra de Color<br>
                        <?php  if (($datos_cotizacion->cliente_entrega_3!='') or ($datos_cotizacion->cliente_entrega_3!=null)) {  $chequeado_entrega_3='checked="true"'; } else { $chequeado_entrega_3=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_3; ?> name="cliente_entrega_3" value="Producto a Contener">Producto a Contener<br>
                        <?php  if (($datos_cotizacion->cliente_entrega_4!='') or ($datos_cotizacion->cliente_entrega_4!=null)) {  $chequeado_entrega_4='checked="true"'; } else { $chequeado_entrega_4=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_4; ?>  name="cliente_entrega_4" value="Muestra Producto a Fabricar">Muestra Producto a Fabricar<br>
                        <?php  if (($datos_cotizacion->cliente_entrega_7!='') or ($datos_cotizacion->cliente_entrega_7!=null)) {  $chequeado_entrega_7='checked="true"'; } else { $chequeado_entrega_7=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_7; ?>  name="cliente_entrega_7" value="Ficha Tecnica de Producto a Contener">Ficha Tecnica de Producto a Contener<br>
                        <?php  if (($datos_cotizacion->cliente_entrega_6!='') or ($datos_cotizacion->cliente_entrega_6!=null)) {  $chequeado_entrega_6='checked="true"'; } else { $chequeado_entrega_6=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_6; ?>   name="cliente_entrega_6" value="Nada">Nada<br>
                            Otro: <input readonly="readonly" type="text" value="<?php echo $datos_cotizacion->cliente_entrega_5; ?>" name="cliente_entrega_5" />                    
                <?php } else {?>                    
                        <?php  if ($_POST["cliente_entrega_1"]!=null) {  $chequeado_entrega_1='checked="true"'; } else { $chequeado_entrega_1=''; } ?>
                           <input type="checkbox" <?php echo $chequeado_entrega_1; ?> id="cliente_entrega_1" onclick="ver_archivo_cliente();" name="cliente_entrega_1" value="Información Digital">Información Digital<br>
                        <?php  if (($_POST["cliente_entrega_2"]!='') or ($_POST["cliente_entrega_2"]!=null)) {  $chequeado_entrega_2='checked="true"'; } else { $chequeado_entrega_2=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_2; ?> name="cliente_entrega_2" value="Muestra de Color">Muestra de Color<br>
                        <?php  if (($_POST["cliente_entrega_3"]!='') or ($_POST["cliente_entrega_3"]!=null)) {  $chequeado_entrega_3='checked="true"'; } else { $chequeado_entrega_3=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_3; ?> name="cliente_entrega_3" value="Producto a Contener">Producto a Contener<br>
                        <?php  if (($_POST["cliente_entrega_4"]!='') or ($_POST["cliente_entrega_4"]!=null)) {  $chequeado_entrega_4='checked="true"'; } else { $chequeado_entrega_4=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_4; ?>  name="cliente_entrega_4" value="Muestra Producto a Fabricar">Muestra Producto a Fabricar<br>
                        <?php  if (($_POST["cliente_entrega_7"]!='') or ($_POST["cliente_entrega_7"]!=null)) {  $chequeado_entrega_7='checked="true"'; } else { $chequeado_entrega_7=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_7; ?>  name="cliente_entrega_7" value="Ficha Tecnica de Producto a Contener">Ficha Tecnica de Producto a Contener<br>
                        <?php  if (($_POST["cliente_entrega_6"]!='') or ($_POST["cliente_entrega_6"]!=null)) {  $chequeado_entrega_6='checked="true"'; } else { $chequeado_entrega_6=''; } ?>
                            <input type="checkbox" <?php echo $chequeado_entrega_6; ?>   name="cliente_entrega_6" value="Nada">Nada<br>
                            Otro: <input readonly="readonly" type="text" value="<?php echo $_POST["cliente_entrega_5"]; ?>" name="cliente_entrega_5" />  
                <?php } ?>              

                        
                        
			
			
			
		</div>
	</div>
            
        <div id="archivo_cliente" <?php  if (($_POST["cliente_entrega_1"]==null) or ($datos_cotizacion->cliente_entrega_1!=null)) { ?> style="display:none;" <?php } ?>>            
                <h3>Ingrese archivo de: Información Digital (Cliente)</h3>
                <div class="control-group">
                        <label class="control-label" for="usuario">Información Digital</label>
                        <div class="controls">
                            <input type="file" id="file" name="file" /><strong> Debe ser archivos Tipo PDF </strong>
                                <div id="nomarch"></div>
                        </div>
                </div>	            
        </div>    
    
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
                <?php  if (sizeof($datos_cotizacion)>0) {   ?>
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo $datos_cotizacion->costo_comercial; ?></textarea>
                <?php } else {?>                    
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo set_value('glosa'); ?></textarea>
                <?php } ?>                       
		</div>
	</div>
    
    <div class="control-group">
		<div class="form-actions">
                 <input type="hidden" name="precio_migrado" value="<?php echo $datos_cotizacion->precio_migrado; ?>" />             
                 <input type="hidden" name="estado" value="<?php if($datos_cotizacion->estado=='') echo 0; else echo $datos_cotizacion->estado; ?>" />             
		 <input type="submit" onclick="cambiar_estado_cotizacion('0');" value="Guardar" class="btn <?php if($datos_cotizacion->estado==0){echo 'btn-warning';}?>"/>
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
<script>
    $(document).ready(function(){
           var valorOption=$("select[name=lleva_barniz]").val();
           var valorOption2=$("select[name=reserva_barniz]").val();
        if(valorOption!="" && valorOption!='Nada' && valorOption!='No Se'){
            $("#reserva_barniz").show();
        }
        if(valorOption2!="" && valorOption2!='Sin Reserva'){
            $("#cala_caucho").show();
        }
        
    });
    </script>
