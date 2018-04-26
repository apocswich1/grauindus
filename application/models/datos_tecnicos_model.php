<?php

class datos_tecnicos_model extends CI_Model{

function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
     
    public function getDatosTecnicosTodos()
    {
        $query=$this->db
                ->select("id,datos_tecnicos")
                ->from("datos_tecnicos")
                ->order_by("id","datos_tecnicos")
                ->get();
                return $query->result();
    }
    public function getDatosTecnicos()
    {
        $query=$this->db
                ->select("id,datos_tecnicos")
                ->from("datos_tecnicos")
                ->where(array("estado"=>"0"))
                ->order_by("id","datos_tecnicos")
                ->get();
                return $query->result();
    }
    public function getDatosTecnicosPorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("id,datos_tecnicos,estado")
                ->from("datos_tecnicos")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();		
    }
   public function insertar($data=array())
    {
         $this->db->insert("moldes_grau",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id_acabado', $id);
         $this->db->update("moldes_grau",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
	   
			$this->db->where('id_acabado', $id);
			$this->db->delete('moldes_grau');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
}