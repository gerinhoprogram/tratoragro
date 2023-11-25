<?php include('header.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title><?php echo $ttl?></title>
</head>

<body>
<?php 
	include ('core/mod_topo/topo.php');
	include	('bannercontato.php');
?>
<div class="wrapper" >
	<div class = "contato">

        <div class = "contato1">
		 <p  class = "destaque2 verde" id = "atend" >Atendimento ao cliente</p>
		 <p class = 'tel'><i class="fab fa-whatsapp"></i> (11) 9 4706-1694</p> 

         <p  class = "destaque2 verde">Comercial</p>
		 <p><span class='tel1'><i class="fab fa-whatsapp icnwhats2"></i> (11) 9 4852-9481 </span> <span class='tel2'><i class="fas fa-phone-volume icntel"></i> (11) 4692-5204 </span> 

        </div>

        <div class = "contato2"> 
         <a href="https://www.facebook.com/TuttoFrescoBR/" target="_blank"><div class = "contatobt"><i class="fab fa-facebook-f"></i>  TuttoFrescoBR</div></a>
         <a href="https://www.instagram.com/tuttofrescohigienizado/?igshid=144railo5w0be" target="_blank"><div class = "contatobt"><i class="fab fa-instagram"></i> @tuttofrescohigienizado</div></a>
        </div>
    </div>
    <div class = "local"> 
        <i class="fas fa-map-marker-alt icnlocal"></i> Estrada do Sogo, km 3,5 | Bairro do Sogo | Biritiba Mirim | SP
    </div>
    
    <div class = "maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2751.759660009316!2d-46.061390692716934!3d-23.59294958593974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cddd49fda77181%3A0x7aa9cc6886570317!2sR.%20Para%C3%ADso%20-%20Estrada%20do%20Sogo%2C%20Biritiba-Mirim%20-%20SP%2C%2008940-000!5e1!3m2!1spt-BR!2sbr!4v1612876961901!5m2!1spt-BR!2sbr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
	
</div>
<?php include('core/mod_rodape/rodape.php');?>
</body>
</html>
