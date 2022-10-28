<?php

    class Pedidos extends Controllers{
        public function __construct()
        {
            session_start();
            parent::__construct();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(MPEDIDOS); //id del modulo
        }

        public function Pedidos()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'/dashboard');
            }
            $data['page_tag'] = "Pedidos";
            $data['page_title'] = "PEDIDOS <small>Atención Al Usuario</small>";
            $data['page_name'] = "pedidos";
            $data['page_functions_js'] = "functions_pedidos.js";
            $this->views->getView($this,"pedidos",$data);
        }

        public function getPedidos()
        {
            if($_SESSION['permisosMod']['r']){
                $arrData = $this->model->selectPedidos();
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<a class="btn btn-info btn-sm" href="'.base_url().'/pedidos/verorden/'.$arrData[$i]['idpedido'].'" title="Ver pedido"><i class="far fa-eye"></i></a>';
                    }
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<a class="btn btn-primary  btn-sm" href="'.base_url().'/pedidos/registro/'.$arrData[$i]['idpedido'].'" title="Editar pedido"><i class="fas fa-pencil-alt"></i></a>';
                    }
                    if($_SESSION['permisosMod']['d']){  
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idpedido'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function delPedido()
        {
            if($_POST){
                if($_SESSION['permisosMod']['d']){
                    $intIdpedido = intval($_POST['idpedido']);
                    $requestDelete = $this->model->deletePedido($intIdpedido);
                    if($requestDelete)
                    {
                        $requestDeleteDetalle = $this->model->deleteDetallePedido($intIdpedido);
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado al pedido ');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar al pedido.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function Registro($idpedido = null)
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'/dashboard');
            }
            unset($_SESSION['arrDetalleReq']);
            $data['page_tag'] = "Registro Requerimiento ";
            $data['page_title'] = "Registro <small>requerimiento</small>";
            $data['page_name'] = "registro_requerimiento";
            $data['page_functions_js'] = "functions_pedidos.js";
            $data['idpedido'] = "";
            if(!empty($idpedido))
            {
                if(is_numeric($idpedido))
                {
                    $data['idpedido'] = $idpedido;
                    $arrPedido = $this->model->selectPedido($idpedido);
                    if(empty($arrPedido))
                    {
                        header("Location:".base_url().'/pedidos');
                    }else{
                        $data['pedido'] = $arrPedido;
                        //Crear Sesión
                        $_SESSION['arrDetalleReq'] = $arrPedido['detalle'];
                    }
                }else{
                    header("Location:".base_url().'/pedidos');
                }
            }
            $this->views->getView($this,"registro",$data);
        }

        public function verorden($idpedido){
            if(!is_numeric($idpedido)){
                header("Location:".base_url().'/pedidos');
            }
            if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'/dashboard');
            }

            $data['page_tag'] = "Pedido";
            $data['page_title'] = "PEDIDO <small>Pacientes</small>";
            $data['page_name'] = "pedido";
            $data['arrPedido'] = $this->model->selectPedido($idpedido);
            $this->views->getView($this,"orden",$data);
        }


        public function addDetalle()
        {
            if($_POST){
                //unset($_SESSION['arrDetalleReq']);exit;
                $arrDetalle = array();
                $cantDetalle = 0;
                $idinsumo = $_POST['id'];
                $msg = "¡Insumo Agregado!";
                //$idinsumo = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
                $cantidad = $_POST['cant'];
                if(is_numeric($idinsumo) and is_numeric($cantidad)){
                    $arrInsumo = $this->model->selectInsumo($idinsumo);
                    if(!empty($arrInsumo)){
                        $arrInsumos = array('idinsumos' => $idinsumo,
                                            'nombre' => $arrInsumo['nombre'],
                                            'cantidad' => $cantidad
                                        );
                        if(isset($_SESSION['arrDetalleReq'])){
                            $on = true;
                            $arrDetalle = $_SESSION['arrDetalleReq'];
                            //dep($_SESSION['arrDetalleReq']);
                            for ($pr=0; $pr < count($arrDetalle); $pr++) {
                                if($arrDetalle[$pr]['idinsumos'] == $idinsumo){ //Si ya existe el insumo
                                    $arrDetalle[$pr]['cantidad'] = $cantidad;
                                    $msg = "¡Insumo Actualizado!";
                                    $on = false;
                                }
                            }
                            if($on){
                                array_push($arrDetalle,$arrInsumos);
                                
                            }
                            $_SESSION['arrDetalleReq'] = $arrDetalle;
                        }else{
                            array_push($arrDetalle, $arrInsumos);
                            $_SESSION['arrDetalleReq'] = $arrDetalle;
                        }
                        $htmlDetalle ="";
                        foreach ($_SESSION['arrDetalleReq'] as $pro) {
                            $cantDetalle += $pro['cantidad'];
                            $htmlDetalle .='<tr>
                                       <td>'.$pro['idinsumos'].'</td>
                                       <td>'.$pro['nombre'].'</td>
                                       <td>'.$pro['cantidad'].'</td>
                                       <td><button class="btn btn-danger btn-sm" onclick="fntDelDetalle('.$pro['idinsumos'].')" title="Eliminar insumo"><i class="far fa-trash-alt" aria-hidden="true"></i></button></td>
                                    </tr>';
                        }
                        $arrResponse = array("status" => true, 
                                            "msg" => $msg,
                                            "cantDetalle" => $cantDetalle,
                                            "htmlDetalle" => $htmlDetalle
                                        );
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'Insumo no existente.');
                    }
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function delDetalle(){
            if($_POST){
                $arrDetalle = array();
                $cantDetalle = 0;
                $subtotal = 0;
                $idinsumo = $_POST['id'];
                if(is_numeric($idinsumo) ){
                    $arrDetalle = $_SESSION['arrDetalleReq'];
                    for ($pr=0; $pr < count($arrDetalle); $pr++) {
                        if($arrDetalle[$pr]['idinsumos'] == $idinsumo){
                            unset($arrDetalle[$pr]);
                        }
                    }
                    sort($arrDetalle);
                    $_SESSION['arrDetalleReq'] = $arrDetalle;

                    $htmlDetalle ="";
                    foreach ($_SESSION['arrDetalleReq'] as $pro) {
                        $cantDetalle += $pro['cantidad'];
                        $htmlDetalle .='<tr>
                                   <td>'.$pro['idinsumos'].'</td>
                                   <td>'.$pro['nombre'].'</td>
                                   <td>'.$pro['cantidad'].'</td>
                                   <td><button class="btn btn-danger btn-sm" onclick="fntDelDetalle('.$pro['idinsumos'].')" title="Eliminar insumo"><i class="far fa-trash-alt" aria-hidden="true"></i></button></td>
                                </tr>';
                    }
                    $arrResponse = array("status" => true, 
                                            "msg" => '¡Insumo eliminado!',
                                            "cantDetalle" => $cantDetalle,
                                            "htmlDetalle" => $htmlDetalle
                                        );
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        //Registra o Actualiza un pedido
        public function registrar()
        {
            if($_POST){
                //dep($_POST);exit;
                if(empty($_POST['idpaciente']) || empty($_POST['idservicio']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{ 
                    $intIdPedido = $_POST['idpedido'];
                    $intIdPaciente = intval(strClean($_POST['idpaciente']));
                    $intIdServicio = intval(strClean($_POST['idservicio']));
                    $strNotas = strClean($_POST['notas']);
                    $request_user = "";
                    if(!empty($_SESSION['arrDetalleReq'])){

                        //Actualizar
                        if(!empty($intIdPedido))
                        {
                            if(is_numeric($intIdPedido ))
                            {
                                //Actuliza campo notas
                                $this->model->updateNotas($intIdPedido,$strNotas);
                                //Marca como eliminado todo el detalle
                                $this->model->deleteDetalle($intIdPedido);
                                //Actualiza/Inserta detalle
                                foreach ($_SESSION['arrDetalleReq'] as $insumo) {
                                    $idinsumo = $insumo['idinsumos'];
                                    $cantidad = $insumo['cantidad'];
                                    $this->model->updateDetalle($intIdPedido,$idinsumo,$cantidad);
                                }
                                $arrResponse = array("status" => true, 
                                                "orden" => $intIdPedido, 
                                                "msg" => 'Pedido actualizado'
                                            );
                                unset($_SESSION['arrDetalleReq']);

                            }else{
                                $arrResponse = array("status" => false, "msg" => 'Error en el ID pedido.');
                            }
                        }else{
                            //Crear pedido
                            $request_pedido = $this->model->insertPedido($intIdPaciente, 
                                                                $intIdServicio, 
                                                                $strNotas);
                            if($request_pedido > 0 ){
                                //Insertamos detalle
                                foreach ($_SESSION['arrDetalleReq'] as $insumo) {
                                    $idinsumo = $insumo['idinsumos'];
                                    $cantidad = $insumo['cantidad'];
                                    $this->model->insertDetalle($request_pedido,$idinsumo,$cantidad);
                                }
                                $arrResponse = array("status" => true, 
                                                "orden" => $request_pedido, 
                                                "msg" => 'Pedido realizado'
                                            );
                                unset($_SESSION['arrDetalleReq']);
                            }else{
                                    $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
                                }
                        }


                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        } //End registro

    }

 ?>
