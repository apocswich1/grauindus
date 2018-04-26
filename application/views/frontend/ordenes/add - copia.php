<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Emisión Orden de Producción Por cuenta del Vendedor</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Emisión Orden de Producción Por cuenta del Vendedor ( Cotización N° <?php echo $id?> )</h3></div>
	   
       
      
  <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente">
              <option value="3000">Otro</option>
              
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>" <?php if($datos->id_cliente==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
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
                <option value="0">Seleccione.....</option>
                <?php
                foreach($vendedores as $vendedor)
                {
                    ?>
                    <option value="<?php echo $vendedor->id?>" <?php if($datos->id_vendedor==$vendedor->id){echo 'selected="selected"';}?>><?php echo $vendedor->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto ( <b>poner en input readonly</b> )</label>
		<div class="controls">
               <input type="text" name="condicion_del_producto" placeholder="Descripción del Producto" value="<?php echo $datos->condicion_del_producto?>" readonly="readonly" />
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Descripción del Producto ( <b>poner en input readonly</b> )</label>
		<div class="controls">
			<input type="text" name="producto" placeholder="Descripción del Producto" value="<?php echo $datos->producto?>" readonly="readonly" />
            <input type="hidden" name="producto2" />
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades a Fabricar( <b>poner en select</b> )</label>
		<div class="controls">
			<select name="cantidad">
                <option value="<?php echo $datos->cantidad_1?>"><?php echo $datos->cantidad_1?></option>
                <option value="<?php echo $datos->cantidad_2?>"><?php echo $datos->cantidad_2?></option>
                <option value="<?php echo $datos->cantidad_3?>"><?php echo $datos->cantidad_3?></option>
                <option value="<?php echo $datos->cantidad_4?>"><?php echo $datos->cantidad_4?></option>
            </select>
            <input type="text" name="precio" id="precio" onkeypress="return soloNumeros(event)" placeholder="Precio" value="<?php echo $impresionPresupuesto->precio_final?>" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes( <b>poner si o no</b> )</label>
		<div class="controls">
			<input type="text" id="dir" name="acepta_excedentes" value="<?php echo $datos->acepta_excedentes?>" readonly="readonly" />
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
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($datos->piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
   <h3>Materialidad</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
               
                <option value="1" <?php if($datos->materialidad_datos_tecnicos=="Microcorrugado"){echo 'selected="selected"';}?>>Microcorrugado</option>
                <option value="2" <?php if($datos->materialidad_datos_tecnicos=="Corrugado"){echo 'selected="selected"';}?>>Corrugado</option>
                <option value="3" <?php if($datos->materialidad_datos_tecnicos=="Cartulina-cartulina"){echo 'selected="selected"';}?>>Cartulina-cartulina</option>
                <option value="4" <?php if($datos->materialidad_datos_tecnicos=="Sólo Cartulina"){echo 'selected="selected"';}?>>Sólo Cartulina</option>
                <option value="5" <?php if($datos->materialidad_datos_tecnicos=="Onda a la Vista"){echo 'selected="selected"';}?>>Onda a la Vista</option>
                <option value="6" <?php if($datos->materialidad_datos_tecnicos=="Otro"){echo 'selected="selected"';}?>>Otro</option>
            </select>
		</div>
	</div>
    
    <div id="materialidad">
    
         <?php
         switch($datos->materialidad_eleccion)
         {
            case 'tapa_mono':
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas</label>
    		<div class="controls">
    			<select name="materialidad_1">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($datos->materialidad_1==$tapa->nombre){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )</option>
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
                    <option value="0">Seleccione......</option>
                    <?php
                    $monotapas=$this->monotapas_model->getMonotapasSelect();
                    foreach($monotapas as $monotapa)
                    {
                        ?>
                        <option value="<?php echo $monotapa->nombre?>" <?php if($datos->materialidad_2==$monotapa->nombre){echo 'selected="selected"';}?>><?php echo $monotapa->nombre?></option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
                <?php
            break;
             case 'tapa_tapa':
                ?>
                 <div class="control-group">
    		<label class="control-label" for="usuario">Tapas</label>
    		<div class="controls">
    			<select name="materialidad_1">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($datos->materialidad_1==$tapa->nombre){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas</label>
    		<div class="controls">
    			<select name="materialidad_2">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($datos->materialidad_1==$tapa->nombre){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )</option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
                <?php
            break;
             case 'mono_mono':
                ?>
                 <div class="control-group">
    		<label class="control-label" for="usuario">MonoTapa</label>
    		<div class="controls">
    			<select name="materialidad_1">
                    <option value="0">Seleccione......</option>
                    <?php
                    $monotapas=$this->monotapas_model->getMonotapasSelect();
                    foreach($monotapas as $monotapa)
                    {
                        ?>
                        <option value="<?php echo $monotapa->nombre?>" <?php if($datos->materialidad_2==$monotapa->nombre){echo 'selected="selected"';}?>><?php echo $monotapa->nombre?></option>
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
                    <option value="0">Seleccione......</option>
                    <?php
                    $monotapas=$this->monotapas_model->getMonotapasSelect();
                    foreach($monotapas as $monotapa)
                    {
                        ?>
                        <option value="<?php echo $monotapa->nombre?>" <?php if($datos->materialidad_2==$monotapa->nombre){echo 'selected="selected"';}?>><?php echo $monotapa->nombre?></option>
                        <?php
                    }
                    ?>
                </select>
    		</div>
    	</div>
                <?php
            break;
         }
         ?>
         
        
        
    <input type="hidden" name="materialidad_eleccion" value="<?php echo $datos->materialidad_eleccion?>" />
    </div>
    
  
    
    <h3>Impresión</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores">
                <?php
                for($i=1;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($datos->impresion_colores==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
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
                $internos=$this->servicios_model->getServiciosPorTipo("Interno");
                foreach($internos as $interno)
                {
                    ?>
                    <option value="<?php echo $interno->servicio?>" <?php if($datos->impresion_acabado_impresion_1==$interno->servicio){echo 'selected="selected"';}?>><?php echo $interno->servicio?></option>
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
                <option value="Con Reserva" <?php if($datos->impresion_acabado_impresion_2=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                <option value="Sin Reserva" <?php if($datos->impresion_acabado_impresion_2=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión externo 1</label>
		<div class="controls">
			<select name="acabado_impresion_3">
               <?php
                $externos=$this->servicios_model->getServiciosPorTipo("Externo");
                foreach($externos as $externo)
                {
                    ?>
                    <option value="<?php echo $externo->servicio?>" <?php if($datos->impresion_acabado_impresion_3==$externo->servicio){echo 'selected="selected"';}?>><?php echo $externo->servicio?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión externo 2</label>
		<div class="controls">
			<select name="acabado_impresion_4">
                <option value="Con Reserva" <?php if($datos->impresion_acabado_impresion_4=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                <option value="Sin Reserva" <?php if($datos->impresion_acabado_impresion_4=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
            </select>
		</div>
	</div>
    
   
    
    <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
			<select name="folia" style="width: 100px;">
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
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;">
                <option value="NO" <?php if($datos->procesos_especiales_cuno=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->procesos_especiales_cuno=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            <select name="cuno_se">
                <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="selected"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="selected"';}?>>Repetición</option>
                <option value="No Lleva" <?php if($datos->procesos_especiales_cuno_valor=="No Lleva"){echo 'selected="selected"';}?>>No Lleva</option>
            </select>
        
		</div>
	</div>
    
    <h3>Instrucciones de Terminación</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Producto se entrega armado</label>
		<div class="controls">
            <select name="producto_se_entrega_armado">
                <option value="SI" <?php if($datos->producto_se_entrega_armado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->producto_se_entrega_armado=="NO"){echo 'selected="selected"';}?>>No</option>
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
           
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Instrucciones para la terminación y pegado, y comentarios generales</label>
		<div class="controls">
			<textarea id="contenido6" name="pegado_instrucciones" placeholder="Observaciones"><?php echo $datos->pegado_instrucciones; ?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar específica</label>
		<div class="controls">
            
            <input type="text" name="cantidad_especifica" id="cantidad_especifica" onkeypress="return soloNumeros(event)" value="<?php echo $datos->cantidad_especifica?>"/>
        
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Envasado ( <b>no se puede modificar</b> )</label>
		<div class="controls">
            <input type="text" name="envasado" onkeypress="return soloNumeros(event)" value="<?php echo $datos->envasado?>" readonly="readonly"/>
        
		</div>
	</div>
    
    <h3>Detalles de Despacho</h3>
    
      
       <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Despacho</label>
		<div class="controls">
            
            <input type="text" name="fecha_despacho" id="fecha_despacho" placeholder="Fecha de Despacho" />
        
		</div>
	</div>
      
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
		<label class="control-label" for="usuario">Total o Parcial</label>
		<div class="controls">
            <select name="tota_o_parcial">
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
		<label class="control-label" for="usuario">Cantidades (Sin es Parcial)</label>
		<div class="controls">
			<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" value="<?php echo $datos->can_despacho_1?>" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" value="<?php echo $datos->can_despacho_2?>" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" value="<?php echo $datos->can_despacho_3?>" />
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
		<label class="control-label" for="usuario">Comisión Agencia ( <b>no se puede modificar</b> )</label>
		<div class="controls">
            <select name="comision_agencia">
                <option value="SI" <?php if($datos->comision_agencia=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->comision_agencia=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costo Comercial ( <b>no se puede modificar</b> )</label>
		<div class="controls">
            
            <input type="text" name="costo_comercial" id="costo_comercial"  onkeypress="return soloNumeros(event)"  value="<?php echo $datos->costo_comercial?>" />
        
		</div>
	</div>
    
  <h3>Datos Finales</h3>


     <div class="control-group">
		<label class="control-label" for="usuario">Persona que Firma orden de compra</label>
		<div class="controls">
            
            <input type="text" name="persona_que_firma" placeholder="Persona que Firma orden de compra"/>
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Número de Orden de Compra</label>
		<div class="controls">
            
            <input type="text" name="numero_orden" placeholder="Número de Orden de Compra" />
        
		</div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="id" value="<?php echo $id?>" />
			<input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <button type="submit" class="btn">Guardar</button>
            
		</div>
	</div>
</form>

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
</div>
