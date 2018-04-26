<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>monotapas/index/<?php echo $this->uri->segment(4)?>">Monotapas &gt;&gt;</a></li>
      <li>Editar Monotapas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Monotapas</h3></div>
	
    
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
		<label class="control-label" for="usuario">Nombre De la Monotapa</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre De la Monotapa" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Código De la Monotapa</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo $datos->codigo?>" placeholder="Código De la Monotapa" />
		</div>
	</div>
    
   
    
     <div class="control-group">
		<label class="control-label" for="usuario">Tipo Onda </label>
		<div class="controls">
			<select name="onda">
                
                <?php
                $a=array("No Procede","Microcorrugado","Corrugado","Cartulina-Cartulina");
                for($i=0;$i<sizeof($a);$i++)
                {
                    ?>
                    <option value="<?php echo $a[$i]?>" <?php if($datos->onda==$a[$i]){echo 'selected="selected"';}?>><?php echo $a[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    
      <div class="control-group">
		<label class="control-label" for="usuario">Tapa, Papel o Cartulina, para onda </label>
		<div class="controls">
				<select name="tapa" onchange="carga_ajax4('<?php echo base_url();?>monotapas/gramaje1',this.value,'gramaje1');">
                <option value="0">Seleccione.....</option>
               <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->id?>" title="<?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )" <?php if($datos->id_tapa==$tapa->id){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )</option>
                        <?php
                    }
                    ?>
            </select>
		</div>
	</div>
    
      <div class="control-group" id="gramaje1">
		<label class="control-label" for="usuario">Gramaje Onda</label>
		<div class="controls">
			<input type="text" name="gramaje" value="<?php echo $datos->gramaje_onda?>" placeholder="Gramaje Onda" readonly="readonly" onkeypress="return soloNumeros(event)" />
            <input type="hidden" name="precio_onda" onclick="sumaGrameje();" />
		</div>
	</div>
    
    
      <div class="control-group">
		<label class="control-label" for="usuario">Tapa, Papel o Cartulina, para liner</label>
		<div class="controls">
				<select name="tapa2" onchange="carga_ajax5('<?php echo base_url();?>monotapas/gramaje2',this.value,'gramaje2');">
                <option value="0">Seleccione.....</option>
               <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->id?>" title="<?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> )" <?php if($datos->id_tapa_2==$tapa->id){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> ) (<?php echo $tapa->reverso?>) </option>
                        <?php
                    }
                    ?>
            </select>
		</div>
	</div>
     
    <div id="gramaje2">
    
    
       <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Liner</label>
		<div class="controls">
			<input type="text" name="gramaje2" value="<?php echo $datos->gramaje_liner?>" placeholder="Gramaje Liner" required="required" onkeypress="return soloNumeros(event)" readonly="readonly" /><input type="button" value="Calcular Gramaje" title="Calcular Gramaje" />
            <input type="hidden" name="precio_liner" />
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Reverso Liner </label>
		<div class="controls">
				<select name="liner">
                <?php
                $b=array("Blanco","Café");
                for($i=0;$i<sizeof($b);$i++)
                {
                    ?>
                    <option value="<?php echo $b[$i]?>" <?php if($datos->liner==$b[$i]){echo 'selected="selected"';}?>><?php echo $b[$i]?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    
    
    </div>
    
    
    
      <div class="control-group">
		<label class="control-label" for="usuario">Gramaje Real</label>
		<div class="controls">
			<input type="text" name="gramaje_real" value="<?php echo $datos->gramaje?>" placeholder="Gramaje Real" readonly="readonly" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" name="precio" value="<?php echo $datos->precio?>" placeholder="Precio" readonly="readonly" /><input type="text" name="precio2" value="<?php echo set_value("precio2")?>" placeholder="Precio 2" />
		</div>
	</div>
    
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
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
