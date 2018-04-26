<?php

class rubros_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   	
     public function insertar($data=array())
    {
		//var_dump($data);
         $this->db->insert("rubros",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("rubros",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rubros');
        return true;
    }
     
    /**
     * #######################################################
     * RUBROS
     * */
    public function getRubros()
    {
        $query=$this->db
        ->select("id,rubro")
        ->from("rubros")
        ->order_by("id","asc")
        ->get();
  
     return $query->result(); 
    }
    
     public function getRubrosPorId($id)
    {
        $query=$this->db
        ->select("id,rubro")
        ->from("rubros")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->row(); 
    }
	  public function getRubrosPorId2($id)
    {
        $query=$this->db
        ->select("id,rubro")
        ->from("rubros")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getRubroPorNombre($id)
    {
        $query=$this->db
        ->select("id,rubro")
        ->from("rubros")
        ->where(array("id"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function insertarRubro($data=array())
    {
         $this->db->insert("rubros",$data);
        return true;
        
    }
    public function updateRubros($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("rubros",$data);
        return true;
    }
    public function deleteRubros($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rubros');
        return true;
    }
    
	    
    public function getIdRubroTexto($texto)
    {
        $sql = "select id from rubros where rubro like '%".$texto."%'";
        $query=$this->db->query($sql);
        return $query->row(); 
    }
    	
}