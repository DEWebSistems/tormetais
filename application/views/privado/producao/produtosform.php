<div class="page-header-form-list">
    <strong>Cadastro de Produtos</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/produtosprivate.js"></script>

<div id="divResultsValidations" class="col-md-12">
</div>
<form action="<?php echo site_url('privado/produtos/lista'); ?>" method="post" class="form-horizontal" role="form">       
    <div class="form-group">
        <label for="itId" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Código:</label>
        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-2">
            <input id="itId" name="itId" type="text" maxlength="90" value="<?php echo $dadosProduto['id'];?>" class="form-control" readonly=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="itNome" class="col-sm-2 control-label">Nome do Produto:</label>
        <div class="col-sm-6">
            <input id="itNome" name="itNome" type="text" maxlength="90" value="<?php echo $dadosProduto['nome'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="taDescricao" class="col-sm-2 control-label">Descrição:</label>
        <div class="col-sm-6">
            <textarea id="taDescricao" name="taDescricao" maxlength="255" class="form-control"><?php echo $dadosProduto['descricao'];?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="seCategoriaProduto" class="col-sm-2 control-label">Categoria do Produto:</label>
        <div class="col-sm-6">
            <select id="seCategoriaProduto" name="seCategoriaProduto" class="form-control">
                <option value="">--Selecione uma Categoria--</option>
                <?php
                    foreach($categoriasProduto as $categoriaProduto)
                    {
                        echo '<option ';
                        echo 'value="' . $categoriaProduto['id'] . '"';
                        if($categoriaProduto['id'] == $dadosProduto['categoriaprodutoid'])
                        {
                            echo ' selected=""';
                        }
                        echo '>';
                        echo $categoriaProduto['nome'];
                        echo '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="seLinhaProduto" class="col-sm-2 control-label">Linha do Produto:</label>
        <div class="col-sm-6">
            <select id="seLinhaProduto" name="seLinhaProduto" class="form-control">
                <option value="">--Selecione uma Linha--</option>
                <?php
                    foreach($linhasProduto as $linhaProduto)
                    {
                        echo '<option ';
                        echo 'value="' . $linhaProduto['id'] . '"';
                        if($linhaProduto['id'] == $dadosProduto['linhaprodutoid'])
                        {
                            echo ' selected=""';
                        }
                        echo '>';
                        echo $linhaProduto['id'] . ' - ' . $linhaProduto['nome'];
                        echo '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravar" name="bsGravar" type="submit" value="<?php echo $operation; ?>" class="btn btn-primary" onclick="return validations();">Gravar</button>
            <button id="bsCancelar" name="bsCancelar" type="submit" class="btn btn-default">Cancelar</button>
        </div>
    </div>              
</form>
<script type="text/javascript">
    CKEDITOR.replace('taDescricao');
</script>