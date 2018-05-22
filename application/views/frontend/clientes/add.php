<?php $this->layout->element('admin_mensaje_validacion'); ?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        z-index: 9999;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
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
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>clientes/index">Clientes &gt;&gt;</a></li>
      <li>Agregar Cliente</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Cliente</h3></div>
	<div id="map"></div>
        <table>
            <tr>
                <td>
                    
    <div class="control-group">
		<label class="control-label" for="usuario">Vendedor <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="vendedor" id="vendedor">
               
				<?php
                if($this->session->userdata('perfil')==1)
                {
                    ?>
                    <option value="0">Seleccione.....</option>
                    <?php
                    foreach($vendedors as $vendedor)
                    {
                        ?>
                        <option value="<?php echo $vendedor->id?>"<?php echo set_value_select(array(),'vendedor','vendedor',$vendedor->id);?>><?php echo $vendedor->nombre?></option>
                        <?php
                    }
                }else
                {
                    ?>
                        <option value="<?php echo $this->session->userdata('id')?>"<?php echo set_value_select(array(),'vendedor','vendedor',$this->session->userdata('id'));?>><?php echo $this->session->userdata('nombre')?></option>
                        <?php
                }
                
                ?>
                <?php
                //foreach($vendedors as $vendedor)
                //{
                    ?>
                   <!--<option value="<?php //echo $vendedor->id?>"><?php //echo $vendedor->nombre?></option>-->
                    <?php
                //}
                ?>
                
            </select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="usuario">RUT Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="rut" name="rut" onblur="ValidarRut(this.value,this.id);" value="<?php echo $_POST['rut']?>" placeholder="(con guion y sin puntos)" />
			<?php echo '<a href='.'#'.'>xxxxxxx-x</a>';?>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Razón Social <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="razon" name="razon" value="<?php echo $_POST['razon']; ?>" placeholder="Razón Social" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre de Fantasía <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="nom" name="nom" value="<?php echo $_POST['nom']; ?>" placeholder="Nombre de Fantasía" />
		</div>
	</div>
    
    
	 <div class="control-group">
		<label class="control-label" for="usuario">E-Mail <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="correo" name="correo" value="<?php echo $_POST['correo']; ?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="tel" name="tel" value="<?php echo $_POST['tel']; ?>" placeholder="Teléfono" />
		</div>
	</div>


                       
    <div class="control-group">
		<label class="control-label" for="usuario">Celular</label>
		<div class="controls">
			<input type="text" id="cel" name="cel" value="<?php echo $_POST['cel']; ?>" placeholder="Celular" />
		

			</div> 
	</div>
        <div class="control-group">
		<label class="control-label" for="usuario">Contacto Cliente</label>
		<div class="controls">
			<input type="text" value="<?php echo $_POST['contacto_cliente'];?>" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" />
		</div>
	</div>
                    </td>
                    <td align="top" width="200px">
                    </td>
                    <td align="top">
                    <h3>Mapa</h3>
                    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.4039775619854!2d-70.67763628470057!3d-33.542878809648066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662dbac1d6938eb%3A0xd5df284d5925ab77!2sCartonajes+Grau!5e0!3m2!1ses-419!2scl!4v1523281688952" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                    </td>
                </tr>
            </table>
    
  
    

    <h3>Dirección</h3>
<div class="control-group">
		<label class="control-label" for="usuario">Región</label>
		<div class="controls">
			<select id ="regionDir" name="region" value="<?php echo set_value_input(array(),'region','region'); ?>" onchange="carga_ajax('<?php echo base_url();?>usuarios/region',this.value,'1','sub_ciudad');carga_ajax('<?php echo base_url();?>clientes/region',this.value,'1','sub_ciudad2');
">
                <option value="0">Seleccione</option>
                <?php
                foreach($regions as $region)
                {
                    ?>
                    <option value="<?php echo $region->id?>"<?php echo set_value_select(array(),'region','region',$region->id);?>><?php echo $region->region?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>

	<div class="control-group" id="sub_ciudad">
		<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
		<select id = "ciudadDir" name="ciudad">
                    <option value="0">Seleccione</option>
                </select>
		</div>
	</div>

	<div class="control-group" id="sub_comuna">
		<label class="control-label" for="usuario">Comuna</label>
		<div class="controls"> 
		<select id = "comunadir" name="comuna">
                    <option value="0">Seleccione</option>
                </select>
		</div>
	</div>


	 <div class="control-group"> 
		<label class="control-label" for="usuario">Dirección</label>
		<div class="controls">
                    <input type="text" id="dir" name="dir"  placeholder="Dirección" value="<?php echo $_POST["dir"] ?>"/>
		</div>
	</div>
    
	<script>
	   function copiaDirecionAdespachoCliente(obj)
	   {
	      if(obj.checked){
			// var div=document.getElementById("divDespacho");
			// div.style.display="none";
			form.region2.value=form.region.value;
			form.ciudad2.value=form.ciudad.value;	
			//agrego el elemento
			var valSelect=form.comuna.value;
			var textSelect=form.comuna.options[form.comuna.selectedIndex].text;
			var opt = document.createElement('option');
				opt.value = valSelect;
				opt.innerHTML = textSelect;
				form.comuna2.appendChild(opt);
			form.dir2.value=form.dir.value;	
			form.comuna2.value=form.comuna.value;
		}
		
	   }	   
	</script>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Usar estos mismos datos para despacho</label>
		<div class="controls">
                    <input type="checkbox" onclick="copiaDirecionAdespachoCliente(this)" id="si" name="si" value="si" />
		</div>
	</div>
	<div id="divDespacho">
    <h3>Despacho</h3>

<div class="control-group">
		<label class="control-label" for="usuario">Contacto</label>
		<div class="controls">
			<input type="text" id="link" name="contacto" value="<?php echo $_POST["contacto"] ?>" placeholder="Contacto" />
		</div>
	</div>

     <div class="control-group">
		<label class="control-label" for="usuario"> Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="forma_pago" id="forma_pago" class="chosen-select">
                <option value="">Seleccione.....</option>
                <?php
                foreach($formas as $forma)
                {
                    ?>
                    <option value="<?php echo $forma->id?>"<?php echo set_value_select(array(),'forma_pago','forma_pago',$forma->id);?>><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Región</label>
		<div class="controls">
		<select id = "regionDesp" name="region2" onchange="carga_ajax('<?php echo base_url();?>clientes/region',this.value,'1','sub_ciudad2');">
                    <option value="0">Seleccione</option>
                    <?php
                    foreach($regions as $region)
                    {
                        ?>
                        <option id = "opcionRegionDesp"  value="<?php echo $region->id?>"<?php echo set_value_select(array(),'region2','region2',$region->id);?>><?php echo $region->region?></option>
                        <?php
                    }
                    ?>
                </select>
		</div>
	</div>
    
    	<div class="control-group" id="sub_ciudad2">
		<label class="control-label" for="usuario">Ciudad</label>
		<div class="controls">
		<select id = "ciudadDesp"  name="ciudad2">
                    <option value="0">Seleccione</option>
                </select>
		</div>
	</div>

	<div class="control-group" id="sub_comuna2">
		<label class="control-label" for="usuario">Comuna</label>
		<div class="controls">
		<select id ="ciudadDesp" name="comuna2">
                    <option value="0">Seleccione</option>
                </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Dirección</label>
		<div class="controls">
			<input type="text" value="<?php echo set_value_input(array(),'dir2','dir2');?>" id="dirDesp" name="dir2" value="<?php echo set_value('dir2'); ?>" placeholder="Dirección" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Horario</label>
		<div class="controls">
			<input type="text" id="link" value="<?php echo set_value_input(array(),'horario','horario'); ?>"  name="horario" value="<?php echo set_value("horario")?>" placeholder="Horario" />
		</div>
	</div>
 </div>   
 
	<?php
	if( $this->session->userdata('perfil')!=2 )
	{
	?>		
    <h3>Datos Comerciales</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Deuda Actual</label>
		<div class="controls">
			<input type="text" value="<?php echo set_value_input(array(),'deuda_vigente','deuda_vigente');?>" id="deuda_vigente" name="deuda_vigente" value="<?php echo set_value("deuda_vigente")?>" placeholder="Deuda Actual" />
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="usuario">Cupo Máximo</label>
		<div class="controls">
			<input type="text" name="cupo_maximo" value="<?php echo set_value_input(array(),'cupo_maximo','cupo_maximo');?>" placeholder="Cupo Máximo" />
		</div>
	  </div>  
    <?php
	}else{
	?>
	<h3>Datos Comerciales</h3>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Deuda Actual</label>
		<div class="controls">
			<input type="text" id="deuda_vigente" name="deuda_vigente" value="<?php echo set_value_input(array(),'deuda_vigente','deuda_vigente');?>" placeholder="Deuda Actual" readonly="true"/>
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="usuario">Cupo Máximo</label>
		<div class="controls">
			<input type="text" name="cupo_maximo" value="<?php echo set_value_input(array(),'cupo_maximo','cupo_maximo');?>" placeholder="Cupo Máximo" readonly="true"/>
		</div>
	  </div>  
	<?php
	}
	?>
    <h3>Observaciones</h3>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Observaciones</label>
		<div class="controls">
		<textarea id="contenido" name="descripcion" placeholder="Observaciones" value="<?php echo set_value_input(array(),'descripcion','descripcion'); ?>"/></textarea>
        			
		</div>
	</div>
    
    
	<div class="control-group">
		<div class="form-actions">
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
	<div class="control-group">
		<div class="form-actions">
                    <input type="text" id="address" name="address" value=""/>
		</div>
	</div>
	<div class="control-group">
		<div class="form-actions">
                    <button type="button" id="submit" class="btn">Mapa</button>
		</div>
	</div>
</form>

<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.titulo.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas"
	});
        
</script>
<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        //var address = '1209+ñuñoa+santiago';
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeks_CGGOpANccqaN_38NDjr6iVuj9H6E&callback=initMap">
    </script>

</div>
