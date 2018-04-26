<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

	<div class="page-header"><h3>Ingreso al sistema</h3></div>
	<div class="control-group">
		<label class="control-label" for="usuario">RUT</label>
		<div class="controls">
			<input type="text" id="login" name="rut" value="<?php echo set_value("rut");?>" placeholder="00000000-0" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="clave">Contraseña</label>
		<div class="controls">
			<input type="password" id="pass" name="pass" value="<?php echo set_value("pass");?>" placeholder="Contraseña" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Iniciar sesión</button>
		</div>
	</div>
</form>
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.login.focus();
        }
    );
</script>