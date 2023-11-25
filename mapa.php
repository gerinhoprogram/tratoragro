<div class = "maps">
        <iframe src="<?php echo $sistema['sistema_mapa'] ?>"></iframe>
        <div class = "card">
            <div class = "insidecard">
                <p class = "endereco">ENDEREÇO</p>
                <p class = "rua">
                    <a href="http://maps.google.com/?q=<?php echo $sistema['sistema_endereco'] .', '. $sistema['sistema_numero'] .', '. $sistema['sistema_cidade'] .', '. $sistema['sistema_estado'] .', '.$sistema['sistema_cep'] ?>" target="_blank">
                        <?php echo $sistema['sistema_endereco'] .' | '. $sistema['sistema_numero'] .' | '. $sistema['sistema_cidade'] .' | '. $sistema['sistema_estado'] .' | '.$sistema['sistema_cep'] ?>
                    </a>
                </p>
            </div>
        </div>    
</div>