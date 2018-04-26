<?php

if ( ! function_exists('saludo') )
{
	function saludo(/* polimorfica */)
	{
		return "hola mundo";
	}
}
/**
 * validación set Value select
 **/
   if(!function_exists('set_value_select'))
   {
     function set_value_select($result=array(),$post,$campo,$valor)
     {
        if(sizeof($result)==0)
                {
                    if(isset($_POST[$post]) and $_POST[$post]==$valor)
                    {
                         return 'selected="true"';   
                    }else
                    {
                        return '';
                    }
                }else
                {
                    if($campo==$valor)
                    {
                         return 'selected="true"';   
                    }else
                    {
                        return '';
                    }
                }
     }
   } 
 /**
 * validación set Value Producción input
 **/
   if(!function_exists('set_value_input'))
   {
     function set_value_input($result=array(),$post,$campo)
     {
        if(sizeof($result)==0)
                {
                    if(isset($_POST[$post]))
                    {
                         return $_POST[$post];   
                    }else
                    {
                        return '';
                    }
                }else
                {
                    if($campo)
                    {
                         return $campo;   
                    }else
                    {
                        return '';
                    }
                }
     }
   }
/**
 * listado de máquinas
 * */
 if(!function_exists("listadoMaquinas"))
 {
    function listadoMaquinas()
    {
        $array=array('r800','r400','sm52','externo');
        return $array;
    }
 }
/**
 * quitar puntos a número
 * */
 if(!function_exists("quitarPuntosNumero"))
 {
    function quitarPuntosNumero($num)
    {
        $numero=str_replace ( ".", "", $num);
        return $numero;
    }
 }
 /**
  * Función para convertir textos en seo_slug
  **/
if ( ! function_exists('con_guion') )
{
  function con_guion($url){
$url = strtolower($url);
//Rememplazamos caracteres especiales latinos 
$find = array('á','é','í','ó','ú','ñ');
$repl = array('a','e','i','o','u','n');
$url = str_replace($find,$repl,$url);
// Añaadimos los guiones
$find = array(' ', '&', '\r\n', '\n', '+'); 
        $url = str_replace ($find, '-', $url); 
// Eliminamos y Reemplazamos demás caracteres especiales 
$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/'); 
$repl = array('', '-', ''); 
$url = preg_replace ($find, $repl, $url); 
//$palabra=trim($palabra);
//$palabra=str_replace(" ","-",$palabra);
return $url;
} 
 }   
 
 /**
  * Función para extraer el id de youtube
  **/
 if ( ! function_exists('get_youtube_id') )
{
 function get_youtube_id($url)
	{
		$start = strpos($url, "v=") + 2;
		return substr($url, $start, 11);
	}
}
/**
 *  Detectar el dispositivo para cargar css web o mobile
 * Retorna True si es un disposivo móvil
 */
 if ( ! function_exists('detectar_SO') )
    {
        function detectar_SO()
        {
            $es_movil=FALSE; //Aquí se declara la variable falso o verdadero XD 
              $usuario = $_SERVER['HTTP_USER_AGENT']; //Con esta leemos la info de su navegador 
             $usuarios_moviles = "Android, AvantGo, Blackberry, Blazer, Cellphone, Danger, DoCoMo, EPOC,EudoraWeb, Handspring, HTC, Kyocera, LG, MMEF20, MMP, MOT-V, Mot, Motorola, NetFront, Newt,Nokia, Opera Mini, Palm, Palm, PalmOS, PlayStation Portable, ProxiNet, Proxinet, SHARP-TQ-GX10,Samsung, Small, Smartphone, SonyEricsson, SonyEricsson, Symbian, SymbianOS, TS21i-10, UP.Browser,UP.Link, WAP, webOS, Windows CE, hiptop, iPhone, iPod, portalmmm, Elaine/3.0, OPWV"; 
            $navegador_usuario = explode(',',$usuarios_moviles);   
            foreach($navegador_usuario AS $navegador){ 
            if(@preg_match('/'.trim($navegador).'/',$usuario)){     
             $es_movil=TRUE;       
            }  
              }
             
             if($es_movil==TRUE){ 
             
               return true; 
             
            } 
             
            else{   
             
              return false;
             
                } 
        }
    }   
    /**
     * función para validar y formatear RUT
     * */ 
    if(!function_exists("esRut"))
    {
        function esRut($r = false){
    if((!$r) or (is_array($r)))
        return false; /* Hace falta el rut */
 
    if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
        return false; /* Era código basura */
 
    if(!((strlen($r) == 8) or (strlen($r) == 9)))
        return false; /* La cantidad de carácteres no es válida. */
 
    $v = strtoupper(substr($r, -1));
    if(!$r = substr($r, 0, -1))
        return false;
 
    if(!((int)$r > 0))
        return false; /* No es un valor numérico */
 
    $x = 2; $s = 0;
    for($i = (strlen($r) - 1); $i >= 0; $i--){
        if($x > 7)
            $x = 2;
        $s += ($r[$i] * $x);
        $x++;
    }
    $dv=11-($s % 11);
    if($dv == 10)
        $dv = 'K';
    if($dv == 11)
        $dv = '0';
    if($dv == $v)
        return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
        //return true;
    return false;
    }
    }
 /**
  * función chao_tilde
  * */
  if(!function_exists("chao_acento"))
  {
    function chao_acento($entra)
    {
        $traduce=array( '&aacute;' => 'á' , '&eacute;' => 'é' , '&iacute;' => 'í' , '&oacute;' => 'ó' , '&uacute;' => 'ú' , '&ntilde;' => 'ñ' , '&Ntilde;' => 'Ñ');
        $sale=strtr( $entra , $traduce );
        return $sale;
    }
  }
  /**
   * restar fechas
   * */
   if(!function_exists("dateDiff"))
   {
    function dateDiff($start, $end) { 

$start_ts = strtotime($start); 

$end_ts = strtotime($end); 

$diff = $end_ts - $start_ts; 

return round($diff / 86400); 

} 
   }
/**
 * sumar días a fecha
 * */
 if(!function_exists('sumarDiasFecha'))
 {
    function sumarDiasFecha($fecha,$dias)
    {
        $fecha = date_create($fecha);
        date_add($fecha, date_interval_create_from_date_string($dias.' days'));
        return date_format($fecha, 'Y-m-d');
    }
 }
   /**
    * invierte fecha de Y-m-d a d-mY
    * */
    if(!function_exists("invierte_fecha"))
    {
        function invierte_fecha($fecha)
		{
		$dia=substr($fecha,8,2);
		$mes=substr($fecha,5,2);
		$anio=substr($fecha,0,4);
		$correcta=$dia."-".$mes."-".$anio;
		return $correcta;
		}
    }
    /**
 * Obtener el día de la semana para una fecha concreta.
 */
 if(!function_exists("diaSemana"))
 {
    function diaSemana($ano,$mes,$dia)
    {
    	// 0->domingo	 | 6->sabado
    	$dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
    		return $dia;
    }
 }
 
 if(!function_exists("invertirFecha"))
 {
    function invertirFecha($fecha)
    {
    	$date = new DateTime($fecha);
        return $date->format('Y-m-d');
    }
 }
 
 if(!function_exists("invertirFecha2"))
 {
    function invertirFecha2($fecha)
    {
    	$date = new DateTime($fecha);
        return $date->format('d-m-Y');
    }
 }

 /**
  * convierte fecha de date a cadena
  * */
  if(!function_exists("fecha"))
  {
    function fecha($fecha)
    {
   	    $dia=substr($fecha,8,2);
		$mes=substr($fecha,5,2);
		$anio=substr($fecha,0,4);
       $diaSemana = diaSemana($anio, $mes, $dia);
       switch($diaSemana)
       {
            case '1':
                $diaSemana="Lunes";
            break;
             case '2':
                $diaSemana="Martes";
            break;
             case '3':
                $diaSemana="Miércoles";
            break;
             case '4':
                $diaSemana="Jueves";
            break;
             case '5':
                $diaSemana="Viernes";
            break;
             case '6':
                $diaSemana="Sábado";
            break;
             case '0':
                $diaSemana="Domingo";
            break;
       }
        switch ($mes){
        	case '01':
        	$mes="Enero";
        	break;
        	case '02':
        	$mes="Febrero";
        	break;
        	case '03':
        	$mes="Marzo";
        	break;
        	case '04':
        	$mes="Abril";
        	break;
        	case '05':
        	$mes="Mayo";
        	break;
        	case '06':
        	$mes="Junio";
        	break;
        	case '07':
        	$mes="Julio";
        	break;
        	case '08':
        	$mes="Agosto";
        	break;
        	case '09':
        	$mes="Septiembre";
        	break;
        	case '10':
        	$mes="Octubre";
        	break;
        	case '11':
        	$mes="Noviembre";
        	break;
        	case '12':
        	$mes="Diciembre";
        	break;
        }
        $fecha=$diaSemana." ".$dia." de ".$mes." de ".$anio;
        return $fecha; 
    }
  }
/**
  * convierte fecha de date a cadena
  * */
  if(!function_exists("fecha_con_hora"))
  {
    function fecha_con_hora($fecha)
    {
   	    $dia=substr($fecha,8,2);
		$mes=substr($fecha,5,2);
		$anio=substr($fecha,0,4);
        $hora=substr($fecha,10,11);
         $diaSemana = diaSemana($anio, $mes, $dia);
       switch($diaSemana)
       {
            case '1':
                $diaSemana="Lunes";
            break;
             case '2':
                $diaSemana="Martes";
            break;
             case '3':
                $diaSemana="Miércoles";
            break;
             case '4':
                $diaSemana="Jueves";
            break;
             case '5':
                $diaSemana="Viernes";
            break;
             case '6':
                $diaSemana="Sábado";
            break;
             case '0':
                $diaSemana="Domingo";
            break;
       }
       switch ($mes){
        	case '01':
        	$mes="Enero";
        	break;
        	case '02':
        	$mes="Febrero";
        	break;
        	case '03':
        	$mes="Marzo";
        	break;
        	case '04':
        	$mes="Abril";
        	break;
        	case '05':
        	$mes="Mayo";
        	break;
        	case '06':
        	$mes="Junio";
        	break;
        	case '07':
        	$mes="Julio";
        	break;
        	case '08':
        	$mes="Agosto";
        	break;
        	case '09':
        	$mes="Septiembre";
        	break;
        	case '10':
        	$mes="Octubre";
        	break;
        	case '11':
        	$mes="Noviembre";
        	break;
        	case '12':
        	$mes="Diciembre";
        	break;
        }
        $fecha=$diaSemana." ".$dia." de ".$mes." de ".date("Y")." a las ".$hora;
        return $fecha; 
       
    }
  }
  /**
   * ordenar arrays
   * */
   if(!function_exists("orderMultiDimensionalArray"))
   {
            function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
            $position = array();  
            $newRow = array();  
            foreach ($toOrderArray as $key => $row) {  
                    $position[$key]  = $row[$field];  
                    $newRow[$key] = $row;  
            }  
            if ($inverse) {  
                arsort($position);  
            }  
            else {  
                asort($position);  
            }  
            $returnArray = array();  
            foreach ($position as $key => $pos) {       
                $returnArray[] = $newRow[$key];  
            }  
            return $returnArray;  
        } 
   }
  /**
   * fecha con slash
   * */
   if(!function_exists("fecha_con_slash"))
   {
     function fecha_con_slash($fecha)
     {
        $dia=substr($fecha,8,2);
		$mes=substr($fecha,5,2);
		$anio=substr($fecha,0,4);
        return $dia."/".$mes."/".$anio;
     }
   }
   