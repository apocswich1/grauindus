<?php

class produccion_listados_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
   /**
    * fotomecánica
    **/ 
   public function getTodosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                //->where(array("situacion"=>$estado))
                ->order_by("prioridad desc ,id desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
                
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("produccion_fotomecanica")
                //->where(array("situacion"=>$estado))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getTodosPaginacionPorEstado($pagina,$porpagina,$quehago,$estado)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("estado"=>$estado))
                ->order_by("prioridad desc ,id desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
                
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("produccion_fotomecanica")
                ->where(array("estado"=>$estado))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getTodosPaginacionPorSituacion($pagina,$porpagina,$quehago,$situacion)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("situacion"=>$situacion))
                ->order_by("prioridad desc ,id desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
                
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("produccion_fotomecanica")
                ->where(array("situacion"=>$situacion))
                ->count_all_results();
                return $query;
            break;
        }
    }
     public function getTodos($estado)
    {
        $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->order_by("prioridad desc ,id desc")
                ->get();
                return $query->result();
    }
    public function getFotomecanicaPorEstado($estado)
    {
        $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("estado"=>$estado))
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getFotomecanicaPorSituacion($estado)
    {
        $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("situacion"=>$estado))
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getFotomecanicaPorNumeroDeOrden($id)
    {
        $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("id_nodo"=>$id))
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    /**
     * control cartulina
     * */
     public function getTodosControlCartulinaPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("produccion_control_cartulina")
                //->where(array("situacion"=>$estado))
                ->order_by("prioridad desc ,id desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
                
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("produccion_control_cartulina")
                //->where(array("situacion"=>$estado))
                ->count_all_results();
                return $query;
            break;
        }
    }
}