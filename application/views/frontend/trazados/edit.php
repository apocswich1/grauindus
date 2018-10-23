<?php $this->layout->element('admin_mensaje_validacion'); ?>
<style>
    .chosen-single{ width: 100% !important;
    }
    .chosen-single input{ width: 100% !important;
    }
    .chosen-select{ width: 100% !important;
    }
    .chosen-select input{ width: 100% !important;
    }
    .chosen-container{width: 100% !important;}
</style>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>moldes/index/<?php echo $pagina?>">Trazados &gt;&gt;</a></li>
      <li>Editar Trazado</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Trazado</h3></div>
    <?php if( $this->session->userdata('perfil')!=2){ ?>
    <div class="control-group">
		<label class="control-label" for="usuario"><strong>PDF Trazados</strong></label>
		<div class="controls">
			<?php if ($datos->archivo==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url().$this->config->item('direccion_pdf').$datos->archivo ?>' target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
    <?php }?>
    <hr />		 
    <table>
        <tr>
            <td>
      <div class="control-group">
		<label class="control-label" for="usuario">Estatus</label>
		<div class="controls">
				<select name="estatus">
                <option value="Provisorio" <?php if($datos->estatus=='Provisorio'){echo 'selected="true"';}?>>Provisorio</option>
                <option value="Definitivo" <?php if($datos->estatus=='Definitivo'){echo 'selected="true"';}?>>Definitivo</option>
            </select>
		</div>
	</div>           
     <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
				<select name="tipo">
                <option value="Exclusivo" <?php if($datos->tipo=='Exclusivo'){echo 'selected="true"';}?>>Exclusivo</option>
                <option value="Genérico" <?php if($datos->tipo=='Genérico'){echo 'selected="true"';}?>>Genérico</option>
            </select>
		</div>
	</div>
     <?php //echo "<h1>" . $datos->estado . "</h1>"; //my code is here ?>
     <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		    <select name="estado">
                    <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>Activo</option>
                    <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>No Activo</option>
            </select>
	
		</div>
	</div> 
     <div class="control-group">
		<label class="control-label" for="id_antiguo">Pauta Conjunta<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="pauta" onchange="activar(this.value);">
                    <option value="0" <?php if($datos->pauta==0){echo 'selected="true"';}?>>No</option>
                    <option value="1" <?php if($datos->pauta==1){echo 'selected="true"';}?>>Si</option>
            </select>
	
		</div>
	</div> 
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="num" value="<?php echo $datos->numero?>" placeholder="Número" readonly="true" />
		</div>
	</div>
    

    
	 
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" />
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
                    <option value="<?php echo $cliente->id?>" <?php if($datos->nombrecliente==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
            </td>
            <td>
            <div class="control-group">
		<label id="optionRango" style="background-color: #0066cc; color: #fff; width: 500px;margin-left: 70px;
padding-left: 70px;">Rango de gramaje de la cartulina para casos contra la fibra</label>
        <label class="control-label" for="usuario">Rango</label>
		<div class="controls">
				<select name="rango_gramaje">
                <option value="">-- Seleccione --</option>
                <option value="1" <?php if($datos->rango_gramaje=="1"){echo 'selected="true"';}?>>Entre 190 y 250 (30mm min)</option>
                <option value="2" <?php if($datos->rango_gramaje=="2"){echo 'selected="true"';}?>>Entre 251 y 325 (50mm min)</option>
                <option value="3" <?php if($datos->rango_gramaje=="3"){echo 'selected="true"';}?>>Entre 326 y Mayores (100mm min)</option>
            </select>
		</div>
	</div>
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
            </td></tr>
        <tr>
            <td>      
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente 2 <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="nombrecliente2" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>" <?php if($datos->nombrecliente2==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Colores<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="colores">
                    <option value="0" <?php if($datos->colores==0){echo 'selected="true"';}?>>0</option>
                    <option value="1" <?php if($datos->colores==1){echo 'selected="true"';}?>>1</option>
                    <option value="2" <?php if($datos->colores==2){echo 'selected="true"';}?>>2</option>
                    <option value="3" <?php if($datos->colores==3){echo 'selected="true"';}?>>3</option>
                    <option value="4" <?php if($datos->colores==4){echo 'selected="true"';}?>>4</option>
                    <option value="5" <?php if($datos->colores==5){echo 'selected="true"';}?>>5</option>
                    <option value="6" <?php if($datos->colores==6){echo 'selected="true"';}?>>6</option>
                    <option value="7" <?php if($datos->colores==7){echo 'selected="true"';}?>>7</option>
            </select>
	
		</div>
	</div> 
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Medidas de la caja<strong>(centímetros)</strong></label>
		<div class="controls"> 
		   L  <input type="text" name="medidas_de_las_cajas"   id="medidas_de_las_cajas"   placeholder="L"  value="<?php echo $datos->medidas_de_las_cajas;?>"   style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas',Formato);" />
                   A  <input type="text" name="medidas_de_las_cajas_2" id="medidas_de_las_cajas_2" placeholder="A"  value="<?php echo $datos->medidas_de_las_cajas_2;?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_2',Formato);"/>
                   H  <input type="text" name="medidas_de_las_cajas_3" id="medidas_de_las_cajas_3" placeholder="H"  value="<?php echo $datos->medidas_de_las_cajas_3;?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_3',Formato);"/>
                   AT <input type="text" name="medidas_de_las_cajas_4" id="medidas_de_las_cajas_4" placeholder="AT" value="<?php echo $datos->medidas_de_las_cajas_4;?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_4',Formato);"/>        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Tamaño Caja <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" id="tamano_caja" name="tamano_caja" value="<?php echo $datos->tamano_caja?>" readonly="true" placeholder="Tamaño Caja" />
		</div>
	</div>
    <div class="control-group" id="glosa" style="<?php if($datos->pauta==1){echo "display: true";}else{echo "display: none";}?>">
        <label class="control-label" for="usuario">Glosa por pauta conjunta<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" id="titulo" name="glosa" value="<?php echo $datos->glosa?>" placeholder="Texto Descriptivo" style="width: 600px"/>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Uniades (Productos completos) por Pliego<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="unidades_productos_completos" value="<?php echo $datos->unidades_productos_completos?>" placeholder="unidades (p/c) por pliego" />
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Totales en el Pliego para Desgajado<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="piezas_totales" value="<?php echo $datos->piezas_totales?>" placeholder="piezas totales en el pliego" />
		</div>
	</div>
            </td>
            <td>
               <label id="option2" style="background-color: #0066cc; color: #fff; width: 500px;margin-left: 70px;
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
        <tr>
        <td>
        <div class="control-group" id="">
    		<label class="control-label" for="usuario" id="criterio" style="background-color:blue; color:#fff; font-weight:bold; text-align:center;"></label>
        </div>
    </tr>
    </table>
    
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Distancia cuchillo a cuchillo<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" id="tamanocuchillo1" name="tamano_cuchillo_1" style="width: 100px;"  value="<?php echo $datos->cuchillocuchillo; ?>" placeholder="0" onblur="cuchillo();" /> X <input type="text" id="tamanocuchillo2" name="tamano_cuchillo_2" style="width: 100px;" value="<?php echo $datos->cuchillocuchillo2 ?>" placeholder="0" onblur="cuchillo();" /> Cms. 
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño a imprimir Ancho por Largo (largo a cortar) <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" id="anchobobina" name="ancho_bobina" style="width: 100px;" value="<?php echo $datos->ancho_bobina?>" placeholder="Ancho" /> X <input type="text" id="largobobina" name="largo_bobina" style="width: 100px;" value="<?php echo $datos->largo_bobina?>" placeholder="Largo" /> 
		</div>
	</div>
    <div class="control-group" id="distancia">
		<label class="control-label" for="usuario">Distancia ccac</label>
		<div class="controls">
                    <input type="text" readonly id="ccac_1" name="ccac_1" style="width: 100px;" value="<?php if(sizeof($datos)>0){ echo ($datos->ancho_bobina-$datos->cuchillocuchillo)*10; }?>" placeholder="ccac 1" /> X <input type="text" id="ccac_2" readonly name="ccac_2" style="width: 100px;" value="<?php if(sizeof($datos)>0){ echo ($datos->largo_bobina-$datos->cuchillocuchillo2)*10; }?>" placeholder="ccac 2" /> 
		</div>
	</div>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Fecha Creación <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="date" name="fecha_creacion" value="<?php  echo $datos->fecha_creacion ?>" />
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
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="archivo" value="<?php echo $datos->archivo?>" />
			<button id="submit" type="btn" class="btn">Guardar</button>
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

    $('#submit').on('click',function(){
        var rango = document.form.rango_gramaje.value;
        var piezas = document.form.piezas_totales.value;
        var unidades = document.form.unidades_productos_completos.value;
        
        if(parseInt(piezas)<parseInt(unidades)){
            alert("Las piezas totales en el pliego no pueden ser menor a unidades por pliego");
            return false;
        }
        if(rango==""){
            alert("Debe ingresar el rango de gramaje de forma obligatoria");
            return false;
        }
        document.form.submit();
    });

    $("#anchobobina").on("blur",function(){
        var ancho = $(this).val();
        var largo = $("#largobobina").val();
        var rango_gramaje = $("select[name=rango_gramaje]").val();
        //alert(rango_gramaje);
        if(parseInt(ancho)>parseInt(largo)){
            $("#criterio").text('Criterio Impresion Contra la Fibra');
            if(rango_gramaje==""){
                alert("Debe seleccionar un rango para el gramaje de la cartulina");
                $("#anchobobina").val("");
                $("#largobobina").val("");
            }else{
                if(rango_gramaje=="1"){
                    var sum = parseInt((30*10)/100);
                    var tc = parseInt($("#tamanocuchillo2").val());
                    var total = sum+tc;
                    if(total<100){
                    $("#largobobina").val(total);
                    $("#ccac_2").val((total-tc)*10);
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#aaca_2").val("");
                    }
                }
                if(rango_gramaje=="2"){
                    var sum = parseInt((50*10)/100);
                    var tc = parseInt($("#tamanocuchillo2").val());
                    var total = sum+tc;
                    $("#largobobina").val(total);
                    if(total<100){
                    $("#largobobina").val(total);
                    $("#ccac_2").val((total-tc)*10);
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#aaca_2").val("");
                    }
                }
                if(rango_gramaje=="3"){
                    var sum = parseInt((100*10)/100);
                    var tc = $("#tamanocuchillo2").val();
                    var total = sum+tc;
                    $("#largobobina").val(total);
                    if(total<100){
                    $("#largobobina").val(total);
                    $("#ccac_2").val((total-tc)*10);
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#aaca_2").val("");
                    }
                }
            }        
        }else{
            $("#criterio").text('No Aplica Criterio');
        }
    });

    $("#largobobina").on("blur",function(){
        var largo = $(this).val();
        var ancho = $("#anchobobina").val();
        var rango_gramaje = $("select[name=rango_gramaje]").val();
        //alert(ancho+"-"+largo);
        if(parseInt(ancho)>parseInt(largo)){
            $("#criterio").text('Criterio de Impresion Contra la Fibra');
            if(rango_gramaje==""){
                alert("Debe seleccionar un rango para el gramaje de la cartulina");
                $("#anchobobina").val("");
                $("#largobobina").val("");
            }else{
                if(rango_gramaje=="1"){
                    var sum = parseInt((30*10)/100);
                    var tc = parseInt($("#tamanocuchillo2").val());
                    var total = sum+tc;
                    var asig = $("#largobobina").val();
                    var resto = parseInt($("#largobobina").val())-tc;
                    
                    if(total<100){
                        if(resto>=3){
                            $("#largobobina").val(asig);
                            $("#ccac_2").val((asig-tc)*10);
                        }else{
                            $("#largobobina").val(total);
                            $("#ccac_2").val((total-tc)*10);
                        }
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#ccac_2").val("");
                    }
                }
                if(rango_gramaje=="2"){
                    var sum = parseInt((50*10)/100);
                    var tc = parseInt($("#tamanocuchillo2").val());
                    var total = sum+tc;
                    var asig = $("#largobobina").val();
                    var resto = parseInt($("#largobobina").val())-tc;
                    
                    if(total<100){
                        if(resto>=5){
                            $("#largobobina").val(asig);
                            $("#ccac_2").val((asig-tc)*10);
                        }else{
                            $("#largobobina").val(total);
                            $("#ccac_2").val((total-tc)*10);
                        }
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#ccac_2").val("");
                    }
                }
                if(rango_gramaje=="3"){
                    var sum = parseInt((100*10)/100);
                    var tc = $("#tamanocuchillo2").val();
                    var total = sum+tc;
                    var asig = $("#largobobina").val();
                    var resto = parseInt($("#largobobina").val())-tc;
                    
                    if(total<100){
                        if(resto>=10){
                            $("#largobobina").val(asig);
                            $("#ccac_2").val((asig-tc)*10);
                        }else{
                            $("#largobobina").val(total);
                            $("#ccac_2").val((total-tc)*10);
                        }
                    }else{
                        alert("No se puede aplicar criterio porque medidas no se corresponden");
                        $("#anchobobina").val("");
                        $("#largobobina").val("");
                        $("#ccac_1").val("");
                        $("#ccac_2").val("");
                    }
                }
                
            }
        }else{
            $("#criterio").text('No Aplica Criterio');
        }
    });
    
    function activar(x){
        if(x==1){
            $('#glosa').show(500);
        }else{
            $('#glosa').hide(500);
        }
    }
    
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

function hacer_medidas(){
   var a = $("#medidas_de_las_cajas").val(),
    b = $("#medidas_de_las_cajas_2").val(),
    c = $("#medidas_de_las_cajas_3").val(),
    d = $("#medidas_de_las_cajas_4").val();
    
    $("#tamano_caja").val(a+' x '+b+' x '+c+' x '+d);
    }
    
$("#medidas_de_las_cajas").on('keyup',function(){
    hacer_medidas();
});
$("#medidas_de_las_cajas_2").on('keyup',function(){
    hacer_medidas();
});
$("#medidas_de_las_cajas_3").on('keyup',function(){
    hacer_medidas();
});
$("#medidas_de_las_cajas_4").on('keyup',function(){
    hacer_medidas();
});

$("#largobobina").on("keyup",function(){
        var a = $(this).val();
        var tamano2 = $("#tamanocuchillo2").val();
            if(parseInt(a) < parseInt(tamano2)){
            if (!$("#etiquetaerror").length > 0 ) {
            $(this).after("<label style='color:red' id='etiquetaerror'>No puede ser menor al tamaño de la cuchilla</label>");
            }
            }else{
                $("#etiquetaerror").remove();
            }    
    });

     $("#tamanocuchillo1").on("keyup",function(){
        var tamano1 = $(this).val();
        var a = $("#anchobobina").val();
            $("#ccac_1").val((parseInt(a)-parseInt(tamano1))*10);    
    });

    $("#tamanocuchillo2").on("keyup",function(){
        var tamano2 = $(this).val();
        var a = $("#largobobina").val();
            $("#ccac_2").val((parseInt(a)-parseInt(tamano2))*10);    
    });
    
    $("#anchobobina").on("keyup",function(){
        var a = $(this).val();
        var tamano1 = $("#tamanocuchillo1").val();
        var largo = $("#largobobina").val();
        $.post(webroot+"cotizaciones/medidas",{ancho:a,largo:largo},function(resp)
        {
        var myObj = $.parseJSON(resp);
        a = myObj[1];
        ancho = myObj[0];
        $("#anchobobina").val(ancho);
        $("#largobobina").val(a);
        });
            $("#ccac_1").val((parseInt(a)-parseInt(tamano1))*10);    
    });
    
    $("#largobobina").on("keyup",function(){
        var a = $(this).val();
        var ancho = $("#anchobobina").val();
        var tamano2 = $("#tamanocuchillo2").val();

        $.post(webroot+"cotizaciones/medidas",{ancho:ancho,largo:a},function(resp)
        {
        var myObj = $.parseJSON(resp);
        a = myObj[1];
        ancho = myObj[0];
        $("#anchobobina").val(ancho);
        $("#largobobina").val(a);
        });
            
            $("#ccac_2").val((parseInt(a)-parseInt(tamano2))*10);    
    });
</script>
</div>
