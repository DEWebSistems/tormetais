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
            <?php
                foreach ($produtos as $produto)
                { ?>
           
                    <div class="media">
                   
                        <a class="pull-left" href="detalhe/<?php echo $produto['id'];?>">
                          <img src="/tormetais/assets/images/carreto abastecedor 13tn.png" alt="..." height="100" width="150" class="media-object">                     
                        </a>
                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="media-heading"><?php echo $produto['nome']; ?></h4>
                                    <?php echo $produto['descricao']; ?>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-default" href="detalhe/<?php echo $produto['id'];?>">Detalhes</a>
                                </div>
                            </div>
                        </div>                    
                    </div>
            <?php
                 }
            ?>
        </div>
    </div>
</div>