function validations()
{
    var isErrors;
    var messagesHTML;
    isErrors = false;
    messagesHTML = '';
    messagesHTML += '<div class="alert alert-warning">';
    messagesHTML += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    messagesHTML += '<h4>Foram encontradas as seguintes inconsistências:</h4>';
    if(allTrim($('#itNome').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itNome').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Nome" é de preenchimento obrigatório.';
    }
    
//    if(allTrim($('#taDescricao').val()) === '')
//    {
//        if(isErrors === false)
//        {
//            $('#taDescricao').focus();
//        }
//        isErrors = true;
//        messagesHTML += '<br/>O campo "Descrição" é de preenchimento obrigatório.';
//    }
    
    if(allTrim($('#seCategoriaProduto').val()) === '')
    {
        if(isErrors === false)
        {
            $('#seCategoriaProduto').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Categoria do Produto" é de seleção obrigatória.';
    }
    if(allTrim($('#seLinhaProduto').val()) === '')
    {
        if(isErrors === false)
        {
            $('#seLinhaProduto').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Linha do Produto" é de seleção obrigatória.';
    }
    
    messagesHTML += '</div>';
    if(isErrors === true)
    {
        $('#divResultsValidations').html(messagesHTML);
        window.scrollTo(0, 0);
        return false;
    }
    else if(isErrors === false)
    {
        $('#divResultsValidations').html('');
        window.scrollTo(0, 0);
        return true;
    }
}

function aExcluirOnClick(id)
{
    if(confirm('Você deseja excluir este registro?'))
    {
        $('#bsExcluir').val(id);
        $('#bsExcluir').click();
    }
}