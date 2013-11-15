<div class="main">
    <div class="row">
        <div class="col-md-3">
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
                <h1><?php echo $dadosProduto['nome'];?></h1>
            </div>
            <div class="row">
                <div class="col-md-4">  
                    <img src="/tormetais/assets/images/carreto abastecedor 13tn.png" alt="..." height="200" width="300" class="media-object">
                </div>
                <div class="col-md-8">
                    <p><?php echo $dadosProduto['descricao'];?></p>
                </div>
            </div>
            <div class="row">
                <div class="page-header">
                    <h3>Imagens</h3>
                </div>
                <div class="col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="page-header">
                    <h3>Vídeos</h3>
                </div>
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
</div>