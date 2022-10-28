<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
          if(empty($data['arrPedido'])){
        ?>
        <p>Datos no encontrados</p>
        <?php }else{
            $orden = $data['arrPedido'];
         ?>
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header">ATENCIÓN AL USUARIO</h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $orden['fecha'] ?></h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4">
              <address><strong>Clinica médica</strong><br>
                <?= "Dirección" ?><br>
                <?= "6465454" ?><br>
                <?= "info@miclinica.com" ?><br>
              </address>
            </div>
            <div class="col-4">
              <address><strong><?= $orden['nombres'].' '.$orden['apellidos'] ?></strong><br>
                Envío: <?= $orden['direccion']; ?><br>
                Tel: <?= $orden['telefono'] ?><br>
                Email: <?= $orden['email_user'] ?>
               </address>
            </div>
            <div class="col-4"><b>Pedido #<?= $orden['idpedido'] ?></b><br> 
                <b>Servicio:</b> <?= $orden['nombreservicio'] ?> <br>
                <b>Responsable:</b> <?= $orden['responsable'] ?> <br>
                <b>Tel. Responsable:</b> <?= $orden['telefonoResp'] ?> <br>
            </div>
            <div class="col-md-12">
                <b>Notas:</b> <?= $orden['notas'] ?> <br><br>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th class="text-left">Insumo</th>
                    <th class="text-center">Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($orden['detalle'] as $detalle) {
                   ?>
                  <tr>
                    <td><?= $detalle['idinsumos'] ?></td>
                    <td class="text-left"><?= $detalle['nombre'] ?></td>
                    <td class="text-center"><?= $detalle['cantidad'] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" ><i class="fa fa-print"></i> Imprimir</a></div>
          </div>
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>