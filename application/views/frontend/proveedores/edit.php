<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>proveedores/index/<?php echo $this->uri->segment(4)?>">Proveedores &gt;&gt;</a></li>
      <li>Editar Proveedor</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Proveedor</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Proveedor" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Razón Social</label>
		<div class="controls">
			<input type="text" id="razon_social" name="razon_social" value="<?php echo $datos->razon_social?>" placeholder="Razón Social" />
		</div>
	</div>          
    	<div class="control-group">
		<label class="control-label" for="usuario">Rut</label>
		<div class="controls">
			<!--<input type="text" id="rut" name="rut" value="<?php //echo $datos->rut?>" placeholder="Numero de Rut"  onblur="ValidarRut(this.value,this.id);"/>-->
			<input type="text" id="rut" name="rut" value="<?php echo $datos->rut?>" placeholder="Numero de Rut"  onblur=""/>
		</div>
	</div>        
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="telefono" name="telefono" value="<?php echo $datos->telefono?>" placeholder="Teléfono" />
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Banco</label>
		<div class="controls">
		<select name="banco">
                    <option value="" <?php if($datos->banco==""){echo "selected='selected'";}  ?>>-- Seleccione --</option>
                    <option value="BANCO ESTADO" <?php if($datos->banco=="BANCO ESTADO"){echo "selected='selected'";}  ?>>BANCO ESTADO</option>
                    <option value="BANCO DE CHILE" <?php if($datos->banco=="BANCO DE CHILE"){echo "selected='selected'";}  ?>>BANCO DE CHILE</option>
                    <option value="BANCO INTERNACIONAL" <?php if($datos->banco=="BANCO INTERNACIONAL"){echo "selected='selected'";}  ?>>BANCO INTERNACIONAL</option>
                    <option value="SCOTIABANK CHILE" <?php if($datos->banco=="SCOTIABANK CHILE"){echo "selected='selected'";}  ?>>SCOTIABANK CHILE</option>
                    <option value="BANCO DE CREDITO E INVERSIONES" <?php if($datos->banco=="BANCO DE CREDITO E INVERSIONES"){echo "selected='selected'";}  ?>>BANCO DE CREDITO E INVERSIONES</option>                    
                    <option value="BANCO BICE" <?php if($datos->banco=="BANCO BICE"){echo "selected='selected'";}  ?>>BANCO BICE</option>                    
                    <option value="HSBC BANK" <?php if($datos->banco=="HSBC BANK"){echo "selected='selected'";}  ?>>HSBC BANK</option>                    
                    <option value="BANCO SANTANDER" <?php if($datos->banco=="BANCO SANTANDER"){echo "selected='selected'";}  ?>>BANCO SANTANDER</option>                    
                    <option value="ITAÚ CORPBANCA" <?php if($datos->banco=="ITAÚ CORPBANCA"){echo "selected='selected'";}  ?>>ITAÚ CORPBANCA</option>                    
                    <option value="BANCO SECURITY" <?php if($datos->banco=="BANCO SECURITY"){echo "selected='selected'";}  ?>>BANCO SECURITY</option>                    
                    <option value="BANCO FALABELLA" <?php if($datos->banco=="BANCO FALABELLA"){echo "selected='selected'";}  ?>>BANCO FALABELLA</option>                    
                    <option value="BANCO RIPLEY" <?php if($datos->banco=="BANCO RIPLEY"){echo "selected='selected'";}  ?>>BANCO RIPLEY</option>                    
                    <option value="BANCO CONSORCIO" <?php if($datos->banco=="BANCO CONSORCIO"){echo "selected='selected'";}  ?>>BANCO CONSORCIO</option>                    
                    <option value="BANCO BBVA" <?php if($datos->banco=="BANCO BBVA"){echo "selected='selected'";}  ?>>BANCO BBVA</option>                    
                    <option value="BANCO BTG PACTUAL CHILE" <?php if($datos->banco=="BANCO BTG PACTUAL CHILE"){echo "selected='selected'";}  ?>>BANCO BTG PACTUAL CHILE</option>                    
                    <option value="OTRO" <?php if($datos->banco=="OTRO"){echo "selected='selected'";}  ?>>OTRO</option>                    
                </select> 		
                </div>
	</div>        
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo de  Cuenta</label>
		<div class="controls">
		<select name="tipo_cuenta">
                    <option value="1" <?php if($datos->tipo_cuenta==1){echo 'selected="true"';}?>>Cuenta Corriente</option>
                    <option value="2" <?php if($datos->tipo_cuenta==2){echo 'selected="true"';}?>>Cuenta Vista</option>
                    <option value="3" <?php if($datos->tipo_cuenta==3){echo 'selected="true"';}?>>Cuenta Rut</option>
                    <option value="4" <?php if($datos->tipo_cuenta==4){echo 'selected="true"';}?>>Cuenta de Ahorro</option>                    
                </select>                    
		</div>
	</div>             
        
    <div class="control-group">
		<label class="control-label" for="usuario">Numero Cuenta</label>
		<div class="controls">
			<input type="text" id="num_cuenta" name="num_cuenta" value="<?php echo $datos->num_cuenta?>" placeholder="Numero de la Cuenta" />
		</div>
	</div>        
    
    <div class="control-group">
		<label class="control-label" for="usuario">Titular de la Cuenta</label>
		<div class="controls">
			<input type="text" id="titular_cuenta" name="titular_cuenta" value="<?php echo $datos->titular_cuenta?>" placeholder="Tiular de la Cuenta" />
		</div>
	</div>            
    
    <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
		<div class="controls">
			<input type="text" id="titulo" name="correo" value="<?php echo $datos->correo?>" placeholder="E-Mail" />
		</div>
	</div>
    
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Rubro</label>
		<div class="controls">
			<input type="text" id="titulo" name="rubro" value="<?php //echo $datos->rubro?>" placeholder="Rubro" />
		</div>
	</div>-->

        
     <div class="control-group">
         <div id="sub_rubro">
		<label class="control-label" for="usuario" >Rubro (Calidad de Taller)<strong style="color: red;">(*)</strong></label>
		<div class="controls" >
			<select name="rubro">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->rubros_model->getRubros();
                            foreach($formas as $forma)
                            {
                                ?>
                                <option value="<?php echo $forma->id; ?>" <?php if($datos->rubro==$forma->id){echo 'selected="selected"';}?>><?php echo $forma->rubro; ?></option>
                                <?php
                            }
                            ?>
                       </select>
		</div>
	</div>                
    </div> 
     <div class="control-group">
         <div id="sub_rubro">
		<label class="control-label" for="usuario" >Rubro 2 (Calidad de Taller)</label>
		<div class="controls" >
			<select name="rubro2">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->rubros_model->getRubros();
                            foreach($formas as $forma)
                            {
                                ?>
                                <option value="<?php echo $forma->id; ?>" <?php if($datos->rubro2==$forma->id){echo 'selected="selected"';}?>><?php echo $forma->rubro; ?></option>
                                <?php
                            }
                            ?>
                       </select>
		</div>
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
                                <option value="<?php echo $forma->id; ?>" <?php if($datos->id_forma_pago==$forma->id){echo 'selected="selected"';}?>><?php echo $forma->forma_pago; ?></option>
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
			<input type="text" id="titulo" name="contacto" value="<?php echo $datos->contacto?>" placeholder="Contacto" />
		</div>
	</div>
    	<div class="control-group">
		<label class="control-label" for="usuario">Horario</label>
		<div class="controls">
                    <textarea id="horario" name="horario" value="" placeholder="horario"><?php echo $datos->horario?></textarea>
		</div>
	</div>
    	<div class="control-group">
		<label class="control-label" for="usuario">Direcci&oacute;n</label>
		<div class="controls">
                    <textarea id="direccion" name="direccion" value="<?php echo $datos->direccion?>" placeholder="direccion"><?php echo $datos->direccion?></textarea>
		</div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
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
