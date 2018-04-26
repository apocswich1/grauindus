<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>usuarios">Usuarios &gt;&gt;</a></li>
      <li>Agregar Usuario</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Usuario</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Perfil</label>
		<div class="controls">
			<select name="perfil">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($perfiles as $perfile)
                {
                    ?>
                    <option value="<?php echo $perfile->perfil?>"><?php echo $perfile->perfil?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cargo</label>
		<div class="controls">
			<select name="cargo">
            <option value="0">Seleccione.....</option>
                <?php
                foreach($cargos as $cargo)
                {
                    ?>
                    <option value="<?php echo $cargo->cargo?>"><?php echo $cargo->cargo?></option>
                    <?php                    
                }
                ?>
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">RUT</label>
		<div class="controls">
			<input type="text" id="titulo" name="rut" value="<?php echo set_value("rut")?>" placeholder="00000000-0" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
		<div class="controls">
			<input type="text" id="tele" name="correo" value="<?php echo set_value('correo'); ?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="tele" name="tel" value="<?php echo set_value('tel'); ?>" placeholder="Teléfono" />
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
                    <option value="<?php echo $region->id?>"><?php echo $region->region?></option>
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
            </select>
		</div>
	</div>

	<div class="control-group" id="sub_comuna">
		<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
			<select name="comuna">
                <option value="0">Seleccione</option>
            </select>
		</div>
	</div>


	 <div class="control-group">
		<label class="control-label" for="usuario">Dirección</label>
		<div class="controls">
			<input type="text" id="dir" name="dir" value="<?php echo set_value('dir'); ?>" placeholder="Dirección" />
		</div>
	</div>

    <h3>Contraseña</h3>
    
	  <div class="control-group">
		<label class="control-label" for="usuario">Contraseña</label>
		<div class="controls">
			<input type="password" id="tele" name="pass" value="<?php echo set_value('pass'); ?>" placeholder="Contraseña" />
		</div>
	</div>

      <div class="control-group">
		<label class="control-label" for="usuario">Repetir Contraseña</label>
		<div class="controls">
			<input type="password" id="tele" name="pass2" value="<?php echo set_value('pass2'); ?>" placeholder="Repetir Contraseña" />
		</div>
	</div>

	<div class="control-group">
		<div class="form-actions">
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
</script>
</div>
