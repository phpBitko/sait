/**
 * Created by bitko on 21.03.2016.
 */
$(function(){

    $('#selectName').click(function () {

        $('#selectName>option').each(function () {
            if ($(this).attr('selected') == 'selected' && this.selected == true){
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                var selectTask = null;
                $(this).attr('selected', 'selected');
                //$(this).attr('selected','selected');
                $('#selectTask>option').each(function () {
                    if (this.selected == true) {
                        selectTask = $(this).attr('value')
                    }
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/execution',
                    headers: {'head':'ajax'},
                    data:{user_id: $(this).attr('value'),
                          task_num: selectTask},
                    success: function(data){
                        if(data != 0){
                            $('#commentText').html(data[0].comment);
                        }else{
                            alert('Задача відсутня!')
                        }
                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });
    $('#selectTask').click(function () {
        $('#selectTask>option').each(function () {
            if ($(this).attr('selected') == 'selected' && this.selected == true){
                //console.log("sdsdss");
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                var selectName = null;
                $(this).attr('selected', 'selected');
                $('#selectName>option').each(function () {
                    if (this.selected == true) {
                        selectName = $(this).attr('value')
                    }
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/execution',
                    headers: {'head':'ajax'},
                    data:{user_id:selectName ,
                         task_num: $(this).attr('value')},
                    success: function(data){
                       // console.log(data);
                        if(data != 0){
                            $('#commentText').html(data[0].comment);
                        }else{
                            alert('Задача відсутня!')
                        }
                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });


    $('#selectTaskEdit').click(function () {
        $('#selectTaskEdit>option').each(function () {
            if ($(this).attr('selected') == 'selected' && this.selected == true){
                //console.log("sdsdss");
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                var selectName = null;
                $(this).attr('selected', 'selected');

             /*   $('#selectName>option').each(function () {
                    console.log($(this));
                    if (this.selected == true) {
                        selectName = $(this).attr('value')
                    }
                });*/
               // console.log($(this).attr('value'));
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/admin/editTask',
                    headers: {'head':'ajax'},
                    data:{task_num: $(this).attr('value')},
                    success: function(data){

                        //console.log(data);
                        if(data != 0){
                           // console.log(data[0].is_actual);
                            $('#textTaskEdit').html(data[0].task_text);
                            if(data[0].is_actual == '1'){
                                $('#actualCheckBox').attr('checked', 'checked');
                                document.getElementById('actualCheckBox').checked = true;
                            }else{
                                $('#actualCheckBox').removeAttr('checked');
                            }
                            $('#html').html(data[0].task_text);
                            $('.save').html('');
                            $('#numTaskOut').html(data[0].task_num);
                        }else{
                            alert('Задача відсутня!')
                        }
                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });


    $('#selectNewsEdit').click(function () {
        $('#selectNewsEdit>option').each(function () {

            if ($(this).attr('selected') == 'selected' && this.selected == true){
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                //console.log($(this).attr('value'));
                $(this).attr('selected', 'selected');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/admin/editNews',
                    headers: {'head':'ajax'},
                    data:{news_id: $(this).attr('value')},
                    success: function(data){
                       // console.log(data);
                        //console.log(data);
                        if(data != 0){
                           // console.log(data);
                            $('#textNewsAdmin').html(data[0].news_text);
                            $('#headNewsIn').attr('value',data[0].news_head);
                            $('#html').html(data[0].news_text);
                            $('.save').html('');
                            $('#headNewsOut').html(data[0].news_head);
                        }
                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });




});
