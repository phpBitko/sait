/**
 * Created by bitko on 21.03.2016.
 */
$(function(){
   // console.log($('#selectName').attr('value'));
    $('#selectName').click(function () {

        $('#selectName>option').each(function () {

           // console.log($(this).attr('selected'));
            //this.removeAttribute('selected');
            if ($(this).attr('selected') == 'selected' && this.selected == true){
                //console.log("sdsdss");
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                var selectTask = null;
                // this.setAttribute('selected','selected');
                $(this).attr('selected', 'selected');
                //$(this).attr('selected','selected');
                $('#selectTask>option').each(function () {
                    if (this.selected == true) {
                        selectTask = $(this).attr('value')
                    }
                       console.log(selectTask);
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/execution',
                    headers: {'head':'ajax'},
                    data:{user_id: $(this).attr('value'),
                          task_num: selectTask},
                    success: function(data){
                        $('#commentText').html(data[0].comment);

                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });
    $('#selectTask').click(function () {
        $('#selectTask>option').each(function () {

            // console.log($(this).attr('selected'));
            //this.removeAttribute('selected');
            if ($(this).attr('selected') == 'selected' && this.selected == true){
                //console.log("sdsdss");
                return false;
            }else if (this.selected == true && $(this).attr('selected') != 'selected'){
                var selectName = null;
                // this.setAttribute('selected','selected');
                $(this).attr('selected', 'selected');
                //$(this).attr('selected','selected');
                $('#selectName>option').each(function () {
                    if (this.selected == true) {
                        selectName = $(this).attr('value')
                    }
                    console.log(selectTask);
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url:'/execution',
                    headers: {'head':'ajax'},
                    data:{user_id:selectName ,
                         task_num: $(this).attr('value')},
                    success: function(data){
                        $('#commentText').html(data[0].comment);
                    }
                });
            }else{
                this.removeAttribute('selected');
            }

        });
    });

});
