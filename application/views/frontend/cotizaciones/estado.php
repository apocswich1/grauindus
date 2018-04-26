<?php $this->layout->element('admin_mensaje_validacion'); ?>

<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Estado Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Estado Cotización</h3></div>
    
    <p>
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
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
        </ul>
    </p>

    <?php
    if($datos->estado==1)
    {
        ?>
        <p>
        <hr />
   <h4>Quién Liberó la última vez</h4>
   <?php
            $usuario=$this->usuarios_model->getUsuariosPorId($datos->quien_autoriza);
            ?>
            <strong><?php echo $usuario->nombre?></strong> el día <strong><?php echo $datos->fecha_autoriza?></strong>
   <hr />
   </p>
        <?php
    }
    ?>
   
   <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		    <select name="estado">
                    <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>En Revisión</option>
                    <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>Liberada</option>
                    <option value="2" <?php if($datos->estado==2){echo 'selected="true"';}?>>Rechazada</option>
            </select>
	        
		</div>
	</div> 
	
    <div class="control-group">
		<label class="control-label" for="usuario">Glosa</label>
		<div class="controls">
			<textarea id="contenido4" name="glosa" placeholder="Observaciones"><?php echo $datos->glosa; ?></textarea>
		</div>
	</div>

   
    
    <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
    
</div>

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
