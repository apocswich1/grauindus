<?php

class pegado_model extends CI_Model{


	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}

    
	
	
	 public function hola($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuario as usu","usu.id=ppp.operador","inner")

                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuario as usu","usu.id=ppp.operador","inner")

                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
}