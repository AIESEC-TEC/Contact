<?php
	include_once("../config/conector.php");
	include("../config/conexion.php");
    $bd = new conector($server,$username,$usrpassword,$dbname);
	mysqli_set_charset($bd,'utf8');
    session_start();
	
	if(isset($_SESSION['userlogin'])){
		$usuario = "<li><a id='user-name' href='#'>".utf8_decode($_SESSION['userlogin'])."</a></li><li><button id='quit-session' type='button' class='btn btn-default'>Log Out</button></li>";
		//<button id='quit-session'>log out</button>
	}
	else {
		$usuario = '<form class="navbar-form pull-right">
              <input id="usuario-login-name" class="span2" type="text" placeholder="AIESEC Email">
              <input id="usuario-login-pass" class="span2" type="password" placeholder="Password">
              <button id="ingresar" type="submit" class="btn">Sign in</button>
            </form>';
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>AIESEC Contact Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/jqueryui.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../images/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../images/favicon.png">
  </head>

  <body>
    <script src="../js/lib/jquery.js"></script>
    <script src="../js/lib/jqueryui.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
    <script src="../js/hide.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/index-mobile.js"></script>
  <div id="menu-top" class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">AIESEC</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <!--
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
				<?php
                    echo $usuario;
                ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <?php
      if(!isset($_SESSION['userlogin'])){
		?>
		  <div class="hero-unit" id="principal">
			<h1>Hola!</h1>
			<p>Bienvenido al nuevo sitio de AIESEC TEC, donde encontraras toda la información acerca de los integrantes del comité y otra información interesante. Te recordamos que esta es una versión en desarrollo por lo que aún no estamos recibiendo feedback, el objetivo de esto es que te vayas familiarizando con progreso del sitio. Muy pronto tendrás acceso a novedosas funcionalidades (y a una interfáz más llamativa...), por el momento, esperamos que el sitio sea de tu agrado!!!</p>
		  </div>
		  <?php
	  	}
		  ?>

      <!-- Example row of columns -->
      <?php
      if(isset($_SESSION['userlogin'])){ ?>
              
<!-- <form action="../../tcpdf/examples/example_001.php" method="post">
<input id="salida" type="hidden" value='<h1>HOLA</h1>' name="salida" />
<input type="submit">
</form> -->
<div id="exportar-contactos" class="exportPDF icon-personilized"></div>
<div id="scroll-table">
	<div class="icon-personilized scroll-left"></div>
    <div class="icon-personilized scroll-right"></div>
</div>
<div class="row" id="buscador">
        <div class="span12">
              <table id="example" class="table table-striped">
                <thead>
                    <th>Contact</th>
                </thead>
                <tbody>
                    <?php
                        if ($result = $bd->query("SELECT * FROM users ORDER BY area")) {
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                                echo '<tr><td><div class="name">'.$row["name"].' '.$row["lastname"].'<div class="phone">'.$row["cellphone"].'</div></div><div class="lookmore" id="'.$row["idUser"].'" title="Watch More"></div></td><tr>';
                            }
                            /* free result set */
                            $result->close();
                        }
                        
    
                    ?>
                </tbody>
              </table>
          <br>
        </div>
      </div>

      <hr>
<?php } ?>
      <footer>
        <p>AIESEC TEC 2013 | Developed & Designed by: Victor Vargas</p>
        <p>Suported by: Team Sirenos</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../js/lib/bootstrap-transition.js"></script>
    <script src="../js/lib/bootstrap-alert.js"></script>
    <script src="../js/lib/bootstrap-modal.js"></script>
    <script src="../js/lib/bootstrap-dropdown.js"></script>
    <script src="../js/lib/bootstrap-scrollspy.js"></script>
    <script src="../js/lib/bootstrap-tab.js"></script>
    <script src="../js/lib/bootstrap-tooltip.js"></script>
    <script src="../js/lib/bootstrap-popover.js"></script>
    <script src="../js/lib/bootstrap-button.js"></script>
    <script src="../js/lib/bootstrap-collapse.js"></script>
    <script src="../js/lib/bootstrap-carousel.js"></script>
    <script src="../js/lib/bootstrap-typeahead.js"></script>
	<div id="protectora">
        <div id="exportar-contactos-div">
            <form action="../tcpdf/examples/example_001.php" method="post" id="exportarPd">
            
            </form>
            <h1>Export PDF</h1>
            <hr>
            <h2>Information to be exported</h2>
            <div class="left-float">
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="phone" valor="8"> Phone
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="cellphone" valor="8"> Cellphone
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="nationality" valor="8"> Nationality
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="aiesecemail" valor="20"> aiesecemail
            </label>
            </div>
            <div class="left-float">
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="email" valor="20"> Email
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="university" valor="20"> University
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="profesion" valor="10"> Profesion
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="skype" valor="15"> Skype
            </label>
            </div>
            <div class="left-float">
            <label class="checkbox-inline">
              <input type="checkbox" name="variablesEx[]" form="exportarPd" value="area" valor="7"> Area
            </label>
            </div>
            <h3>Page Space</h3>
            <div id="progressbar"></div>
            <div id="moreThanAllowed" class="alert-error">You can't select more columns than the page size allows.</div>
            <h2>Filter by:</h2>
            <div class="left-float-clear">
                <select name="filtro" form="exportarPd">
	              <option value="all">All</option>
                  <option value="COM & IM">COMM & IM</option>
                  <option value="FLA">FLA</option>
                  <option value="ICX">ICX</option>
                  <option value="OGX">OGX</option>
                  <option value="Sales">Sales</option>
                  <option value="tm">TM</option>
                </select>
            </div>
            <input type="submit" form="exportarPd" class="btn btn-primary btn-large" value="Export">
            <button id="cancelExport" class="btn btn-default btn-large">Cancel</button>
        </div>
    </div>
    <div id="contactInfo">
    	<div id="contactInfoHeader"><div class="back" id="contactInfoBack"></div><div id="contactInfoHeaderMain"><h4>Contact Information</h4></div></div>
        <div id="downloadContact">Descargar este contacto a tú celular</div>
        <div id="contactInfoContent">
            <address id="contactInfoAddress">
              <strong>Name:</strong><br>
              <p id="userInfoName"></p>
              <strong>Cellphone:</strong><br>
              <p id="userInfoCell"></p>
              <strong>Phone:</strong><br>
              <p id="userInfoPhone"></p>
              <strong>Aiesec Email:</strong><br>
              <a id="userInfoAiesec" href=""></a><br>
              <strong>Email:</strong><br>
              <a id="userInfoMail" href=""></a><br>
              <strong>Skype:</strong><br>
              <p id="userInfoSkype"></p>
              <strong>University:</strong><br>
              <p id="userInfoUniversity"></p>
              <strong>Profesion:</strong><br>
              <p id="userInfoProfesion"></p>
              <strong>Area:</strong><br>
              <p id="userInfoArea"></p>
              <strong>Local Commite:</strong><br>
              <p id="userInfoLc"></p>
            </address>
        </div>
    </div>
  </body>
</html>
<?php
	$bd->close();
?>