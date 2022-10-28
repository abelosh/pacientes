<?php 
    headerAdmin($data); 
    getModal('modalsRequerimientos',$data);

    $idpedido = "";
    $notas = "";
    $idpaciente = "";
    $nomPaciente = "";
    $identificacion = "";
    $idservicio = "";
    $nomServicio = "";
    $arrDetalle = "";
    if(!empty($data['pedido']))
    {
        $idpedido = $data['pedido']['idpedido'];
        $notas = $data['pedido']['notas'];
        $idservicio = $data['pedido']['servicioid'];
        $idpaciente = $data['pedido']['personaid'];
        $nomServicio = $data['pedido']['nombreservicio'];
        $nomPaciente = $data['pedido']['nombres']." ".$data['pedido']['apellidos'];
        $identificacion = $data['pedido']['identificacion'];
        $arrDetalle = $data['pedido']['detalle'];
    }
?>
  <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fa fa-clipboard"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-clipboard fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
              <div class="tile">
                <div class="row">
                    <div class="col-md-5">

                      <div class="divider">
                          <h4 class="divider-text">Paciente </h4>
                      </div>
                        <input type="hidden" id="txtidPedido" name="txtidPedido" value="<?= $idpedido; ?>" >
                        <input type="hidden" id="txtidPaciente" name="txtidPaciente" value="<?= $idpaciente; ?>" required="">
                        <input type="hidden" id="txtidServicio" name="txtidServicio" value="<?= $idservicio; ?>" required="">
                        
                        <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                              <label for="txtIdentPaciente">Identificación <span class="required">*</span></label>
                              <div class="input-group mb-3">
                                <input type="text" id="txtIdentPaciente" class="form-control" placeholder="Identificación paciente" value="<?= $identificacion; ?>" readonly="">
                                <?php 
                                    if(empty($data['idpedido'])){
                                ?>
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#busquedaPaciente" onclick="fntGetPacientes()"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <?php } ?>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-icon-left">
                                    <label for="txtNombre">Nombres <span class="required">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Nombre completo" id="txtNombres" value="<?= $nomPaciente; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <label for="txtBuscarServicio">Servicio <span class="required">*</span></label>
                              <div class="input-group mb-3">
                                <input type="text" id="txtBuscarServicio" class="form-control" placeholder="Servicio" value="<?= $nomServicio; ?>" readonly="">
                                <?php 
                                    if(empty($data['idpedido'])){
                                 ?>
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#busquedaServicio" onclick="fntGetServicios()"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <?php } ?>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="tile">
                            <div class="divider">
                              <h4 class="divider-text">Insumo</h4>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="tableInsumosReq">
                                  <thead>
                                    <tr>
                                      <th width="20">ID</th>
                                      <th width="">Insumo</th>   
                                      <th width="10" >Cantidad</th>
                                      <th width="10">Agregar</th>
                                    </tr>
                                  </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="tile">
                            
                            <div class="divider">
                              <h4 class="divider-text">Detalle Insumo </h4>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm" id="tableDetallePedido">
                                  <thead>
                                    <tr>
                                      <th width="100">ID</th>
                                      <th>Insumo</th>   
                                      <th width="50">Cantidad</th>
                                      <th width="10">Acción</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tblDetalleInsumos">
                                    <?php 
                                        if(!empty($arrDetalle))
                                        {
                                            foreach ($arrDetalle as $insumo) {
                                    ?>
                                        <tr>
                                           <td><?= $insumo['idinsumos']; ?></td>
                                           <td><?= $insumo['nombre']; ?></td>
                                           <td><?= $insumo['cantidad']; ?></td>
                                           <td><button class="btn btn-danger btn-sm" onclick="fntDelDetalle(<?= $insumo['idinsumos']; ?>)" title="Eliminar insumo"><i class="far fa-trash-alt" aria-hidden="true"></i></button></td>
                                        </tr>

                                    <?php 
                                            }
                                        }
                                     ?>
                                  </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                  <label for="txtNotas">Notas<span class="required">*</span></label>
                                  <div class="form-group">
                                    <textarea class="form-control" id="txtNotas" rows="3"><?= $notas; ?></textarea>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button id="btnActionSave" class="btn btn-primary" type="button" ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"> Guardar </span></button>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>

                </div>
              </div>
            
            
        
        <div class="row">
            
        </div>
    </main>
<?php footerAdmin($data); ?>