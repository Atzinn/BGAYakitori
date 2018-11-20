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
    
    <div class="rows">
        <div align="center">
        <?php   
        session_start();
          if(isset($_SESSION['id']) && isset($_SESSION['id2']) || isset($_SESSION['id']) && isset($_SESSION['dec_pass'])){
            echo "<h2>Disculpe las molestias estámos trabajando en ello</h2>";
             echo '<img src="img/fixing.png" height="200px" weight="200px"><br><br>';
              echo "<br<br><a href=index2.php><input type='button' class='button-primary' value='Menú Principal'></a>";
          }else{
              echo "<scipt>alert('No has iniciado sesion')</script>";
               echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
          }
        ?>     
        </div>
    </div>
</body>
</html>