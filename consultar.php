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
    <link rel="icon" type="i  mage/png" href="images/favicon.png">
</head>
<body>
 <?php
  session_start() ; 
    if(isset($_SESSION['id'])){
 ?>
     <header class="header">
        <img src="img/bgayakitori.png" class="logo">
        <h1>Búsqueda avanzada</h1>
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
    
  <div align="center" class="rows">
   <form name="actualizar" method="get" action="cons.php">
    
        <h1>¿Cómo quiere consultar?</h1>
        <h4>Puede consultar por estos tres datos</h4>
        <ol>Nombre de usuario</ol>
        <ol>Nombre</ol>
        <ol>Apellidos </ol>
        <input type="text" name="datos">
        <input type="submit" class="button-primary" name="go" value="Consultar">
   </form>
   <a href="index2.php"><input type="button" class="button" value="Menú Principal"></a>
  </div>
  <?php
    }else{
        echo "<script>alert('No has iniciado sesión')</script>";
         echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
    }
  ?>
</body>
</html>