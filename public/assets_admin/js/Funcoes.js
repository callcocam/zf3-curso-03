$(function()
{    $.strPad = function(input, pad_length, pad_string, pad_type){
        var output = input.toString();
        if (pad_string === undefined) { pad_string = ' '; }
        if (pad_type === undefined) { pad_type = 'STR_PAD_RIGHT'; }
        if (pad_type == 'STR_PAD_RIGHT') {
            while (output.length < pad_length) {
                output = output + pad_string;
            }
        } else if (pad_type == 'STR_PAD_LEFT') {
            while (output.length < pad_length) {
                output = pad_string + output;
            }
        } else if (pad_type == 'STR_PAD_BOTH') {
            var j = 0;
            while (output.length < pad_length) {
                if (j % 2) {
                    output = output + pad_string;
                } else {
                    output = pad_string + output;
                }
                j++;
            }
        }
        return output;
    };

})

