<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>papeles/index/<?php echo $this->uri->segment(4)?>">Papeles &gt;&gt;</a></li>
      <li>Agregar Papeles o Monotapas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Papeles o Monotapas</h3></div>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="0">Seleccione.....</option>
                <?php
               foreach($tipos as $tipo)
               {
                    ?>
                    <option value="<?php echo $tipo->id?>"><?php echo $tipo->materiales_tipo?></option>
                    <?php
               }
               ?>

                
            </select>
		</div>
	</div>
    
<div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
			<select name="proveedor">
                <option value="0">Seleccione.....</option>
                <?php
                $proves=$this->proveedores_model->getProveedores();
                foreach($proves as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($datos->id_proveedor==$prove->id){echo 'selected="selected"';}?> ><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
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
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Reverso</label>
		<div class="controls">
			<input type="text" id="titulo" name="reverso" value="<?php echo set_value("reverso")?>" placeholder="Reverso" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Procedencia</label>
		<div class="controls">
			<input type="text" id="titulo" name="procedencia" value="<?php echo set_value("procedencia")?>" placeholder="Procedencia" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
			<input type="text" id="titulo" name="gramaje" value="<?php echo set_value("gramaje")?>" placeholder="Gramaje" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho</label>
		<div class="controls">
			<input type="text" id="titulo" name="ancho" value="<?php echo set_value("ancho")?>" placeholder="Ancho" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Peso Kilos</label>
		<div class="controls">
			<input type="text" id="titulo" name="peso" value="<?php echo set_value("peso_kilos")?>" placeholder="Peso Kilos" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Valor en Dólares</label>
		<div class="controls">
			<input type="text" id="titulo" name="dolares" value="<?php echo set_value("valor_en_dolares")?>" placeholder="Valor en Dólares" />
		</div>
	</div>
    
      
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo Onda</label>
		<div class="controls">
			<input type="text" id="titulo" name="tipo_onda" value="<?php echo set_value("tipo_onda")?>" placeholder="Tipo Onda" />
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Onda</label>
		<div class="controls">
			<input type="text" id="titulo" name="onda" value="<?php echo set_value("onda")?>" placeholder="Onda" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Liner</label>
		<div class="controls">
			<input type="text" id="titulo" name="liner" value="<?php echo set_value("liner")?>" placeholder="Liner" />
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
