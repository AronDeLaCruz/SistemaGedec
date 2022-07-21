<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

require "../config/Conexion.php";
class Tablas{
  public function listar(){
    $sql="SELECT * FROM rotacion where idrotacion BETWEEN 22 and 42  ";
    return ejecutarConsulta($sql);
  }
}
if ($_SESSION['consultav']==1) {
$tablas = new Tablas();
$tablas10 = $tablas->listar();


?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2><center><b>CAPACIDAD DE PRODUCCIÓN - POSTTEST</b></center></h2>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div>
                      <nav class="navbar navbar-expand">
                        <ul class="navbar-nav">
                          <li class="nav-item" style="margin-right:1px; list-style-type: none;">
                            <a class="btn btn-info btn-sm nav-link active" type="button" href="tablacapacidadproduccion.php">
                              PreTest
                            </a>
                          </li>
                          <li class="nav-item" style="margin-right:20px; list-style-type: none;">
                            <a class="btn btn-primary btn-sm nav-link" href="tablacapacidadproduccionpost.php">
                              PosTest
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>

                        <th>Producto </th>
                          <th>Capacidad Utilizada</th>
                          <th>Capacidad Maxima</th>
                          <th>Valor del Indicador</th>
 

                        </thead>
                          <?php
                              // LOOP TILL END OF DATA
                              while($rows=$tablas10->fetch_assoc())
                              {
                          ?>
                        <tbody>
                          <td><?php echo $rows['marca'];?></td>
                          <td><?php echo $rows['inventario'];?></td>
                          <td><?php echo $rows['vd'];?></td>
                          <td><?php echo $rows['indicador'];?></td>

                        </tbody>
                          <?php
                              }
                          ?>     
                        <tfoot>

                        <th>Producto </th>
                          <th>Capacidad Utilizada</th>
                          <th>Capacidad Maxima</th>
                          <th>Valor del Indicador</th>


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


  <?php 
}
ob_end_flush();
  ?>
