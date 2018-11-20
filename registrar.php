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
    <script type="text/javascript" src=""></script>
</head>
<body>
    <header class="header">
       
        <img src="img/bgayakitori.png" class="logo">
        <h1>Registrar</h1>
        
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
    
    <?php
        session_start();
    ?>
    
    <div class="rows" class="container">
            <form id="reg-form" action="agregar.php" method="POST" autocomplete='off' name="register" onsubmit="return validateForm()">
             <div class="row" align='center'>
               <div class="four columns">
                <legend>Nombre: <input type="text" name='nombre' size='20' required/></legend><br>
                </div>
                <div class="four columns">
                 <legend>Apellido: <input type="text" name='apellido' required/></legend><br></div>
                 <div class="four columns">
                  <legend>Telefono: <input type="text" name='telefono'></legend><br></div>
                  <div class="threecolumns">
                   <legend>Nombre de usuario: <fieldset>
                                               <div>
                                                <input type="text" name='user_name' id='user_name' required/><br>
                                                <span id="result"></span>
                                                </div>
                                            </fieldset>
                    </legend><br></div>
                   <div class="four columns">
                    <legend>Contraseña: <input type="password" name='password' required/></legend><br></div>
                    <div class="three columns">
                   <legend>CURP: <input type="text" name='curp'></legend><br></div>
                   <div class="four columns">
                   <legend>Tipo de trabajador: <select name="tipos">
                                                   <option value="administrador">Gerente</option>
                                                    <option value="cajero">Cajero</option>
                                                     <option value="mesero">Mesero</option>
                                               </select>
                   </legend><br>
                  </legend><br></div>
                  <div align="center">
                 <input type="submit" class="button-primary" name="go" value="Registrar" id="send">
                 <?php
                    
                    if(isset($_SESSION['id']) && isset($_SESSION['id2'])){
                        #echo $_SESSION['id']." ".$_SESSION['id2'];
                        echo "<a href='index2.php'><input type='button' class='button' value='Menú Principal'></a>";
                    }elseif(isset($_SESSION['id']) && isset($_SESSION['dec_pass'])){
                        #echo $_SESSION['id']." ".$_SESSION¨['desc_pass'];
                        echo "<a href=index2.php'><input type='button' class='button' value='Menú Principal'></a>";
                    }
                 ?>
                 </div>
            </form>
    </div>
</body>
</html>