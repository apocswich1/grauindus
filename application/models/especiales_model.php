    <?php

class especiales_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   	
     public function insertar($data=array())
    {
		//var_dump($data);
         $this->db->insert("produccion_especiales",$data);
         //echo $this->db->last_query();
        return true;
        
    }
     
    public function update($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("produccion_especiales",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id_cotizacion', $id);
        $this->db->delete('produccion_especiales');
        return true;
    }
     
    /**
     * #######################################################
     * RUBROS
     * */
    public function getProduccionEspeciales()
    {
        $query=$this->db
        ->select("*")
        ->from("produccion_especiales")
        ->order_by("id","asc")
        ->get();
  
     return $query->result(); 
    }
    
     public function getProduccionEspecialesPorId($id)
    {
        $query=$this->db
        ->select("*")
        ->from("produccion_especiales")
        ->where(array("id_cotizacion"=>$id))
        ->get();
        //$this->db->last_query();
        return $query->row(); 
    }
    	
}