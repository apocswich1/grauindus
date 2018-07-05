    <?php

class grupos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   	
     public function insertar($data=array())
    {
		//var_dump($data);
         $this->db->insert("grupos",$data);
         //echo $this->db->last_query();
        return true;
        
    }
     public function insertarCotizacionesGrupales($data=array())
    {
        $this->db->insert("cotizaciones_grupales",$data);
       // echo $this->db->last_query();
        return true;
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("grupos",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('grupos');
        return true;
    }
     
    /**
     * #######################################################
     * RUBROS
     * */
    public function getGrupos()
    {
        $query=$this->db
        ->select("*")
        ->from("grupos")
        ->order_by("id","asc")
        ->get();
  
     return $query->result(); 
    }
    
    public function getExisteGrupo($id)
    {
        $query=$this->db
        ->select("*")
        ->from("grupos")
        ->where("idc_01 = $id OR idc_02 = $id OR idc_03 = $id OR idc_04 = $id OR idc_05 = $id OR idc_06 = $id OR idc_07 = $id OR idc_08 = $id OR idc_09 = $id OR idc_10 = $id")
        ->order_by("id","asc")
        ->get();
  //echo $this->db->last_query();exit;
     return $query->row(); 
    }
    
     public function getGruposPorId($id)
    {
        $query=$this->db
        ->select("*")
        ->from("grupos")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function getCotizacionesGruposPorId($id,$grupo)
    {
        $query=$this->db
        ->select("*")
        ->from("cotizaciones_grupales")
        ->where(array("id_cot"=>$id,"id_grupo"=>$grupo))
        ->get();
       // echo $this->db->last_query();exit;
        return $query->row(); 
    }
	  public function getGruposPorId2($id)
    {
        $query=$this->db
        ->select("id,grupo")
        ->from("grupos")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getGrupoPorNombre($id)
    {
        $query=$this->db
        ->select("id,grupo")
        ->from("grupos")
        ->where(array("id"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function insertarGrupo($data=array())
    {
         $this->db->insert("grupos",$data);
        return true;
        
    }
    public function updateGrupos($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("grupos",$data);
        return true;
    }
    public function updateCotizacionesGrupales($data=array(),$id ,$grupo)
    {
         $this->db->where(array('id_cot'=>$id,'id_grupo'=>$grupo));
         $this->db->update("cotizaciones_grupales",$data);
        // echo $this->db->last_query();
        return true;
    }
    public function deleteGrupos($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('grupos');
        return true;
    }
    
	    
    public function getIdGrupoTexto($texto)
    {
        $sql = "select id from grupos where grupo like '%".$texto."%'";
        $query=$this->db->query($sql);
        return $query->row(); 
    }
    	
}