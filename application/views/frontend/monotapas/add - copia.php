<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>monotapas/index/<?php echo $this->uri->segment(4)?>">Monotapas &gt;&gt;</a></li>
      <li>Agregar Monotapas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Monotapas</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo set_value("codigo")?>" placeholder="Código" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    
      <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Gramaje Onda</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo set_value("gramaje")?>" placeholder="Gramaje Onda" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
      <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Onda </label>
		<div class="controls">
			<select name="onda">
                <option value="0">Seleccione.....</option>
                <?php
                $a=array("Microcorrugado","Corrugado","Cartulina-Cartulina");
                for($i=0;$i<sizeof($a);$i++)
                {
                    ?>
                    <option value="<?php echo $a[$i]?>"><?php echo $a[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
       <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Gramaje Liner</label>
		<div class="controls">
			<input type="text" name="gramaje2" value="<?php echo set_value("gramaje2")?>" placeholder="Gramaje Liner" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
      <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Liner </label>
		<div class="controls">
				<select name="liner">
                <option value="0">Seleccione.....</option>
                <?php
                for($i=0;$i<sizeof($a);$i++)
                {
                    ?>
                    <option value="<?php echo $a[$i]?>"><?php echo $a[$i]?></option>
                    <?php
                }
                ?>
            </select>
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
        document.form.codigo.focus();
        }
    );
    
</script>
</div>
