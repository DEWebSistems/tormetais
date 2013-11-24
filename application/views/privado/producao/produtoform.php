<div class="page-header-form-list">
    <strong>Cadastro de Produtos</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/produto.js"></script>
<?php
    if($messages['isErrors'] == true)
    {        
        echo '<div class="alert alert-danger alert col-md-12" style="margin-top: 10px;">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>Erro</h4>';
        echo $messages['messagesErrors'];
        echo '</div>';
    }
    if($messages['isSuccess'] == true)
    {
        echo '<div class="alert alert-success alert col-md-12" style="margin-top: 10px;">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>' . $messages['messagesSuccess'] . '</h4>';
        echo '</div>';
    }
?>
<div id="divResultsValidations" class="col-md-12">
</div>
<form action="" method="post" class="form-horizontal" style="margin-top: 20px;" role="form">       
    <div class="form-group">
        <label for="itNome" class="col-sm-2 control-label">Nome do Produto:</label>
        <div class="col-sm-6">
            <input id="itNome" name="itNome" type="text" maxlength="90" value="" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="taDescricao" class="col-sm-2 control-label">Descricao:</label>
        <div class="col-sm-6">
            <textarea id="taDescricao" name="taDescricao" maxlength="255" value="" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="seCategoriaProduto" class="col-sm-2 control-label">Categoria do Produto:</label>
        <div class="col-sm-6">
            <select id="seCategoriaProduto" name="seCategoriaProduto" class="form-control">
                <option value="">--Selecione uma Categoria--</option>
                <?php                              
                    foreach($categoriasProduto as $idCategoria => $nome)
                    {                        
                        echo '<option ';
                        echo 'value="' . $idCategoria . '"';
//                        if($idCategoria == $produto['categoriaProdutoId'])
//                        {
//                            echo ' selected=""';
//                        }
                        echo '>';
                        echo $nome;
                        echo '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravar" name="bsGravar" type="submit" class="btn btn-primary" onclick="return validateBeforeSubmitRecord();">Gravar</button>
            <button id="bsCancelar" name="bsCancelar" type="submit" class="btn btn-default">Cancelar</button>
        </div>
    </div>
    
    <script type="text/javascript">CKEDITOR.replace( 'taDescricao' );</script>
    
    
</form>