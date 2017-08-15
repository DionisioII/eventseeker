$(function()
{
    $("#username").bind('blur',function(event)
    {
        var value = $(this).val();
        
        doValidation(value);
         
        });
                                                                                           
   function doValidation(value)
{
	function showResponse(resp)    {
		if (resp==true)
        $("#username").parent().parent().find('.errors').html('disponibile');
        else
        $("#username").parent().parent().find('.errors').html('non disponibile');
        
    }

	var url = '<?echo $this->url(array('controller' => 'public', 'action' => 'validatelogin',), 'default'); ?>' ;
    $.ajax({
		type: 'POST',
		url: url,
		data: 'value='+value,
		dataType: 'json',
		success: showResponse
    });
}

});
