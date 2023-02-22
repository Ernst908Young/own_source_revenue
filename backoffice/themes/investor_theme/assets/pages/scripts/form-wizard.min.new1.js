function ajaxPost(post_url,form_data){
	$.ajax({
       url: post_url,
       type: 'post',
       dataType: 'json',
       data: form_data,
       success: function(data) {
          if(data!=''){
          	// console.log(data);
      		if(data.STATUS=='SUCCESS'){
      			return true;
      		}
      		return false;
          }
        },
        error:function(data){
        	console.log(data);
			return false;          	
        }
	});
}
function investmentValidation(){

}
var FormWizard = function() {
    return {
        init: function() {
            function e(e) {
                return e.id ? "<img class='flag' src='../../assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
            }
            if (jQuery().bootstrapWizard) {
               /* $("#country_list").select2({
                    placeholder: "Select",
                    allowClear: !0,
                    formatResult: e,
                    width: "auto",
                    formatSelection: e,
                    escapeMarkup: function(e) {
                        return e
                    }
                });*/
                var r = $("#submit_form"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                r.validate({
                    doNotHideMessage: !0,
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: !1,
                    rules: {
                        company_name: {
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                            validCompanyName: !0
                        },Address: {
                            minlength: 10,
                            maxlength: 200,
                            required: !0,
                            validAddress: !0
                        },pin_code:{
                            required: !0,
                            digits: !0,
                            minlength: 6,
                            maxlength: 6
                        },
                        mob_number: {
                            required: !0,
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        tel_phone: {
                            digits: !0,
                            minlength: 8,
                            maxlength: 8
                        },
                        std_code_tel_phone:{
                            digits: !0,
                            minlength: 5,
                            maxlength: 5
                        },
                        std_code_fax:{
                            digits: !0,
                            minlength: 5,
                            maxlength: 5
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        'User[email]':{
                            required:!0,
                            email:!0
                        },
                        'User[mobile]':{
                            required: !0,
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        'User[full_name]':{
                            lettersWithSpaceOnly: !0,
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                        },
                        'User[password]':{
                            required: !0,
                        },
                        'User[dept_id]':{
                            required: !0,
                        },
                        fax: {
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        start_up:{
                            required: !0,
                        },
                        md_name:{
                            lettersWithSpaceOnly: !0,
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                        },
                        designation:{
                            required: !0,

                        },
                        md_mob:{
                            required: !0,
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        md_email:{
                            required: !0,
                            email: !0
                        },
                        md_tel:{
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        md_fax:{
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        auth_name :{
                            lettersWithSpaceOnly: !0,
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                        },auth_designation:{
                            lettersWithSpaceOnly: !0,
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                        },
                        auth_email:{
                            required: !0,
                            email: !0
                        },
                        auth_mob:{
                            required: !0,
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        auth_tel:{
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        auth_fax:{
                            digits: !0,
                            minlength: 10,
                            maxlength: 10
                        },
                        plant_machinery_invst: {
                        	number: !0
                        },
                        building_construction_invst: {
                        	number: !0
                        },
                        other_invst: {
                        	number: !0
                        },
                        mean_of_fin_equity: {
                        	number: !0
                        },
                        mean_of_fin_term_loan: {
                        	number: !0
                        },
                        mean_of_fin_assistance: {
                        	number: !0
                        },
                        mean_of_fin_grant: {
                        	number: !0
                        },
                        "fnc_year[]":{
                            finYear:!0
                        },
                        "fnc_turnover[]":{
                            number: !0
                        },
                        "fnc_prftBfrTax[]":{
                            number: !0
                        },
                        "fnc_netWrth[]":{
                            number: !0
                        },
                        "fnc_rsrvSrpls[]":{
                            number: !0
                        },
                        "fnc_sharCaps[]":{
                            number: !0
                        },
                        noforg:{
                            required:!0
                        },
                        project_status:{
                            required:!0
                        },
                        activity_of_company:{
                            letterswithbasicpunc:!0,
                            required:!0,
                            minlength:20,
                            maxlength:1000

                        },
                        org_category:{
                            required: !0,
                        },
                        ntrofunit:{
                            required: !0,
                        },
                        ntrofunittype:{
                            required: !0,
                        },
                        "Name_of_the_Raw_Material[]":{
                            lettersWithSpaceOnly: !0,
                            maxlength:50,
                        },
                         "Annual_Requirement_Unit[]":{
                            alphanumeric: !0,
                            maxlength:20,
                        },
                         "material_quantity[]":{
                            alphanumeric: !0,
                            maxlength:10,
                        },
                         "Product_Description[]":{
                            lettersWithSpaceOnly: !0,
                            maxlength:50,
                        },
                         "Annual_Install_Capacity[]":{
                            alphanumeric: !0,
                            maxlength:20,
                        },
                         "product_manufactured_Quantity[]":{
                            alphanumeric: !0,
                            maxlength:10,
                        },
                        type_of_industry:{
                            required:!0
                        },
                        expected_date_of_commercial_production:{
                            required:!0
                        },
                        Brief_Description_about_Processes:{
                            required:!0,
                            minlength:100,
                            maxlength:1000
                        },
                        industry_type:{
                            required:!0
                        },
                        "invstmnt_in_land[]":{
                            required:!0,
                            number:!0,
                        },
                        "invstmnt_in_building[]":{
                            required:!0,
                            number:!0,
                        },
                        "invstmnt_in_plant[]":{
                            required:!0,
                            number:!0,
                            investmentDetail:!0
                        },
                        "invstmnt_in_wrkingcapital[]":{
                            required:!0,
                            number:!0,
                        },
                        "invstmnt_in_other[]":{
                            required:!0,
                            number:!0,
                        },
                        "invstmnt_in_total[]":{
                            required:!0,
                            number:!0,
                        },
						emp_fmtotals:{
							required:!0,                            
						},
                        "no_of_emp_mskilled[]":{
                            digits:!0,
                        },
                        "no_of_emp_munskilled[]":{
                            digits:!0,
                        },
                        "no_of_emp_msupervisory[]":{
                            digits:!0,
                        },
                        "no_of_emp_mengineer[]":{
                            digits:!0,
                        },
                        "no_of_emp_it_mprofessional[]":{
                            digits:!0,
                        },
                        "no_of_emp_mmanagement[]":{
                            digits:!0,
                        },
                        "no_of_emp_mtotal[]":{
                            digits:!0,
                        },
                        "no_of_emp_fskilled[]":{
                            digits:!0,
                        },
                        "no_of_emp_funskilled[]":{
                            digits:!0,
                        },
                        "no_of_emp_fsupervisory[]":{
                            digits:!0,
                        },
                        "no_of_emp_fengineer[]":{
                            digits:!0,
                        },
                        "no_of_emp_it_fprofessional[]":{
                            digits:!0,
                        },
                        "no_of_emp_fmanagement[]":{
                            digits:!0,
                        },
                        have_own_land:{
                            required:!0
                        },
                        Proposed_details_of_Land:{
                            required:!0
                        },
                        industrial_water:{
                            number:!0
                        },
                        domestic_water:{
                            number:!0
                        },
                        source_of_water:{
                           lettersWithSpaceOnly:!0
                        },
                        coal:{
                            number:!0
                        },
                        lpg:{
                            number:!0
                        },
                        electricity:{
                            number:!0
                        },
                         solar:{
                            number:!0
                        },
                        "Name_of_the_Department[]":{
                            lettersWithSpaceOnly:!0
                        },
                        "Name_of_the_Approval[]":{
                            // lettersWithSpaceOnly:!0
                            alphanumericWithSpace:!0
                            // alphanumeric:!0
                        },
                        "Reference_no_of_the_letter[]":{
                            alphanumericWithSlash:!0
                        },
                        "requried_approval_department[]":{
                            lettersWithSpaceOnly:!0
                        },
                        "required_approval_name[]":{
                            alphanumericWithSpace:!0
                        },
                        detail_of_leased_space_area_in_sq_meters:{
                            rentedSpaceAttributesRequired:!0
                        },
                        detail_of_leased_address:{
                            rentedSpaceAttributesRequired:!0
                        },
                        detail_of_leased_space_tehsil:{
                            rentedSpaceAttributesRequired:!0
                        },
                        land_disctric:{
                            rentedSpaceAttributesRequired:!0
                        },
                        Land_in_Hectares:{
                            otherLandAttributesRequired:!0
                        },
                        land_address:{
                            otherLandAttributesRequired:!0
                        },
                         detail_of_leased_space_tehsil:{
                            otherLandAttributesRequired:!0
                        },
                         land_leased_disctric:{
                            otherLandAttributesRequired:!0
                        },
                        password: {
                            minlength: 5,
                            required: !0
                        },

                        rpassword: {
                            minlength: 5,
                            required: !0,
                            equalTo: "#submit_form_password"
                        },
                        fullname: {
                            required: !0
                        },
                        
                        phone: {
                            required: !0
                        },
                        gender: {
                            required: !0
                        },
                        address: {
                            required: !0
                        },
                        city: {
                            required: !0
                        },
                        country: {
                            required: !0
                        },
                        card_name: {
                            required: !0
                        },
                        card_number: {
                            minlength: 16,
                            maxlength: 16,
                            required: !0
                        },
                        card_cvc: {
                            digits: !0,
                            required: !0,
                            minlength: 3,
                            maxlength: 4
                        },
                        card_expiry_date: {
                            required: !0
                        },
                        "payment[]": {
                            required: !0,
                            minlength: 1
                        },
                        iAgree:{
                            required:!0,
                        },
                        edu_cert_qual:{
                            required:0,
                        },
                        edu_tech_qual:{
                            required:0,
                        },
                        cert_prof_exp:{
                            required:0,
                        },
                        cert_equity:{
                            required:0,
                        },
                        cert_unit_approv_sanct:{
                            required:0,
                        },
                        cert_project_cost:{
                            required:0,
                        },
                        cert_debt_cover_ratio:{
                            required:0,
                        },
                        cert_poll_cat:{
                            required:0,
                        },
                        cert_adpt_water_system:{
                            required:0,
                        },
                        cert_usage_local_materail:{
                            required:0,
                        },
                        cert_regist_startup:{
                            required:0,
                        },
                        cert_land_acquistion:{
                            required:0,
                        },
                        cert_enterprenure_type:{
                            required:0,
                        },
                        cert_unit_type:{
                            required:0,
                        },
                        cert_unit_benifited:{
                            required:0,
                        }
                    },
                    messages: {
                        "payment[]": {
                            required: "Please select at least one option",
                            minlength: jQuery.validator.format("Please select at least one option")
                        },
                        edu_tech_qual: {
                            required: "Please select a Membership type"
                        },
                    },
                    errorPlacement: function(e, r) {
                        "gender" == r.attr("name") ? e.insertAfter("#form_gender_error") : "payment[]" == r.attr("name") ? e.insertAfter("#form_payment_error") : e.insertAfter(r)
                    },
                    invalidHandler: function(e, r) {
                        i.hide(), t.show(), App.scrollTo(t, -200)
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                    success: function(e) {
                        "gender" == e.attr("for") || "payment[]" == e.attr("for") ? (e.closest(".form-group").removeClass("has-error").addClass("has-success"), e.remove()) : e.addClass("valid").closest(".form-group").removeClass("has-error").addClass("has-success")
                    },
                    submitHandler: function(e) {
                        i.show(), t.hide(), e[0].submit()
                    }
                });
                var a = function() {
                        $("#tab4 .form-control-static", r).each(function() {
                            var e = $('[name="' + $(this).attr("data-display") + '"]', r);
                            if (e.is(":radio") && (e = $('[name="' + $(this).attr("data-display") + '"]:checked', r)), e.is(":text") || e.is("textarea")) $(this).html(e.val());
                            else if (e.is("select")) $(this).html(e.find("option:selected").text());
                            else if (e.is(":radio") && e.is(":checked")) $(this).html(e.attr("data-title"));
                            else if ("payment[]" == $(this).attr("data-display")) {
                                var t = [];
                                $('[name="payment[]"]:checked', r).each(function() {
                                    t.push($(this).attr("data-title"))
                                }), $(this).html(t.join("<br>"))
                            }
                        })
                    },
                    o = function(e, r, t) {
                        var i = r.find("li").length,
                            o = t + 1;
                        $(".step-title", $("#form_wizard_1")).text("Step " + (t + 1) + " of " + i), jQuery("li", $("#form_wizard_1")).removeClass("done");
                        for (var n = r.find("li"), s = 0; t > s; s++) jQuery(n[s]).addClass("done");
                        1 == o ? $("#form_wizard_1").find(".button-previous").hide() : $("#form_wizard_1").find(".button-previous").show(), o >= i ? ($("#form_wizard_1").find(".button-next").hide(), $("#form_wizard_1").find(".button-submit").show(), a()) : ($("#form_wizard_1").find(".button-next").show(), $("#form_wizard_1").find(".button-submit").hide()), App.scrollTo($(".page-title"))
                    };
                $("#form_wizard_1").bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    onTabClick: function(e, r, t, i) {
                        return !1
                    },
                    onNext: function(e, a, n) {
                        var form_data = $('.caf_form_submission_wizard').serialize();
                        var post_url = $('#caf_form_url').val();

                        var postResult=ajaxPost(post_url,form_data);
                        if(!postResult){
                        	$('alert-message-error').html("Couldn't save your data. Please refresh your page before proceed.");
                        }
                        return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                    },
                    onPrevious: function(e, r, a) {
                        i.hide(), t.hide(), o(e, r, a)
                    },
                    onTabShow: function(e, r, t) {
                        var i = r.find("li").length,
                            a = t + 1,
                            o = a / i * 100;
                        $("#form_wizard_1").find(".progress-bar").css({
                            width: o + "%"
                        })
                    }
                }), $("#form_wizard_1").find(".button-previous").hide(), $("#form_wizard_1 .button-submit1").click(function() {
                    // start preloader
                    $( "#finalCAFSubmit" ).submit();
                    // alert("hope you like it :)");
                    
                }).hide(), $("#country_list", r).change(function() {
                    r.validate().element($(this))
                })
            }
        }
    }
}();
jQuery(document).ready(function() {
    FormWizard.init()
});