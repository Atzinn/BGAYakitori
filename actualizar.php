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
  	
  	
    <script type="text/javascript" src="JS/jquery-3.3.1.js"></script>
    <!--Script para disponibilidad del nombre de usuario------>
  	<script type="text/javascript">
        $(document).ready(function(){
            $("#user_name").keyup(function(){
                var user_name=$(this).val();
                
                if(user_name.length>3){
                    $("#result").html('Checking...');
                    
                    /*$.post("username-check.php", $("#reg-form").serialize())
    					.done(function(data){
    					$("#result").html(data);
   						});*/
                    
                    $.ajax({
                        type: 'POST',
                        url: 'username-check.php',
                        data: $(this).serialize(),
                        success: function(data){
                            $('#result').html(data);
                        }
                    });
                    return false;
                }else{ $("#result").html('');}
            });
        
        });
    </script>      	
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
    
    <div class="rows" class="container" align='center'>
          <br><br>
           <h2>Se pueden actualizar los siguientes datos</h2>
           <?php
             include 'conection.php';
             session_start();
             $worker=$_POST['user'];
              $_SESSION['id']=$_POST['user'];
            if(isset($_SESSION['id'])){
            
             $bus="SELECT * 
			      FROM users 
			      INNER JOIN (datos_user,trabajadores,permisos) 
			      ON (datos_user.id_datos=users.id_datos 
                  AND trabajadores.id_trabajador=datos_user.id_trabajador 
                  AND permisos.id_user=users.id_user) 
			      WHERE users.user_name='".$_SESSION['id']."'";
               # echo "<br>".$bus;
                
              $rbus=mysqli_query($conn,$bus);
              if($rbus){
               while($datos=mysqli_fetch_array($rbus)){
        
            ?>
            <form id="reg-form" action="actualizacion.php" method="POST" autocomplete='off'>
             <div class="row" align='center'>
               <div class="four columns">
                <legend>Nombre: <input type="text" name='nombre' value="<?php echo $datos['nombre']; ?>"></legend><br>
                </div>
                <div class="four columns">
                 <legend>Apellido: <input type="text" name='apellido' value="<?php echo $datos['apellidos']; ?>"></legend><br></div>
                 <div class="four columns">
                  <legend>Telefono: <input type="text" name='telefono' value="<?php echo $datos['num_tel']; ?>"></legend><br></div>
                  <div class="threecolumns">
                   <legend>Nombre de usuario: <fieldset>
                                               <div>
                                                <input type="text" name='user_name' id='user_name' value="<?php echo $datos['user_name'] ?>"><br>
                                                <span id="result"></span>
                                                </div>
                                            </fieldset>
                    </legend><br></div>
                   <div class="four columns">
                    <legend>Contraseña: <input type="password" name='password' value="<?php echo $datos['pass'] ?>"></legend><br></div>
                    <div class="three columns">
                   <legend>CURP: <input type="text" name='curp' value="<?php echo $datos['CURP'] ?>"></legend><br></div>
                   <div class="fourcolumns">
                   <legend>Tipo de trabajador: <input type="text" name='tipo' value="<?php echo $datos['tipo_trabajador'] ?>"></legend><br>
                  </legend><br></div>
                  <div align="center">
                 <input type="submit" class="button-primary" name="go" value="Actualizar" id="send">
                      <a href="index2.php"><input type="button" class="button" value="Menú Principal"></a></div></div>
            </form>
            <?php
               }
             }else{
                  echo "No se ejecuto correctamente la consulta";
                   echo "<br<br><a href=index2.php><input type='button' class='button-primary' value='Menú Principal'></a>";
              }
             }else{
                echo "<script>alert('No has iniciado sesión')</script>";
                 echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
            }
            ?>
        </div>
</body>
</html>