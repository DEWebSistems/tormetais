<div class="content">

<div class="main">
    <div class="row">
        <div class="col-md-3">
            <div class="page-header">
                <h4>Categorias</h4>
            </div>
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <?php                    
                    foreach ($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<li><a href=" '. site_url('publico/produtos/filtro/' . $categoriaProduto['id']) . '">'. $categoriaProduto['nome'].'</a></li>';                                
                    }
                ?>
             </ul>
        </div>
        <div class="col-md-9">
            <div class="page-header">
                <h4><?php echo $dadosProduto['nome'];?></h4>
            </div>
            <div class="row">
                <div class="col-md-4">  
                    <img src="/tormetais/assets/images/carreto abastecedor 13tn.png" alt="..." height="200" width="300" class="media-object">
                </div>
                <div class="col-md-8">
                    <p><?php echo $dadosProduto['descricao'];?></p>
                    <p><a class="btn btn-primary" href="<?php echo site_url('publico/produtos/lista/'); ?>">Voltar</a></p>
                </div>
            </div>
            
            <div class="page-header">
                <h4>Imagens</h4>
            </div>
            <div id="links">            
                <?php                                                                 
                    foreach ($imagensproduto as $imagemproduto => $url)
                    {
                        ?>    
                
                        
                            
                                <a href="<?php echo $url;?>" title="<?php echo $dadosProduto['nome'];?>" data-gallery>
                                    <img src="<?php echo $url;?>" alt="<?php echo $dadosProduto['nome'];?>" height="75" width="75">
                                </a>  
                            
                                                
                <?php
                    }
                ?>
            </div>                                    
                <?php 
                    if(count($videosproduto) > 0)
                    {
                ?>
                
                <div class="page-header">
                    <h4>Vídeos</h4>
                </div>
                    
                <div class="row">
                    <?php                                                                 
                        foreach ($videosproduto as $videoproduto => $url)
                        {
//                                echo $url;
                            ?>                            
                            <div class="col-md-4">	                        
                                <div class="thumbnail">                            
                                    <div class="caption">                                            
                                        <div align="center">
                                            <iframe width="250" height="200" src="<?php echo $url;?>" frameborder="0" allowfullscreen></iframe>                                                
                                        </div>
                                    </div>
                                </div>          
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
</div>
<script src="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/js/jquery.blueimp-gallery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/js/bootstrap-image-gallery.min.js'); ?>"></script>