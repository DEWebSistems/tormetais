<div class="page-header-form-list">
    <strong>Cadastro de Serviços</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/servicosprivate.js"></script>

<div id="divResultsValidations" class="col-md-12">
</div>
<form action="<?php echo site_url('privado/servicos/lista'); ?>" method="post" class="form-horizontal" role="form">       
    <div class="form-group">
        <label for="itId" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Código:</label>
        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-2">
            <input id="itId" name="itId" type="text" maxlength="90" value="<?php echo $dadosServico['id'];?>" class="form-control" readonly=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="itNome" class="col-sm-2 control-label">Nome do Serviço:</label>
        <div class="col-sm-6">
            <input id="itNome" name="itNome" type="text" maxlength="90" value="<?php echo $dadosServico['nome'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="taDescricao" class="col-sm-2 control-label">Descrição:</label>
        <div class="col-sm-6">
            <textarea id="taDescricao" name="taDescricao" maxlength="255" class="form-control"><?php echo $dadosServico['descricao'];?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="seCategoriaServico" class="col-sm-2 control-label">Categoria do Serviço:</label>
        <div class="col-sm-6">
            <select id="seCategoriaServico" name="seCategoriaServico" class="form-control">
                <option value="">--Selecione uma Categoria--</option>
                <?php
                    foreach($categoriasServico as $categoriaServico)
                    {
                        echo '<option ';
                        echo 'value="' . $categoriaServico['id'] . '"';
                        if($categoriaServico['id'] == $dadosServico['categoriaservicoid'])
                        {
                            echo ' selected=""';
                        }
                        echo '>';
                        echo $categoriaServico['nome'];
                        echo '</option>';
                    }
                ?>
            </select>
        </div>
    </div>    
    <div class="form-group">
        <label for="icbServicoPrincipal" class="col-sm-2 control-label">Serviço Principal:</label>        
        <div class="col-sm-6">
            <input id="icbServicoPrincipal" name="icbServicoPrincipal" type="checkbox" value="marcado"/>
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