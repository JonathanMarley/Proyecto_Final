<?php
 $nombre = $_POST['txtnombre'];
 $correo = $_POST['txtcorreo'];
 $comentario = $_POST['txtcomentario'];
 
 if (!empty($nombre) || !empty($correo) || !empty($comentario)) {
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "registro";
 
   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
   if (mysqli_connect_error()) {
     die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
   }
   else {
     $SELECT = "SELECT id from registro where id = ? limit 1 ";
     $INSERT = "INSERT INTO registro (nombre,correo,comentario) VALUES(?,?,?)";
     
     $stmt = $conn->prepare($SELECT);
     $stmt ->bind_param("i", $id);
     $stmt ->execute();
     $stmt ->bind_result($id);
     $stmt ->store_result();
     $rnum =$stmt->num_rows;
     if ($rnum == 0) {
       $stmt ->close();
       $stmt = $conn->prepare($INSERT);
       $stmt ->bind_param("sss",$nombre,$correo,$comentario);
       $stmt ->execute();
       echo "TU REGISTRO YA ESTA COMPLETADO, VUELVA A LA PAGINA PRINCIPAL";  
     }elseif($rnum == 0 ){
       echo "ups creo que hay un error";
     }
     $stmt->close();
     $conn->close();
   }
 
 }else {
   echo "todos los datos son Obligatorios";
   die();
 }

 
?>

