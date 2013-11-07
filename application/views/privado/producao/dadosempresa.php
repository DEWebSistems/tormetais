<script type="text/javascript" src="/tormetais/assets/plugins/jquerymask/jquerymask1.3.1.min.js"></script>
<script type="text/javascript" src="/tormetais/assets/js/dadosempresa.js"></script>
<script>
    $(function(){
        $(".maskCNPJ").mask("99.999.999/9999-99");
        $(".maskTelefone").mask("(99) 9999-9999");
        $(".maskCEP").mask("99999-999");
    });
</script>
<br/>
<br/>
<?php
    if($messages['isErrors'] == true)
    {
        echo '<div class="alert alert-danger alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>Erro</h4>';
        echo $messages['messagesErrors'];
        echo '</div>';
    }
    if($messages['isSuccess'] == true)
    {
        echo '<div class="alert alert-success alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>' . $messages['messagesSuccess'] . '</h4>';
        echo '</div>';
    }
?>
<div id="divResultsValidations" class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
</div>
<form action="" method="post" class="form-horizontal" role="form">
    <div class="form-group">
        <label for="itNomeFantasia" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Nome Fantasia:</label>
        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-6">
            <input id="itNomeFantasia" name="itNomeFantasia" type="text" maxlength="90" value="<?php echo $dadosEmpresa['nomefantasia'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itRazaoSocial" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Razão Social:</label>
        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-6">
            <input id="itRazaoSocial" name="itRazaoSocial" type="text" maxlength="90" value="<?php echo $dadosEmpresa['razaosocial'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itCNPJ" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">CNPJ:</label>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <input id="itCNPJ" name="itCNPJ" type="text" maxlength="18" value="<?php echo $dadosEmpresa['cnpj'];?>" class="form-control maskCNPJ"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itIE" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Inscrição Estadual:</label>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <input id="itIE" name="itIE" type="text" maxlength="25" value="<?php echo $dadosEmpresa['ie'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="seEstado" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Estado:</label>
        <div class="col-xs-8 col-sm-4 col-md-3 col-lg-3">
            <select id="seEstado" name="seEstado" class="form-control">
                <option value="">--Selecione um estado--</option>
                <?php
                    foreach($estados as $sigla => $nome)
                    {
                        echo '<option ';
                        echo 'value="' . $sigla . '"';
                        if($sigla == $dadosEmpresa['estado'])
                        {
                            echo ' selected=""';
                        }
                        echo '>';
                        echo $nome;
                        echo '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="itCidade" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Cidade:</label>
        <div class="col-xs-8 col-sm-5 col-md-4 col-lg-3">
            <input id="itCidade" name="itCidade" type="text" maxlength="60" value="<?php echo $dadosEmpresa['cidade'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itBairro" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Bairro:</label>
        <div class="col-xs-8 col-sm-5 col-md-4 col-lg-3">
            <input id="itBairro" name="itBairro" type="text" maxlength="50" value="<?php echo $dadosEmpresa['bairro'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itEndereco" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Endereço:</label>
        <div class="col-xs-10 col-sm-6 col-md-5 col-lg-4">
            <input id="itEndereco" name="itEndereco" type="text" maxlength="100" value="<?php echo $dadosEmpresa['endereco'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itNumero" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Número:</label>
        <div class="col-xs-7 col-sm-4 col-md-3 col-lg-2">
            <input id="itNumero" name="itNumero" type="text" maxlength="20" value="<?php echo $dadosEmpresa['numero'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itComplemento" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Complemento:</label>
        <div class="col-xs-10 col-sm-5 col-md-4 col-lg-3">
            <input id="itComplemento" name="itComplemento" type="text" maxlength="50" value="<?php echo $dadosEmpresa['complemento'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itTelefonePrincipal" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Telefone Principal:</label>
        <div class="col-xs-7 col-sm-4 col-md-3 col-lg-2">
            <input id="itTelefonePrincipal" name="itTelefonePrincipal" type="tel" maxlength="14" value="<?php echo $dadosEmpresa['telefoneprincipal'];?>" class="form-control maskTelefone"/>
        </div>
    </div>
    <div class="form-group">
        <label for="itTelefoneSecundario" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Telefone Secundário:</label>
        <div class="col-xs-7 col-sm-4 col-md-3 col-lg-2">
            <input id="itTelefoneSecundario" name="itTelefoneSecundario" type="tel" maxlength="14" value="<?php echo $dadosEmpresa['telefonesecundario'];?>" class="form-control maskTelefone"/>
        </div>
    </div>
    <div class="form-group">
        <label for="iemEMailPrincipal" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">E-Mail Principal:</label>
        <div class="col-xs-10 col-sm-6 col-md-5 col-lg-4">
            <input id="iemEMailPrincipal" name="iemEMailPrincipal" type="email" maxlength="100" value="<?php echo $dadosEmpresa['emailprincipal'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="iemEMailSecundario" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">E-Mail Secundário:</label>
        <div class="col-xs-10 col-sm-6 col-md-5 col-lg-4">
            <input id="iemEMailSecundario" name="iemEMailSecundario" type="email" maxlength="100" value="<?php echo $dadosEmpresa['emailsecundario'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="iurlLinkLocalizacaoGoogleMaps" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Link do Mapa:</label>
        <div class="col-xs-10 col-sm-8 col-md-7 col-lg-6">
            <input id="iurlLinkLocalizacaoGoogleMaps" name="iurlLinkLocalizacaoGoogleMaps" type="url" maxlength="200" value="<?php echo $dadosEmpresa['linklocalizacaogooglemaps'];?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="taDescricaoEmpresa" class="col-xs-8 col-sm-2 col-md-2 col-lg-2 control-label">Descrição da Empresa:</label>
        <div class="col-xs-10 col-sm-8 col-md-7 col-lg-6">
            <textarea id="taDescricaoEmpresa" name="taDescricaoEmpresa" maxlength="5000" rows="10" class="form-control"><?php echo $dadosEmpresa['descricaoempresa'];?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravar" name="bsGravar" type="submit" class="btn btn-primary" onclick="return validateBeforeSubmitRecord();">Gravar</button>
            <button id="bsCancelar" name="bsCancelar" type="submit" class="btn btn-default">Cancelar</button>
        </div>
    </div>
</form>
<br/>
<br/>