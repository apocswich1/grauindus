<?php

class servicios_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    
    public function getServiciosSelect()
    {
         $query=$this->db
                ->select("id,servicio,tipo,precio")
                ->from("servicios_internos_y_externos")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getServiciosPorTipo($tipo)
    {
         $query=$this->db
                ->select("id,servicio,tipo,precio")
                ->from("servicios_internos_y_externos")
                ->where(array("tipo"=>$tipo))
                ->get();
                return $query->result();
    }
    
    public function getServiciosPorId($id)
    {
          $query=$this->db
               ->select("id,servicio,tipo,precio")
                ->from("servicios_internos_y_externos")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
   
     public function insertar($data=array())
    {
         $this->db->insert("servicios_internos_y_externos",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("servicios_internos_y_externos",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('servicios_internos_y_externos');
        return true;
    }
    
    
}