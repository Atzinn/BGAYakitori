<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <!-- Mobile Specific Metas –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT –––––––––––––––––––––––––––––––––––––––––––––––––– -->
 	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/skeleton.css">
  	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <img src="img/bgayakitori.png" class="logo">
        <h1>Registrado</h1>
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
    
    <?php
    session_start();
    include 'conection.php';
    echo"<div align='center'>";
        /*Variables*/
            $name=$_POST['nombre'];
             $lastname=$_POST['apellido'];
              $phone=$_POST['telefono'];
               $user=$_POST['user_name'];
                $pass=$_POST['password'];
                 $curp=$_POST['curp'];
                  $type=$_POST['tipos'];
                   $en_pass= password_hash($pass, PASSWORD_DEFAULT);
    
                if($type=='administrador'){
                    $per="Administrador";
                }elseif($type=="cajero" || $type=="mesero"){
                    $per="Trabajador";
                }
        /*------------------------------------------------------*/
        if(isset($_SESSION['id']) && isset($_SESSION['id']) || isset($_SESSION['id']) && isset($_SESSION['dec_pass'])){
        /*QUERY y resultados*/
            $query='INSERT INTO users (id_user,user_name,pass,id_datos) VALUES (NULL,"'.$user.'","'.$en_pass.'",NULL)';
            #echo $query."<br>";
             $query2="INSERT INTO datos_user(id_datos,nombre,apellidos,id_trabajador,user_name,num_tel,CURP)
                        VALUES (NULL,'".$name."','".$lastname."',NULL,'".$user."','".$phone."','".$curp."')";
            #echo $query2."<br>";
              $query3="INSERT INTO trabajadores (id_trabajador,user_name,tipo_trabajador,comentarios)
                        VALUES (NULL,'".$user."','".$type."',' ')";
            #echo $query3."<br>";
               $query4="INSERT INTO permisos (id_user,id_trabajador,user_name,permisos)
                        VALUES (NULL,NULL,'".$user."','".$per."')";
            #echo $query4."<br>";
            $res1=mysqli_query($conn,$query);
             $res2=mysqli_query($conn,$query2);
              $res3=mysqli_query($conn,$query3);
               $res4=mysqli_query($conn,$query4);
            if($res1 AND $res2 AND $res3 AND $res4){
                /*Querys para actualizar las llaves foraneas en los registros*/
                $SQL="SELECT id_datos FROM datos_user WHERE CURP='".$curp."'";
                 $r=mysqli_query($conn,$SQL);
                while($id_dato=mysqli_fetch_array($r)){
                    $act="UPDATE users SET id_datos='".$id_dato['id_datos']."' WHERE user_name='".$user."'";
                     $ra=mysqli_query($conn,$act);
                }
                $SQL2="SELECT id_trabajador FROM trabajadores WHERE user_name='".$user."'";
                 $r2=mysqli_query($conn,$SQL2);
                while($id_trab=mysqli_fetch_array($r2)){
                    $act2="UPDATE datos_user SET id_trabajador='".$id_trab['id_trabajador']."' WHERE user_name='".$user."'";
                     $ra2=mysqli_query($conn,$act2);
                    $act3="UPDATE permisos SET id_trabajador='".$id_trab['id_trabajador']."' WHERE user_name='".$user."'";
                     $ra3=mysqli_query($conn,$act3);
                }
                $SQL3="SELECT id_user FROM users WHERE user_name='".$user."'";
                 $r3=mysqli_query($conn,$SQL3);
                while($id_user=mysqli_fetch_array($r3)){
                    $act4="UPDATE permisos SET id_user='".$id_user['id_user']."' WHERE user_name='".$user."'";
                     $r4=mysqli_query($conn,$act4);
                }
                /*-----------------------------------------------------------*/
                echo "<h2>Se ha registrado el trabajador</h2><br>";
            }else{echo "No se pudo registrar el trabajador<br>";}
        /*-------------------------------------------------------*/
        
        /*Usuario registrado*/
        $Cons="SELECT * 
			   FROM users 
			   INNER JOIN (datos_user,trabajadores,permisos) 
			   ON (datos_user.id_datos=users.id_datos AND trabajadores.id_trabajador=datos_user.id_trabajador AND permisos.id_user=users.id_user) 
			   WHERE CURP='".$curp."'";
        #echo $Cons."<br>";
        $registros=mysqli_query($conn,$Cons);
		    echo "<table border=1>";
             echo "<tr>";
		      echo "<th>Nombre Completo</th>";
		       echo "<th>Nombre de usuario</th>";
		        echo "<th>Número de telefono</th>";
		       echo "<th>CURP</th>";
              echo "<th>Puesto</th>"
              echo "<th>Permisos<th>";
		     echo "</tr>";
        if($registros){
			while($columna=mysqli_fetch_array($registros)){
				echo "<tr>";
		  		 echo "<td>".$columna['nombre']." ".$columna['apellidos']."</td>";
		   		  echo "<td>".$columna['user_name']."</td>";
		           echo "<td>".$columna['num_tel']."</td>";
		          echo "<td>".$columna['CURP']."</td>";
                 if($columna['tipo_trabajador']=="administrador"){
                     echo "<td>Gerente</td>";
                 }
                else{
                    echo "<td>".$columna['tipo_trabajador']."</td>";
                }
	             echo "<td>".$columna['permisos']."<td>";
		        echo "</tr>";
			}
		}else{echo "Hay error en laconsulta";}
        /*--------------------------------------------------------*/
     }else{
            echo "<script>alert('No has iniciado sesión')</script>";
             echo "<meta http-equiv='Refresg' content='0;url=index.html'>";
        }
    echo "</div>";
    ?>
</body>
</html>