<div class="content">

    <div class="main">
    
        <div class="page-header">
            <h3><?php echo $dadosAnuncio['nome'];?></h3>
        </div>
        <div class="row">
            <div class="col-md-6">  
                <img src="<?php echo $dadosAnuncio['imagemprincipal'];?>" alt="<?php echo $dadosAnuncio['nome'];?>" style="width: 100%;" class="media-object img-rounded">
                <br/>
                <p><a class="btn btn-success" href="<?php echo site_url('publico/inicial/'); ?>">Início</a></p>
            </div>
            <div class="col-md-6" style="font-size: 14px;">
                <p><?php echo $dadosAnuncio['descricao'];?></p>                    
            </div>
        </div>            
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <h4 class="font-agricola">Imagens</h4>
                </div>
                <div id="links">            
                    <?php                                                                 
                        foreach ($imagensanuncio as $imagemanuncio)
                        {
                    ?>                                                                        
                            <a href="<?php echo $imagemanuncio['localizacao']; ?>" title="<?php echo $dadosAnuncio['nome'];?>" data-gallery>
                                <img src="<?php echo $imagemanuncio['localizacao']; ?>" alt="<?php echo $dadosAnuncio['nome'];?>" height="100" width="100" class="img-rounded">
                            </a>                                                                              
                    <?php
                        }
                    ?>
                </div>      
            </div>
                
            <div class="col-md-6">
                <?php 
                    if(count($videosanuncio) > 0)
                    {
                ?>

                <div class="page-header">
                    <h4 class="font-agricola">Vídeos</h4>
                </div>

                <div class="row">
                    <?php                                                                 
                        foreach ($videosanuncio as $videoanuncio)
                        {
                            ?>  
                    <div class="col-md-12" align="center">
                        <iframe width="450" height="300" src="<?php echo $videoanuncio['localizacao']; ?>" frameborder="0" allowfullscreen></iframe>                                                
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