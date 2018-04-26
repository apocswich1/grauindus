<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * Herramientas
 *
 */
class herramientas_funciones
{
    /*
     * Valida Rut
     */
        public function valida_rut($rut)
        {
            $rut = preg_replace('/[^k0-9]/i', '', $rut);
            $dv  = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut)-1);
            $i = 2;
            $suma = 0;
            foreach(array_reverse(str_split($numero)) as $v)
            {
                if($i==8)
                    $i = 2;
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);

            if($dvr == 11)
                $dvr = 0;
            if($dvr == 10)
                $dvr = 'K';
            if($dvr == strtoupper($dv))
                return true;
            else
                return false;
        }        
        
    public static function esRut($r = false){
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
    /*
     * ingjjsg@gmai.com
     * Para medir el ancho de bobina a usar mediante la medida de la cartulina
     */
    public static function ancho_bobina_usar($ancho){
//        exit($ancho);
        $ancho_bobina_a_usar=0;
            if (($ancho>91) and ($ancho<=100)) 
               $ancho_bobina_a_usar=1000; 
            elseif (($ancho>81) and ($ancho<=90)) 
               $ancho_bobina_a_usar=1800; 
            elseif (($ancho>71) and ($ancho<=80))             
               $ancho_bobina_a_usar=1600; 
            elseif (($ancho>61) and ($ancho<=70))      
               $ancho_bobina_a_usar=1400; 
            elseif (($ancho>51) and ($ancho<=60))      
               $ancho_bobina_a_usar=1800;        
            return $ancho_bobina_a_usar;
    }    
    
public static function validaRutMigracion($rut){
    if(strpos($rut,"-")==false){
        $RUT[0] = substr($rut, 0, -1);
        $RUT[1] = substr($rut, -1);
    }else{
        $RUT = explode("-", trim($rut));
    }
    $elRut = str_replace(".", "", trim($RUT[0]));
    $factor = 2;
    for($i = strlen($elRut)-1; $i >= 0; $i--):
        $factor = $factor > 7 ? 2 : $factor;
        $suma += $elRut{$i}*$factor++;
    endfor;
    $resto = $suma % 11;
    $dv = 11 - $resto;
    if($dv == 11){
        $dv=0;
    }else if($dv == 10){
        $dv="k";
    }else{
        $dv=$dv;
    }
   if($dv == trim(strtolower($RUT[1]))){
       return true;
   }else{
       return false;
   }
}

public static function  verifica_RUT($rut='') {
  $tmpRUT = '';
  $sep = array();
  $multi = 2;
  $suma = 0;
  if (empty($rut)) return false;
  for ($i = 0; $i < strlen($rut); $i++) {
    if ($rut[$i] != ' ' AND $rut[$i] != ' ' AND $rut[$i] != '.' AND $rut[$i] != '-') $tmpRUT .= $rut[$i];
  }
  if ( strlen($tmpRUT) == 8 ) $tmpRUT = '0'.$tmpRUT;
  if (strlen($tmpRUT) != 9) return false;
  $sep['rut'] = substr($tmpRUT,0,8);
  $sep['dv']  = substr($tmpRUT, -1);
  if ($sep['dv'] == 'k') $sep['dv'] = 'K';
  if (!is_numeric($sep['rut'])) return false;
  if (empty($sep['rut']) OR $sep['dv'] == '') return false;
  for ($i=strlen($sep['rut']) - 1; $i >= 0; $i--) {
    $suma = $suma + $sep['rut'][$i] * $multi;
    if ($multi == 7) $multi = 2;
    else $multi++;
  }
  $resto = $suma % 11;
  if ($resto == 1) {
    $sep['dvt'] = 'K';
  }
  else {
    if ($resto == 0) {
      $sep['dvt'] = '0';
    }
    else {
      $sep['dvt'] = 11 - $resto;
    }
  }
  if ($sep['dvt'] != $sep['dv']) return false;
  return true;
}
    
public static function MostrarBarniz($arreglCotizacion=0){
    $html='';   
    if(count($arreglCotizacion)>0){
        if ($arreglCotizacion->ing_lleva_barniz!='')
            $html.='<li>Tipo de Barniz : <strong>'.$arreglCotizacion->ing_lleva_barniz.'</strong></li>';
        if ($arreglCotizacion->ing_reserva_barniz!='')        
            $html.='<li>Reserva : <strong>'.$arreglCotizacion->ing_reserva_barniz.'</strong></li>';    
        if ($arreglCotizacion->ing_cala_caucho!='')        
            $html.='<li>Cala Caucho: <strong>'.$arreglCotizacion->ing_cala_caucho.'</strong></li>';      
        return $html;
    }
      else $html;
    }



    public static function validaRutActaul ( $rutCompleto ) {
            if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
            $rut = explode('-', $rutCompleto);
            return strtolower($rut[1]) == self::dv($rut[0]);
    }
    public static function dv ( $T ) {
            $M=0;$S=1;
            for(;$T;$T=floor($T/10))
                    $S=($S+$T%10*(9-$M++%6))%11;
            return $S?$S-1:'k';
    }
}