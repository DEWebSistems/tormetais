<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Tor Metais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Everaldo Boccoli" >
        <meta name="author" content="Daniel Rockenbach Loro" >

        <link rel="shortcut icon" href="<?php echo base_url('/assets/images/favicon.ico');?>" />
        <!-- Styles -->
        
        <link href="<?php echo base_url('/assets/bootstrap/3.0.0/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/layout.css'); ?>" rel="stylesheet">

        <!-- Java Script -->
        <script type="text/javascript" src="<?php echo base_url('/assets/jquery/jquery203/jquery-2.0.3.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/3.0.0/js/bootstrap.js'); ?>"></script>
        
        <script type="text/javascript">
            $(function(){
                $('#itUsuario').focus();
                $('#bsAcessar').click(function(){
                    var isError = false;
                    $('#spanHelpBlockUsuario').remove();
                    $('#divFGUsuario').removeClass('has-warning');
                    $('#spanHelpBlockSenha').remove();
                    $('#divFGSenha').removeClass('has-warning');
                    if($('#itUsuario').val() === '')
                    {
                        isError = true;
                        $('#divFGUsuario').addClass('has-warning');
                        $('#divInputUsuario').html($('#divInputUsuario').html() + '<span id="spanHelpBlockUsuario" class="help-block">O usuário deve ser informado.</span>');
                    }
                    if($('#ipSenha').val() === '')
                    {
                        isError = true;
                        $('#divFGSenha').addClass('has-warning');
                        $('#divInputSenha').html($('#divInputSenha').html() + '<span id="spanHelpBlockSenha" class="help-block">A senha deve ser informada.</span>');
                    }
                    if(isError === true)
                    {
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div>
            <div class="row">
                <div class="col-lg-offset-5 col-lg-3">
                    <h2 style="text-align: center;">Tor Metais</h2>
                    <h3 style="text-align: center;">Área Administrativa</h3>
                </div>
            </div>
            <?php
                if($messages['errors'] != '')
                {
                    echo '<div class="row">';
                    echo '<div class="col-lg-offset-0 col-lg-12">';
                    echo '<div class="alert alert-danger" style="text-align: center;"><h4>Acesso Negado</h4>' . $messages['errors'] .  '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
            <form id="formLogin" name="formLogin" action="<?php echo site_url('privado/login'); ?>" method="post" class="form-horizontal" role="form">
                <div id="divFGUsuario" class="form-group">
                    <label for="itUsuario" class="col-xs-2 col-sm-4 col-md-4 col-lg-2 col-lg-offset-3 control-label">Usuário:</label>
                    <div id="divInputUsuario" class="col-xs-10 col-sm-5 col-md-4 col-lg-3">
                        <input id="itUsuario" name="itUsuario" type="text" value="<?php echo $fields['user']; ?>" class="form-control" placeholder="Usuário"/>
                    </div>
                </div>
                <div id="divFGSenha" class="form-group">
                    <label for="ipSenha" class="col-xs-2 col-sm-4 col-md-4 col-lg-2 col-lg-offset-3 control-label">Senha:</label>
                    <div id="divInputSenha" class="col-xs-10 col-sm-5 col-md-4 col-lg-3">
                        <input id="ipSenha" name="ipSenha" type="password" value="<?php echo $fields['password']; ?>" class="form-control" placeholder="Senha"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-5 col-xs-10 col-sm-5 col-md-4 col-lg-3">
                        <button id="bsAcessar" name="bsAcessar" type="submit" class="btn btn-primary btn-block">Acessar</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>