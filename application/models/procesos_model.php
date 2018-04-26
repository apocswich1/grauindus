<?php

class procesos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getProcesosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,nombre,descripcion,precio,fecha")
                ->from("procesos")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("id,nombre,descripcion,precio,fecha")
                ->from("procesos")
                ->count_all_results();
                return $query;
            break;
        }
    }

    public function getProcesosTipo()
    {
        $this->load->database();
  
        
                $query=$this->db
               ->select("*")
                ->from("procesos_tipo")
                ->order_by("procesos_tipo","asc")
                ->get();
                return $query->result();
        
    }
    public function getProcesos()
    {
        $this->load->database();
  
        
                $query=$this->db
               ->select("id,nombre,descripcion,precio,fecha")
                ->from("procesos")
                ->order_by("nombre","asc")
                ->get();
                return $query->result();
        
    }

    public function getProcesosPorId($id)
    {
          $query=$this->db
                ->select("id,nombre,descripcion,precio,fecha")
                ->from("procesos")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
   
    
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("procesos",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("procesos",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
	   
			$this->db->where('id', $id);
			$this->db->delete('procesos');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
   
}