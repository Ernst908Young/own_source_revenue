<script type="text/javascript">

$(document).ready(function(){

$("#div_UK-FCL-00843_0, #div_UK-FCL-00844_0").hide();
$("#UK-FCL-00841_0")
//$("#UK-FCL-00843_0, #UK-FCL-00844_0").attr('readonly',true);
$("#UK-FCL-00841_0, #UK-FCL-00837_0, #UK-FCL-00840_0").on("change",function(){ 
    var district_code = $("#UK-FCL-00837_0").val();  
    var block_code = $("#UK-FCL-00840_0").val();  
     var gram_panchayat_code = $("#UK-FCL-00841_0").val();  
     var service_id = "<?= $_GET['service_id']; ?>";
     if(district_code && block_code && gram_panchayat_code){
        $("#UK-FCL-00839_0").select2("val","");
            $.ajax({
                type: "POST",
                url: "/panchayatiraj/backoffice/infowizardtwo/subForm/getnameplaces/district_code/" + district_code+'/block_code/'+block_code+'/gram_panchayat_code/'+gram_panchayat_code+'/service_id/'+service_id,
                success: function(result) {                 
                    $("#UK-FCL-00839_0").html(result);
                 //   alert("<!-?php echo @$fieldValues['UK-FCL-00839_0']; ?>");
                    <?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>          
                        $("#UK-FCL-00839_0").val("<?php echo @$fieldValues['UK-FCL-00839_0']; ?>");
                        $("#UK-FCL-00839_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00839_0']; ?>");
                        $("#UK-FCL-00839_0").change();
                    <?php } ?>
                }
        });
     }else{
            $("#UK-FCL-00839_0").select2("val","");
            console.log('ff');
     }     

});	

$("#main_booking_schedule").hide();
$("#UK-FCL-00839_0").on("change",function(){ 
    var name_place_id = $(this).val();
    var act = 'current';
    var month = "<?= date('m') ?>";
    var year = "<?= date('Y') ?>";     
     if(name_place_id){       
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {"act": act, "month": month, "year": year, "name_place_id" : name_place_id},
               url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/subForm/changecalendar",
                success: function(result) {
                    $("#main_booking_schedule").show();
                    $("#div_booking_calendar").html(result.calender_content);
                }
        });
     }else{
        $("#UK-FCL-00839_0").select2("val","");
      
     }   

}); 


}); 


$(window).on('load',function() 
{   
	$("#div_UK-FCL-00858_0").hide();
	$("#div_UK-FCL-00865_0").hide();
	$("#div_UK-FCL-00866_0").hide();
	$("#div_UK-FCL-00798_0").hide();
	$("#div_UK-FCL-00859_0").hide();
	$("#div_UK-FCL-00860_0").hide();
	$("#div_UK-FCL-00861_0").hide();
	
	$("#UK-FCL-00862_0").on('change',function(){
		var feetype = $(this).val();
		$("#div_UK-FCL-00858_0").hide();
		$("#div_UK-FCL-00865_0").hide();
		$("#div_UK-FCL-00866_0").hide();
		$("#div_UK-FCL-00798_0").hide();
		$("#div_UK-FCL-00859_0").hide();
		$("#div_UK-FCL-00860_0").hide();
		$("#div_UK-FCL-00861_0").hide();
		if(feetype=="Yearly Basis"){
			$("#div_UK-FCL-00858_0").show();
			$("#div_UK-FCL-00865_0").show();
			$("#div_UK-FCL-00859_0").show();
			$("#div_UK-FCL-00860_0").show();
			$("#div_UK-FCL-00861_0").show();
			$("#div_UK-FCL-00798_0").show();
			$("#UK-FCL-00798_0").val('5000');			
		}
		if(feetype=="One Time"){
			$("#div_UK-FCL-00866_0").show();
			$("#div_UK-FCL-00798_0").show();
			$("#div_UK-FCL-00859_0").show();
			$("#div_UK-FCL-00860_0").show();
			$("#div_UK-FCL-00861_0").show();
			$("#UK-FCL-00798_0").val('1000');
		}		
	});	
	
	
    <?php if(isset($_GET['subID']) && !empty($_GET['subID']) || isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id'])) { ?>

        $("#UK-FCL-00841_0").change();

    <?php } ?>
	
	 <?php
    /*  echo "<pre>";
    print_r($_SESSION['RESPONSE']);die; */
    if (isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])) {
        $iuid = $_SESSION['RESPONSE']['iuid'];
        $email = $_SESSION['RESPONSE']['email'];
        $first_name = $_SESSION['RESPONSE']['first_name'];
        $last_name = $_SESSION['RESPONSE']['last_name'];
        $surname = $_SESSION['RESPONSE']['surname'];
        $mobile_number = $_SESSION['RESPONSE']['mobile_number'];
        $country_name = $_SESSION['RESPONSE']['country_name'];
        $country_name = $_SESSION['RESPONSE']['country_name'];
        $state_name = $_SESSION['RESPONSE']['state_name'];
        $city_name = $_SESSION['RESPONSE']['city_name'];
        $address = $_SESSION['RESPONSE']['address'];
        $address2 = $_SESSION['RESPONSE']['address2'];
        $pin_code = $_SESSION['RESPONSE']['pin_code'];
    ?>

    $('#UK-FCL-00852_0').val('<?php echo @$first_name.' '.@$last_name; ?>');
    $('#UK-FCL-00853_0').val('Individual');
    $('#UK-FCL-00854_0').val('<?php echo @$mobile_number; ?>');
    $('#UK-FCL-00855_0').val('<?php echo @$email; ?>');    
    $('#UK-FCL-00007_0').val('India');
    $('#UK-FCL-00740_0').val('Uttar Pradesh');

<?php } ?>
 });

 function changemonth(act, month, year){
        var name_place_id = $("#UK-FCL-00839_0").val();
        if(name_place_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {"act": act, "month": month, "year": year, "name_place_id" : name_place_id},
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/subForm/changecalendar",
                success: function (result) {
                    if(result.status){
                        $("#main_booking_schedule").show();
                        $("#div_booking_calendar").html(result.calender_content);
                    }
                }
            });
        }else{
            $("#main_booking_schedule").hide();
        }
        
    }

    function bookdates(date, month, year){
       var name_place_id = $("#UK-FCL-00839_0").val();
        if(name_place_id){
          $.ajax({
                type: "POST",
                dataType: 'json',
                data: {"date": date, "month": month, "year": year, "name_place_id" : name_place_id},
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/subForm/bookdates",
                success: function (result) {
                    if(result.status){
                        var from_date = result.from_date;
                        var to_date = result.to_date;
                        $("#UK-FCL-00844_0").val(to_date);
                        $("#UK-FCL-00843_0").val(from_date);
                        $("#main_booking_schedule").show();
                        $("#div_booking_calendar").html(result.calender_content);
                    }
                }
            });
          }else{
            $("#main_booking_schedule").hide();
        }
    }

function addmoreaction(id,service_id,div_id){
 

    $.ajax({
            type: "GET",
            dataType: 'json',
            data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMaster/getAddmoreData",
            success: function (data) {
                console.log(data);
                var tr_ = "<tr class='add_more_"+div_id+"'>";
                var td_ = '';
                var err = 0;
                var fieldsIDArr = new Array();
                $.each(data, function (key, item) {
                    var id = item.id;
                    var vall;
                    var typeVal;
                    var name = item.full_name;
                    var formchk_id = item.formchk_id;
                    var selector = $('[name="' + formchk_id + '"]');
                    var cls = '';
                
                    if ($(selector).is("input")) {
                        if ($("input:radio[name='" + formchk_id + "']").attr('type') == 'radio') {
                            /*vall = $("input:radio[name='" + formchk_id + "']:checked").val();
                            typeVal = 'radio';
                            $("input:radio[name='" + formchk_id + "']").addClass('val');
                            if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
                                cls = 'val';
                            }*/
                            var getSelectedValue = document.querySelector( 'input[name="'+formchk_id+'"]:checked');
                            if(getSelectedValue!= null){
                                vall = getSelectedValue.value
                            }else{
                                vall = '';
                            }

                            typeVal = 'radio';
                            $("input:radio[name='" + formchk_id + "']").addClass('val');
                            if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
                                cls = 'val';
                            }
                        }else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
                            vall = $("input[name='" + formchk_id + "']").val();
                            typeVal = 'number';
                            $("input[name='" + formchk_id + "']").addClass('val');
                            if ($("input[name='" + formchk_id + "']").hasClass('val')) {
                                cls = 'val';
                            }                           
                        }
                        else {
                            vall = $("input[name='" + formchk_id + "']").val();
                            typeVal = 'text';
                            $("input:text[name='" + formchk_id + "']").addClass('val');
                            if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
                                cls = 'val';
                            }
                            
                        }
                    }

                    else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {                        
                        if ($('#' + formchk_id).prop('multiple')) {
                            typeVal = 'multiple';
                            var selMulti = $.map($("#" + formchk_id + " option:selected"), function (el, i) {
                                return $(el).text();
                            });
                            vall = selMulti.join(", ");
                            $('#' + formchk_id).addClass('val');
                            if ($('#' + formchk_id).hasClass('val')) {
                                cls = 'val';
                            }
                            $("#" + formchk_id + " option").removeAttr("selected");
                        }
                        else {  
                            typeVal = 'dropdown';
                            vall = $("select[name='" + formchk_id + "'] option:selected").text();
                            $("select[name='" + formchk_id + "']").addClass('val'); 
                            if ($("select[name='" + formchk_id + "']").hasClass('val')) {
                                cls = 'val';
                            }
                            $("#" + formchk_id + " option").removeAttr("selected");
                        }
                    }
                    else if ($(selector).is("textarea")) {  
                        typeVal = 'textarea';
                        vall = $("textarea[name='" + formchk_id + "']").val();
                        $("textarea[name='" + formchk_id + "']").addClass('val');
                        if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
                            cls = 'val';
                        }
                    }
                    else if ($('.chk_' + formchk_id).is(':checkbox')) {
                        typeVal = 'checkbox';
                        vall = $('.chk_' + formchk_id + ':checked').map(function () {
                            return this.value;
                        }).get().join(',');
                        $('.chk_' + formchk_id).addClass('val');
                        if ($('.chk_' + formchk_id).hasClass('val')) {
                            cls = 'val';
                        }   
                    }

                    if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
                        $(".form-control-feedback-addmore").remove();
                        if(div_id==4905){
                            
                           var checkfield = true;

                                if(formchk_id=='UK-FCL-00826_0'){
                                         $(".form-control-feedback-addmore").remove();        
                                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                                                    fieldsIDArr.push(formchk_id); 
                                    
                                    }else{
                                            var labelData = $("#label_" + formchk_id).text();

                                            labelData=labelData.replace('('+formchk_id+')',"");
                                            $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                                                                    
                                            err = err + 1;
                                            return false;     
                                    }   
                        }   
                        if(div_id==188){
                            
                                if(formchk_id=='UK-FCL-00140_0' || formchk_id=='UK-FCL-00142_0' || formchk_id=='UK-FCL-00143_0'){
                                        var labelData = $("#label_" + formchk_id).text();
                                    labelData=labelData.replace('('+formchk_id+')',"");
                                    //alert(formchk_id);
                                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");                      
                                    err = err + 1;
                                    return false;
                                    }else{
                                        $(".form-control-feedback-addmore").remove();
                                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                                                    fieldsIDArr.push(formchk_id);       
                                    }   
                        }   
                        if(div_id==669){
                                
                                if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00113_0'){
                                        var labelData = $("#label_" + formchk_id).text();
                                    labelData=labelData.replace('('+formchk_id+')',"");
                                    //alert(formchk_id);

                                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");                      
                                    err = err + 1;
                                    return false;
                                    }else{
                                        $(".form-control-feedback-addmore").remove();
                                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                                                    fieldsIDArr.push(formchk_id);       
                                    }   
                        }           
                    }
                    else {
                        $(".form-control-feedback-addmore").remove();
                        //console.log(typeVal);
                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                        fieldsIDArr.push(formchk_id);                       
                    }

                }); 
                if (err == 0) {
                    //alert(JSON.stringify(fieldsIDArr));
                    if(confirm('Before adding, please check whether the details entered is correct.')) 
                    {
                    $('#add_more_' + div_id).show();
                    $('#tbl_' + div_id).show();
                    td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                    tr_ += td_ + "</tr>";
                    $(tr_).appendTo($('#tbl_' + div_id));
                    //alert(fieldsIDArr);
                    fieldsIDArr.forEach(myFunction);
                    function myFunction(value, index, array) {  
                        $("input:radio[name='" + value + "']").prop('checked', false);
                        $('#' + value).val("");
                        $("#" + value + "").select2("val", "");
                        $('.chk_' + value + ':checked').removeAttr('checked');
                    }
                    $("input[name=middlenamecheckbox]").prop('checked', false); 
                    $("#UK-FCL-00133_0").attr('readonly',false);
                }
                } else
                    return false;
                                    
                $('.del_1').on('click', function () {                   
                    $(this).closest('tr').remove();
                    var uio= $(this).attr('pi');
                    if($("."+uio).length<2){
                        $("#"+uio).css('display','none');
                    }
                                        
                });
            } // success function close here
        }); //ajax end here
 }

</script>