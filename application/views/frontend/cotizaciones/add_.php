<?php $this->layout->element('admin_mensaje_validacion'); ?>



<div id="contenidos">


<?php echo form_open_multipart(null, array('onsubmit'=>'verificaCampos()','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Solicitud de Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Solicitud de Cotización </h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="cliente" onchange="BuscarMoldesRegistradosCliente(this.value,'molde_select_cliente');BuscarFormaPagoCliente(this.value,'sub_forma_pago');BuscarBuscarVendedorCliente(this.value,'sub_vendedor');" class="chosen-select" style="width: 500px;">
                        <option value="0">Seleccione.....</option>
                        <?php
                        $clientes=$this->clientes_model->getClientesNormalTodo();
                        foreach($clientes as $cliente)
                        { ?>
                            <option value="<?php echo $cliente->id?>" <?php if(isset($_POST["cliente"]) and $_POST["cliente"]==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?> <?php if($cliente->estado==2){echo '(BLOQUEADO)';} if($cliente->id_region==0){echo '( Info. Incompleta)';}?></option>
                        <?php } ?>
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
                    if($this->session->userdata('perfil')==1) { ?>
                        <option value="0">Seleccione.....</option>
                        <?php foreach($vendedores as $vendedor) { ?>
                            <option value="<?php echo $vendedor->id?>" <?php if($vendedor->nombre=="OFICINA"){echo 'selected="selected"';}?>  ><?php echo $vendedor->nombre?></option>
                        <?php  } 
                    }else
                    { ?>
                            <option value="<?php echo $this->session->userdata('id')?>"><?php echo $this->session->userdata('nombre')?></option>
                    <?php } ?>
                </select>
		</div>
        </div>            
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
                    <select name="condicion_del_producto" onchange="llamarDetalleCondicion(this.value);condicionParaMoldes(this.value);llamarlink(this.value);">
                            <option value="0" <?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="0"){echo 'selected="true"';}?> style="font-weight:bold">Nuevo</option>
                            <option value="1"<?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="1"){echo 'selected="true"';}?>>Buscar Repetición?</option>
                     <!--   <option value="2"<?php //if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="2"){echo 'selected="true"';}?>>Repetición Con Cambios</option> -->
                            <option value="3"<?php if(isset($_POST["condicion_del_producto"]) and $_POST["condicion_del_producto"]=="3"){echo 'selected="true"';}?>>Producto Genérico</option>
                    </select>
		</div>
    </div>
    
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
			<input style="width: 500px;" type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo set_value("producto")?>"  onblur="ValidarNombreProducto();"/><input type="hidden" name="producto_id" value="0" />
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Cotizar <strong style="color: red;">(*)</strong></label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
			<input type="text" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo set_value("can1")?>" /> - <input type="text" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo set_value("can2")?>" /> - <input type="text" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo set_value("can3")?>" /> - <input type="text" value="0" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo set_value("can4")?>" />
		</div>
	</div>
    
   
    
     <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
			<select name="acepta_excedentes" style="width: 100px;" onchange="aceptaExcedentes();">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select> 
            <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span>
            <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" />
            
        
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Visto Bueno <strong>(VB)</strong> en Maquina</label>
		<div class="controls">
			<select name="vb_maquina" style="width: 100px;" onchange="aceptaExcedentes123();">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select> 
           <!-- <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span> -->
           <!-- <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" /> -->
            
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Generales</label>
		<div class="controls">
			<textarea id="contenido4s" name="obs" placeholder="Observaciones"><?php if(isset($_POST["obs"])){echo $_POST["obs"];}?></textarea>
		</div>
	</div>
    
    <h3>Piezas Adicionales</h3>
   
   
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<select name="piezas_adicionales" class="chosen-select">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales=="No lleva"){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2 </label>
		<div class="controls">
			<select name="piezas_adicionales2" class="chosen-select">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales=="No lleva"){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
			<select name="piezas_adicionales3" class="chosen-select">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales=="No lleva"){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php if(isset($_POST["comentario_piezas_adicionales"])){echo $_POST["comentario_piezas_adicionales"];}?></textarea>
		</div>
	</div>
    
    
    <div id="referencia">
        
    </div>
    
        <div class="control-group" id="div_estan_los_moldes" style="display: block;">
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			<!--<select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
			<select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);">
                        <option value="NO" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                        <option value="NO LLEVA" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='NO LLEVA'){echo 'selected="selected"';}?>>NO LLEVA</option>
                        <option value="CLIENTE LO APORTA" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='CLIENTE LO APORTA'){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
			<option value="MOLDE GENERICO" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='MOLDE GENERICO'){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
			<option value="MOLDE REGISTRADOS DEL CLIENTE" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='MOLDE DEL CLIENTE'){echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
            </select> 
		</div>
	</div>
	
	<div class="control-group" id="div_estan_los_moldes_generico" style="display: none;">
		<label class="control-label" for="usuario">Moldes Genéricos</label>
		<div class="controls">
                    <!--<select name="select_estan_los_moldes_genericos" style="width: 100px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
			<select name="select_estan_los_moldes_genericos" style="width: 300px;" onchange="estanLosMoldes(this.value);">
                        <option value="SI" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    </select> 
                    <div id="molde_select">
                          <select name="molde" id="molde" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')";>
                              <?php
                              $moldes=$this->moldes_model->getMoldes2();
                              foreach($moldes as $molde)
                              {
                                  ?>
                                  <option value="<?php echo $molde->id?>" <?php if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                  <?php
                              }
                              ?>
                          </select> 
                          <span id="div_moldes"></span>
                    </div>
		</div>
        </div>
    
    
	<div class="control-group" id="div_estan_los_moldes_clientes" style="display: none;">
		<label class="control-label" for="usuario">Moldes del Cliente</label>
		<div class="controls">
                    <!--<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 100px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">-->
			<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 300px;" onchange="estanLosMoldes(this.value);">
                        <option value="SI" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php if(isset($_POST["estan_los_moldes"]) and $_POST["estan_los_moldes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    </select> 
                    <div id="molde_select_cliente">
                          <select name="molde" id="molde" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')";>
                            <option value="0">Seleccione......</option>
                              <?php
                              $moldes=$this->moldes_model->getMoldes2();
                              foreach($moldes as $molde)
                              {
                                  ?>
                                  <option value="<?php echo $molde->id?>" <?php if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                  <?php
                              }
                              ?>
                          </select> 
                          <span id="div_moldes2"></span>
                    </div>                    
		</div>
        </div>    
   
	
    <h3>Materialidad <strong style="color: red;">(*)</strong></h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
			<select style="width: 400px;" name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                foreach($datosTecnicos as $datosTecnico)
                {
                    ?>
                    <option value="<?php echo $datosTecnico->id?>" <?php if(isset($_POST["datos_tecnicos"]) and $_POST["datos_tecnicos"]==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div id="materialidad">
    
          <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
					$tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
					$tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
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
				<select name="solicita_muestra" style="width: 100px;" onchange="detalleDeMuestra();">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
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
			<select name="colores" onchange="cromalin(this.value);" >
                <?php
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if(isset($_POST["colores"]) and $_POST["colores"]==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select><div id="notificacion_colores"></div>
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
                    <option value="<?php echo $i?>" <?php if(isset($_POST["colores_metalicos"]) and $_POST["colores_metalicos"]==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
		</div>
	</div>
    
 <div class="control-group">
		<label class="control-label" for="usuario">Tiene Fondo</label>
		<div class="controls">
		<select id="tiene_fondo" name="tiene_fondo" style="width: 100px;" onchange="llevaFondoCotizacion(this.value);">
                    <option value="">Seleccione</option>
                    <option value="NO" <?php if(isset($_POST["tiene_fondo"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <option value="SI" <?php if(isset($_POST["tiene_fondo"])=="SI"){echo 'selected="selected"';}?>>SI</option>
            </select> 
        
		</div>
	</div>    
    
 <div class="control-group" style="display: none;" id="fondo_select">
		<label class="control-label" for="usuario">Imagen de Impresión</label>
		<div class="controls">
		<select id="proceso_fondo" name="proceso_fondo" style="width: 100px;">
                <option value="CO" <?php if(isset($_POST["proceso_fondo"])=="CO"){echo 'selected="selected"';}?>>Al Corte</option>
                <option value="CE" <?php if(isset($_POST["proceso_fondo"])=="CE"){echo 'selected="selected"';}?>>Al Centro</option>
                <option value="NO" <?php if(isset($_POST["proceso_fondo"])=="NO"){echo 'selected="selected"';}?>>No se Sabe</option>
            </select> 
        
		</div>
	</div>     
    

 <div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
		<select name="lleva_barniz" style="width: 100px;">
                <option value="NO" <?php if(isset($_POST["lleva_barniz"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if(isset($_POST["lleva_barniz"])=="SI"){echo 'selected="selected"';}?>>SI</option>
            </select> 
        
		</div>
	</div>
    
    
    <div class="control-group" id="reserva_barniz" style="display: <?php if($fotomecanica->acabado_impresion_1=='100'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Reserva Barniz</label>
		<div class="controls">
			<select name="reserva_barniz" style="width: 100px;">
                <option value="SI" <?php if(isset($_POST["lleva_barniz"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if(isset($_POST["lleva_barniz"])=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
        
		</div>
	</div>

    
    <h3>Trabsjos Internos</h3>    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
		<div class="controls">
			<select name="acabado_impresion_1">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($interno->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
			<select name="acabado_impresion_2" onchange="procesosInternos();">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($interno->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
			<select name="acabado_impresion_3" onchange="procesosInternos();">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($interno->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
    
    <h3>Trabsjos Externos</h3>    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
		<div class="controls">
			<select name="acabado_impresion_4">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($externo->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
			<select name="acabado_impresion_5" onchange="procesosExternos();">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($externo->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
			<select name="acabado_impresion_6" onchange="procesosExternos();">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($externo->caracteristicas=="No Lleva"){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
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
            <select name="hacer_cromalin" style="width: 100px;" id="dir">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">No</option>
            </select>
		</div>
	</div>
    
    <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
			<select name="folia" style="width: 100px;" onchange="cambiaFolia();">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
            <span id="folia_se_a" style="display: none;">
            <select name="folia_se">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
            </select>
            </span>
            <span id="folia_se_b" style="display: block;">
                <input type="text" name="folia_se" value="No Lleva" readonly="true" />
            </span>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
			<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2();">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
           <span id="folia_se_2_a" style="display: none;">
            <select name="folia_se_2">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
            </select>
            </span>
            <span id="folia_se_2_b" style="display: block;">
                <input type="text" name="folia_se_2" value="No Lleva" readonly="true" />
            </span>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Folia 3</label>
		<div class="controls">
			<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3();">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
            <span id="folia_se_3_a" style="display: none;">
            <select name="folia_se_3">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
            </select>
            </span>
            <span id="folia_se_3_b" style="display: block;">
                <input type="text" name="folia_se_3" value="No Lleva" readonly="true" />
            </span>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;" onchange="cambiaCuno();">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
            <span id="cuno_se_a" style="display: none;">
            <select name="cuno_se">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
            </select>
            </span>
            <span id="cuno_se_b" style="display: block;">
                <input type="text" name="cuno_se" value="No Lleva" readonly="true" />
            </span>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
			<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2();">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
            
            <span id="cuno_se_2_a" style="display: none;">
            <select name="cuno_se_2">
                <option value="Nuevo">Nuevo</option>
                <option value="Repetición">Repetición</option>
            </select>
            </span>
            <span id="cuno_se_2_b" style="display: block;">
                <input type="text" name="cuno_se_2" value="No Lleva" readonly="true" />
            </span>
		</div>
	</div>
    
    <h3>Instrucciones de Terminación</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Producto se entrega armado</label>
		<div class="controls">
            <select name="producto_se_entrega_armado">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">No</option>
            </select>
        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tiene desgajado especial ( Pieza chica )</label>
		<div class="controls">
            <select name="tiene_desgajado">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">No</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Montaje Pieza Especial</label>
		<div class="controls">
            <select name="montaje_pieza_especial">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">No</option>
            </select>
            <br />
            <input type="text" onkeypress="nextOnEnter(this,event);" />
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Instrucciones para la terminación y pegado</label>
		<div class="controls">
			<textarea id="contenido6" name="pegado_instrucciones" onkeypress="nextOnEnter(this,event);"  placeholder="Observaciones"><?php echo set_value('obs'); ?></textarea>
		</div>
	</div>
    
    <div class="control-group" style="display:none;">
		<label class="control-label" for="usuario">Empaquetar</label>
		<div class="controls">
            <select name="cantidad_especifica_sino">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica</label>
		<div class="controls"><!--onkeypress="nextOnEnter(this,event);" -->
            
        <input type="text" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" placeholder="0" /><br>
        <input type="checkbox" name="cantidad_a_empaquetar_a_criterio" value="cantidad_a_empaquetar_a_criterio">Cantidad a Empaquetar a Criterio de Empresa
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
                <option value="NO" selected="selected">NO</option>
            </select>
        
		</div>
	</div>
      
      <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente">
                <option value="SI">SI, Retira Cliente</option>
                <option value="NO" selected="selected">Despacho Empresa</option>
            </select>
        
		</div>
	</div>
    

    
      <div class="control-group">
		<label class="control-label"  for="usuario">Total o Parcial</label>
		<div class="controls">
                    <select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')">
                <option value="Total" selected="selected">Total</option>
                <option value="Parcial">Parcial</option>
                <option value="despachos semanales">despachos semanales</option>
                <option value="despachos mensuales">despachos mensuales</option>
                <option value="despachos bimensuales">despachos bimensuales</option>
                <option value="despachos trimestrales">despachos trimestrales</option>
            </select>
        
		</div>
	</div>
    
       <div class="control-group" id="producto">
           <div id="cantidadesDespacho" style="display: none;">
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                    
			<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" />
                </div>
                </div>
        </div>
    <h3>Comercial</h3>
    
     <div class="control-group">
         <div id="sub_forma_pago">
		<label class="control-label" for="usuario" >Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls" >
			<select name="forma_pago">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->clientes_model->getFormasPago();
                            $cliente_forma_pago_id=$this->clientes_model->getClientePorIdBasico($cliente->id);
                            foreach($formas as $forma)
                            {
                                ?>
                                <option value="<?php echo $forma->id; ?>" <?php if($cliente_forma_pago_id->id_forma_pago==$forma->id){echo 'selected="selected"';}?>><?php echo $forma->forma_pago; ?></option>
                                <?php
                            }
                            ?>
                       </select>
		</div>
	</div>                
    </div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comisión Agencia</label>
		<div class="controls">
            <select name="comision_agencia">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costo Comercial %</label>
		<div class="controls">
            
            <input type="text" name="costo_comercial" id="costo_comercial"  onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" />
        
		</div>
	</div>
    <!--
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
	-->
	
	    <h3>Cliente Entrega</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Cliente Entrega</label>
		<div class="controls">
            
			<input type="checkbox" id="cliente_entrega_1" onclick="ver_archivo_cliente();" name="cliente_entrega_1" value="Información Digital">Información Digital<br>
			<input type="checkbox" name="cliente_entrega_2" value="Muestra de Color">Muestra de Color<br>
			<input type="checkbox" name="cliente_entrega_3" value="Producto a Contener">Producto a Contener<br>
			<input type="checkbox" name="cliente_entrega_4" value="Muestra Producto a Fabricar">Muestra Producto a Fabricar<br>
			<input type="checkbox" name="cliente_entrega_6" value="Nada">Nada<br>
			Otro: <input type="text" name="cliente_entrega_5" />
                        
                        
			
			
			
		</div>
	</div>
            
        <div id="archivo_cliente" style="display:none;">            
                <h3>Ingrese archivo de: Información Digital (Cliente)</h3>
                <div class="control-group">
                        <label class="control-label" for="usuario">Información Digital</label>
                        <div class="controls">
                                <input type="file" id="file" name="file" />  
                                <div id="nomarch"></div>
                        </div>
                </div>	            
        </div>    
    
    <div class="control-group" style="display: none;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo set_value('glosa'); ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<div class="form-actions">
		 <input type="hidden" name="estado" />
			<input type="submit" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>" />
		    <!--
<input type="button" value="Rechazar" class="btn <?php if($ing->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
-->
            <!--
<input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
-->
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

