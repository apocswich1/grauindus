<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Troquelado - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Troquelado - Fast Track N° <?php echo $id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
   <!-- /Migas -->
    <?php
      switch($tipo)
      {
        case '1':
            ?>
            <div class="page-header"><h3>Troquelado - Orden de Producción N° <?php echo $id?></h3></div>
            <ul>
                <?php
                 if($datos->id_cliente==3000)
                {
                    $cliente=$datos->nombre_cliente;
                }else
                {
                    $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                    $cliente=$cli->razon_social;
                }
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                ?>
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Troquelado - Fast Track N° <?php echo $id?></h3></div>
            <ul>
                <?php
                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                ?>
                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
                <hr />
            <?php
        break;
      }
      ?>
	<p>
         
    </p>
	
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción del trabajo</label>
		<div class="controls">
			<textarea id="contenido4" name="descripcion_del_trabajo"><?php echo $control->descripcion_del_trabajo; ?></textarea>
       </div>
	</div> 
  
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número molde troquel <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_molde_troquel" value="<?php echo $control->numero_molde_troquel?>"/>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total Pliegos a troquelar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_a_troquelar" placeholder="Total Pliegos a troquelar" value="<?php echo $control->total_pliegos_a_troquelar?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos recibidos de emplacado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_recibidos_de_emplacado" value="<?php echo $control_cartulina->total_pliegos?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->operador==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ayudante 1 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante_1">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->ayudante_1==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total pliegos buenos <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="total_pliegos_buenos" placeholder="Total pliegos buenos" value="<?php echo $control->total_pliegos_buenos?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Merma <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="merma" placeholder="Merma" value="<?php echo $control->merma?>" />
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    
    
    
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="id_cliente" value="<?php if($tipo==1){echo $datos->id_cliente;}else{echo $datos->cliente;}?>" />
			<input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			<input type="button" value="Guardar" class="btn <?php if($control->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
   		 <input type="button" value="Rechazar" class="btn <?php if($control->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
		</div>
	</div>
</form>

<script type="text/javascript">
     jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
