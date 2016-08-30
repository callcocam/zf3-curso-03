$(function()
{
    var notice;
    var options = {
        target:        '#output1',   // target element(s) to be updated with server response
        beforeSubmit:  showRequest,  // pre-submit callback
        success:       showResponse,  // post-submit callback
        uploadProgress:uploadProgress,
        type: 'post',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json'
    };
    // bind form using 'ajaxForm'
    $('#Manager').ajaxForm(options);
})
function progress() {
     notice = new PNotify({
        text: "POR FAVOR AGUARDE!",
        type: 'info',
        icon: 'fa fa-spinner fa-spin',
        hide: false,
        buttons: {
            closer: false,
            sticker: false
        },
        opacity: .75,
        shadow: false,
        width: "170px"
    });
}
function  uploadProgress(event, position, total, percentComplete) {
    var options = {
        text: percentComplete + "% complete."
    };
    notice.update(options);
}
// pre-submit callback
function showRequest(formData, jqForm, options) {
    $('.valid').removeClass('has-error').addClass('has-success');
    progress();
    return true;
}
function showResponse(responseText, statusText, xhr, $form)  {
    var options = {
        title : "OPISSS!!",
        text: responseText.error,
        type:responseText.class,
        hide:true,
        buttons:{
            closer: true,
            sticker: true
        },
        icon : 'fa fa-check',
        opacity : 1,
        shadow : true,
       width : PNotify.prototype.options.width
    };
    if(responseText.err){
        $.each( responseText.err, function( key, value ) {
            $($.vsprintf(".%s",[ key])).removeClass('has-success').addClass('has-error');
        });
    }
    else{
        $("#id").val(responseText.data.id);
    }
    notice.update(options);

}