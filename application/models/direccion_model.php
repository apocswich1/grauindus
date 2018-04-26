<?php

class direccion_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    public function getRegion()
    {
         $query=$this->db
                ->select("id,region")
                ->from("region")
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
     public function getCiudad()
    {
         $query=$this->db
                ->select("id,nombre,id_region")
                ->from("ciudades")
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
     public function getCiudadPorRegion($id)
    {
         $query=$this->db
                ->select("id,nombre,id_region")
                ->from("ciudades")
                ->where(array("id_region"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
     public function getComuna()
    {
         $query=$this->db
                ->select("id,nombre,ciudad")
                ->from("comuna")
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
     public function getComunaPorCiudad($id)
    {
         $query=$this->db
                ->select("id,nombre,ciudad")
                ->from("comuna")
                ->where(array("ciudad"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
   
}