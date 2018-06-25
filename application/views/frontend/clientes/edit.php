<?php $guardar=true; ?>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>clientes/index">Clientes &gt;&gt;</a></li>
      <li>Editar Cliente</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Cliente</h3></div>
        <?php if ($error_rut)  
            { 
                $guardar=false;
            ?> 
            <div class="alert alert-success">Error en el rut, ya fue registrado</div>        
        <?php } ?>          
	
    
    <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado</label>
		<div class="controls">
		    <select name="estado" onchange="bloqueo();">
                    <option value="2" <?php if($datos->estado==2){echo 'selected="true"';}?>>Bloqueado</option>
                    <?php
                    if($this->session->userdata('perfil')!=2)
                    {
                    ?>
                        <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>Activo</option>
                        <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>No Activo</option>
                    <?php
                    }
                    ?>
            </select>
	
		</div>
	</div>
    
    <div class="control-group" id="div_bloqueo" style="display: <?php if($datos->estado==2){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué está bloqueando a este cliente?</label>
		<div class="controls">
		<textarea id="contenidosss" name="bloqueado" placeholder="Observaciones"><?php echo $datos->bloqueado; ?></textarea>
        			
		</div>
	</div>
    <?php
	if( $this->session->userdata('perfil')!=2 )
	{
	?>	
    <div class="control-group">
		<label class="control-label" for="id_antiguo">Fast Track</label>
		<div class="controls">
		    <select name="fast">
                    <option value="0" <?php if($datos->fast==0){echo 'selected="true"';}?>>NO</option>
                    <option value="1" <?php if($datos->fast==1){echo 'selected="true"';}?>>SI</option>
            </select>
	
		</div>
	</div> 
    <?php
	}
	?>	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedor <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="vendedor">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($vendedors as $vendedor)
                {
                    if($datos->id_vendedor==$vendedor->id)
                    {
                         ?>
                    <option value="<?php echo $vendedor->id?>" selected="selected"><?php echo $vendedor->nombre?></option>
                    <?php
                    }else
                    {
                         ?>
                    <option value="<?php echo $vendedor->id?>"><?php echo $vendedor->nombre?></option>
                    <?php
                    }
                   
                }
                ?>
                
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">RUT Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php if ($datos->rut==$this->config->item('rut_repetido')) { ?>
                    <input type="text" onblur="ValidarRut(this.value,this.id);" id="rut" name="rut" value="<?php echo $datos->rut?>" placeholder="00000000-0" />
            	    <?php echo '<a href='.'#'.'>xxxxxxx-x</a>';?>                    
                    <?php } else { ?>             
                    <input type="text" readonly="readonly" id="titulo" name="rut" value="<?php echo $datos->rut?>" placeholder="00000000-0" />
                    <?php } ?>                      
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Razón Social <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="link" name="razon" value="<?php echo $datos->razon_social?>" placeholder="Razón Social" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre de Fantasía <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo $datos->nombre_fantasia?>" placeholder="Nombre de Fantasía" />
		</div>
	</div>
    
    
	 <div class="control-group">
		<label class="control-label" for="usuario">E-Mail <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="tele" name="correo" value="<?php echo $datos->correo; ?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="tele" name="tel" value="<?php echo $datos->telefono; ?>" placeholder="Teléfono" />
		</div>
	</div>


    <div class="control-group">
		<label class="control-label" for="usuario">Celular</label>
		<div class="controls">
			<input type="text" id="tele" name="cel" value="<?php echo $datos->celular; ?>" placeholder="Celular" />
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Contacto Cliente</label>
		<div class="controls">
			<input type="text" value="<?php echo $datos->contacto_cliente; ?>" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Fax</label>
		<div class="controls">
			<input type="text" id="tele" name="fax" value="<?php echo $datos->fax; ?>" placeholder="Fax" />
		</div>
	</div>
    

    <h3>Dirección</h3>
<div class="control-group">
		<label class="control-label" for="usuario">Región</label>
		<div class="controls">
			<select name="region" onchange="carga_ajax('<?php echo base_url();?>usuarios/region',this.value,'1','sub_ciudad');">
                <option value="0">Seleccione</option>
                <?php
                foreach($regions as $region)
                {
                    if($datos->id_region==$region->id)
                    {
                        ?>
                    <option value="<?php echo $region->id?>" selected="selected"><?php echo $region->region?></option>
                    <?php
                    }else
                    {
                        ?>
                    <option value="<?php echo $region->id?>"><?php echo $region->region?></option>
                    <?php
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>

	<div class="control-group" id="sub_ciudad">
		<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
			<select name="ciudad">
                <option value="0">Seleccione</option>
                 <?php
                foreach($cuidads as $ciudad)
                {
                    if($datos->id_ciudad==$ciudad->id)
                    {
                        ?>
                <option value="<?php echo $ciudad->id?>" selected="selected"><?php echo $ciudad->nombre ?></option>
                    <?php
                    }else
                    {
                        ?>
                    <option value="<?php echo $ciudad->id?>"><?php echo $ciudad->nombre?></option>
                    <?php
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>

	<div class="control-group" id="sub_comuna">
		<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
			<select name="comuna">
                <option value="0">Seleccione</option>
                <?php
                foreach($comunas as $comuna)
                {
                    if($comuna->id==$datos->id_comuna)
                    {
                       ?>
                    <option value="<?php echo $comuna->id?>" selected="selected"><?php echo $comuna->nombre?></option>
                    <?php 
                    }else
                    {
                       ?>
                    <option value="<?php echo $comuna->id?>"><?php echo $comuna->nombre?></option>
                    <?php 
                    }
                }
                ?>
            </select>
		</div>
	</div>


	 <div class="control-group">
		<label class="control-label" for="usuario">Dirección</label>
		<div class="controls">
			<input type="text" id="dir" name="dir" value="<?php echo $datos->direccion; ?>" placeholder="Dirección" />
		</div>
	</div>
    
	
	
    
    <h3>Despacho</h3>
		<script>
	   function copiaDirecionAdespachoCliente(obj)
	   {
	      if(obj.checked){
			// var div=document.getElementById("divDespacho");
			// div.style.display="none";
			form.region2.value=form.region.value;
			form.ciudad2.value=form.ciudad.value;	
			//agrego el elemento
			var valSelect=form.comuna.value;
			var textSelect=form.comuna.options[form.comuna.selectedIndex].text;
			var opt = document.createElement('option');
				opt.value = valSelect;
				opt.innerHTML = textSelect;
				form.comuna2.appendChild(opt);
			form.dir2.value=form.dir.value;	
			form.comuna2.value=form.comuna.value;
		}
		
	   }	   
	</script>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Usar estos mismos datos para despacho</label>
		<div class="controls">
                    <input type="checkbox" onclick="copiaDirecionAdespachoCliente(this)" id="si" name="si" value="si" />
		</div>
	</div>
	<div id="divDespacho">


<div class="control-group">
		<label class="control-label" for="usuario">Contacto</label>
		<div class="controls">
			<input type="text" id="link" name="contacto" value="<?php echo $datos->contacto?>" placeholder="Contacto" />
		</div>
	</div>

     <div class="control-group">
		<label class="control-label" for="usuario">Forma de Pago</label>
		<div class="controls">
                    <select name="forma_pago" class="chosen-select">
                <option value="">Seleccione.....</option>
                <?php
                foreach($formas as $forma)
                {
                   if($forma->id==$datos->id_forma_pago)
                   {
                    ?>
                    <option value="<?php echo $forma->id?>" selected="selected"><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago?></option>
                    <?php
                   }else
                   {
                    ?>
                    <option value="<?php echo $forma->id?>"><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago?></option>
                    <?php
                   }
                    
                }
                ?>
                
            </select>
		</div>
	</div>
    
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Región</label>
		<div class="controls">
			<select name="region2" onchange="carga_ajax('<?php echo base_url();?>clientes/region',this.value,'1','sub_ciudad2');">
                <option value="0">Seleccione</option>
                <?php
                foreach($regions as $region2)
                {
                    if($datos->id_region_despacho==$region2->id)
                    {
                        ?>
                    <option value="<?php echo $region2->id?>" selected="selected"><?php echo $region2->region?></option>
                    <?php
                    }else
                    {
                        ?>
                    <option value="<?php echo $region2->id?>"><?php echo $region2->region?></option>
                    <?php
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>
    
    	<div class="control-group" id="sub_ciudad2">
		<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
			<select name="ciudad2">
                <option value="0">Seleccione</option>
                  <?php
                foreach($cuidads as $ciudad)
                {
                    if($datos->id_ciudad_despacho==$ciudad->id)
                    {
                        ?>
                    <option value="<?php echo $ciudad->id?>" selected="selected"><?php echo $ciudad->nombre?></option>
                    <?php
                    }else
                    {
                        ?>
                    <option value="<?php echo $ciudad->id?>"><?php echo $ciudad->nombre?></option>
                    <?php
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>

	<div class="control-group" id="sub_comuna2">
		<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
			<select name="comuna2">
                <option value="0">Seleccione</option>
                <?php
                foreach($comunas as $comuna)
                {
                    if($comuna->id==$datos->id_comuna_despacho)
                    {
                       ?>
                    <option value="<?php echo $comuna->id?>" selected="selected"><?php echo $comuna->nombre?></option>
                    <?php 
                    }else
                    {
                       ?>
                    <option value="<?php echo $comuna->id?>"><?php echo $comuna->nombre?></option>
                    <?php 
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Dirección</label>
		<div class="controls">
			<input type="text" id="dir" name="dir2" value="<?php echo $datos->direccion_despacho; ?>" placeholder="Dirección" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Horario de Bodega</label>
		<div class="controls">
			<input type="text" id="link" name="horario" value="<?php echo $datos->horario_despacho?>" placeholder="Horario" />
		</div>
	</div>
    
	
	
	<?php
	if( $this->session->userdata('perfil')!=2 )
	{
	?>	
      <h3>Datos Comerciales</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Deuda Actual</label>
		<div class="controls">
			<input type="text" id="deuda_vigente" name="deuda_vigente" value="<?php echo $datos->deuda_vigente?>" placeholder="Deuda Actual" />
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="usuario">Cupo Máximo</label>
		<div class="controls">
			<input type="text" name="cupo_maximo" value="<?php echo $datos->cupo_maximo?>" placeholder="Cupo Máximo" />
		</div>
	  </div>  
    <?php
	}else{
	?>
		<h3>Datos Comerciales</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Deuda Actual</label>
		<div class="controls">
			<input type="text" id="deuda_vigente" name="deuda_vigente" value="<?php echo $datos->deuda_vigente?>" placeholder="Deuda Actual" readonly="true"/>
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="usuario">Cupo Máximo</label>
		<div class="controls">
			<input type="text" name="cupo_maximo" value="<?php echo $datos->cupo_maximo?>" placeholder="Cupo Máximo" readonly="true"/>
		</div>
	  </div>  
	<?php
	}
	?>
	
    <h3>Observaciones</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Observaciones</label>
		<div class="controls">
		<textarea id="contenido" name="descripcion" placeholder="Observaciones"><?php echo $datos->observaciones; ?></textarea>
        			
		</div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
                <input type="hidden" name="id" value="<?php echo $datos->id?>" />
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
        document.form.titulo.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas"
	});
</script>
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
</div>
