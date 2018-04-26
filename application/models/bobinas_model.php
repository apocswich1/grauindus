<?php

class bobinas_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   	
     public function insertar($data=array())
    {
		//var_dump($data);
         $this->db->insert("bobinas",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id_nodo', $id);
         $this->db->update("bobinas",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id_nodo', $id);
        $this->db->delete('bobinas');
        return true;
    }
     
    /**
     * #######################################################
     * RUBROS
     * */
    public function getBobinas()
    {
        $query=$this->db
        ->select("*")
        ->from("bobinas")
        ->order_by("id","asc")
        ->get();
  
     return $query->result(); 
    }
    
     public function getBobinasPorId($id)
    {
        $query=$this->db
        ->select("*")
        ->from("bobinas")
        ->where(array("id_nodo"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->row(); 
    }
	  public function getBobinasPorId2($id)
    {
        $query=$this->db
        ->select("id_nodo,descripcion")
        ->from("bobinas")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getBobinaPorNombre($id)
    {
        $query=$this->db
        ->select("id_nodo,descripcion")
        ->from("bobinas")
        ->where(array("id"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function insertarBobina($data=array())
    {
         $this->db->insert("bobinas",$data);
        return true;
        
    }
    public function updateBobinas($data=array(),$id)
    {
         $this->db->where('id_nodo', $id);
         $this->db->update("bobinas",$data);
        return true;
    }
    public function deleteBobinas($id)
    {
        $this->db->where('id_nodo', $id);
        $this->db->delete('bobinas');
        return true;
    }
    
	    
    public function getIdBobinaTexto($texto)
    {
        $sql = "select id from bobinas where descripcion like '%".$texto."%'";
        $query=$this->db->query($sql);
        return $query->row(); 
    }
    	
}