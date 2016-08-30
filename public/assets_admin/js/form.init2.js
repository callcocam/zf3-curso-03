$(function()
{
    var bar = $('.bar');
    var percent = $('.percent');
    var progress = $('.progress');
    var status = $('#status');
    progress.css('display','none');
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

    // pre-submit callback
    function showRequest(formData, jqForm, options) {
        progress.css('display','block');
        $('.valid').removeClass('has-error').addClass('has-success');
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
        return true;
    }

    function showResponse(responseText, statusText, xhr, $form)  {
        if(responseText.err){
            $.each( responseText.err, function( key, value ) {
                $($.vsprintf(".%s",[ key])).removeClass('has-success').addClass('has-error');
            });
        }
        else{
            $("#id").val(responseText.data.id);
        }
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
        setTimeout(function(){
            bar.width('0%')
            percent.html('0%');
            progress.css('display','none').css('transition','all .2s ease-in-out;');
        },2000);
    }

    function  uploadProgress(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    }
})