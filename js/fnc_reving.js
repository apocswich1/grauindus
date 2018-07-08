/* 
 * Funciones para revision ingenieria
 * Desarrollado por Elvis Hernandez
 */
function calculo_ccac_minimo(){
    /******variables******/
    var tamano_1 = $("#tamano_1").val();
    var tamano_2 = $("#tamano_2").val();
    var tamano_cuchillo_1 = $("#tamano_cuchillo_1").val();
    var tamano_cuchillo_2 = $("#tamano_cuchillo_2").val();
    var icf = $("#imprimir_contra_la_fibra").val();
    var tfn = $("#lleva_fondo_negro").val();
    var imp = $("#imagen_impresion").val();
    var variable_textoccac;
    var textoccac;
    var variable_alertaccac;
    
    /******Logica de preferencia en calculo ccac minimo******/
  if(imp=='NO' && tfn=='' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='NO' && tfn=='' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='NO' && tfn=='' && icf == 'NO'){//valor por omisiòn sera 25
      textoccac='CCAC: 25mm'
      variable_textoccac=25;}
  if(imp=='' && tfn=='SI' && icf == 'NO'){
      textoccac='CCAC: 25mm'
      variable_textoccac=25;}
  if(imp=='CO' && tfn=='SI' && icf == 'NO'){
      textoccac='CCAC: 25mm'
      variable_textoccac=25;}
  if(imp=='CO' && tfn=='' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='' && tfn=='' && icf == 'NO'){//valor por omisiòn sera 25
      textoccac='CCAC: 25mm'
      variable_textoccac=25;}
  if(imp=='' && tfn=='' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='' && tfn=='' && icf == ''){ //valor por omisiòn sera 45
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CE' && tfn=='SI' && icf == ''){
      textoccac='CCAC: 45mm'
      variable_textoccac=25;}
  if(imp=='CE' && tfn=='SI' && icf == 'NO'){
      textoccac='CCAC: 25mm'
      variable_textoccac=25;}
  if(imp=='CO' && tfn=='SI' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='' && tfn=='NO' && icf == ''){//valor por omisiòn sera 45
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='NO' && tfn=='SI' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CO' && tfn=='' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CO' && tfn=='SI' && icf == 'SI'){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CE' && tfn=='SI' && icf == 'SI'){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CO' && tfn=='NO' && icf == 'NO'){
      textoccac='CCAC: 20mm'
  variable_textoccac=20;}
  if(imp=='CO' && tfn=='' && icf == 'NO'){
      textoccac='CCAC: 25mm'
  variable_textoccac=25;}
  if(imp=='CO' && tfn=='NO' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='' && tfn=='NO' && icf == 'NO'){//valor por omisiòn sera 20
      textoccac='CCAC: 20mm'
  variable_textoccac=20;}
  if(imp=='' && tfn=='SI' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=25;}
  if(imp=='' && tfn=='NO' && icf == 'SI'){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='' && tfn=='SI' && icf == 'SI'){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='NO' && tfn=='SI' && icf == 'SI'){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='NO' && tfn=='' && icf == ''){//valor por omisiòn sera 45
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='CO' && tfn=='NO' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='CE' && tfn=='NO' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  if(imp=='CE' && tfn=='NO' && icf == 'NO'){
      textoccac='CCAC: 10mm'
      variable_textoccac=10;}
  if(imp=='CE' && tfn=='NO' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='CE' && tfn=='' && icf == 'SI'){
      textoccac='CCAC: 45mm'
      variable_textoccac=45;}
  if(imp=='CE' && tfn=='' && icf == 'NO'){
      textoccac='CCAC: 25mm'
  variable_textoccac=25;}
  if(imp=='CE' && tfn=='' && icf == ''){
      textoccac='CCAC: 45mm'
  variable_textoccac=45;}
  
  /******validacion para textos laterales de seleccion******/
  if(icf=="" || icf=="SI"){ icf = "SI: 45 mm"; }else{ icf = "NO"; }
  if(imp=="" || imp=="NO"){ imp = ":No Se Sabe"; }else{ if(imp=="CE"){ imp = "Al Centro: 10 mm"; }else{ imp = "Al Corte: 20 mm"; }}
  if(tfn=="" || tfn=="SI"){ tfn = "SI: 25 mm"; }else{ tfn = "NO"; }
  
  var total_medida1=(tamano_1-tamano_cuchillo_1)*10;
  var total_medida2=(tamano_2-tamano_cuchillo_2)*10;
  
  if(tamano_1 == "" || tamano_2 == "" || tamano_cuchillo_1 =="" || tamano_cuchillo_2 =="" || tamano_1 == 0 || tamano_2 == 0 || tamano_cuchillo_1 ==0 || tamano_cuchillo_2 ==0){    
  var msg = "Debe completar los campos para el calculo ccac";
  }else{
  if(total_medida1 < variable_textoccac){                
  var msg = "La distancia CCAC1 minima es de "+variable_textoccac+" mm. Modifique el ancho a cortar.";
  var msg2 = "El calculo CCAC1:"+total_medida1+" No puede ser menor a "+variable_textoccac+" mm. Modifique el ancho a cortar.";
  }else{
  var msg = "";    
  }
  }
  
  $("#ccac_1").val(parseInt(Math.round(total_medida1)));
  $("#ccac_2").val(parseInt(Math.round(total_medida2)));
  
  /*****Asignacion de *textos laterales de seleccion******/  
  $("#etiquetaicf").html("<h4>Contra la Fibra "+icf+"</h4>")  
  $("#etiquetatfn").html("<h4>LLeva Fondo Negro "+tfn+"</h4>")  
  $("#etiquetaimp").html("<h4>Imagen Impresion "+imp+"</h4>")  
  $("#etiquetaccacmin").html("<h4 style='color:green'>Distancia CCAC Min: "+variable_textoccac+" mm</h4>")  
  $("#alertaccacmin").html("<h4 style='color:red'>"+msg+"</h4>")  
  $("#pinza").val(variable_textoccac);
  
}



/*****Calculo textoccac y moldes*****/



/*********Moldes y Trazados*****/

/*******invocacion de funciones************/
calculo_ccac_minimo();