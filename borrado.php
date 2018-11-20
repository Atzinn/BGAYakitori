<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Elminar</title>
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
    <link rel="icon" type="i  mage/png" href="images/favicon.png">
</head>
<body>
    <header class="header">
        <img src="img/bgayakitori.png" class="logo">       
        <h1>Eiminado</h1>
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>

    <div align='center' class'rows'>
     <?php        
        session_start();
        include "conection.php";
        
        if(isset($_SESSION['id']) && isset($_SESSION['id2']) || isset($_SESSION['id']) && isset($_SESSION['dec_pas'])){
            
            $del1="DELETE FROM users
                   WHERE users.user_name='".$_SESSION['id']."'";
            echo $del1."<br>";
            $del2="DELETE FROM datos_user
                   WHERE datos_user.user_name='".$_SESSION['id']."'";
            echo $del2."<br>";
            $del3="DELETE FROM trabajadores
                   WHERE trabajadores.user_name='".$_SESSION['id']."'";
            echo $del3."<br>";
            $del4="DELETE FROM permisos
                   WHERE permisos.user_name='".$_SESSION['id']."'";
            echo $del4."<br>";
            $rdel1=mysqli_query($conn,$del1);
             $rdel2=mysqli_query($conn,$del2);
              $rdel3=mysqli_query($conn,$del3);
               $rdel4=mysqli_query($conn,$del4);
            if($rdel1 AND $rdel2 AND $rdel3 AND $rdel4){
                echo "<h2>El usuario ha sido eliminado exitosamente</h2>";
                 echo "<a href='index2.php'><input type='button' class='button' value='Menú Principal'></a>";
            }else{
                echo "<h3>No se pudo eliminar el usuario</h3>";
                echo "<a href='index2.php'><input type='button' class='button' value='Menú Principal'></a>";                
            }               
            
        }else{
        
        }
    ?>
</div>  
</body>
</html>