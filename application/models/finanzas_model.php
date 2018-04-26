<?php

class finanzas_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    
    public function getFinanzasSelect()
    {
         $query=$this->db
                ->select("id,dolar,uf,quien,cuando")
                ->from("finanzas")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
   
    
    public function getFinanzasPorId($id)
    {
          $query=$this->db
               ->select("id,dolar,uf")
                ->from("finanzas")
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
         $this->db->update("finanzas",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('finanzas');
        return true;
    }
    
    
}