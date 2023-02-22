<script type="text/javascript">
$(document).ready(function() {
	// code here
	$("a.back_btn").css('visibility', 'hidden');
	$("#UK-FCL-00089_0").attr('readonly', true);
	$("#UK-FCL-00403_0").on("blur", function() {
		var reg_no = $(this).val();
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "/backoffice/infowizardtwo/subFormDissidentProxyCircularForm12/getcompanyNameByregno/reg_no/" + reg_no,
			beforeSend: function() {
				$("#UK-FCL-00403_0-error").text("Please wait...");
			},
			success: function(result) {
				if(result.status == true) {
					$("#UK-FCL-00403_0-error").text("");
					$("#UK-FCL-00089_0").val(result.cname);
				} else {
					$("#UK-FCL-00403_0-error").text(result.msg);
					$("#UK-FCL-00089_0").val("");
				}
				console.log(result);
			}
		});
	});
	/*$("#UK-FCL-00302_0").datepicker({
	    maxDate: 0
	});*/
	//director details
	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
	$('#UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00324_0').keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#UK-FCL-00105_0").blur(function() {
		if($(this).val()) {
			$("input[name=middlenamecheckbox]").prop('checked', false);
		}
	});
	$("input[name=middlenamecheckbox]").change(function() {
		if($(this).is(':checked')) {
			$("#UK-FCL-00105_0").val("");
			$("#UK-FCL-00105_0").attr('readonly', true);
		} else {
			$("#UK-FCL-00105_0").attr('readonly', false);
		}
	});
	$("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Name of Person Soliciting:</strong></div>").insertBefore("#div_UK-FCL-00132_0");
	// end director detail
	/*$("#UK-FCL-00403_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	*/
});
</script>