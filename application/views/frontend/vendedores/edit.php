<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>vendedores/index">Vendedores &gt;&gt;</a></li>
      <li>Editar Vendedores</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Vendedores</h3></div>

	<div class="control-group">
		<label class="control-label" for="id_vendedor">Codigo vendedor</label>
		<div class="controls">
                    	<input type="text" id="id_vendedor" name="id_vendedor" value="<?php echo $datos->id_vendedor;?>" placeholder="codigo vendedor" />

		</div>
	</div>		   
       
       <div class="control-group">
		<label class="control-label" for="usuario">Comisión</label>
		<div class="controls">
			<select name="comision">
                <option value="0">Seleccione.....</option>
                <?php
                for($i=1;$i<=100;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($datos->comision==$i){echo 'selected="selected"';}?> ><?php echo $i?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">RUT</label>
		<div class="controls">
			<input type="text" id="titulo" name="rut" value="<?php echo $datos->rut?>" placeholder="00000000-0" />
		</div>
	</div>
    
    

    
    
	 <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
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
		<label class="control-label" for="usuario">Situación Laboral</label>
		<div class="controls">
			<input type="text" id="tele" name="situacion" value="<?php echo $datos->situacion_laboral; ?>" placeholder="Situación Laboral" />
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
                    ?>
                    <option value="<?php echo $region->id?>" <?php if($datos->id_region==$region->id){echo 'selected="selected"';}?>><?php echo $region->region?></option>
                    <?php
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
                $ciudads=$this->direccion_model->getCiudadPorRegion($datos->id_region);
                foreach($ciudads as $ciudad)
                {
                    ?>
                    <option value="<?php echo $ciudad->id?>" <?php if($datos->id_ciudad==$ciudad->id){echo 'selected="selected"';}?>><?php echo $ciudad->nombre?></option>
                    <?php
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
                $comunas=$this->direccion_model->getComunaPorCiudad($datos->id_ciudad);
                foreach($comunas as $comuna)
                {
                    ?>
                    <option value="<?php echo $comuna->id?>" <?php if($datos->id_comuna==$comuna->id){echo 'selected="selected"';}?>><?php echo $comuna->nombre?></option>
                    <?php
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
    
  
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
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
        document.form.titulo.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas"
	});
</script>
</div>
