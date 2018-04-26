<?php
//$busqueda	= $this->utilidades->busqueda_paginador();
$url		= (isset($url) ? $url : base_url()."{$this->router->class}/index/pagina/1/");
?>
<div class="pull-right">
	<?php echo form_open($url, array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" value="" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
