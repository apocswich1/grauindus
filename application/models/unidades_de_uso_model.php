<?php

class unidades_de_uso_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getUnidadesDeUso()
    {
         $query=$this->db
                ->select("id,unidades_de_compra,unidad_venta,factor_conv,unidad_uso")
                ->from("unidades_de_uso")
                ->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;             
                return $query->result();
    }
    
    
    public function getUnidadesDeUsoPorId($id)
    {
           $query=$this->db
                ->select("id,unidades_de_compra,unidad_venta,factor_conv,unidad_uso")
                ->from("unidades_de_uso")
                ->where(array("id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;             
                return $query->row();
    }
   
     public function insertar($data=array())
    {
         $this->db->insert("unidades_de_uso",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("unidades_de_uso",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('unidades_de_uso');
        return true;
    }
    
    
}