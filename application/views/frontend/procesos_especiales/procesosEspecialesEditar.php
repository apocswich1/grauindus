<script>
    function guardar()
    {
    window.location = "procesos_especiales/editar";
    }
    
</script>



<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
    
<?php //echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li> <a <!-- href="<?php //echo base_url()?>procesos_especiales/index"-->>Pocesos especiales &gt;&gt;</a> </li>
      <li>Agregar proceso especial</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar proceso especial</h3></div>
      <!--  <div><?php echo base_url(); ?></div> -->
        
        <form action ="<?php echo base_url(); ?>procesos_especiales/editar/<?php echo $id?>" method="post">
	<div class="control-group">
		<label class="control-label" for="usuario">Proceso especial</label>
		
                <div class="controls">
                    <input type="text" id="titulo" name="proceso"  placeholder="Proceso especial" value= <?php echo $nombre_editar ?> />
		</div>
	</div>
    
    
    
	<div class="control-group">
		<div class="form-actions">
                    <button type="submit" class="btn" <!--onclic ="guardar()"-->  Guardar</button>
		</div>
	</div>
        </form>

        <table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php 
   // var_dump($datos); 
     //foreach($data as $datos->result()=>$dato)
   //  foreach($datos->result() as $data)  
    foreach($tabla->result() as $dato)
    {
        ?>
       <td><?php echo $dato->nombre_procesp?></td>
 
     
            <td>
              <a href="<?php echo base_url(); ?>procesos_especiales/retornaDatosEditar/<?php echo $dato->id_procesp?>/<?php // echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
            <a href="<?php echo base_url(); ?>procesos_especiales/eliminar/<?php echo $dato->id_procesp?>/" onclick="eliminar('<?php echo base_url()?>procesosEspeciales/eliminar/<?php echo $dato->id_procesp?>/<?php // echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
             </tbody>
   <?php      
    }
      ?>
                  <tr>
        <td colspan="7" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
        

            
    </tr>
    
    

   
</table>
       		 

<!--
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.nom.focus();
        }
    );
    
</script>+-->
</div>