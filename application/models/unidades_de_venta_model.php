<?php

class unidades_de_venta_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getUnidadesDeVenta()
    {
         $query=$this->db
                ->select("id,unidades_de_venta")
                ->from("unidades_de_venta")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    
    
    public function getUnidadesDeVentaPorId($id)
    {
           $query=$this->db
               ->select("id,unidades_de_venta")
                ->from("unidades_de_venta")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
   
     public function insertar($data=array())
    {
         $this->db->insert("unidades_de_venta",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("unidades_de_venta",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('unidades_de_venta');
        return true;
    }
    
    
}