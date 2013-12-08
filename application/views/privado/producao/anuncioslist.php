<div class="page-header-form-list">
    <strong>Manutenção de Anúncio</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/anunciosprivate.js"></script>            
    
    <br/>
    <form action="" method="post">        
        <br/>
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 100px;">Código</th>
                    <th>Nome</th>
                    <th style="width: 200px;">
                        Opções                        
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($anuncios))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhum anúncio cadastrado.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    if(count($anuncios) > 0) {
                        foreach($anuncios as $anuncio)
                        {
                            echo '<tr>';
                            echo '<td>' . $anuncio['id'] . '</td>';
                            echo '<td>' . $anuncio['nome'] . '</td>';
                            echo '<td>';
                            echo '<div class="btn-group">';
                            echo '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Opções <span class="caret"></span></button>';
                            echo '<ul class="dropdown-menu" role="menu">';
                            echo '<li><a href=" '. site_url("privado/anuncios/alterar/" . $anuncio['id']) . '">Alterar</a></li>';                            
                            echo '<li><a href=" '. site_url("privado/anuncios/multimidias/" . $anuncio['id']) . '">Fotos</a></li>';
                            echo '</ul>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </form>