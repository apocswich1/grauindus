<?php $this->layout->element('admin_mensaje_validacion'); ?>



<div id="contenidos">
<?php echo form_open(null, array('onsubmit'=>'verificaCampos()','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Editar Solicitud de Cotización N° <?php echo number_format($id,0,'','.');?></li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Solicitud de Cotización N° <?php echo number_format($id,0,'','.');?></h3></div>
	
    
     <div class="control-group">
		<label class="control-label" for="usuario">Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="cliente" class="chosen-select">
              
                <!--
 <option value="3000">Otro</option>
-->
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>" <?php if($datos->id_cliente==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?> <?php if($cliente->estado==2){echo '(BLOQUEADO)';}?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedor</label>
		<div class="controls">
			<select name="vendedor">
                
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
			<select name="condicion_del_producto" onchange="llamarDetalleCondicion(this.value);">
                <option value="0" <?php if($datos->condicion_del_producto=='Nuevo'){echo 'selected="true"';}?>>Nuevo</option>
                <option value="1"<?php if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo 'selected="true"';}?>>Repetición Sin Cambios</option>
                <option value="2"<?php if($datos->condicion_del_producto=='Repetición Con Cambios'){echo 'selected="true"';}?>>Repetición Con Cambios</option>
                <option value="3"<?php if($datos->condicion_del_producto=='Producto Genérico'){echo 'selected="true"';}?>>Producto Genérico</option>
            </select>
		</div>
	</div>
    
   <div id="div_condicion" style="display: none;">
     <div class="control-group">
		<label class="control-label" for="usuario">Detalle de Cambios</label>
		<div class="controls">
			<textarea id="contenido4" name="detalle_cambios" placeholder="Observaciones"><?php echo $datos->producto; ?></textarea>
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
			<input type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo $datos->producto; ?>" onkeypress="return alpha_con_numeros(event)" /><input type="hidden" name="producto_id" value="0" />
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Cotizar <strong style="color: red;">(*)</strong></label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
			<input type="text" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo $datos->cantidad_1; ?>" /> - <input type="text" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo $datos->cantidad_2; ?>" /> - <input type="text" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo $datos->cantidad_3; ?>" /> - <input type="text" value="0" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo $datos->cantidad_4; ?>" />
		</div>
	</div>
    
   
    
     <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
			<select name="acepta_excedentes" style="width: 100px;" onchange="aceptaExcedentes();">
                <option value="NO" <?php if($datos->acepta_excedentes=='NO'){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($datos->acepta_excedentes=='SI'){echo 'selected="true"';}?>>SI</option>
                
            </select> 
            <span id="acepta_excedentes">Acepta pagar extra por cantidad exacta</span>
            <input type="hidden" name="acepta_excedentes_extra" value="<?php echo $datos->acepta_excedentes_extra?>" />
            
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Generales</label>
		<div class="controls">
			<textarea id="contenido4s" name="obs" placeholder="Observaciones"><?php echo $datos->obs?></textarea>
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
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos->piezas_adicionales){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
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
    
    <div class="control-group">
	<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			<select name="estan_los_moldes" style="width: 100px;" onchange="estanLosMoldes(this.value);">
                            <option value="NO" <?php if($datos->estan_los_moldes=="NO"){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if($datos->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO LLEVA" <?php if($datos->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
                        </select> 
                        <?php if($datos->estan_los_moldes=="SI"){ ?> <span id="molde_select">
                        <?php } else { ?> <span id="molde_select"  style="display: none;"> <?php  } ?>
                        <select name="molde" id="molde" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                            <?php
                            $moldes=$this->moldes_model->getMoldes();
                            foreach($moldes as $molde)
                            {
                                ?>
                                <option value="<?php echo $molde->id?>" <?php if($fotomecanica->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                <?php
                            }
                            ?>
                        </select> 
            <span id="div_moldes"></span>
            </span>
		</div>
	</div>
    <h3>Materialidad <strong style="color: red;">(*)</strong></h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');" class="chosen-select">
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
			<select name="colores">
                <?php
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($datos->impresion_colores==$i){echo 'selected="true"';}?>><?php echo $i?></option>
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
                    <option value="<?php echo $i?>" <?php if(isset($_POST["colores_metalicos"]) and $_POST["colores_metalicos"]==$i){echo 'selected="true"';}?>><?php echo $i?></option>
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
			<select name="acabado_impresion_2">
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
			<select name="acabado_impresion_5">
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

    
    <div class="control-group">
		<label class="control-label" for="usuario">Hacer Cromalín</label>
		<div class="controls">
			<input type="checkbox" id="dir" name="hacer_cromalin" value="si" />
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
    
     <div class="control-group">
		<label class="control-label" for="usuario">Empaquetar</label>
		<div class="controls">
            <select name="cantidad_especifica_sino">
                <option value="">Seleccione......</option>                   
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select>
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica (0)</label>
		<div class="controls"><!--onkeypress="nextOnEnter(this,event);" -->
             
            <input type="text" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" placeholder="0" />
        
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Envasado</label>
		<div class="controls">
            <select name="envasado">
                <option value="">Seleccione......</option>                   
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
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
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
		<label class="control-label" for="usuario">Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                <?php
                    $formas=$this->clientes_model->getFormasPago();
//                    $id_forma_pago_texto=$this->clientes_model->getIdCodigoFormaPagoTexto($datos->forma_pago);  
//                    echo $datos->forma_pago."hola";
                ?>
		<select name="forma_pago">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($formas as $forma)
                {
                    ?>
                    <option value="<?php echo $forma->id; ?>" <?php if($forma->id==$datos->forma_pago){echo 'selected="selected"';}?>  ><?php echo $forma->forma_pago; ?></option>
                    <?php
                }
                ?>
                
            </select>
            <?php //echo print_r($datos)."hollaa".$datos->forma_pago;  ?>                    
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
    
    <h3>Cliente Entrega</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Cliente Entrega</label>
		<div class="controls">
            <select name="cliente_entrega" size="5" multiple="multiple">
                <option value="Información Digital" <?php if($datos->cliente_entrega_1=="Información Digital"){echo 'selected="selected"';}?>  >Información Digital</option>
                <option value="Muestra de Color" <?php if($datos->cliente_entrega_1=="Muestra de Color"){echo 'selected="selected"';}?>  >Muestra de Color</option>                
                <option value="Producto a Contener" <?php if($datos->cliente_entrega_1=="Producto a Contener"){echo 'selected="selected"';}?>  >Producto a Contener</option>
                <option value="Muestra Producto a Fabricar" <?php if($datos->cliente_entrega_1=="Muestra Producto a Fabricar"){echo 'selected="selected"';}?>  >Muestra Producto a Fabricar</option>                 
                <option value="Otro" <?php if($datos->cliente_entrega_1=="Otro"){echo 'selected="selected"';}?>  >Otro</option>                 
            </select>
            
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

