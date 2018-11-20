<?php
    session_start();
    session_destroy();
    echo "<head>
               <title>Redirect...</title>
	           <meta http-equiv='Refresh' content='0;url=index.html'>
           </head>
           <body>
             <div align='center'>  
               <h3><strong><center>Accediendo al sitio, por favor espera 5 segundos.</center></strong></h3>
               <img src='img/image.gif'>
             </div>
           </body>";
			
?>