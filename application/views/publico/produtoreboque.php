

<div class="main">
    <div class="row">
        <div class="col-md-2">
            <div class="page-header">
                <h4>Categorias</h4>
            </div>
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <?php                    
                    foreach ($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<li><a href=" '. site_url('publico/produtosagricola/filtro/' . $categoriaProduto['id']) . '">'. $categoriaProduto['nome'].'</a></li>';                                
                    }
                ?>
             </ul>
        </div>
        <div class="col-md-10">
            <div class="page-header">
                
                <h4><?php echo $dadosProduto['nome'];?></h4>
            </div>
            <div class="row">
                <div class="col-md-6">  
                    <img src="<?php echo $dadosProduto['imagemprincipal'];?>" alt="<?php echo $dadosProduto['nome'];?>" height="336" width="500" class="media-object img-rounded">
                       
                    <br/>
                    <p><a class="btn btn-primary" href="<?php echo site_url('publico/produtosagricola/lista/'); ?>">Voltar</a></p>
                </div>
                <div class="col-md-6" style="font-size: 14px;">
                    <p><?php echo $dadosProduto['descricao'];?></p>                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h4>Imagens</h4>
                    </div>
                    <div id="links">            
                        <?php                                                                 
                            foreach ($imagensproduto as $imagemproduto)
                            {
                        ?>                                                                        
                                <a href="<?php echo $imagemproduto['localizacao']; ?>" title="<?php echo $dadosProduto['nome'];?>" data-gallery>
                                    <img src="<?php echo $imagemproduto['localizacao']; ?>" alt="<?php echo $dadosProduto['nome'];?>" height="100" width="100" class="img-rounded">
                                </a>                                                                              
                        <?php
                            }
                        ?>
                    </div>      
                </div>
                
                <div class="col-md-6">
                    <?php 
                        if(count($videosproduto) > 0)
                        {
                    ?>

                    <div class="page-header">
                        <h4>Vídeos</h4>
                    </div>

                    <div class="row">
                        <?php                                                                 
                            foreach ($videosproduto as $videoproduto)
                            {
                                ?>  
                        <div class="col-md-12" align="center">
                            <iframe width="450" height="300" src="<?php echo $videoproduto['localizacao']; ?>" frameborder="0" allowfullscreen></iframe>                                                
                        </div>
                        <?php
                            }
                        ?>
                    </div>                                    
                    <?php 
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Anterior
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Próximo
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/tormetais/assets/bootstrap-image-gallery-3.1.0/js/jquery.blueimp-gallery.min.js"></script>
<script src="/tormetais/assets/bootstrap-image-gallery-3.1.0/js/bootstrap-image-gallery.min.js"></script>
</div>