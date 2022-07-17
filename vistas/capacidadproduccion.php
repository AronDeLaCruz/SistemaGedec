<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['consultav']==1) {

require_once "../modelos/Consultas.php";
$consulta = new Consultas();
$compras10 = $consulta->capacidadproduccionpre();
$fechasc='';
$totalesc='';
while ($regfechac=$compras10->fetch_object()) {
  $fechasc=$fechasc.'"'.$regfechac->fecha.'",';
  $totalesc=$totalesc.$regfechac->indicador.',';
}

//quitamos la ultima coma
$fechasc=substr($fechasc, 0, -1);
$totalesc=substr($totalesc, 0,-1);

$ventas12 = $consulta->capacidadproduccionpost();
  $fechasv='';
  $totalesv='';
  while ($regfechav=$ventas12->fetch_object()) {
    $fechasv=$fechasv.'"'.$regfechav->fecha.'",';
    $totalesv=$totalesv.$regfechav->indicador.',';
  }


  //quitamos la ultima coma
  $fechasv=substr($fechasv, 0, -1);
  $totalesv=substr($totalesv, 0,-1);

?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Capacidad de produccion</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                Compras de los ultimos 10 dias
                                </div>
                                <div class="box-body">
                                <canvas id="pretest" width="400" height="300"></canvas>
                                </div>
                            </div>    
                        </div>
            
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    Compras de los ultimos 10 dias
                                </div>
                                <div class="box-body">
                                    <canvas id="postest" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
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

<script src="../public/js/Chart.bundle.min.js"></script>
<script src="../public/js/Chart.min.js"></script>
<script>
var ctx = document.getElementById("pretest").getContext('2d');
var pretest = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc ?>],
        datasets: [{
            label: '# Pretest de productos en los últimos 10 dias',
            data: [<?php echo $totalesc ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

var ctx = document.getElementById("postest").getContext('2d');
var postest = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasv ?>],
        datasets: [{
            label: '# Postest de productos en los últimos 10 dias',
            data: [<?php echo $totalesv ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
  <?php 
}
ob_end_flush();
  ?>

