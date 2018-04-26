<?php

class cotizaciones_relacion_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    public function getCotizacionPorClienteDiezRegistros($padre,$hijo)
    {
       /*
       $query=$this->db
                ->select("id,padre,hijo,estado")
                ->from("cotizaciones_asociadas")
                ->where(array("padre"=>$padre,"hijo"=>$hijo,"estado"=>'0'))
                //->or_where(array("padre"=>$padre,"hijo"=>$hijo,"estado"=>'0'))
                ->get();
                //echo $this->db->last_query()."<br/>";
                return $query->row();
        */
        $query=$this->db
                ->query("select *
                        from
                        cotizaciones_asociadas
                        where
                        estado='0'
                        and
                        padre='".$padre."'
                        or
                        hijo='".$hijo."'");
//                echo $this->db->last_query();exit;
                
                return $query->result();
    }
   
        
}