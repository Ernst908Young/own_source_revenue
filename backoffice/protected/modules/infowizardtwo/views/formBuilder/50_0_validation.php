<script type="text/javascript">

$(document).ready(function(){
    $("#main_booking_schedule").hide();
    $("#UK-FCL-00863_0").on("change",function(){
        var tax_type = $("#UK-FCL-00863_0").val();
        if(tax_type=='House Tax'){
            $("#UK-FCL-00864_0").val(10000);           
            $("#UK-FCL-00861_0").val("27*110");
        }

        if(tax_type=='Water Tax'){
            $("#UK-FCL-00864_0").val(9000);           
            $("#UK-FCL-00861_0").val("");
        }

        if(tax_type=='Property Tax'){
            $("#UK-FCL-00864_0").val(5000);           
            $("#UK-FCL-00861_0").val("40*40");
        }

        if(tax_type=='Sewage Tax'){
            $("#UK-FCL-00864_0").val(7500);           
            $("#UK-FCL-00861_0").val("");
        }          
    });
});


$(window).on('load',function() 
{   

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



</script>
