<?php

class variables_cotizador_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    
    public function getVariablesCotizadorSelect()
    {
         $query=$this->db
                ->select("id,tipo,nombre,precio,fecha_modificacion")
                ->from("variables_cotizador")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    
    public function getVariablesCotizadorPorId($id)
    {
          $query=$this->db
                ->select("id,tipo,nombre,precio,fecha_modificacion")
                ->from("variables_cotizador")
                ->where(array("id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;           
          
                return $query->row();
    }
    public function getVariablesCotizadorPorNombre($id)
    {
          $query=$this->db
                ->select("precio")
                ->from("variables_cotizador")
                ->where(array("nombre like"=>$id))
                ->get();
               // echo $this->db->last_query();exit;           
          
                return $query->row();
    }
   
     public function insertar($data=array())
    {
         $this->db->insert("variables_cotizador",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("variables_cotizador",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('variables_cotizador');
        return true;
    }
    
    
}