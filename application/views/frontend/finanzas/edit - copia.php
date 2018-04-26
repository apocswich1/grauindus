<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>finanzas">Mantenedor Financiero &gt;&gt;</a></li>
      <li>Editar Mantenedor Financiero</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Guardar con datos actuales tomados del SBIF (Superintendencia de Bancos e Instituciones Financieras de Chile)</h3></div>
	<?php 
     require_once("Sbif.php");
     $key="a127d84de78836a568f4b210d568e241ab352968";
     $Sbif=new Sbif($key);
    ?>
    <p>
        <ul>
            <li>Dolar de hoy : <strong><?php echo $Sbif->obtiene()?></strong></li>
            <li>UF de hoy : <strong><?php echo $Sbif->obtieneUF()?></strong></li>
        </ul>
        <div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="dolar_actual" value="<?php echo $Sbif->obtiene()?>" />
            <input type="hidden" name="uf_actual" value="<?php echo $Sbif->obtieneUF()?>" />
			<input type="button" value="Guardar" class="btn" onclick="sbif();" />
		</div>
	</div>
    </p>
    <h3>Guardar con datos manuales</h3>
     <div class="control-group">
		<label class="control-label" for="usuario">Dólar</label>
		<div class="controls">
			<input type="text" id="link" name="dolar" value="<?php echo $datos->dolar?>" required="required" placeholder="Dólar" onkeypress="return soloNumeros(event)"  />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Fomento (UF)</label>
		<div class="controls">
			<input type="text" id="link" name="uf" value="<?php echo $datos->uf?>" placeholder="Unidad de Fomento (UF)" required="required" onkeypress="return soloNumeros(event)" />
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
        document.form.dolar.focus();
        }
    );
</script>
</div>
