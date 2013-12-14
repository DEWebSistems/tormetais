function validations()
{
    alert('');
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
    if(allTrim($('#seProdutos').val()) === '')
    {
        if(isErrors === false)
        {
            $('#seProdutos').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Produto Destaque" é de seleção obrigatório.';
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