<div>
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'formcorreo','id'=>'form')); ?>
<h1>Mensaje para : <?php echo $datos->razon_social?></h1>
<textarea id="contenido" name="mensaje" placeholder="Mensaje"><?php echo set_value('Mensaje'); ?></textarea>
<input type="hidden" name="url" />
<hr />
<div style="text-align: center;">
<input type="button" value="Enviar" onclick="enviaCorreo(document.URL)" class="btn btn-default" />
</div>
<?php echo form_close();?>
</div>