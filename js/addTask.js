$(function(){

    $('#textTaskAdmin').keyup(function () {
        var text = $('#textTaskAdmin').val();
        $('#html').html(text);
    });



    $('#numTaskIn').keyup(function () {
        var text = $('#numTaskIn').val();
        if(+text){
            $('#numTaskOut').html(text);
        }else if (text != ""){
            //console.log($('#numTaskIn')[0]);
            alert("Ви ввели не число!");
            $('#numTaskOut').html('');
            $('#numTaskIn').val('');
        }
    });


    });
