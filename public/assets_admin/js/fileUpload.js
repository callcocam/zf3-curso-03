$(function(){
    var fileUpload={
        targetDefault:null,
        defaultPreview:null,
        fileInput:null,
        element:function(el,tarDefaults,imgPreviews){
            //fileInput um input do tipo file
            fileUpload.fileInput=$(el);
            //um campo de texto ou hidden que conten o nome do arquivo atual
            fileUpload.targetDefault=$(tarDefaults);
            //elemento do tipo img
            fileUpload.defaultPreview=$(imgPreviews);
            fileUpload.fileInput.css({
                position: 'absolute',
                top: 0,
                left: 0,
                right: 0,
                bottom:0,
                width: '100%',
                height: '100%',
                opacity: 0,
                cursor: 'pointer'
            }).change(function(){
                var fileDefault = fileUpload.targetDefault.attr('default');
                if (!fileUpload.fileInput.val()) {
                    fileUpload.defaultPreview.fadeOut('fast', function () {
                        fileUpload.defaultPreview.attr('src', fileDefault).fadeIn('slow');
                    });
                    return false;
                }
                if (this.files && this.files[0].type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        fileUpload.defaultPreview.fadeOut('fast', function () {
                            fileUpload.defaultPreview.attr('src', e.target.result).fadeIn('fast');
                        });
                    };
                    reader.readAsDataURL(this.files[0]);
                    var formattedDate = new Date();
                    var m = $.strPad(formattedDate.getMonth(),2,'0','STR_PAD_LEFT');
                    var y = $.strPad(formattedDate.getFullYear(),4,'0','STR_PAD_LEFT');
                    var valor=$.vsprintf("/images/%s/%s/%s",[ y, m,fileUpload.fileInput.val()]);
                    fileUpload.targetDefault.val(valor);
                } else {
                    fileUpload.defaultPreview.fadeOut('fast', function () {
                        fileUpload.defaultPreview.attr('src', fileDefault).fadeIn('slow');
                    });

                    fileUpload.fileInput.val('');
                    return false;
                }
            });
        }
    };
    fileUpload.element("#atachament","#images","#img-preview");
})