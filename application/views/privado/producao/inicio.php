<br/>
<div class="jumbotron">
    <p>Olá <?php echo $dadosUsuario['nome']; ?></p>
    <h2>Bem Vindo ao Sistema Administrativo</h2>
    <a href="<?php echo site_url('privado/usuarios'); ?>" class="btn btn-default btn-sm">Meu Usuário</a>
    <a href="<?php echo site_url('privado/logout'); ?>" class="btn btn-default btn-sm">Logout</a>
</div>