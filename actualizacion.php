<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
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
        <h1>Actualizar</h1>
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
    
    <div class="rows">
        <div class="container">
           <h2>Actualizar usuario</h2>
           <?php
             include 'conection.php';
             session_start();
            if(isset($_SESSION['id']) && isset($_SESSION['id2']) || isset($_SESSION['id']) && isset($_SESSION['dec_pass']) ){
              if(!$_GET['go']=''){
                    $name=$_POST['nombre'];
                     $lastname=$_POST['apellido'];
                      $phone=$_POST['telefono'];
                       $user=$_POST['user_name'];
                        $pass=$_POST['password'];
                         $curp=$_POST['curp'];
                          $type=$_POST['tipo'];
                           $en_pass=password_hash($pass, PASSWORD_DEFAULT);
              }
                /*Primeros querys*/
                    $act1="UPDATE users
                           SET user_name='".$user."',pass='".$en_pass."'
                           WHERE user_name='".$_SESSION['id']."'";
                    $act2="UPDATE datos_user
                           SET nombre='".$name."',apellidos='".$lastname."',user_name='".$user."',num_tel='".$phone."',CURP='".$curp."'
                           WHERE user_name='".$_SESSION['id']."'";
                    $act3="UPDATE trabajadores
                           SET user_name='".$user."',tipo_trabajador='".$type."'
                           WHERE user_name='".$_SESSION['id']."'";
                    $act4="UPDATE permisos
                           SET user_name='".$user."', permisos='".$type."'
                           WHERE user_name='".$_SESSION['id']."'";
                    $ract1=mysqli_query($conn,$act1);
                     $ract2=mysqli_query($conn,$act2);
                      $ract3=mysqli_query($conn,$act3);
                       $ract4=mysqli_query($conn,$act4);
                    #echo "<br>".$act1."<br>".$act2."<br>".$act3."<br>".$act4;
                /*-----------------------------------------------*/
                /*if condicional de actualizacion e impresión de datos*/
                    echo "<div align=center class=rows>";
                    if($ract1 AND $ract2 AND $ract3 AND $ract4){
                        $Cons="SELECT * 
			                   FROM users 
			                   INNER JOIN (datos_user,trabajadores,permisos) 
			                   ON (datos_user.id_datos=users.id_datos 
                               AND trabajadores.id_trabajador=datos_user.id_trabajador 
                               AND permisos.id_user=users.id_user) 
			                   WHERE users.user_name='".$user."'";
                        #echo $Cons."<br>";
                        $registros=mysqli_query($conn,$Cons);
		                  echo "<table border=1>";
                           echo "<tr>";
		                    echo "<th>Nombre Completo</th>";
		                     echo "<th>Nombre de usuario</th>";
		                    echo "<th>Número de telefono</th>";
		                   echo "<th>CURP</th>";
                          echo "<th>Permisos<th>";
		                 echo "</tr>";
                     if($registros){
			             while($columna=mysqli_fetch_array($registros)){
				            echo "<tr>";
		  		             echo "<td>".$columna['nombre']." ".$columna['apellidos']."</td>";
		   		              echo "<td>".$columna['user_name']."</td>";
		                       echo "<td>".$columna['num_tel']."</td>";
		                      echo "<td>".$columna['CURP']."</td>";
	                         echo "<td>".$columna['permisos']."<td>";
		                    echo "</tr>";
			             }
		            }else{echo "Hay error en la consulta";}
                    }else{
                        echo "No se ejecuto correctamente la consulta";
                        echo "<br<br><a href=index2.php.php><input type='button' class='button' value='Mení Principal'></a>";
                    }
                    echo "<a href=index2.php><input type='button' value='Menú Principal'></a>";
                     
                echo "</div>";
                /*---------------------------------------------------------*/
                
            
                
            }else{
                echo "<script>alert('No has iniciado sesión')</script>";
                 echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";   
            }
             
        
            ?>
        </div></div>
</body>
</html>