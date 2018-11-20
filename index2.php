<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BGA Yakitori</title>
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
    if(isset($_SESSION['id'])){
             if($_SESSION['id']=='' AND $_SESSION['id2']==''){
                   echo "<script> alert('Los campos están vacios')</script>";
                    echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
                   echo "<img src='images/image.gif'>";
            
    ?>
    <div class="rows">
        <div align="center">
            <form action="login.php" method="GET" name="form">
                <legend>Nombre de usuario: </legend><input type="text" name="user_name"><br>
                <legend>Contraseña: </legend><input type="password" name="pass"><br>
                <input name="formulario" type="hidden" value="ingresar">
                <input type="submit" class="button-primary" id="log" name="ingre" value='Ingresar'>
                 <a href="registrar.html" class="button" >Registrar</a>
            </form>
           
        </div>
    </div>
    <?php
             }
            /*Consulta*/
                $cons="SELECT *
                       FROM users
                       JOIN (permisos)
                       ON (permisos.id_user=users.id_user)
                       WHERE users.user_name='".$_SESSION['id']."'";
                #echo $cons."<br>";
       // echo $cons;
        #echo "<br>".$_SESSION['id']."<br>".$_SESSION['id2'];
        include "conection.php";
                $rcons=mysqli_query($conn,$cons);
                if($rcons){
                   // while($usuario=mysqli_fetch_array($rcons)){
                    $usuario=mysqli_fetch_array($rcons);
                    $_ESSION['dec_pass']=password_verify($_SESSION['id2'],$usuario['pass']);
                    #echo "Usuario de bd: ".$usuario['user_name']."<br>Contraseña de bd:".$usuario['pass'];
                    echo "<div class='rows' align='center'>";
                       if($_SESSION['id']==$usuario['user_name'] AND $_SESSION['dec_pass']==$usuario['pass']){
                            #echo "entro al and correcto";
                            $_SESSION['permisos']=$usuario['permisos'];
                            echo "<h2>Bienvenido '".$_SESSION['id']."'</h2>";
                            #if para permisos
                            if($usuario['permisos']=="Administrador"){
                                #echo "<br>".$usuario['permisos'];
                                echo "<table>";
                                 echo "<h3>¿Qué deseas hacer?</h3>";
                                 echo "<tr>";
                                  echo "<th><div align='center'><a href='registrar.php'><input type='button' class='button' value='Agregar'></a></div></th>";
                                   echo "<th><form name='actualizar' method='POST' action='actualizar.php'>";
                                    echo "<div align='center'>";
                                     echo "<legend>Introduce el nombre de usaurio del<br>trabajador que deseas actualizar</legend>";
                                     echo "<input type='text' name='user' id='user'>";
                                     echo "<br>";
                                     echo "<input type='submit' class='button-primary' value='Buscar' name='go'>";
                                    echo "</div>";
                                   echo "</form></th>";
                                   echo "<th><a href='consultar.php'><input type='button' class='button' value='Busqueda avalzada'></a></th>";
                                  echo "<th><a href='inventario.php'><input type='button' class='button' value='Inventario'></a></th>";
                                 echo "</tr>";
                                echo "</table>";
                            }else if($usuario['permisos']=='Trabajador'){
                                echo "<table>";
                                 echo "<tr>";
                                  echo "<th><a href='consultar.php'><input type='button' class='button-primary' value='Busqueda avalzada'></a></th>";
                                  echo "<th><a href='#'><input type='button' class='button' value='Inventario'></a></th>";
                                 echo "</tr>";
                                echo "</table>";
                            }
                        }else if(!$_SESSION['id']=$usuario['user_name'] && !$_SESSION['dec_pass']=$usuario['pass']){
                            #echo "entro al and de error";
                             echo "Nombre de usuario o contraseña equivocados";
                            echo "<br><br><a href='destroy.php'><input type='button' class'button' value='Volver'</a>";
                           echo "<br><br>usuario: '" .$_SESSION['id']."' password: '".$_SESSION['id2']."'";
                        }else if(!$_SESSION['id']=$usuario['user_name'] || !$_SESSION['dec_pass']){
                            #echo "entro al or de error";
                             echo "Nombre de usuario o contraseña equivocados";
                            echo "<br><br><a href='destroy.php'><input type='button' class'button' value='Inicio'></a>";
                           echo "<br><br>usuario: '" .$_SESSION['id']."' password: '".$_SESSION['id2']."'";
                        }
                        
                        echo "</div>"; #Cierre del Div despues del while
                    //}#Cierre del while                    
                }else{echo "No se ejecuto correctamente la consulta";
                      echo "<br<br><a href=destroy.php><input type='button' class='button-primary' value='Inicio'></a>";}#Cierre del if de ejecucion del query*/
            
            /*--------------*/
        }else{ 
                echo "<script>alert('No has iniciado sesión')</script>";
                 echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
                 #echo "usuario: '" .$_SESSION['id']."' password: '".$_SESSION['id2']."'";
                
         } 
    ?>
</body>
</html>