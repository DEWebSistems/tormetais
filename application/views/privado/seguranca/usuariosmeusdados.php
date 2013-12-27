<h3 class="page-header-form-list">Meus Dados de Usuário</h3>
<div class="row">
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
</div>
<div style="margin-left: 20px; margin-right: 20px;">
    <a href="<?php echo site_url('privado/inicio'); ?>" class="btn btn-primary">Início</a>
    <br/>
    <br/>
    <table class="table table-bordered table-condensed">
        <tbody>
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
    <a href="<?php echo site_url('privado/usuarios/alterarmeusdados'); ?>" class="btn btn-default">Alterar Dados</a>
    <a href="<?php echo site_url('privado/usuarios/alterarminhassenhas'); ?>" class="btn btn-default">Alterar Senha</a>
    <br/>
    <br/>
</div>