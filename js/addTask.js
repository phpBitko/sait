$(function(){

    $('#textTaskAdmin').keyup(function () {
        var text = $('#textTaskAdmin').val();
        $('#html').html(text);
    });

    $('#textTaskEdit').keyup(function () {
        var text = $('#textTaskEdit').val();
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

   /* $('#deleteTaskButton').click(function(){

        if(confirm('Ви точно хочете видалити?')){
            console.log('sds');
        }else {
            console.log('sds');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url:'/admin/editTask',
                headers: {'head':'ajax'},
                data:{delete:'no'}
            });
    }
    })*/


});