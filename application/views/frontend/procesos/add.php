<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>procesos">Procesos de Empresa &gt;&gt;</a></li>
      <li>Agregar Procesos de Empresa</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Procesos de Empresa</h3></div>
	
    

    <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<select name="nom">
                <option value="0">Seleccione.....</option>
                <?php
                $procesos_tipo=$this->procesos_model->getProcesosTipo();
                foreach($procesos_tipo as $procesos_tipos)
                {
                    ?>
                    <option value="<?php echo $procesos_tipos->procesos_tipo?>"> <?php echo $procesos_tipos->procesos_tipo?> </option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	<!--
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php// echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    -->
    
    
    
  <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<input type="text" id="titulo" name="des" value="<?php echo set_value("des")?>" placeholder="Descripción" />
		</div>
	</div>
    
    
    
    	<div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio" value="<?php echo set_value("precio")?>" placeholder="Precio" />
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
        document.form.nom.focus();
        }
    );
    
</script>
</div>
