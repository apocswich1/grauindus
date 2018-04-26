<?php
/**
 * Obtener Valor del dólar en Chile para la API de Sbif
 * 
 * @class       Sbif
 * @author		Desarrollado por César Cancino www.cesarcancino.com
 * @link		http://www.cesarcancino.com
 * @date        Creada el 12 de agosto de 2015
 */
class Sbif
{
    private $key;
    public function __construct($key)
    {
        $this->key=$key;
    }
    public function obtiene()
    {
        $data = file_get_contents('http://api.sbif.cl/api-sbifv3/recursos_api/dolar?apikey='.$this->key.'&formato=json');
        $datos=json_decode($data,true);
        $valor="";
        foreach($datos["Dolares"] as $dato)
        {
            $valor= $dato["Valor"];
        }
        return $valor;
    }
    public function calcular($cantidad)
    {
        $valor=self::obtiene() * $cantidad;
        return $valor;
    }
}
