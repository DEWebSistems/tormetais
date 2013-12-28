<div class="content">
    <div class="main">
        <div class="main-content">   

            <div class="row">
                
                <?php
            
                if(count($linhasProdutos) > 0) {                         
                    foreach ($linhasProdutos as $linhaProduto)
                    {                                  
                        if($linhaProduto['id'] == 1)
                        {
                            $produtoPrincipal = $linhaProduto['produtoprincipal']
                        ?>                                     
                        <div class="col-md-6">	
                            <div class="page-header">
                                <a class="font-agricola" href="<?php echo site_url('publico/produtosagricola/lista'); ?>"><h4><?php echo $linhaProduto['nome']?></h4></a>                        
                            </div>
                            <div class="row">                                                
                                    <div class="col-md-6">
                                        
                                        <img src="<?php echo base_url($produtoPrincipal['imagemprincipal']);?>" alt="<?php echo $produtoPrincipal['nome'];?>" style="width: 100%;" class="img-rounded">   
                                        <div align="center">
                                            <a class="font-agricola" href="<?php echo site_url('publico/produtosagricola/detalhe/'.$produtoPrincipal['id']); ?>">
                                                <h4><?php echo  $produtoPrincipal['nome'];?></h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $linhaProduto['descricao'];?>
                                        <a class="font-agricola" href="<?php echo site_url('publico/produtosagricola/lista'); ?>">mais</a>                            
                                    </div>
                            </div>
                        </div>
                       <?php
                        } else {
                            $produtoPrincipal = $linhaProduto['produtoprincipal']
                        ?>
                            <div class="col-md-6">	
                                <div class="page-header">
                                    <a class="font-reboque" href="<?php echo site_url('publico/produtosreboque/lista'); ?>"><h4><?php echo $linhaProduto['nome']?></h4></a>                        
                                </div>
                                <div class="row">                                                
                                        <div class="col-md-6">
                                            <img src="<?php echo base_url($produtoPrincipal['imagemprincipal']);?>" alt="<?php echo $produtoPrincipal['nome'];?>" style="width: 100%;" class="img-rounded">   
                                            <div align="center">
                                                <a class="font-reboque" href="<?php echo site_url('publico/produtosreboque/detalhe/'.$produtoPrincipal['id']); ?>">
                                                <h4><?php echo $produtoPrincipal['nome'];?></h4>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $linhaProduto['descricao'];?>
                                            <a class="font-reboque" href="<?php echo site_url('publico/produtosreboque/lista'); ?>">mais</a>                            
                                        </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
                       ?>
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
                        <?php                                               
                            if(isset($servicoPrincipal))
                            {
                        ?>
                                <div class="col-md-6">
                                    <a href="<?php echo site_url('publico/servicos/detalhe/' . $servicoPrincipal['id']); ?>">
                                        <img src="<?php echo base_url($servicoPrincipal['imagemprincipal']); ?>" alt="<?php echo $servicoPrincipal['nome'] ?>" style="width:100%;" class="img-rounded">   
                                    </a>
                                    <div align="center">
                                        <a class="font-agricola" href="<?php echo site_url('publico/servicos/detalhe/' . $servicoPrincipal['id']); ?>">
                                            <h4><?php echo $servicoPrincipal['nome'] ?></h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $dadosEmpresa['descricaoservicos'] ?>
                                    <a href="<?php echo site_url('publico/servicos/lista'); ?>">mais</a><p>                            
                                </div>
                        <?php 
                            }
                            else {                                 
                        ?>
                                    <div class="col-md-12">
                                        <p><?php echo $dadosEmpresa['descricaoservicos'] ?>
                                        <a href="<?php echo site_url('publico/servicos/lista'); ?>">mais</a><p>                            
                                    </div>
                        <?php 
                            }                          
                        ?>
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
                                          <img class="media-object" src="<?php echo base_url($noticia['imagemprincipal']); ?>" alt="<?php echo $noticia['nome']; ?>" height="75" width="75" class="img-rounded">
                                        </a>
                                        <div class="media-body">
                                            <a class="font-agricola" href="<?php echo site_url('publico/noticias/detalhe/' . $noticia['id']); ?>">
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
                    <ol class="carousel-indicators" style="margin-bottom: 50px;">
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
                                        <img  alt="<?php echo $anuncio['nome'];?>"  src="<?php echo base_url($anuncio['imagemprincipal']);?>" class="img-rounded"> 
                                        <div align="center" >        
                                            <a class="font-agricola" href="<?php echo site_url('publico/anuncios/detalhe/' . $anuncio['id']); ?>">
                                                <p><h3><?php echo $anuncio['nome'];?></h3></p>
                                            </a>
                                        </div>
                                    </div>
                        <?php 
                                    $isActive = false;
                                } else
                                {
                        ?>            
                                    <div class="item">
                                        <img  alt="<?php echo $anuncio['nome'];?>"  src="<?php echo base_url($anuncio['imagemprincipal']);?>" class="img-rounded">                                        
                                        
                                        <div align="center" >       
                                            <a class="font-agricola" href="<?php echo site_url('publico/anuncios/detalhe/' . $anuncio['id']); ?>">
                                                <p><h3><?php echo $anuncio['nome'];?></h3></p>
                                            </a>
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