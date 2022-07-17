<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['consultav']==1) {

?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Rotacion de productos</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Proveedor</th>
                          <th>Usuario</th>
                          <th>Documento</th>
                          <th>Número</th>
                          <th>Total Compra</th>
                          <th>Estado</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Proveedor</th>
                          <th>Usuario</th>
                          <th>Documento</th>
                          <th>Número</th>
                          <th>Total Compra</th>
                          <th>Estado</th>
                        </tfoot>   
                      </table>
                    </div>         
                </div>
            </div>
        </div>
     
    </section>
</div>


<?php 
}else{
    require 'noacceso.php'; 
}

require 'footer.php';
?>

<script src="scripts/tablas.js"></script>

  <?php 
}
ob_end_flush();
  ?>
