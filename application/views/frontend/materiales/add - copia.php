<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>materiales/index/<?php echo $this->uri->segment(4)?>">Tapas y Cartulinas &gt;&gt;</a></li>
      <li>Agregar Tapas y Cartulinas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Tapas y Cartulinas</h3></div>
	
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
            <option value="2000">Otro</option>
                
            </select>
		</div>
	</div>
    
    	<div class="control-group">
		<label class="control-label" for="usuario">Otro Tipo</label>
		<div class="controls">
			<input type="text" id="titulo" name="otro_tipo" value="<?php echo set_value("otro_tipo")?>" placeholder="Otro Tipo" />
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
                    <option value="<?php echo $prove->id?>" ><?php echo $prove->nombre?></option>
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
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Descripción" />
		</div>
	</div>
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Reverso</label>
		<div class="controls">
			<select name="reverso">
                <option value="Café">Café</option>
                <option value="Blanco">Blanco</option>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Procedencia</label>
		<div class="controls">
			<select name="procedencia">
                <option value="0">Seleccione.....</option>
                <?php
                $procedencias=$this->materiales_model->getMaterialesProcedencia();
                foreach($procedencias as $procedencia)
                {
                    ?>
                    <option value="<?php echo $procedencia->id?>"><?php echo $procedencia->procedencia?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo set_value("gramaje")?>" placeholder="Gramaje" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho</label>
		<div class="controls">
			<select name="ancho">
            <?php $array=array("60","70","72" , "80", "90", "92");?>
                
                <?php
                for($i=0;$i<sizeof($array);$i++)
                {
                    ?>
                    <option value="<?php echo $array[$i]?>"><?php echo $array[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Pedido</label>
		<div class="controls">
			<input type="text" name="ancho_de_pedido" id="ancho_de_pedido" value="<?php echo set_value("ancho_de_pedido")?>" onkeypress="return soloNumeros(event)" />


		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Precio Kilo</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio_kilos" value="<?php echo set_value("precio_kilos")?>" placeholder="Precio Kilo" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Valor en Dólares</label>
		<div class="controls">
			<input type="text" id="titulo" name="dolares" value="<?php echo set_value("valor_en_dolares")?>" placeholder="Valor en Dólares" onkeypress="return soloNumeros(event)" />
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
