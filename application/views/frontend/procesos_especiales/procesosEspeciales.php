

<script>
    function guardar()
    {
    window.location = "procesos_especiales/guardar";
    }
    
</script>



<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
    
<?php //echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li> <a <!-- href="<?php //echo base_url()?>procesos_especiales/index"-->>Pocesos especiales &gt;&gt;</a> </li>
      <li>Agregar proceso especial</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar proceso especial</h3></div>
	
        <form action ="<?php echo base_url(); ?>procesos_especiales/guardar" method="post">
	<div class="control-group">
		<label class="control-label" for="usuario">Proceso especial</label>
		
                <div class="controls">
			<input type="text" id="titulo" name="proceso" value="<?php echo set_value("proceso")?>" placeholder="Proceso especial" />
		</div>
	</div>
    
    
    
	<div class="control-group">
		<div class="form-actions">
                    <button type="submit" class="btn" <!--onclic ="guardar()"-->  Guardar</button>
		</div>
	</div>
        </form>

       		 

<!--
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.nom.focus();
        }
    );
    
</script>+-->
</div>

