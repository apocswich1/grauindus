<?php

class maquinas_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getMaquinasPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,nombre,descripcion,tamano_maximo,tamano_minimo,velocidad,ancho_minimo,ancho_maximo,estado,fecha,colores,tiempo_de_postura")
                ->from("maquinas")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("maquinas")
                ->count_all_results();
                return $query;
            break;
        }
    }

   
    public function getMaquinaPorId($id)
    {
          $query=$this->db
                ->select("id,nombre,descripcion,tamano_maximo,tamano_minimo,velocidad,ancho_minimo,ancho_maximo,estado,fecha,colores,tiempo_de_postura")
                ->from("maquinas")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
      
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("maquinas",$data);
        return $this->db->insert_id();
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("maquinas",$data);
        return true;
    }
    
    public function delete($id)
    {
	   	$this->db->where('id', $id);
	    $this->db->delete('maquinas');
    }
    /**
     * procesos
     * */
     public function getProcesos()
     {
         $query=$this->db
                ->select("id,nombre")
                ->from("maquinas_procesos")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
     }
     public function getProcesosPorMaquina($id)
     {
         $query=$this->db
                ->select("m.id,m.id_maquina,m.id_proceso,p.nombre")
                ->from("maquinas_procesos_relacion as m")
                ->join("maquinas_procesos as p","p.id=m.id_proceso","inner")
                ->where(array("m.id_maquina"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
     }
      public function existeProcesoEnMaquina($id_proceso,$id)
     {
         $query=$this->db
                ->select("id")
                ->from("maquinas_procesos_relacion")
                ->where(array("id_proceso"=>$id_proceso,"id_maquina"=>$id))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();
     }
    public function deleteProcesosMaquinaPorId($id)
    {
	   	$this->db->where('id_maquina', $id);
	    $this->db->delete('maquinas_procesos_relacion');
    }
   
}