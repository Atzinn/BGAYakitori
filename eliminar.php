<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar usuario</title>
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
        <h1>BGA Yakitori</h1>
    </header>      
  
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
  
   <?php
        session_start();
        
        if(isset($_SESSION['id']) && isset($_SESSION['id2']) || isset($_SESSION['id']) && isset($_SESSION['dec_pass'])){
    
    
    echo "<div class='rows' align='center'>";
     echo" <h1>¿Seguro quiere eliminar?</h1>";
        
            include 'conection.php';
            
            $usr=$_GET['user'];
            $_SESSION['usr']=$_GET['user'];
            
             $Cons="SELECT * 
			        FROM users 
			        INNER JOIN (datos_user,trabajadores,permisos) 
			        ON (datos_user.id_datos=users.id_datos 
                    AND trabajadores.id_trabajador=datos_user.id_trabajador 
                    AND permisos.id_user=users.id_user) 
			        WHERE users.user_name='".$usr."'";
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
             }
                 
                echo "<form action='borrado.php' method='get' name='borrado'>".
                     "<input type='hidden' value='".$columna['user_name']."' name='eliminado' id='eliminado'>". 
                     "<input type='submit' name='go' value='Aceptar' class='button-primary'>".
                     "</form>";
                echo "<a href='index2.php'><input type='button' class='button' value='Menú Principal'></a>";
        
    echo "</div>";
    
        }else{
            echo "<script>alert('No has iniciado sesión')</script>";
             echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";   
        }       
    ?>
    
</body>
</html>