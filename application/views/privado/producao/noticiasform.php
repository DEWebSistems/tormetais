<h3 class="page-header-form-list">Cadastro de Noticias</h3>
<script type="text/javascript" src="/tormetais/assets/js/noticiasprivate.js"></script>

<div id="divResultsValidations" class="col-md-12">
</div>
<form action="<?php echo site_url('privado/noticias/lista'); ?>" method="post" class="form-horizontal" role="form">       
    <div class="form-group">
        <label for="itId" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Código:</label>
        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-2">
            <input id="itId" name="itId" type="text" maxlength="90" value="<?php echo $dadosNoticia['id'];?>" class="form-control" readonly=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="itNome" class="col-sm-2 control-label">Nome do Noticia:</label>
        <div class="col-sm-6">
            <input id="itNome" name="itNome" type="text" maxlength="90" value="<?php echo $dadosNoticia['nome'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="taDescricao" class="col-sm-2 control-label">Descrição:</label>
        <div class="col-sm-6">
            <textarea id="taDescricao" name="taDescricao" maxlength="2000" class="form-control"><?php echo $dadosNoticia['descricao'];?></textarea>
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