
<?php ob_start();	    
      
    include('core/mod_includes/php/connect.php');
    $ttl = "Site1"; 
    session_start(); 

    $sql = "SELECT * FROM  sistema";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    $sistema = $result = $stmt->fetch();

?>
<base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/site_painel/site1/" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<meta property="" content="" />
<meta property="og:locale" content="pt_BR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="site1" />
<meta property="og:description" content="">
<meta name="keywords" content="" />
<meta property="og:url" content="http://rogerioweb.com/site_painel/site1/" />
<meta property="og:image" content="http://rogerioweb.com/site_painel/site1/webapp/uploads/">
<meta name="copyright" content="MogiComp Soluções Web">
<meta name="robots" content="">
<meta name="revisit-after" content="1 day">
<meta name="description" content="">
<meta name="keywords" content="">

<!-- ESTILO CSS -->
<link rel="stylesheet" type="text/css" href="core/css/estilo.css">
<link rel="stylesheet" type="text/css" href="core/css/carousel.css">
<link rel="stylesheet" type="text/css" href="core/css/estrutura.css">
<link rel="shortcut icon" href="core/imagens/favicon.png">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="core/css/estrutura.css">

<!-- JAVASCRIPT -->

<script src="core/mod_includes/js/jquery-1.8.3.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="core/mod_includes/js/funcoes.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="core/mod_includes/js/wow.min.js"></script>
<script>
	 new WOW().init();
</script>
<!-- 
<div class="bt-whats">
    <a href="https://api.whatsapp.com/send?phone=5511963620226" target='_blank'><i class="fab fa-whatsapp"></i></a>
</div>  -->



