<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>materiales/index/<?php echo $this->uri->segment(4)?>">Tapas, Papeles y Cartulinas &gt;&gt;</a></li>
      <li>Editar Tapas, Papeles y Cartulinas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Tapas, Papeles y Cartulinas</h3></div>
	
     <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado</label>
		<div class="controls">
		    <select name="estado">
                    <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>No Vigente</option>
                    <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>Vigente</option>
            </select>
	
		</div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="0">Seleccione.....</option>
                <?php
               foreach($tipos as $tipo)
               {
                    ?>
                    <option value="<?php echo $tipo->id?>" <?php if($datos->tipo==$tipo->id){echo 'selected="selected"';}?>><?php echo $tipo->materiales_tipo?></option>
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
                    <option value="<?php echo $prove->id?>" <?php if($datos->id_proveedor==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    
    
    
	<div class="control-group">
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo $datos->codigo?>" placeholder="Código" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Descripción" />
		</div>
	</div>
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Reverso</label>
		<div class="controls">
			<select name="reverso">
                <option value="Cafe" <?php if($datos->reverso=="Cafe"){echo 'selected="selected"';}?>>Café</option>
                <option value="Blanco" <?php if($datos->reverso=="Blanco"){echo 'selected="selected"';}?>>Blanco</option>
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
                    <option value="<?php echo $procedencia->id?>" <?php if($datos->id_materiales_procedencia==$procedencia->id){echo 'selected="selected"';}?>><?php echo $procedencia->procedencia?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="gramaje">
		<label class="control-label" for="usuario">Gramaje</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo $datos->gramaje?>" placeholder="Gramaje" onkeypress="return soloNumeros(event)" />
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
                    <option value="<?php echo $array[$i]?>" <?php if($datos->ancho==$array[$i]){echo 'selected="selected"';}?>><?php echo $array[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de Pedido</label>
		<div class="controls">
			<input type="text" name="ancho_de_pedido" id="ancho_de_pedido" value="<?php echo $datos->ancho_de_pedido?>" onkeypress="return soloNumeros(event)" />


		</div>
	</div>
    
   <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Compra</label>
		<div class="controls">
			<select name="unidad_de_compra">
                <option value="0">Seleccione.....</option>
                <?php
                $unidads=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidads as $unidad)
                {
                    ?>
                    <option value="<?php echo $unidad->id?>" <?php if($datos->unidad_de_compra==$unidad->id){echo 'selected="selected"';}?>><?php echo $unidad->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Divisa</label>
		<div class="controls">
			<select name="divisa">
                <option value="Pesos" <?php if($datos->divisa=="Pesos"){echo 'selected="selected"';}?>>Pesos</option>
               <option value="Dólares" <?php if($datos->divisa=="Dólares"){echo 'selected="selected"';}?>>Dólares</option>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio" value="<?php echo $datos->precio?>" placeholder="Precio" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
    
    
 
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
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
