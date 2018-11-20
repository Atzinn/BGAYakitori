<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultar</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––– –––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
    <body>
        <header class="header">
            <img src="img/bgayakitori.png" class="logo">
            <h1>Usuario</h1>
        </header>
        
        <nav class="menu">
           <div align="center">
            <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
           </div>
        </nav>
        <br><br>
        
    <div class="rows" align='center'>
        <?php
            session_start();
            include 'conection.php';
            $cons=$_GET['datos'];
                if(isset($_SESSION['id']) && isset($_SESSION['id2']) || isset($_SESSION['id']) && isset($_SESSION['dec_pass'])){
                    /*Consulta*/
                        $Cons="SELECT * 
			                   FROM users 
			                   INNER JOIN (datos_user,trabajadores,permisos) 
			                   ON (datos_user.id_datos=users.id_datos 
                               AND trabajadores.id_trabajador=datos_user.id_trabajador 
                               AND permisos.id_user=users.id_user) 
			                   WHERE users.user_name LIKE '%".$cons."%'
                               OR datos_user.nombre LIKE '%".$cons."%'
                               OR datos_user.apellidos LIKE '%".$cons."%'";
                        #echo "<br>".$Cons;
                        $Rcons=mysqli_query($conn,$Cons);
                    /*-------------------------*/
                    /*Impresión de datos*/
                    if($_SESSION['permisos']=="Administrador"){
                        echo "<table border=1>";
                           echo "<tr>";
		                    echo "<th>Nombre Completo</th>";
		                     echo "<th>Nombre de usuario</th>";
		                      echo "<th>Número de telefono</th>";
		                     echo "<th>CURP</th>";
                            echo "<th>Permisos</th>";
                            echo "<th>Opciones</th>";
		                   echo "</tr>";
                        
                        while($registros=mysqli_fetch_array($Rcons)){
                            echo "<tr>";
		  		             echo "<td>".$registros['nombre']." ".$registros['apellidos']."</td>";
		   		              echo "<td>".$registros['user_name']."</td>";
		                       echo "<td>".$registros['num_tel']."</td>";
		                      echo "<td>".$registros['CURP']."</td>";
	                         echo "<td>".$registros['permisos']."<td>";
                            echo "<td>";
                            echo "<form action='actualizar.php' method='POST'>".
                                "<input type='hidden' value='".$registros['user_name']."' name='user' id='user'><br>".
                                "<input type='submit' name='actualizar' class='button-primary' value='Actualizar'>".
                                "</form><br>";
                            echo "<form action='eliminar.php' method='GET'>".
                                "<input type='hidden' value='".$registros['user_name']."' name='user' id='usuer'><br>".
                                "<input type='submit' name='eliminar' class='button-primary' value='Eliminar'>".
                                "</form><br>";
                            echo "</td>";
                            echo "</tr>";   
                        } echo "<a href=index2.php><input type='button' class='button' value='Menú Principal'></a>";
                        
                    }else if($_SESSION['permisos']=="Trabajador"){
                        echo "<table border=1>";
                           echo "<tr>";
		                    echo "<th>Nombre Completo</th>";
		                     echo "<th>Nombre de usuario</th>";
		                      echo "<th>Número de telefono</th>";
		                     echo "<th>CURP</th>";
                            echo "<th>Permisos</th>";
		                   echo "</tr>";
                        
                        while($registros=mysqli_fetch_array($Rcons)){
                            echo "<tr>";
		  		             echo "<td>".$registros['nombre']." ".$registros['apellidos']."</td>";
		   		              echo "<td>".$registros['user_name']."</td>";
		                       echo "<td>".$registros['num_tel']."</td>";
		                      echo "<td>".$registros['CURP']."</td>";
	                         echo "<td>".$registros['permisos']."<td>";                        
                            echo "</tr>";   
                        } echo "<a href=index2.php><input type='button' class='button' value='Menú Principal'></a>";
                    }
                    /*---------------------------*/
                    
                }else{
                    echo "<script>alert('No has iniciado sesión')</script>";
                     echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";   
                }
                
            
        ?>
    </div>        
    </body>
</html>