<?php 
	
	class PedidosModel extends Mysql
	{
		private $intIdPedido;
		private $intIdInsumo;

		private $strNombre;
		private $strDescripcion;	
		private $intTipocategoria;
		private $intStatus;
        public $intIdcategoria;
		private $strRuta;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
			
		}

		public function selectPedidos()
		{
			$sql = "SELECT p.idpedido,
							DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
							p.servicioid,
							s.nombreservicio,
							p.personaid,
							pr.nombres,
							pr.apellidos
					FROM pedido p 
					INNER JOIN persona pr
					ON p.personaid = pr.idpersona 
					INNER JOIN servicio s
					ON p.servicioid = s.idservicio
					WHERE p.status != 0 ORDER BY p.idpedido DESC";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectInsumo(int $idinsumos){
			$this->intIdInsumo = $idinsumos;
			$sql = "SELECT idinsumos,nombre
                    FROM insumos
					WHERE idinsumos = $this->intIdInsumo";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPedido(string $pacienteid, int $servicioid, string $notas){
			$query_insert  = "INSERT INTO pedido(personaid,servicioid,notas) 
								  VALUES(?,?,?)";
			$arrData = array($pacienteid,
	    						$servicioid,
	    						$notas
	    					);
			$request_insert = $this->insert($query_insert,$arrData);
		    $return = $request_insert;
		    return $return;
		}

		public function insertDetalle(int $idpedido, int $productoid, int $cantidad){
			$query_insert  = "INSERT INTO detalle_pedido(pedidoid,insumoid,cantidad) 
								  VALUES(?,?,?)";
			$arrData = array($idpedido,
	    					$productoid,
							$cantidad
						);
			$request_insert = $this->insert($query_insert,$arrData);
		    $return = $request_insert;
		    return $return;
		}

		public function selectPedido(int $idpedido){
			$busqueda = "";
			
			$request = array();
			$sql = "SELECT p.idpedido,
						   	pr.identificacion,
							DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
							p.servicioid,
							p.notas,
							s.nombreservicio,
							p.personaid,
							pr.nombres,
							pr.apellidos,
							pr.telefono,
							pr.email_user,
							pr.direccion,
							pr.responsable,
							pr.telefonoResp
					FROM pedido p 
					INNER JOIN persona pr
					ON p.personaid = pr.idpersona 
					INNER JOIN servicio s
					ON p.servicioid = s.idservicio
					WHERE p.idpedido =  $idpedido AND p.status != 0 ";

			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$sql_detalle = "SELECT i.idinsumos,
										i.nombre,
										d.cantidad
									FROM detalle_pedido d
									INNER JOIN insumos i
									ON d.insumoid = i.idinsumos
									WHERE d.pedidoid = $idpedido AND d.status !=0 "; 
				$requestProductos = $this->select_all($sql_detalle);
				$requestPedido['detalle'] = $requestProductos;
			}
			return $requestPedido;
		}	


		public function deletePedido(int $intIdpedido)
		{
			$this->intIdPedido = $intIdpedido;
			$sql = "UPDATE pedido SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
		public function deleteDetallePedido(int $intIdpedido)
		{
			$this->intIdPedido = $intIdpedido;
			$sql = "UPDATE detalle_pedido SET status = ? WHERE pedidoid = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		//Actualiza notas 
		public function updateNotas(int $idpedido,string $notas)
		{
			$this->intIdPedido = $idpedido;
			$sql = "UPDATE pedido SET notas = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array($notas);
			$request_up_p = $this->update($sql,$arrData);
			return $request_up_p;
		}

		//Marca como eliminado el detalle de un pedido existente
		public function deleteDetalle(int $idpedido)
		{
			$this->intIdPedido = $idpedido;
			$sql = "UPDATE detalle_pedido SET status = ? WHERE pedidoid = $this->intIdPedido ";
			$arrData = array(0);
			$request_up_d = $this->update($sql,$arrData);
			return $request_up_d;
		}
		//Actualiza o Inserta detalles a un pedido existente
		public function updateDetalle(int $idpedido, int $idinsumo, int $cantidad)
		{
			$this->intIdPedido = $idpedido;
			$this->intIdInsumo = $idinsumo;
			//Busca detalle
			$sql = "SELECT id
                    FROM detalle_pedido
					WHERE pedidoid = $this->intIdPedido AND insumoid = $this->intIdInsumo ";
			$request = $this->select($sql);
			if(empty($request)) //Si no existe el detalle, lo crea
			{
				$request_dt = $this->insertDetalle($this->intIdPedido,$this->intIdInsumo,$cantidad);
			}else{ // Si existe el detalle lo actualiza
				$idDetalle = $request['id'];
				$sql_up = "UPDATE detalle_pedido SET cantidad = ?, status = ? WHERE id = $idDetalle";
				$arrDataUp = array($cantidad,1);
				$request_dt = $this->update($sql_up,$arrDataUp);
			}

			return $request_dt;
		}
			

	}

 ?>