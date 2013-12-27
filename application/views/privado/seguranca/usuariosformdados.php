<h3 class="page-header-form-list">Alterar Meus Dados</h3>
<?php
    if($messages['isErrors'] == true)
    {
        echo '<div class="alert alert-danger alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>Foram encontradas as seguintes inconsistências:</h4>';
        echo $messages['messagesErrors'];
        echo '</div>';
    }
?>
<form action="<?php echo site_url('privado/usuarios'); ?>" method="post" class="form-horizontal" role="form">       
    <div class="form-group">
        <label for="itId" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Código:</label>
        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-2">
            <input id="itId" name="itId" type="text" maxlength="90" value="<?php echo $dadosUsuario['id'];?>" class="form-control" readonly=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="itNome" class="col-sm-2 control-label">Nome:</label>
        <div class="col-sm-6">
            <input id="itNome" name="itNome" type="text" maxlength="90" value="<?php echo $dadosUsuario['nome'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itEMail" class="col-sm-2 control-label">E-Mail:</label>
        <div class="col-sm-6">
            <input id="itEMail" name="itEMail" type="text" maxlength="100" value="<?php echo $dadosUsuario['email'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itLogin" class="col-sm-2 control-label">Login:</label>
        <div class="col-sm-6">
            <input id="itLogin" name="itLogin" type="text" maxlength="20" value="<?php echo $dadosUsuario['login'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravarMeusDados" name="bsGravarMeusDados" type="submit" value="" class="btn btn-primary" onclick="return validations();">Gravar</button>
            <button id="bsCancelarMeusDados" name="bsCancelarMeusDados" type="submit" class="btn btn-default">Cancelar</button>
        </div>
    </div>
</form>