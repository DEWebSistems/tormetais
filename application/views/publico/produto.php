<div class="main">
    <div class="row">
        <div class="col-md-3">
            <div class="page-header">
                <h4>Categorias</h4>
            </div>
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <?php
//                    echo '<pre>';
//                    print_r($categoriasProdutos);
//                    echo '</pre>';
                    foreach ($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<li><a href="filtro/'.$categoriaProduto['id'].'">'. $categoriaProduto['nome'].'</a></li>';                                
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
            <div class="row">
                <div class="page-header">
                    <h4>Imagens</h4>
                </div>
                <div class="col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="page-header">
                    <h4>Vídeos</h4>
                </div>
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
</div>