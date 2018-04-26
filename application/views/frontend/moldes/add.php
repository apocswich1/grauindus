<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>moldes">Moldes &gt;&gt;</a></li>
      <li>Agregar Molde</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Molde</h3></div>
	
<table style="width:1200px">
    <tr>
        <td>
          <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
				<select name="tipo">
                <option value="Exclusivo">Exclusivo</option>
                <option value="Genérico">Genérico</option>
            </select>
		</div>
	</div>
	 
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente 1 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
				<select name="nombrecliente" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>" <?php if(isset($_POST["nombrecliente"]) and $_POST["nombrecliente"]==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente 2 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
				<select name="nombrecliente2" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($clientes as $cliente2)
                {
                    ?>
                    <option value="<?php echo $cliente2->id?>" <?php if(isset($_POST["nombrecliente2"]) and $_POST["nombrecliente2"]==$cliente2->id){echo 'selected="true"';}?>><?php echo $cliente2->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>   
        </td>
        <td>
        <div class="control-group">
        <label id="option1" style="background-color: #0066cc; color: #fff; width: 500px;margin-left: 70px;
padding-left: 70px;">Materialidad Opcion Principal</label>
<div id="seccion1">
    <div class="control-group">
		<label class="control-label" for="usuario">Materialidad<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select id="materialidad_opcion1" name="materialidad_opcion1" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                foreach($datosTecnicos as $datosTecnico){ ?>                
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos->materialidad_opcion1==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                <?php } ?>
            </select>
		</div></div>
	
    
          <div class="control-group" id="div_materialidad_1">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    		<select name="placa1"  class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>
                </select>
    		</div>
    	</div>
        <?php 
            if (sizeof($datos)>0) {  
               if ($datos->materialidad_opcion1=="3") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($datos->materialidad_opcion1=="4") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }        
         // echo $div_materialidad2;              
        ?>
                <div class="control-group" id="div_materialidad_2" <?php echo $div_materialidad2; ?>>
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
                    <select name="onda1"  class="chosen-select chosen-single" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->onda1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>
                </select>
    		</div>
    	</div>
        
        <?php 
          if (sizeof($datos)>0) 
            {
               if ($datos->materialidad_opcion1=="4") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            else
            {
               if ($_POST["materialidad_opcion1"]==4) 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }            
        ?>        
                <div class="control-group" id="div_materialidad_3" <?php echo $div_materialidad3; ?>>
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
                    <select name="liner1" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->liner1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>                    
                </select>
    		</div>
    	</div>
    	</div></div>     
        </td>
        </tr>
        <tr>
        <td>
           <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Medidas de la caja<strong>(centímetros)</strong></label>
		<div class="controls"> 
		   L  <input type="text" name="medidas_de_las_cajas"   id="medidas_de_las_cajas"   placeholder="L"  value="<?php echo $_POST["medidas_de_las_cajas"];?>"   style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas',Formato);" />
                   A  <input type="text" name="medidas_de_las_cajas_2" id="medidas_de_las_cajas_2" placeholder="A"  value="<?php echo $_POST["medidas_de_las_cajas_2"];?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_2',Formato);"/>
                   H  <input type="text" name="medidas_de_las_cajas_3" id="medidas_de_las_cajas_3" placeholder="H"  value="<?php echo $_POST["medidas_de_las_cajas_3"];?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_3',Formato);"/>
                   AT <input type="text" name="medidas_de_las_cajas_4" id="medidas_de_las_cajas_4" placeholder="AT" value="<?php echo $_POST["medidas_de_las_cajas_4"];?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_4',Formato);"/>        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño Caja <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="tamano_caja" value="<?php echo set_value("tamano_caja")?>" placeholder="Tamaño Caja" />
		</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="usuario">Unidades (Productos Completos) por Pliego<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="unidades_productos_completos" value="<?php echo set_value("unidades_productos_completos")?>" placeholder="unidades por pliego" />
		</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Totales en el Pliego para Desgajado<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="piezas_totales" value="<?php echo set_value("piezas_totales")?>" placeholder="piezas totales en el pliego" />
		</div>
    </div> 
        </td>
        <td> <label id="option2" style="background-color: #0066cc; color: #fff; width: 500px;margin-left: 70px;
padding-left: 70px;">Materialidad Opcion Secundaria</label>
<div id="seccion2">
<div class="control-group">
		<label class="control-label" for="usuario">Materialidad 2<strong style="color: red;">(*)</strong></label>
		<div class="controls">
				<select id="materialidad_opcion2" name="materialidad_opcion2" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                foreach($datosTecnicos as $datosTecnico){ ?>                
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos->materialidad_opcion2==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                <?php } ?>
            </select>
		</div>
	</div>
    
          <div class="control-group" id="div_materialidad_11">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    		<select name="placa2"  class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->placa2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>
                </select>
    		</div>
    	</div>
        <?php 
            if (sizeof($datos)>0) 
            {
               if ($datos->materialidad_opcion2=="3") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($datos->materialidad_opcion2=="4") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            else
            {
               if ($_POST["datos_tecnicos"]==3) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                 
            }            
        ?>
                <div class="control-group" id="div_materialidad_22" <?php echo $div_materialidad2; ?>>
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
                    <select name="onda2"  class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>
                </select>
    		</div>
    	</div>
        
        <?php 
            if (sizeof($datos)>0) 
            {
               if ($datos->materialidad_opcion2=="4") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            else
            {
               if ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }            
        ?>        
                <div class="control-group" id="div_materialidad_33" <?php echo $div_materialidad3; ?>>
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
                    <select name="liner2" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->liner2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } ?>                    
                </select>
    		</div>
    	</div>
    	</div>
        </td>
    </tr>
</table>
        <!--<div class="page-header"></div>-->
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Distancia cuchillo a cuchillo<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_cuchillo_1" style="width: 100px;"  value="<?php echo set_value("tamano_cuchillo_1"); ?>" placeholder="0" onblur="cuchillo();" /> X <input type="text" name="tamano_cuchillo_2" style="width: 100px;" value="<?php echo set_value("tamano_cuchillo_2") ?>" placeholder="0" onblur="cuchillo();" /> Cms. 
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño a imprimir Ancho por Largo (largo a cortar) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_bobina" style="width: 100px;" value="<?php echo set_value("ancho_bobina") ?>" placeholder="Ancho" /> X <input type="text" name="largo_bobina" style="width: 100px;" value="<?php echo set_value('largo_bobina') ?>" placeholder="Largo" /> 
		</div>
	</div>

    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Fecha Creación <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="date" name="fecha_creacion" value="<?php  echo set_value("fecha_creacion") ?>" />
		</div>
	</div>
      
        <h3>PDF de Imagen</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ingrese PDF de la Imagen</label>
		<div class="controls">
			<input type="file" id="file" name="file" />
		</div>
	</div>
  
  

    
	<div class="control-group">
		<div class="form-actions">
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.nom.focus();
        }
    );
    
       $("#materialidad_opcion1").on('change',function(){
        var x = this.value;
        
        if(x==4){
            $("#div_materialidad_2").hide();
            $("#div_materialidad_3").hide();
        }
        if(x==3){
            $("#div_materialidad_3").show();
            $("#div_materialidad_2").hide();
            $("#div_materialidad_1").show();
        }
        if(x==1){
            $("#div_materialidad_1").show();
            $("#div_materialidad_2").show();
            $("#div_materialidad_3").show();
        }
        if(x==2){
            $("#div_materialidad_1").show();
            $("#div_materialidad_2").show();
            $("#div_materialidad_3").show();
        }
        if(x==''){
            $("#div_materialidad_1").show();
            $("#div_materialidad_2").show();
            $("#div_materialidad_3").show();
        }
        
    });
    $("#materialidad_opcion2").on('change',function(){
        var x = this.value;
        
        if(x==4){
            $("#div_materialidad_22").hide();
            $("#div_materialidad_33").hide();
        }
        if(x==3){
            $("#div_materialidad_33").show();
            $("#div_materialidad_22").hide();
            $("#div_materialidad_11").show();
        }
        if(x==1){
            $("#div_materialidad_11").show();
            $("#div_materialidad_22").show();
            $("#div_materialidad_33").show();
        }
        if(x==2){
            $("#div_materialidad_11").show();
            $("#div_materialidad_22").show();
            $("#div_materialidad_33").show();
        }
        if(x==''){
            $("#div_materialidad_11").show();
            $("#div_materialidad_22").show();
            $("#div_materialidad_33").show();
        }
        
    });
</script>
</div>
