<div class="content">
    <div class="main">
        <div class="main-content">   

            <div class="row">
                <div class="col-md-6">	

                    <div class="page-header">
                        <a href="<?php echo site_url('publico/produtosagricola/lista'); ?>"><h4>Tor Metais - A Solução no Campo</h4></a>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/tormetais/assets/imagesproductions/34491e12130d9a6574706de0c6159559.jpg" alt="..." height="200" width="300" class="img-rounded">   
                            <div align="center">
                                <h4>meu produto</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <a href="#">mais</a><p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>       
                    </div>

                </div>
                <div class="col-md-6">	                        

                    <div class="page-header">
                        <a href="<?php echo site_url('publico/produtosreboque/lista'); ?>"><h4>Tor Metais - Reboques</h4></a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/tormetais/assets/imagesproductions/3a48c049a10b03d61453e2ea2e9f5137.jpg" alt="..." height="200" width="300" class="img-rounded">   
                            <div align="center">
                                <h4>meu produto</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <a href="#">mais</a><p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>    

                </div>                              
            </div>

            <div class="row">                    
                <div class="col-md-5">
                    <div class="page-header">
                        <h4>Serviços</h4>
                    </div>     
                </div>
                <div class="col-md-3">
                    <div class="page-header">
                        <h4>Notícias</h4>
                    </div>     
                </div>
                <div class="col-md-4">
                    <div class="page-header">
                        <h4>Anúncios</h4>
                    </div>     
                </div>
            </div>



            <div class="row">

                <div class="col-md-5">	                        

                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo site_url('publico/servicos/detalhe/' . $servicoPrincipal['id']); ?>">
                                <img src="<?php echo $servicoPrincipal['imagemprincipal'] ?>" alt="<?php echo $servicoPrincipal['nome'] ?>" style="width:100%;" class="img-rounded">   
                            </a>
                            <div align="center">
                                <a href="<?php echo site_url('publico/servicos/detalhe/' . $servicoPrincipal['id']); ?>">
                                    <h4><?php echo $servicoPrincipal['nome'] ?></h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $dadosEmpresa['descricaoservicos'] ?>
                            <a href="<?php echo site_url('publico/servicos/lista'); ?>">mais</a><p>                            
                        </div>
                    </div>    

                </div>           

                 <div class="col-md-3">                     
                         
                         <?php
            
                            if(count($noticias) > 0) {                                                                
                                foreach ($noticias as $noticia)
                                {                                   
                                    ?>
                                    <div class="media">
                                        <a class="pull-left" href="<?php echo site_url('publico/noticias/detalhe/' . $noticia['id']); ?>">
                                          <img class="media-object" src="<?php echo $noticia['imagemprincipal']; ?>" alt="<?php echo $noticia['nome']; ?>" height="75" width="75" class="img-rounded">
                                        </a>
                                        <div class="media-body">
                                            <a href="<?php echo site_url('publico/noticias/detalhe/' . $noticia['id']); ?>">
                                                <h4><?php echo $noticia['nome']; ?></h4>                               
                                            </a> 
                                        </div>
                                      </div>                                                                                                
                        <?php
                                }
                            }
                        ?>                                                                       
                 </div>

                <div class="col-md-4">	


                <div id="carousel-anuncios" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php

                            $num = 0;

                            foreach ($anuncios as $anuncio)
                            {
                                if($num == 0)
                                {
                        ?>   
                        <li data-target="#carousel-anuncios" data-slide-to="<?php echo $num; ?>" class="active"></li>
                        <?php 
                                    
                                  } else
                                  {
                        ?>                                                           
                        <li data-target="#carousel-anuncios" data-slide-to="<?php echo $num; ?>" class=""></li>                     
                        <?php
                                  }
                                  $num ++;
                            }
                        ?>         
                    </ol>
                    <div class="carousel-inner">

                        <?php

                            $isActive = true;

                            foreach ($anuncios as $anuncio)
                            {
                                if($isActive)
                                {
                        ?>                                                
                                    <div class="item active">
                                        <img  alt="<?php echo $anuncio['nome'];?>"  src="<?php echo $anuncio['imagemprincipal'];?>">
                                        <div class="carousel-caption">                              
                                            <p><strong><?php echo $anuncio['nome'];?></strong>></p>
                                        </div>
                                    </div>
                        <?php 
                                    $isActive = false;
                                } else
                                {
                        ?>            
                                <div class="item">
                                    <img  alt="<?php echo $anuncio['nome'];?>"  src="<?php echo $anuncio['imagemprincipal'];?>">
                                    <div class="carousel-caption">                              
                                        <p><?php echo $anuncio['nome'];?></p>
                                    </div>
                                </div>    
                        <?php
                                }
                            }
                        ?>                                                                                                                                                                                                            
                    </div>
                  </div>                                                                                               
                </div>                                                            
            </div>                               
        </div>
    </div>        
    <br/>
    <br/>       
</div>