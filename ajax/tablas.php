<?php 
require_once "../modelos/Ingreso.php";
if (strlen(session_id())<1) 
	session_start();

    $tabla = new Tablas();

    $idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
    $idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
    $idusuario=$_SESSION["idusuario"];
    $tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
    $serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
    $num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
    $fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
    $impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
    $total_compra=isset($_POST["total_compra"])? limpiarCadena($_POST["total_compra"]):"";

    switch ($_GET["op"]) {
        case 'listar':
            $rspta=$ingreso->listar();
            $data=Array();
    
            while ($reg=$rspta->fetch_object()) {
                $data[]=array(
                "0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idingreso.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>',
                "1"=>$reg->fecha,
                "2"=>$reg->proveedor,
                "3"=>$reg->usuario,
                "4"=>$reg->tipo_comprobante,
                "5"=>$reg->serie_comprobante. '-' .$reg->num_comprobante,
                "6"=>'S/ '.number_format($reg->total_compra,2,".",","),
                "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
                  );
            }
            $results=array(
                 "sEcho"=>1,//info para datatables
                 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
                 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
                 "aaData"=>$data); 
            echo json_encode($results);
            break;

            case 'ventasfechacliente':
                $fecha_inicio=$_REQUEST["fecha_inicio"];
                $fecha_fin=$_REQUEST["fecha_fin"];
                $idcliente=$_REQUEST["idcliente"];
            
                    $rspta=$consulta->ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente);
                    $data=Array();
            
                    while ($reg=$rspta->fetch_object()) {
                        $data[]=array(
                        "0"=>$reg->fecha,
                        "1"=>$reg->usuario,
                        "2"=>$reg->cliente,
                        "3"=>$reg->tipo_comprobante,
                        "4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
                        "5"=>$reg->total_venta,
                        "6"=>$reg->impuesto,
                        "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
                          );
                    }
                    $results=array(
                         "sEcho"=>1,//info para datatables
                         "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
                         "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
                         "aaData"=>$data); 
                    echo json_encode($results);
                    break;
    }


?>