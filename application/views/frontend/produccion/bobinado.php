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
            <li>Bobinado - Orden de Producción N° <?php echo $id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Bobinado - Fast Track N° <?php echo $id?></li>
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
            <div class="page-header"><h3>Bobinado - Orden de Producción N° <?php echo $id?></h3></div>
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
            <div class="page-header"><h3>Bobinado - Fast Track N° <?php echo $id?></h3></div>
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
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo $control->descripcion_del_trabajo; ?>" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de bobina <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="numero_de_bobina" placeholder="Número de bobina" value="<?php echo $control->numero_de_bobina?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho de bobina madre <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_de_bobina_madre" placeholder="Ancho de bobina madre" value="<?php echo $control->ancho_de_bobina_madre?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho a bobinar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_a_bobinar" placeholder="Ancho a bobinar" value="<?php echo $control->ancho_a_bobinar?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios2 as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($control->operador==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ayudante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->ayudante==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho sobrante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_sobrante" placeholder="Ancho sobrante" value="<?php echo $control->ancho_sobrante?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Kilos sobrantes <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="kilos_sobrantes" placeholder="Kilos sobrantes" value="<?php echo $control->kilos_sobrantes?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Kilos sobrantes <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="kilos_sobrantes" placeholder="Kilos sobrantes" value="<?php echo $control->kilos_sobrantes?>" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Origen <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="origen" placeholder="Origen" value="<?php echo $control->origen?>" />
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
