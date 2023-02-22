function getDeptDetail(url,dept_tag){
 //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
             data: "dept_tag=" + dept_tag,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#Applications_dept_id').empty();
                    $('#Applications_dept_id').append('<option  value="">Please Select Department</option>');
                    data.forEach(function (object) { 
                        $('#Applications_dept_id').append('<option  value="' + object.sp_id + '" ' + sel + '>' + object.service_provider_tag + '</option>');

                    });                    
                    
                } else {
                    $('#Applications_dept_id').empty();
                    $('#Applications_dept_id').append('<option value="">Please select Department</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}