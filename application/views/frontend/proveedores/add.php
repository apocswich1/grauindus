<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>proveedores/index">Proveedores &gt;&gt;</a></li>
      <li>Agregar Proveedor</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Proveedor</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $_POST["nom"]?>" placeholder="Proveedor" />
		</div>
	</div>

    
	<div class="control-group">
		<label class="control-label" for="usuario">Razón Social</label>
		<div class="controls">
			<input type="text" id="razon_social" name="razon_social" value="<?php echo $_POST["razon_social"]?>" placeholder="Razón Social" />
		</div>
	</div>        
	<div class="control-group">
		<label class="control-label" for="usuario">Rut</label>
		<div class="controls">
			<input type="text" id="rut" name="rut" value="<?php echo $_POST["rut"] ?>" placeholder="Numero de Rut" />
		</div>
	</div>        
        
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="telefono" name="telefono" value="<?php echo $_POST["tel"]?>" placeholder="Teléfono" />
		</div>
	</div>
        
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo de  Cuenta</label>
		<div class="controls">
		<select name="tipo_cuenta">
                    <option value="1" <?php if(($_POST['tipo_cuenta'])==1){echo "selected='selected'";}  ?>>Cuenta Corriente</option>
                    <option value="2" <?php if(($_POST['tipo_cuenta'])==2){echo "selected='selected'";}  ?>>Cuenta Vista</option>
                    <option value="3" <?php if(($_POST['tipo_cuenta'])==3){echo "selected='selected'";}  ?>>Cuenta Rut</option>
                    <option value="4" <?php if(($_POST['tipo_cuenta'])==4){echo "selected='selected'";}  ?>>Cuenta de Ahorro</option>                    
                </select> 		
                </div>
	</div>             
        
    <div class="control-group">
		<label class="control-label" for="usuario">Numero Cuenta</label>
		<div class="controls">
			<input type="text" id="num_cuenta" name="num_cuenta" value="<?php echo $_POST["num_cuenta"]?>" placeholder="Numero de la Cuenta" />
		</div>
	</div>        
    
    <div class="control-group">
		<label class="control-label" for="usuario">Titular de la Cuenta</label>
		<div class="controls">
			<input type="text" id="titular_cuenta" name="titular_cuenta" value="<?php echo $_POST["titular_cuenta"]?>" placeholder="Tiular de la Cuenta" />
		</div>
	</div>          
        
    <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
		<div class="controls">
			<input type="text" id="titulo" name="correo" value="<?php echo $_POST["correo"]?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Rubro (Calidad de Taller)</label>
		<div class="controls">
                        <select name="rubro">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $rubros=$this->rubros_model->getRubros();
                            print_r($rubros);
                            foreach($rubros as $rubro)
                            {
                                ?>
                                <option value="<?php echo $rubro->id; ?>" <?php if(($_POST['rubro'])==$rubro->id){echo "selected='selected'";}  ?>><?php echo $rubro->rubro; ?></option>
                                <?php
                            }
                            ?>
                       </select>
			<!--<input type="text" id="titulo" name="rubro" value="<?php//echo set_value("rubro")?>" placeholder="Rubro" />-->
		</div>
	</div>
    
        <div class="control-group">
		<label class="control-label" for="usuario">Rubro 2 (Calidad de Taller)</label>
		<div class="controls">
                        <select name="rubro2">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $rubros=$this->rubros_model->getRubros();
                            print_r($rubros);
                            foreach($rubros as $rubro)
                            {
                                ?>
                                <option value="<?php echo $rubro->id; ?>" <?php if(($_POST['rubro2'])==$rubro->id){echo "selected='selected'";}  ?>><?php echo $rubro->rubro; ?></option>
                                <?php
                            }
                            ?>
                       </select>
			<!--<input type="text" id="titulo" name="rubro" value="<?php//echo set_value("rubro")?>" placeholder="Rubro" />-->
		</div>
	</div>
     <div class="control-group">
         <div id="sub_forma_pago">
		<label class="control-label" for="usuario" >Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls" >
			<select name="forma_pago">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->clientes_model->getFormasPago();
                            foreach($formas as $forma)
                            {
                                ?>
                            <option value="<?php echo $forma->id; ?>" <?php if(($_POST['forma_pago'])==$forma->id){echo "selected='selected'";}  ?>><?php echo $forma->forma_pago; ?></option>
                                <?php
                            }
                            ?>
                       </select>
		</div>
	</div>                
    </div>        
    
    
    	<div class="control-group">
		<label class="control-label" for="usuario">Contacto</label>
		<div class="controls">
			<input type="text" id="titulo" name="contacto" value="<?php echo $_POST["contacto"]?>" placeholder="Contacto" />
		</div>
	</div>
    	<div class="control-group">
		<label class="control-label" for="usuario">Horario</label>
		<div class="controls">
                    <textarea id="titulo" name="horario" value="<?php echo $_POST["horario"]?>" placeholder="Horario"></textarea>
		</div>
	</div>
    	<div class="control-group">
		<label class="control-label" for="usuario">Direcci&oacute;n</label>
		<div class="controls">
                    <textarea id="titulo" name="direccion" value="<?php echo $_POST["direccion"]?>" placeholder="Direccion"></textarea>
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
