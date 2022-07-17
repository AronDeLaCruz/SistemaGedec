<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Consultas{


	//implementamos nuestro constructor
public function __construct(){

}

//listar registros
public function comprasfecha($fecha_inicio,$fecha_fin){
	$sql="SELECT DATE(i.fecha_hora) as fecha, u.nombre as usuario, p.nombre as proveedor, i.tipo_comprobante, i.serie_comprobante, i.num_comprobante, i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
	return ejecutarConsulta($sql);
}

public function rotacionproductos(){
	//$sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) AS fecha, SUM(total_venta) AS total FROM venta GROUP BY fecha_hora ORDER BY fecha_hora LIMIT 0,14;";
	$sql="SELECT CONCAT(DAY(v.fecha_hora),'-',MONTH(v.fecha_hora)) AS fecha, (d.precio_venta/avg(a.stock))*100 AS indicador FROM ((detalle_venta d INNER JOIN venta v ON v.idventa=d.idventa) INNER JOIN articulo a on d.idarticulo=a.idarticulo) GROUP BY fecha_hora ORDER BY fecha_hora LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function rotacionproductospost(){
	$sql="SELECT CONCAT(DAY(fecha),'-',MONTH(fecha)) AS fecha, indicador AS indicador FROM rotacion WHERE MONTH(fecha)=6 GROUP BY fecha ORDER BY fecha LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function capacidadproduccionpre(){
	$sql="SELECT CONCAT(DAY(fecha),'-',MONTH(fecha)) AS fecha, indicador AS indicador FROM rotacion WHERE MONTH(fecha)=4 GROUP BY fecha ORDER BY fecha LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function capacidadproduccionpost(){
	$sql="SELECT CONCAT(DAY(fecha),'-',MONTH(fecha)) AS fecha, indicador AS indicador FROM rotacion WHERE MONTH(fecha)=6 GROUP BY fecha ORDER BY fecha LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function exactitudinventarios(){
	$sql="SELECT CONCAT(DAY(v.fecha_hora),'-',MONTH(v.fecha_hora)) AS fecha, (d.precio_venta/avg(a.stock))*100 AS indicador FROM ((detalle_venta d INNER JOIN venta v ON v.idventa=d.idventa) INNER JOIN articulo a on d.idarticulo=a.idarticulo) GROUP BY fecha_hora ORDER BY fecha_hora LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function exactitudinventariospost(){
	$sql="SELECT CONCAT(DAY(fecha),'-',MONTH(fecha)) AS fecha, indicador AS indicador FROM rotacion WHERE MONTH(fecha)=6 GROUP BY fecha ORDER BY fecha LIMIT 0,14;";
	return ejecutarConsulta($sql);
}

public function ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente){
	$sql="SELECT DATE(v.fecha_hora) as fecha, u.nombre as usuario, p.nombre as cliente, v.tipo_comprobante,v.serie_comprobante, v.num_comprobante , v.total_venta, v.impuesto, v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.idcliente='$idcliente'";
	return ejecutarConsulta($sql);
}

public function totalcompra(){
	$sql="SELECT format(IFNULL(SUM(total_compra),0),2) as total_compra FROM ingreso";
	return ejecutarConsulta($sql);
}

public function totalventa(){
	$sql="SELECT format(IFNULL(SUM(total_venta),0),2) as total_venta FROM venta";
	return ejecutarConsulta($sql);
}

public function comprasultimos_10dias(){
	$sql=" SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) AS fecha, SUM(total_compra) AS total FROM ingreso GROUP BY fecha_hora ORDER BY fecha_hora  LIMIT 0,10";
	return ejecutarConsulta($sql);
}

public function ventasultimos_12meses(){
	$sql=" SELECT DATE_FORMAT(fecha_hora,'%M') AS fecha, SUM(total_venta) AS total FROM venta GROUP BY MONTH(fecha_hora) ORDER BY fecha_hora  LIMIT 0,12";
	return ejecutarConsulta($sql);
}


}

 ?>
