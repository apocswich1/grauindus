<?php

class produccion_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
    public function getFotomecanicaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();exit();
                return $query->row();
    }
    
    
    public function getFotomecanicaGlosa($id)
    {
         $query=$this->db
                ->select("glosa")
                ->from("produccion_fotomecanica")
                ->where(array("id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    
    public function getUltimaRechazada()
    {
         $query=$this->db
                ->select("pf.id_nodo,pf.fecha_rechazada_recepcion_OT,pf.comentario_rechazo,oc.id as ot")
                ->from("produccion_fotomecanica pf")
                ->join("cotizaciones_orden_de_compra oc","pf.id_nodo = oc.id_cotizacion","left")
                ->where("pf.fecha_rechazada_recepcion_OT <> '0000-00-00'")
                ->order_by("pf.fecha_rechazada_recepcion_OT DESC")
                ->limit(1)
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    
    public function getFotomecanicaArchivo($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
	public function getControlCartulinaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_cartulina")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
	
	
	public function getControlCartulinaParcialPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_cartulina_parcial")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getControlControlPapelPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_papel")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	//Control onda y liner
	
	  public function getControlControlOndaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_onda")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
	
		  public function getControlControlLinerPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_liner")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	//Bobinado onda y liner
	
	  public function getBobinadoOndaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bobinado_onda")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
		  public function getBobinadolLinerPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bobinado_liner")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	//fin control onda y liner
    public function getConfeccionModelTroquelPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_confeccion_molde_troquel")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getBobinadoCartulinaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bobinado_cartunila")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getBobinadoCartulinaLinerPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bobinado_liner")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
     public function getBobinadoCartulinaOndaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bobinado_onda")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getCorteCartulinaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corte_cartulina")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getCorrugadoPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corrugado")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getImprentaProgramacionPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_imprenta_programacion")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getImprentaProduccionPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_imprenta_produccion")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getServiciosPorImprentaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_servicios_post_imprenta")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getEmplacadoPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_emplacado")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
    public function getTroqueladoPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_troquelado")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getTallerExternosPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_talleres_externos")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getDesgajadoPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_desgajado")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getPegadoPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_pegado")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    public function getBodegaPorTipo($tipo,$id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bodega")
                ->where(array("tipo"=>$tipo,"id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
	    public function getBodegaPorIdnodo($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bodega")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
	
	
	//confeccion molde troquel

	//prioridad	fecha liberacion fotomecanica	numero orde	cliente	detalle	fecha OP	fecha lib fotomec	revi o nuevo	vendedor	estado

	
	public function getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_del_trabajo,cli.razon_social,ppp.cuando,op.id as id_op,op.cuando as opcuando,ven.nombre as vennombre,op.id_cotizacion,ppp.situacion")
                ->from("produccion_confeccion_molde_troquel as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				

                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
		        ->select("ppp.descripcion_del_trabajo,cli.razon_social,ppp.cuando,op.id as id_op,op.cuando as opcuando,ven.nombre as vennombre,op.id_cotizacion,ppp.situacion")
                ->from("produccion_confeccion_molde_troquel as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
	
	//Pegado
	
		 public function getPegadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador,ppp.id as id_bodega")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				

                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
	//Pegado estado
	
		 public function getPegadoEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.orden_de_trabajo,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador,ppp.id as id_bodega,op.cuando as opcuando,ppp.empaquetado,ppp.id_nodo,ven.nombre as vennombre")
                ->from("produccion_pegado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")

                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.orden_de_trabajo,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador,ppp.id as id_bodega,op.cuando as opcuando,ppp.empaquetado,ppp.id_nodo,ven.nombre as vennombre")
                ->from("produccion_pegado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	//Pegado mas fechas desde hasta Bodega
	
 public function getPegadoConCotizacionPaginacionPorFecha($pagina,$porpagina,$quehago,$desde,$hasta,$operador1)
    {
         switch($quehago)
        {
            case 'limit':

			if($operador1 != 'Todos'){
				$sql = "SELECT `ppp`.`orden_de_trabajo`, `usu`.`nombre`, `ppp`.`descripcion_del_trabajo`, `ppp`.`cantidad_cajas_buenas`, `cli`.`razon_social`, `ppp`.`cuando`, `op`.`id` as id_op, `hcd`.`pegado`, `ppp`.`operador`, `ppp`.`id` as id_bodega 
FROM `produccion_pegado_parcial` as ppp 
INNER JOIN `clientes` as cli ON `cli`.`id`=`ppp`.`id_cliente` 
INNER JOIN `usuarios` as usu ON `usu`.`id`=`ppp`.`operador` 
INNER JOIN `orden_de_produccion` as op ON `op`.`id_cotizacion`=`ppp`.`orden_de_trabajo`
INNER JOIN `hoja_de_costos_datos` as hcd ON `hcd`.`id_cotizacion`=`ppp`.`orden_de_trabajo` 
WHERE (`ppp`.`cuando` BETWEEN '".$desde."' AND '".$hasta."') and `ppp`.`operador` = ".$operador1."
  ORDER BY `ppp`.`orden_de_trabajo` asc ";
			}else{
				
							$sql = "SELECT `ppp`.`orden_de_trabajo`, `usu`.`nombre`, `ppp`.`descripcion_del_trabajo`, `ppp`.`cantidad_cajas_buenas`, `cli`.`razon_social`, `ppp`.`cuando`, `op`.`id` as id_op, `hcd`.`pegado`, `ppp`.`operador`, `ppp`.`id` as id_bodega 
FROM `produccion_pegado_parcial` as ppp 
INNER JOIN `clientes` as cli ON `cli`.`id`=`ppp`.`id_cliente` 
INNER JOIN `usuarios` as usu ON `usu`.`id`=`ppp`.`operador` 
INNER JOIN `orden_de_produccion` as op ON `op`.`id_cotizacion`=`ppp`.`orden_de_trabajo`
INNER JOIN `hoja_de_costos_datos` as hcd ON `hcd`.`id_cotizacion`=`ppp`.`orden_de_trabajo` 
WHERE `ppp`.`cuando` BETWEEN '".$desde."' AND '".$hasta."'  ORDER BY `ppp`.`orden_de_trabajo`,`ppp`.`operador` asc ";
				
			}
				
				$query=$this->db->query($sql);
			//echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
	
	
	//pegado parcial
	  public function getPegadoParcialPorId($id,$usu)
    {
         $query=$this->db
                ->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador,ppp.cantidad_a_empaquetar,foto.materialidad_datos_tecnicos")
                ->from("produccion_pegado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizacion_fotomecanica as foto","foto.id_cotizacion=ppp.orden_de_trabajo","inner")
                ->where(array("ppp.orden_de_trabajo"=>$id,"ppp.operador"=>$usu))
                ->get();
                echo $this->db->last_query();
                return $query->row();
    }
	
	//Desgajado
		 public function getDesgajadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.orden_de_trabajo,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.operador,ppp.unidades_de_caja_por_pliego,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ppp.total_desgajado,op.nombre_producto_normal")
                ->from("produccion_desgajado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.orden_de_trabajo,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.operador,ppp.unidades_de_caja_por_pliego,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ppp.total_desgajado,op.nombre_producto_normal")
                ->from("produccion_desgajado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
											
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	//Desgajado estado
		 public function getDesgajadoEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.orden_de_trabajo,cli.razon_social,ppp.cuando,op.id as id_op,ppp.operador,ppp.unidades_de_caja_por_pliego,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ppp.total_desgajado,op.nombre_producto_normal,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.numero_de_pliegos,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ven.nombre as vennombre,ppp.estado")
                ->from("produccion_desgajado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("ppp.orden_de_trabajo,cli.razon_social,ppp.cuando,op.id as id_op,ppp.operador,ppp.unidades_de_caja_por_pliego,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ppp.total_desgajado,op.nombre_producto_normal,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.numero_de_pliegos,ppp.total_piezas_por_pliego,ppp.total_cajas_a_entregar,ven.nombre as vennombre,ppp.estado")
                ->from("produccion_desgajado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
											
                ->count_all_results();
                return $query;
            break;
        }
    }
		
	//Control Cartulina Parcial
		 public function getCCartulinaConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock,op.id_cotizacion,op.cuando as opcuando,ppp.descripcion_del_trabajo,ven.nombre as vennombre,ppp.situacion,ppp.estado,ppp.total_kilos2,op.nombre_producto_normal")
                ->from("produccion_control_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ven.nombre as vennombre,op.id as id_op,op.nombre_producto_normal,op.cuando as opcuando,ppp.fecha_liberada,op.id_cotizacion,ppp.estado,ppp.id_nodo,cot.id_vendedor")
                ->from("produccion_control_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
		//Control Cartulina Pendientes
		 public function getCCartulinaPendientesConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ven.nombre as vennombre,op.id as id_op,op.nombre_producto_normal,op.cuando as opcuando,ppp.fecha_liberada,op.id_cotizacion,ppp.estado,ppp.id_nodo,cot.id_vendedor")
                ->from("produccion_fotomecanica as ppp")
				
				//->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.id_nodo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("clientes as cli","cli.id=cot.id_cliente","inner")
				
                ->order_by("ppp.id_nodo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				  ->select("cli.razon_social,ven.nombre as vennombre,op.id as id_op,op.nombre_producto_normal,op.cuando as opcuando,ppp.fecha_liberada,op.id_cotizacion,ppp.estado,ppp.id_nodo")
                ->from("produccion_fotomecanica as ppp")
				
				
				//->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.id_nodo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("clientes as cli","cli.id=cot.id_cliente","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

	public function getParcialControlCartulina($id)
    {
         $query=$this->db
                ->select("sum(total_kilos2) as sum")
                ->from("produccion_control_cartulina_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	

	
	public function getParcialControlOndaSuma($id)
    {
         $query=$this->db
                ->select("sum(total_kilos2) as sum")
                ->from("produccion_control_onda_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
		public function getParcialControlLinerSuma($id)
    {
         $query=$this->db
                ->select("sum(total_kilos2) as sum")
                ->from("produccion_control_liner_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	public function getParcialBobinadoOndaSuma($id)
    {
         $query=$this->db
                ->select("sum(total_kilos) as sum")
                ->from("produccion_bobinado_onda_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
		public function getParcialBobinadoLinerSuma($id)
    {
         $query=$this->db
                ->select("sum(total_kilos) as sum")
                ->from("produccion_bobinado_liner_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	public function getParcialBobinadoCartulinaSuma($id)
    {
         $query=$this->db
                ->select("sum(total_kilos) as sum")
                ->from("produccion_bobinado_cartunila_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
			
	//Control Cartulina Estado
		 public function getCCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock,op.id_cotizacion,op.cuando as opcuando,ppp.descripcion_del_trabajo,ven.nombre as vennombre,ppp.situacion,ppp.estado,ppp.id_nodo,hcd.total_pliegos")
                ->from("produccion_control_cartulina as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock,op.id_cotizacion,op.cuando as opcuando,ppp.descripcion_del_trabajo,ven.nombre as vennombre,ppp.situacion,ppp.estado,ppp.id_nodo,ppp.total_pliegos")
                ->from("produccion_control_cartulina as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("hoja_de_costos_datos as hcd","hcd.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

	
	//Confeccion molde de troquel 
		 public function getConfeccionMoldeTroquelCotizacionPaginacionBorrar($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock,op.id_cotizacion,op.cuando as opcuando,ppp.descripcion_del_trabajo,ven.nombre as vennombre,ppp.situacion,ppp.estado")
                ->from("produccion_control_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock")
                ->from("produccion_control_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.quien_sabe_ubicacion_de_la_bobina","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

	
		//Control onda 
		 public function getCOndaConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,ppp.ancho_de_bobina,op.nombre_producto_normal,ppp.gramaje_onda,ppp.numero_bobina_onda,ppp.hay_que_comprar_onda")
                ->from("produccion_control_onda_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ppp.cuando,op.id as id_op,ppp.ancho_de_bobina,op.nombre_producto_normal,ppp.gramaje_onda,ppp.numero_bobina_onda,ppp.hay_que_comprar_onda")
                ->from("produccion_control_onda_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	


		//Control onda Estado
		 public function getCOndaEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        { 
            case 'limit':
                 $query=$this->db
              
                ->select("op.id as id_op,cli.razon_social,ppp.ancho_seleccionado_recomendada,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje_onda,ppp.ancho_a_usar_onda,ven.nombre as vennombre,ppp.estado,op.id_cotizacion,ppp.id_nodo,ppp.total_kilos")
                ->from("produccion_control_onda as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
			    ->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("op.id as id_op,cli.razon_social,ppp.ancho_seleccionado_recomendada,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje_onda,ppp.ancho_a_usar_onda,ven.nombre as vennombre,ppp.estado,op.id_cotizacion,ppp.id_nodo,ppp.total_kilos")
                ->from("produccion_control_onda as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
			    ->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
				    public function getControlCartulina($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_cartulina")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
			    public function getParcialControlOnda($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_onda_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
				    public function getControlOnda($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_onda")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
	
				    public function getParcialControlLiner($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_liner_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
				    public function getControlLiner($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_control_liner")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
	public function getParcialCorteCartulina($id)
    {
				$query=$this->db
                ->select("sum(can_despacho_1) as sum")
                ->from("produccion_corte_cartulina_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
				    public function getParcialCorteCartulinaLiner($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corte_cartulina_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
				    public function getParcialImprentaProduccion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_imprenta_produccion_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
	
	
				    public function getImprentaProduccion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_imprenta_produccion")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
		
		
					    public function getCorrugado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corrugado")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
		

					    public function getParcialServicioPostImprenta($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_servicios_post_imprenta_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
						    public function getParcialCorrugado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corrugado_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
					    public function getParcialEmplacado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_emplacado_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
						    public function getEmplacado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_emplacado")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
		
					public function getCorteCartulina($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_corte_cartulina")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
						public function getTroquelado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_troquelado")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
					    public function getParcialTallerPegadoExterno($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_talleres_externos_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
					    public function getParcialPegado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_pegado_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	
					    public function getPegado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_pegado")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
					    public function getParcialBodega($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_bodega_parcial")
                ->where(array("id_nodo"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
	
	//Control Liner 
		 public function getCLinerConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,ppp.ancho_de_bobina,op.nombre_producto_normal,ppp.gramaje_liner,ppp.numero_bobina_liner,ppp.hay_que_comprar_liner")
                ->from("produccion_control_liner_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ppp.cuando,op.id as id_op,ppp.ancho_de_bobina,op.nombre_producto_normal,ppp.gramaje_liner,ppp.numero_bobina_liner,ppp.hay_que_comprar_liner")
                ->from("produccion_control_liner_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

	
		//Control Liner Estado
		 public function getCLinerEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        { 
            case 'limit':
                 $query=$this->db
              
                ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje_liner,ppp.ancho_a_usar_liner,ven.nombre as vennombre,ppp.estado,op.id_cotizacion,ppp.id_nodo")
                ->from("produccion_control_liner as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
			    ->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje_liner,ppp.ancho_a_usar_liner,ven.nombre as vennombre,ppp.estado,op.id_cotizacion,ppp.id_nodo")
                ->from("produccion_control_liner as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
			    ->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
		//Bobinado Cartulina
		 public function getBobinadoCartulinaConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_cartulina,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,usu2.nombre as nombre2,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.medida_final_pliego_a_cortar")
                ->from("produccion_bobinado_cartunila_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("usuarios as usu2","usu2.id=ppp.ayudante","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.descripcion_cartulina,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,usu2.nombre as nombre2,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.medida_final_pliego_a_cortar")
                ->from("produccion_bobinado_cartunila_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("usuarios as usu2","usu2.id=ppp.ayudante","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
		//Bobinado Cartulina Estado
		 public function getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_cartulina,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,usu2.nombre as nombre2,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.medida_final_pliego_a_cortar,ven.nombre as vennombre,ppp.id_nodo")
                ->from("produccion_bobinado_cartunila as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("usuarios as usu2","usu2.id=ppp.ayudante","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.descripcion_cartulina,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,usu2.nombre as nombre2,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.medida_final_pliego_a_cortar,ven.nombre as vennombre,ppp.id_nodo")
                ->from("produccion_bobinado_cartunila as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("usuarios as usu2","usu2.id=ppp.ayudante","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
			    public function getParcialBobinadoCartulina($id)
					{
						 $query=$this->db
								->select("*")
								->from("produccion_bobinado_cartunila_parcial")
								->where(array("id_nodo"=>$id))
								->get();
								//echo $this->db->last_query();
								return $query->row();
					}
	
		//Bobinado Onda
		 public function getBobinadoOndaConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_onda,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,op.id_cotizacion,ppp.id_nodo")
                ->from("produccion_bobinado_onda_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("ppp.descripcion_onda,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos,op.id_cotizacion,ppp.id_nodo")
                ->from("produccion_bobinado_onda_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
		//Bobinado Onda Estado
		 public function getBobinadoOndaEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.descripcion_onda,ppp.ancho_a_bobinar,ppp.medida_final_pliego_a_cortar,ppp.total_pliegos_para_la_orden,ppp.total_kilos_a_bobinar,ven.nombre as vennombre,ppp.cuando,ppp.id_nodo")
                ->from("produccion_bobinado_onda as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.descripcion_onda,ppp.ancho_a_bobinar,ppp.medida_final_pliego_a_cortar,ppp.total_pliegos_para_la_orden,ppp.total_kilos_a_bobinar,ven.nombre as vennombre,ppp.cuando,ppp.id_nodo")
                ->from("produccion_bobinado_onda as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
		//Bobinado Liner 
		 public function getBobinadoLinerConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("ppp.descripcion_liner,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos")
                ->from("produccion_bobinado_liner_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				  ->select("ppp.descripcion_liner,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.datos_tecnicos,ppp.ancho_a_bobinar,ppp.gramaje_seleccionado,ppp.total_pliegos_para_la_orden,ppp.operador,ppp.total_kilos")
                ->from("produccion_bobinado_liner_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")
				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
		//Bobinado Liner Estado
		 public function getBobinadoLinerEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.descripcion_liner,ppp.ancho_a_bobinar,ppp.medida_final_pliego_a_cortar,ppp.total_pliegos_para_la_orden,ppp.total_kilos_a_bobinar,ven.nombre as vennombre,ppp.cuando,ppp.id_nodo")
                ->from("produccion_bobinado_liner as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                 ->select("op.id as id_op,cli.razon_social,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.descripcion_liner,ppp.ancho_a_bobinar,ppp.medida_final_pliego_a_cortar,ppp.total_pliegos_para_la_orden,ppp.total_kilos_a_bobinar,ven.nombre as vennombre,ppp.cuando,ppp.id_nodo")
                ->from("produccion_bobinado_liner as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

		//Corte Cartulina 
		 public function getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_corte_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_corte_cartulina_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
		//Corte Cartulina Estado
		 public function getCorteCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.ancho_bobina,ven.nombre as vennombre,ppp.largo_a_cortar")
                ->from("produccion_corte_cartulina as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")		
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.operador,ppp.total_kilos,ppp.total_pliegos_a_cortar,ppp.numero_de_tarimas,ppp.total_pliegos_cortados,ppp.ancho_realmente_cortado,ppp.largo_realmente_cortado,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.ancho_bobina,ven.nombre as vennombre,ppp.largo_a_cortar")
                ->from("produccion_corte_cartulina as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")		
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	

			//Imprenta produccion
		 public function getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.colores,ppp.descripcion_tapa,ppp.total_pliegos_buenos,ppp.impresion_para_trabajo,ppp.tipo_cartulina,ppp.can_parcial")
                ->from("produccion_imprenta_produccion_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.maestro","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.colores,ppp.descripcion_tapa,ppp.total_pliegos_buenos,ppp.impresion_para_trabajo,ppp.tipo_cartulina,ppp.can_parcial")
                ->from("produccion_imprenta_produccion_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.maestro","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	

		//Imprenta produccion Estado
		 public function getImprentaProduccionEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.colores,ppp.descripcion_tapa,ppp.total_pliegos_buenos,ppp.impresion_para_trabajo,ppp.tipo_cartulina,ppp.can_parcial,ppp.id_nodo,ppp.total_merma,ppp.barniz,ppp.laca,ven.nombre as vennombre,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje,ppp.tamano_a_imprimir_1,ppp.tamano_a_imprimir_2")
                ->from("produccion_imprenta_produccion as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.maestro","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.colores,ppp.descripcion_tapa,ppp.total_pliegos_buenos,ppp.impresion_para_trabajo,ppp.tipo_cartulina,ppp.can_parcial,ppp.id_nodo,ppp.total_merma,ppp.barniz,ppp.laca,ven.nombre as vennombre,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.gramaje,ppp.tamano_a_imprimir_1,ppp.tamano_a_imprimir_2")
                ->from("produccion_imprenta_produccion as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("usuarios as usu","usu.id=ppp.maestro","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
		//Imprenta Programacion Estado
		 public function getImprentaProgramacionEstadoConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,op.cuando as opcuando,op.id as id_op,ppp.id_nodo,ppp.descripcion_del_trabajo,ppp.tamano_a_imprimir_1,ppp.tamano_a_imprimir_2,ppp.colores,ppp.cantidad,ven.nombre as vennombre")
                ->from("produccion_imprenta_programacion as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")			
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				->select("cli.razon_social,op.cuando as opcuando,op.id as id_op,ppp.id_nodo,ppp.descripcion_del_trabajo,ppp.tamano_a_imprimir_1,ppp.tamano_a_imprimir_2,ppp.colores,ppp.cantidad,ven.nombre as vennombre")
                ->from("produccion_imprenta_programacion as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")			
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
				//Servicio Post Imprenta 
	public function getServicioPostImprentaCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.descripcion_trabajo_externo,ppp.tamano_cartulina,ppp.cantidad_de_pliegos,ppp.fecha_recepcion_pedido,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_servicios_post_imprenta_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.descripcion_trabajo_externo,ppp.tamano_cartulina,ppp.cantidad_de_pliegos,ppp.fecha_recepcion_pedido,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_servicios_post_imprenta_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }



		//Servicio Post Imprenta Estado
	public function getServicioPostImprentaEstadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.descripcion_trabajo_externo,ppp.tamano_cartulina,ppp.cantidad_de_pliegos,ppp.fecha_recepcion_pedido,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,pro.nombre as provnombre,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.cantidad_de_pliegos,ppp.id_nodo,ven.nombre as vennombre")
                ->from("produccion_servicios_post_imprenta as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("proveedores as pro","pro.id=ppp.proveedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
				 ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.descripcion_trabajo_externo,ppp.tamano_cartulina,ppp.cantidad_de_pliegos,ppp.fecha_recepcion_pedido,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,pro.nombre as provnombre,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.cantidad_de_pliegos,ppp.id_nodo,ven.nombre as vennombre")
                ->from("produccion_servicios_post_imprenta as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("proveedores as pro","pro.id=ppp.proveedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

	
	
					//Corrugado
	public function getCorrugadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.onda_a_usar,ppp.liner_a_usar,ppp.reverso_a_usar,ppp.total_pliegos_a_fabricar,ppp.total_pliegos_producidos,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_corrugado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")		
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
	             ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.onda_a_usar,ppp.liner_a_usar,ppp.reverso_a_usar,ppp.total_pliegos_a_fabricar,ppp.total_pliegos_producidos,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3")
                ->from("produccion_corrugado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")		
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	

	
						//Corrugado Estado
	public function getCorrugadoCotizacionEstadoPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.onda_a_usar,ppp.liner_a_usar,ppp.reverso_a_usar,ppp.total_pliegos_a_fabricar,ppp.total_pliegos_producidos,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.ancho_de_onda_a_usar,ppp.ancho_de_liner_a_usar,ppp.tamano_1,ppp.tamano_2,ven.nombre as vennombre")
                ->from("produccion_corrugado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
	             ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.onda_a_usar,ppp.liner_a_usar,ppp.reverso_a_usar,ppp.total_pliegos_a_fabricar,ppp.total_pliegos_producidos,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.ancho_de_onda_a_usar,ppp.ancho_de_liner_a_usar,ppp.tamano_1,ppp.tamano_2,ven.nombre as vennombre")
                ->from("produccion_corrugado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }

		
					//Emplacado
	public function getEmplacadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.total_pliegos_buenos")
                ->from("produccion_emplacado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")	
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.total_pliegos_buenos")
                ->from("produccion_emplacado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")	
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
						//Emplacado Estado
	public function getEmplacadoEstadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_pliegos_buenos,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.id_nodo,ppp.ccac1,ppp.ccac2,ven.nombre as vennombre")
                ->from("produccion_emplacado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_pliegos_buenos,op.cuando as opcuando,ppp.descripcion_del_trabajo,ppp.id_nodo,ppp.ccac1,ppp.ccac2,ven.nombre as vennombre")
                ->from("produccion_emplacado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	

	
	
						//Troquelado
	public function getTroqueladoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.numero_molde_troquel,ppp.total_pliegos_a_troquelar")
                ->from("produccion_troquelado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")	
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.numero_molde_troquel,ppp.total_pliegos_a_troquelar")
                ->from("produccion_troquelado_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("usuarios as usu","usu.id=ppp.operador","inner")	
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
							//Troquelado Estado
	public function getTroqueladoEstadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.numero_molde_troquel,ppp.total_pliegos_a_troquelar,ven.nombre as vennombre,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,foto.materialidad_datos_tecnicos")
                ->from("produccion_troquelado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("cotizacion_fotomecanica as foto","foto.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.total_o_parcial,ppp.can_despacho_1,ppp.can_despacho_2,ppp.can_despacho_3,ppp.numero_molde_troquel,ppp.total_pliegos_a_troquelar,ven.nombre as vennombre,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,foto.materialidad_datos_tecnicos")
                ->from("produccion_troquelado as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				->join("cotizacion_fotomecanica as foto","foto.id_cotizacion=ppp.orden_de_trabajo","inner")
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	

	
						//Taller Pegado Externo
	public function getTallerPegadoExternoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidad_a_pegar,ppp.chofer")
                ->from("produccion_talleres_externos_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidad_a_pegar,ppp.chofer")
                ->from("produccion_talleres_externos_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	//Taller Pegado Externo estado
	public function getTallerPegadoExternoEstadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidad_a_pegar,ppp.chofer,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.si_no,ppp.cantidad_a_pegar,ppp.precio,ven.nombre as vennombre")
                ->from("produccion_talleres_externos as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidad_a_pegar,ppp.chofer,ppp.id_nodo,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.si_no,ppp.cantidad_a_pegar,ppp.precio,ven.nombre as vennombre")
                ->from("produccion_talleres_externos as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
	
							//Bodega
	public function getBodegaParcialCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidades_a_ingresar,ppp.total_cajas_pendientes,ppp.cierra_la_orden")
                ->from("produccion_bodega_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                 ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidades_a_ingresar,ppp.total_cajas_pendientes,ppp.cierra_la_orden")
                ->from("produccion_bodega_parcial as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	//fecha de ingreso	numero orde	fech lib pegado	cliente	detalle	fecha OP	cantidad de cajas	cantidad justa(s/n)	precio	tipo empaque	fcha entrega	taller/ pegadora	tiene entregas parciales?	vendedor	estado

							//Bodega estado
	public function getBodegaEstadoCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidades_a_ingresar,ppp.total_cajas_pendientes,ppp.cierra_la_orden,ppp.id_nodo,ven.nombre as vennombre,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.precio_venta,ppp.total_cajas_ingresadas")
                ->from("produccion_bodega as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->order_by("ppp.orden_de_trabajo","asc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cli.razon_social,ppp.cuando,op.id as id_op,op.nombre_producto_normal,ppp.cantidades_a_ingresar,ppp.total_cajas_pendientes,ppp.cierra_la_orden,ppp.id_nodo,ven.nombre as vennombre,ppp.descripcion_del_trabajo,op.cuando as opcuando,ppp.precio_venta,ppp.total_cajas_ingresadas")
                ->from("produccion_bodega as ppp")
				->join("clientes as cli","cli.id=ppp.id_cliente","inner")				
				->join("orden_de_produccion as op","op.id_cotizacion=ppp.orden_de_trabajo","inner")
				->join("cotizaciones as cot","cot.id=op.id_cotizacion","inner")
				->join("vendedores as ven","ven.id=cot.id_vendedor","inner")
				
				
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	
	
    public function MermasParaProduccion($id,$ngramaje,$ancho) //Kilos cartulina
    {
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $datos2=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);
        $cortes=$this->produccion_model->getCorteCartulina($id);
		  
//print_r($cortes); exit();
		   $tamano1=$ancho;
           $tamano2=$ing->tamano_a_imprimir_2;

    if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland 800";
    }

   if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
		}
            }else
            {
		//ultra
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }
                else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
                }
            }
        }else
        {
            if($fotomecanica->colores == 0)
            {
                $color1=0;
                $color2=0;
            }
            elseif($fotomecanica->colores >= 1 and $fotomecanica->colores <= 3)
            {	
                if($maquina=="Máquina Roland 800")
                {
                   $color1= 400;
                   $color2=0;
                }else
                {
                        //ultra
                   $color1= 300;
                   $color2=0;
                }
            }
        }
       // echo $ing->unidades_por_pliego;exit;
         $canTotal=number_format($datos->cantidad_1/5000,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         $cantidad_1=$datos->cantidad_1/$ing->unidades_por_pliego;
         //echo $cantidad_1;exit;

         if($datos->cantidad_1/$ing->unidades_por_pliego>5000)
         {
            $can1=150;
            if($can1==150)
            {
                $entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can2=(($entero)-2)*75;
            }else
            {
                $can2=0;
            }
                
            
         }else
         {
            $can1=0;
            $can2=0;
         }
        
        
        $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if($fotomecanica->lleva_barniz=='SI')
         {
            $cantidadBarniz=$datos->cantidad_1-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    $bar1=150;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz=($datos->cantidad_1/$ing->unidades_por_pliego);
			   if($enteroBarniz < 2000)
			   {
				$bar1=150;
                $bar2=0;   
			   }else
			   {
               $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+0.5)-2)*10;
               //echo $enteroBarniz;exit;   
               $bar1=150;
               $bar2=$enteroBarniz;
			   }
            }
            
            
         }else
         {
                $bar1=0;
                $bar2=0;
         }
		 

		
		
		
        if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
 
		$acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
		$acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
		$acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
		
		
		if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

		if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
		if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
		if($laca == null)
		{
			$laca=0;
		}
		
		
		if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        } 
		
	if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
        if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
		
		
	if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
			//echo $acabado_nombre4->tipo;
            $numeros_de_acabados=1;			
        }else
        {
        } 
		
	if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
			//echo $acabado_nombre5->tipo;
            $numeros_de_acabados=2;		
        }else
        {
        } 
		
        if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
			//echo $acabado_nombre6->tipo;
            $numeros_de_acabados=3;	
        }else
        {
        } 
		
		 if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
	if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17")
        {
            if($termolaminado == 50)
            {
                      $externo=0;
            }else{
            $externo=50;
            }
        }else
        {
            $externo=0;
        }
		
       // echo $ing->materialidad_datos_tecnicos;exit;
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $cartulina=30*$canTotal2;
            }else
            {
                $cartulina=0;
            }
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/

                $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        if($ing->lleva_troquelado=="NO")
        {
            $troquelado=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
             $troquelado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/

                            $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              

                            $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          

                    $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      

                        $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                            $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          

                            $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        $sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
			 $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
		
             //ehndz: La siguiente linea fue modificada porque la formula no se corresponde ($costoPlacaKilo ----> $hoja->placa_kilo)
            //$valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$ngramaje)/10000000;
          $ngramaje=$ngramaje/10; 
          $valorPlacaKilo=($hoja->placa_kilo*$tamano1*$cortes->largo_realmente_cortado*$ngramaje)/10000000;
//          echo $hoja->placa_kilo."<br>"; 
//          echo $tamano1."<br>"; 
//          echo $cortes->largo_realmente_cortado."<br>"; 
//          echo $ngramaje."<br>"; 
//          echo floor($valorPlacaKilo)."<br>"; 
          $valorPlacaKilo = floor($valorPlacaKilo);
          //print_r($cortes); 
          //echo ->ancho_realmente_cortado;
          // exit();
                return $valorPlacaKilo;
    }

	
	
	
	
	
	
	
	//Monotapa
	 public function LlamarKilosMonotapa($id,$ngramos)
    {
		
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
		$ordenCompra=$this->orden_model->getOrdenesDeCompraPorCotizacion($id);
		$fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
		$materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
		$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
		$recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
		$cantidad_cajas = $ordenCompra->cantidad_de_cajas + 104;
		$tamano1=$ing->tamano_a_imprimir_1;
                $tamano2=$ing->tamano_a_imprimir_2;

		$GramosMetroCuadrado=$ngramos+($ngramos *($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
		  
		$kilosOnda =  ($tamano1 * $tamano1 * $GramosMetroCuadrado * $cantidad_cajas) / 10000000;
		
		 return $kilosOnda;
	}
	//Monotapa
	
		 public function LlamarKilosOnda($id,$ngramos,$ancho)
    {
		
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
		$ordenCompra=$this->orden_model->getOrdenesDeCompraPorCotizacion($id);
		$fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);

		if($fotomecanica->materialidad_datos_tecnicos == 'Corrugado')
		{
		$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(25);
		}
		if($fotomecanica->materialidad_datos_tecnicos == 'Microcorrugado'){
		$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);	
		}
		
		
		
		  $cantidad_cajas = ($ordenCompra->cantidad_de_cajas / $ing->unidades_por_pliego) +  104;
		  $tamano1=$ancho;
          $tamano2=$ing->tamano_a_imprimir_2;
		  

		  
		$kilosOnda =  ($tamano1 * $tamano2 * $ngramos * $cantidad_cajas * (($variable_cotizador->precio * 10 + 1000)/1000)) / 10000000;
		
		 return $kilosOnda;
	}
	
	
	
	
		 public function LlamarKilosLiner($id,$ngramos,$ancho)
    {
		
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
		$ordenCompra=$this->orden_model->getOrdenesDeCompraPorCotizacion($id);
		$fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);

	
		
		
		
		  $cantidad_cajas = ($ordenCompra->cantidad_de_cajas / $ing->unidades_por_pliego) + 104;
		  $tamano1=$ancho;
          $tamano2=$ing->tamano_a_imprimir_2;
		  

		  
		$kilosOnda =  ($tamano1 * $tamano2 * $ngramos * $cantidad_cajas ) / 10000000;
		
		 return $kilosOnda;
	}
	
	
	
	
	
	
    public function reversarOp($id)
    {		
	         $query=$this->db
               ->set("estado","0")
	       ->where(array("id_cotizacion"=>$id))
               ->update("orden_de_produccion");
             
                 $query=$this->db
	       ->set("estado","0")
	       ->where(array("id_cotizacion"=>$id))
               ->update("cotizaciones_orden_de_compra");
			
                 $query=$this->db
	       ->set("rev","1")
	       ->set("fecha_revision_molde",date('Y-m-d'))
	       ->where(array("id"=>$id))
               ->update("cotizaciones");
                 
                 $query=$this->db
	       ->set("impreso","")
	       ->where(array("id_cotizacion"=>$id))
               ->update("hoja_de_costos_datos");
    }
    public function reversarOp2($id)
    {		
	       $query=$this->db
	       ->where(array("id_nodo"=>$id))
               ->delete("produccion_fotomecanica");
		//echo $this->db->last_query()."<br />";
	       
                $query=$this->db
	       ->where(array("id_nodo"=>$id))
               ->delete("produccion_control_cartulina");
		//echo $this->db->last_query()."<br />";
                
                $query=$this->db
	       ->where(array("id_nodo"=>$id))
               ->delete("produccion_control_onda");
		//echo $this->db->last_query()."<br />";
                
                $query=$this->db
	       ->where(array("id_nodo"=>$id))
               ->delete("produccion_control_liner");
		//echo $this->db->last_query();exit;
                //return $query;
                
                 $query=$this->db
               ->set("estado","0")
	       ->where(array("id_cotizacion"=>$id))
               ->update("orden_de_produccion");
             
                 $query=$this->db
	       ->set("estado","0")
	       ->where(array("id_cotizacion"=>$id))
               ->update("cotizaciones_orden_de_compra");
                 
                 $query=$this->db
	       ->set("rev","1")
	       ->where(array("id_cotizacion"=>$id))
               ->update("cotizaciones");
				
    }
    public function getpaguinacionBodegaCerrados()
    {		
				$query=$this->db
               ->select("*")
                ->from("produccion_bodega")
				->where(array("estado"=>'4'))
                ->count_all_results();
				//echo $this->db->last_query();exit;
                return $query;
				
    }
    
    public function getServiciosPorImprentaImpresion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_servicios_post_imprenta")
                ->where(array("id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }    
	
  public function getLargoDePinzas($id)
    {
         $query=$this->db
                ->select("largo_de_pinza,gato,largo_de_pinza_por_cola,largo_de_pinza_gato_derecho,largo_de_pinza_gato_izquierdo")
                ->from("produccion_imprenta_produccion")
                ->where(array("id_nodo"=>$id))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }    	
	
  public function getEtiquetaDespacho($id)
    {
      /*
	SELECT 
	oc.id AS ot,
	op.fecha AS fecha,
	cl.razon_social,
	op.cantidad_pedida AS cantidad,
	c.producto_id,
	c.producto,
	p.codigo

	FROM orden_de_produccion op               

	LEFT JOIN cotizaciones c ON c.id = op.id_cotizacion
	LEFT JOIN produccion_control_cartulina cc ON op.id_cotizacion=cc.id_nodo
	LEFT JOIN clientes cl ON cl.id=c.id_cliente
	LEFT JOIN cotizaciones_orden_de_compra oc ON oc.id_cotizacion=op.id_cotizacion
	LEFT JOIN cotizacion_ingenieria i ON i.id_cotizacion = op.id_cotizacion
	LEFT JOIN productos p ON p.id_cotizacion = c.id
	WHERE 
	op.id_cotizacion=4027
      */
      
        $query=$this->db
        ->select("oc.id AS ot,
                    op.fecha AS fecha,
                    cl.razon_social,
                    op.cantidad_pedida AS cantidad,
                    c.producto_id,
                    c.producto,
                    p.codigo")
                
        ->from("orden_de_produccion as op")
        ->join("cotizaciones as c","c.id = op.id_cotizacion","left")
        ->join("produccion_control_cartulina as cc","op.id_cotizacion=cc.id_nodo","left")
        ->join("clientes as cl","cl.id=c.id_cliente","left")
        ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")
        ->join("cotizacion_ingenieria as i","i.id_cotizacion = op.id_cotizacion","left")
        ->join("productos as p","p.id_cotizacion = c.id","left")
        ->where(array("op.id_cotizacion"=>$id))

        //->order_by("ppp.orden_de_trabajo","asc")
        ///->limit($porpagina,$pagina)
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row();	
    }    	

}