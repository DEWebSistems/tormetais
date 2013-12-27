<h3 class="page-header-form-list">Alterar Minha Senha</h3>
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
<div style="margin-left: 20px; margin-right: 20px;">
    <table class="table table-bordered table-condensed">
        <tbody>
            <tr>
                <th style="width: 100px;">Código:</th>
                <td><?php echo $dadosUsuario['id']; ?></td>
            </tr>
            <tr>
                <th style="width: 100px;">Nome:</th>
                <td><?php echo $dadosUsuario['nome']; ?></td>
            </tr>
            <tr>
                <th>E-Mail:</th>
                <td><?php echo $dadosUsuario['email']; ?></td>
            </tr>
            <tr>
                <th>Login:</th>
                <td><?php echo $dadosUsuario['login']; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<form action="<?php echo site_url('privado/usuarios'); ?>" method="post" class="form-horizontal" role="form">       
    <div class="form-group">
        <label for="ipwSenhaAtual" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Senha Atual:</label>
        <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
            <input id="ipwSenhaAtual" name="ipwSenhaAtual" type="password" maxlength="20" value="" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="ipwNovaSenha" class="col-sm-2 control-label">Nova Senha:</label>
        <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
            <input id="ipwNovaSenha" name="ipwNovaSenha" type="password" maxlength="20" value="" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="ipwRepitaNovaSenha" class="col-sm-2 control-label">Repita A Nova Senha:</label>
        <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
            <input id="ipwRepitaNovaSenha" name="ipwRepitaNovaSenha" type="password" maxlength="20" value="" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravarMinhasSenhas" name="bsGravarMinhasSenhas" type="submit" value="" class="btn btn-primary" onclick="return validations();">Gravar</button>
            <button id="bsCancelarMinhasSenhas" name="bsCancelarMinhasSenhas" type="submit" class="btn btn-default">Cancelar</button>
        </div>
    </div>
</form>