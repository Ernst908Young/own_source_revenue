<script type = "text/javascript" >



    $(document).ready(function() {


        $("#UK-FCL-00096_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00310_0").val('');
                $("#UK-FCL-00310_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00310_0").attr('readonly', false);
            }
            $("#UK-FCL-00372_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00372_0").html(result);

                }
            });
        });


        // form 4 auto populate 


        $("#UK-FCL-00344_0").attr('readonly', true);

        $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");

        $("#div_UK-FCL-00316_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00316_0' name='middlenamecheckbox00316_0'> I do not have a middle name or middle initial</div>");

        $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00133_0' name='middlenamecheckbox00133_0'> I do not have a middle name or middle initial</div>");
        $("#div_UK-FCL-00466_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00466_0' name='middlenamecheckbox00466_0'> I do not have a middle name or middle initial</div>");


        if ($("#UK-FCL-00132_0").val() != '' && $("#UK-FCL-00105_0").val() == '') {
            $("input[name=middlenamecheckbox00105_0]").prop('checked', true);
            $("#UK-FCL-00105_0").attr('readonly', true);
        }

        if ($("#UK-FCL-00150_0").val() != '' && $("#UK-FCL-00133_0").val() == '') {
            $("input[name=middlenamecheckbox00133_0]").prop('checked', true);
            $("#UK-FCL-00133_0").attr('readonly', true);
        }
        if ($("#UK-FCL-00172_0").val() != '' && $("#UK-FCL-00316_0").val() == '') {
            $("input[name=middlenamecheckbox00316_0]").prop('checked', true);
            $("#UK-FCL-00316_0").attr('readonly', true);
        }
        if ($("#UK-FCL-00301_0").val() != '' && $("#UK-FCL-00466_0").val() == '') {
            $("input[name=middlenamecheckbox00466_0]").prop('checked', true);
            $("#UK-FCL-00466_0").attr('readonly', true);
        }




        $("#UK-FCL-00520_0, #UK-FCL-00347_0, #UK-FCL-00530_0, #UK-FCL-00395_0, #UK-FCL-00357_0").attr('readonly', true);

        $("#UK-FCL-00290_0").on("blur", function() {
            var reg_no = $(this).val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/backoffice/infowizardtwo/subFormArticlesofRevivalform11/getsocietyNameByregno/reg_no/" + reg_no,
                beforeSend: function() {
                    $("#UK-FCL-00290_0-error").text("Please wait...");
                },
                success: function(result) {
                    if (result.status == true) {
                        $("#UK-FCL-00290_0-error").text("");
                        $("#UK-FCL-00520_0").val(result.cname);

                    } else {
                        $("#UK-FCL-00290_0-error").text(result.msg);
                        $("#UK-FCL-00520_0").val("");
                    }
                    console.log(result);
                }
            });
        });

        //form 15 srn start
        $("#UK-FCL-00647_0").on("blur", function() {
            var srn_no = $(this).val();
            getcomapnyname(srn_no);

        });
        $("#UK-FCL-00648_0").attr('readonly', true);

        function getcomapnyname(srn_no) {
            if (srn_no != "") {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "/backoffice/infowizardtwo/subFormArticlesofRevivalform11/getCompanyNameBySrnNo/srn_no/" + srn_no + "/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
                    beforeSend: function() {
                        $("#UK-FCL-00647_0-error").text("Please wait...");
                    },
                    success: function(result) {
                        if (result.status == true) {
                            if (result.app_status == 'valid') {
                                $("#UK-FCL-00648_0").val(result.name);
                                $("#UK-FCL-00647_0-error").html("");

                            } else {
                                $("#UK-FCL-00647_0-error").text(result.msg);

                            }
                        } else {
                            if (result.user) {
                                $("#UK-FCL-00647_0-error").text(result.msg);

                            } else {
                                //alert(result.msg);
                            }
                        }
                        //  console.log(result);
                    }
                });
            }
        }




        // form 15 srn end

        // $("#UK-FCL-00399_0").attr('readonly',true);
        $("#label_UK-FCL-00002_0, #label_UK-FCL-00004_0, #label_UK-FCL-00011_0, #label_UK-FCL-00007_0, #label_UK-FCL-00523_0").find('b').after('<span style="color:red;"> * </span>');

        $('#UK-FCL-00002_0, #UK-FCL-00003_0, #UK-FCL-00004_0, #UK-FCL-00011_0, #UK-FCL-00327_0, #UK-FCL-00010_0, #UK-FCL-00328_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        $("#div_UK-FCL-00003_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

        $("input[name=middlenamecheckbox]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00003_0").val("");
                $("#UK-FCL-00003_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00003_0").attr('readonly', false);
            }
        });




        //form 2 validation
        $("#UK-FCL-00347_0, #UK-FCL-00530_0").val("BARBADOS");
        $('#UK-FCL-00340_0, #UK-FCL-00341_0, #UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00350_0, #UK-FCL-00528_0, #UK-FCL-00529_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });



        $("#UK-FCL-00345_0").on("change", function() {
            $("#UK-FCL-00345_0-error").empty();
            $("#div_UK-FCL-00345_0").removeClass("has-error");
        })

        $("#UK-FCL-00351_0").on("change", function() {
            $("#UK-FCL-00351_0-error").empty();
            $("#div_UK-FCL-00351_0").removeClass("has-error");
        })
        $("#UK-FCL-00349_0").on("change", function() {
            $("#UK-FCL-00349_0-error").empty();
            $("#div_UK-FCL-00349_0").removeClass("has-error");
        })
        $("#UK-FCL-00531_0").on("change", function() {
            $("#UK-FCL-00531_0-error").empty();
            $("#div_UK-FCL-00531_0").removeClass("has-error");
        })
        $("#UK-FCL-00012_0").on("change", function() {
            $("#UK-FCL-00012_0-error").empty();
            $("#div_UK-FCL-00012_0").removeClass("has-error");
        })

        $("#UK-FCL-00096_0").on("change", function() {
            $("#UK-FCL-00096_0-error").empty();
            $("#div_UK-FCL-00096_0").removeClass("has-error");
        })
        $("#UK-FCL-00129_0").on("change", function() {
            $("#UK-FCL-00129_0-error").empty();
            $("#div_UK-FCL-00129_0").removeClass("has-error");
        })
        $("#UK-FCL-00384_0").on("change", function() {
            $("#UK-FCL-00384_0-error").empty();
            $("#div_UK-FCL-00384_0").removeClass("has-error");
        })
        $("#UK-FCL-00534_0").on("change", function() {
            $("#UK-FCL-00534_0-error").empty();
            $("#div_UK-FCL-00534_0").removeClass("has-error");
        })
        $("#UK-FCL-00295_0").on("change", function() {
            $("#UK-FCL-00295_0-error").empty();
            $("#div_UK-FCL-00295_0").removeClass("has-error");
        })
        $("#UK-FCL-00372_0").on("change", function() {
            $("#UK-FCL-00372_0-error").empty();
            $("#div_UK-FCL-00372_0").removeClass("has-error");
        })
        $("#UK-FCL-00533_0").on("change", function() {
            $("#UK-FCL-00533_0-error").empty();
            $("#div_UK-FCL-00533_0").removeClass("has-error");
        })
        $("#UK-FCL-00395_0").on("change", function() {
            $("#UK-FCL-00395_0-error").empty();
            $("#div_UK-FCL-00395_0").removeClass("has-error");
        })
        $("#UK-FCL-00355_0").on("change", function() {
            $("#UK-FCL-00355_0-error").empty();
            $("#div_UK-FCL-00355_0").removeClass("has-error");
        })




        $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");

        $("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>Mailing Address:</strong></div>").insertBefore("#div_UK-FCL-00342_0");

        $("<div class='col-md-12' id='form2preaddtitle' style='margin-top:10px;'><strong>The details of the managers of the society as of this date are:</strong></div>").insertBefore("#div_UK-FCL-00132_0");



        var val12d = $("#UK-FCL-00012_0").val();
        if (val12d == 'Notice of Address') {
            showregis();
            showmail();
            hidepre();
        }
        if (val12d == 'Notice of change in registered office address') {
            showregis();
            hidemail();
            showpre();
        }
        if (val12d == 'Notice of change in mailing address') {
            hideregis();
            showmail();
            hidepre();
        }
        if (val12d == 'Notice of change in registered office address and mailing address') {
            showregis();
            showmail();
            showpre();
        }

        $("#UK-FCL-00012_0").on("change", function() {
            var val12 = $(this).val();
            if (val12 == 'Notice of Address') {
                showregis();
                showmail();
                hidepre();
            }
            if (val12 == 'Notice of change in registered office address') {
                showregis();
                hidemail();
                showpre();
            }
            if (val12 == 'Notice of change in mailing address') {
                hideregis();
                showmail();
                hidepre();
            }
            if (val12 == 'Notice of change in registered office address and mailing address') {
                showregis();
                showmail();
                showpre();
            }
        });

        // form 3 validation
        /*
        $("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>The details of the managers of the society as of this date are:</strong></div>").insertBefore("#UK-FCL-00132_0"); */




        // parish and postal code dependency



        $('#UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00238_0, #UK-FCL-00310_0, #UK-FCL-00094_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        $('#UK-FCL-00150_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00104_0, #UK-FCL-00309_0, #UK-FCL-00336_0, #UK-FCL-00242_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        $('#UK-FCL-00172_0, #UK-FCL-00316_0, #UK-FCL-00419_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00354_0, #UK-FCL-00356_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        var val533d = $("#UK-FCL-00533_0").val();
        if (val533d == 'Notice of Manager(s)') {
            $("#div_UK-FCL-00395_0").hide();
            hideappoint();
            hidecess();
            showpresent();
        }

        if (val533d == 'Notice of Change (Appointment of Manager(s))') {
            $("#div_UK-FCL-00395_0").show();
            showappoint();
            hidecess();
            showpresent();
        }
        if (val533d == 'Notice of Change (Cessation of Manager(s))') {
            $("#div_UK-FCL-00395_0").show();
            hideappoint();
            showcess();
            showpresent();
        }
        if (val533d == 'Notice of Change (Appointment and Cessation of Manager(s))') {
            $("#div_UK-FCL-00395_0").show();
            showappoint();
            showcess();
            showpresent();
        }

        $("#UK-FCL-00533_0").on("change", function() {
            var val533 = $(this).val();

            if (val533 == 'Notice of Manager(s)') {
                $("#div_UK-FCL-00395_0").hide();
                hideappoint();
                hidecess();
                showpresent();
            }

            if (val533 == 'Notice of Change (Appointment of Manager(s))') {
                $("#div_UK-FCL-00395_0").show();
                showappoint();
                hidecess();
                showpresent();
            }
            if (val533 == 'Notice of Change (Cessation of Manager(s))') {
                $("#div_UK-FCL-00395_0").show();
                hideappoint();
                showcess();
                showpresent();
            }
            if (val533 == 'Notice of Change (Appointment and Cessation of Manager(s))') {
                $("#div_UK-FCL-00395_0").show();
                showappoint();
                showcess();
                showpresent();
            }

        });

        ////middle name validation of filed UK-FCL-00105_0 on form 3
        /*var ff105 = $("#UK-FCL-00105_0").val();
        if(ff105==''){
        	$("#UK-FCL-00105_0").attr('readonly',true);
        	$("input[name=middlenamecheckbox00105_0]").prop('checked', true);
        }*/

        $("#UK-FCL-00105_0").blur(function() {
            if ($(this).val()) {
                $("input[name=middlenamecheckbox00105_0]").prop('checked', false);
            }
        });
        $("input[name=middlenamecheckbox00105_0]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00105_0").val("");
                $("#UK-FCL-00105_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00105_0").attr('readonly', false);
            }
        }); // end 

        ////middle name validation of filed UK-FCL-00133_0 on form 3
        /*var ff133 = $("#UK-FCL-00133_0").val();
        if(ff133==''){
        	$("#UK-FCL-00133_0").attr('readonly',true);
        	$("input[name=middlenamecheckbox00133_0]").prop('checked', true);
        }*/
        $("#UK-FCL-00133_0").blur(function() {
            if ($(this).val()) {
                $("input[name=middlenamecheckbox00133_0]").prop('checked', false);
            }
        });
        $("input[name=middlenamecheckbox00133_0]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00133_0").val("");
                $("#UK-FCL-00133_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00133_0").attr('readonly', false);
            }
        }); // end 

        ////middle name validation of filed UK-FCL-00316_0 on form 3
        /*var ff316 = $("#UK-FCL-00316_0").val();
        if(ff316==''){
        	$("#UK-FCL-00316_0").attr('readonly',true);
        	$("input[name=middlenamecheckbox00316_0]").prop('checked', true);
        }*/
        $("#UK-FCL-00316_0").blur(function() {
            if ($(this).val()) {
                $("input[name=middlenamecheckbox00316_0]").prop('checked', false);
            }
        });
        $("input[name=middlenamecheckbox00316_0]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00316_0").val("");
                $("#UK-FCL-00316_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00316_0").attr('readonly', false);
            }
        }); // end 


        //form 4 validation
        $("#UK-FCL-00357_0").val("BARBADOS");
        $('#UK-FCL-00301_0, #UK-FCL-00466_0, #UK-FCL-00324_0, #UK-FCL-00169_0, #UK-FCL-00353_0, #UK-FCL-00399_0').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        /*var ff466 = $("#UK-FCL-00466_0").val();
        if(ff466==''){
        	$("#UK-FCL-00466_0").attr('readonly',true);
        	$("input[name=middlenamecheckbox00466_0]").prop('checked', true);
        }*/
        $("#UK-FCL-00466_0").blur(function() {
            if ($(this).val()) {
                $("input[name=middlenamecheckbox00466_0]").prop('checked', false);
            }
        });
        $("input[name=middlenamecheckbox00466_0]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00466_0").val("");
                $("#UK-FCL-00466_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00466_0").attr('readonly', false);
            }
        }); // end 

        // parish and postal code dependency
        $("#UK-FCL-00345_0").on("change", function() {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                    beforeSend: function() {
                        $("#UK-FCL-00345_0-error").text("Please Wait...");
                        $("#UK-FCL-00346_0").html("");
                    },
                    success: function(result) {
                        $("#UK-FCL-00345_0-error").text("");
                        $("#UK-FCL-00346_0").html(result);
                    }
                });
            }
        });

        // parish and postal code dependency
        $("#UK-FCL-00531_0").on("change", function() {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                    beforeSend: function() {
                        $("#UK-FCL-00531_0-error").text("Please Wait...");
                        $("#UK-FCL-00532_0").html("");
                    },
                    success: function(result) {
                        $("#UK-FCL-00531_0-error").text("");
                        $("#UK-FCL-00532_0").html(result);
                    }
                });
            }
        });
        // parish and postal code dependency
        $("#UK-FCL-00355_0").on("change", function() {
            if ($(this).val()) {
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                    beforeSend: function() {
                        $("#UK-FCL-00355_0-error").text("Please Wait...");
                        $("#UK-FCL-00460_0").html("");
                    },
                    success: function(result) {
                        $("#UK-FCL-00355_0-error").text("");
                        $("#UK-FCL-00460_0").html(result);
                    }
                });
            }
        });


        // country and state/parish code dependency
        $("#UK-FCL-00007_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00010_0").val('');
                $("#UK-FCL-00010_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00010_0").attr('readonly', false);
            }
            $("#UK-FCL-00523_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00523_0").html(result);

                }
            });
        });

        // country and state/parish code dependency
        $("#UK-FCL-00351_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00348_0").val('');
                $("#UK-FCL-00348_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00348_0").attr('readonly', false);
            }

            $("#UK-FCL-00349_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00349_0").html(result);

                }
            });
        });


        // country and state/parish code dependency
        $("#UK-FCL-00096_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00310_0").val('');
                $("#UK-FCL-00310_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00310_0").attr('readonly', false);
            }
            $("#UK-FCL-00129_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00129_0").html(result);

                }
            });
        });

        // country and state/parish code dependency
        $("#UK-FCL-00384_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00336_0").val('');
                $("#UK-FCL-00336_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00336_0").attr('readonly', false);
            }
            $("#UK-FCL-00534_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00534_0").html(result);

                }
            });
        });

        // country and state/parish code dependency
        $("#UK-FCL-00295_0").on('change', function() {
            var countryCode = $(this).val();
            if (countryCode == 829) {
                $("#UK-FCL-00354_0").val('');
                $("#UK-FCL-00354_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00354_0").attr('readonly', false);
            }
            $("#UK-FCL-00372_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00372_0").html(result);

                }
            });
        });

        $("#UK-FCL-00096_0").on('change', function() {
            var countryCode = $(this).val();
            $("#UK-FCL-00372_0").select2("val", "");
            $.ajax({
                type: "POST",
                url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
                success: function(result) {
                    $("#UK-FCL-00372_0").html(result);

                }
            });
        });




        checksubmitbutton();



    });

function checksubmitbutton() {
    var ff00525_0 = $('input[name=UK-FCL-00525_0]:checked').val();
    var ff00526_0 = $('input[name=UK-FCL-00526_0]:checked').val();
    var ff00527_0 = $('input[name=UK-FCL-00527_0]:checked').val();

    if (ff00525_0 == 'No' && ff00526_0 == 'No' && ff00527_0 == 'No') {
        sshn();
    } else {
        hssn();
    }
}

function hssn() {
    $(".submitForm").attr("style", 'display:none !important;');
    $(".next_btn").attr("style", 'display:inline-block !important;');
}

function sshn() {
    $(".submitForm").attr("style", 'display:inline-block !important;');
    $(".next_btn").attr("style", 'display:none !important;');
}
//form 2 function hide show
function showregis() {
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").show();
}

function hideregis() {
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").hide();
}

function showmail() {
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").show();
}

function hidemail() {
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").hide();
}

function showpre() {
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").show();
}

function hidepre() {
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").hide();
}

//form 3 functions hide show

/*middlenamecheckbox00133_0_div
middlenamecheckbox00316_0_div*/
function showappoint() {
    /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").show();*/
    //$("#title_UK-FCL-00132_0").closest("div.form-part").show();
}

function hideappoint() {
    /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").hide();*/
    //$("#title_UK-FCL-00132_0").closest("div.form-part").hide();
}

function showcess() {
    $("#title_UK-FCL-00150_0").closest("div.form-part").show();
}

function hidecess() {
    $("#title_UK-FCL-00150_0").closest("div.form-part").hide();
}

function showpresent() {
    $("#title_UK-FCL-00172_0").closest("div.form-part").show();
}

function hidepresent() {
    $("#title_UK-FCL-00172_0").closest("div.form-part").hide();
}




function addmoreaction(id, service_id, div_id) {


    $.ajax({
        type: "GET",
        dataType: 'json',
        data: {
            "button_id": id,
            "service_id": service_id,
            "add_more_button_di": div_id
        },
        url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMaster/getAddmoreData",
        success: function(data) {
            console.log(data);
            var tr_ = "<tr class='add_more_" + div_id + "'>";
            var td_ = '';
            var err = 0;
            var fieldsIDArr = new Array();
            $.each(data, function(key, item) {
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
                        var getSelectedValue = document.querySelector('input[name="' + formchk_id + '"]:checked');
                        if (getSelectedValue != null) {
                            vall = getSelectedValue.value
                        } else {
                            vall = '';
                        }

                        typeVal = 'radio';
                        $("input:radio[name='" + formchk_id + "']").addClass('val');
                        if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
                            cls = 'val';
                        }
                    } else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
                        vall = $("input[name='" + formchk_id + "']").val();
                        typeVal = 'number';
                        $("input[name='" + formchk_id + "']").addClass('val');
                        if ($("input[name='" + formchk_id + "']").hasClass('val')) {
                            cls = 'val';
                        }
                    } else {
                        vall = $("input[name='" + formchk_id + "']").val();
                        typeVal = 'text';
                        $("input:text[name='" + formchk_id + "']").addClass('val');
                        if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
                            cls = 'val';
                        }

                    }
                } else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {
                    if ($('#' + formchk_id).prop('multiple')) {
                        typeVal = 'multiple';
                        var selMulti = $.map($("#" + formchk_id + " option:selected"), function(el, i) {
                            return $(el).text();
                        });
                        vall = selMulti.join(", ");
                        $('#' + formchk_id).addClass('val');
                        if ($('#' + formchk_id).hasClass('val')) {
                            cls = 'val';
                        }
                        $("#" + formchk_id + " option").removeAttr("selected");
                    } else {
                        typeVal = 'dropdown';
                        vall = $("select[name='" + formchk_id + "'] option:selected").text();
                        $("select[name='" + formchk_id + "']").addClass('val');
                        if ($("select[name='" + formchk_id + "']").hasClass('val')) {
                            cls = 'val';
                        }
                        $("#" + formchk_id + " option").removeAttr("selected");
                    }
                } else if ($(selector).is("textarea")) {
                    typeVal = 'textarea';
                    vall = $("textarea[name='" + formchk_id + "']").val();
                    $("textarea[name='" + formchk_id + "']").addClass('val');
                    if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
                        cls = 'val';
                    }
                } else if ($('.chk_' + formchk_id).is(':checkbox')) {
                    typeVal = 'checkbox';
                    vall = $('.chk_' + formchk_id + ':checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    $('.chk_' + formchk_id).addClass('val');
                    if ($('.chk_' + formchk_id).hasClass('val')) {
                        cls = 'val';
                    }
                }

                if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
                    $(".form-control-feedback-addmore").remove();
                    if (div_id == 2433) {
                        if (formchk_id == 'UK-FCL-00003_0') {
                            var mnt = $("#UK-FCL-00003_0").val();
                            if (mnt) {
                                var checkfield = true;
                            } else {
                                var mncb = $('input[name=middlenamecheckbox]:checked').val();
                                if (mncb) {
                                    var checkfield = true;
                                } else {
                                    var checkfield = false;
                                }
                            }
                        } else {
                            var checkfield = true;
                        }

                        if (formchk_id == 'UK-FCL-00002_0' || checkfield == false || formchk_id == 'UK-FCL-00004_0' || formchk_id == 'UK-FCL-00011_0' || formchk_id == 'UK-FCL-00007_0' || formchk_id == 'UK-FCL-00523_0') {

                            var labelData = $("#label_" + formchk_id).text();

                            labelData = labelData.replace('(' + formchk_id + ')', "");
                            //alert(formchk_id);
                            if (formchk_id == "UK-FCL-00003_0") {
                                $("#input_" + formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                            } else {

                                $("#input_" + formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");

                            }

                            err = err + 1;
                            return false;
                        } else {
                            $(".form-control-feedback-addmore").remove();
                            /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                            	if(vall==""){
                            		vall = 'NA';
                            	}
                            }*/
                            td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="' + vall + '"  readonly/></td>';
                            fieldsIDArr.push(formchk_id);
                        }
                    } else if (div_id == 4135) {
                        if (formchk_id == 'UK-FCL-00105_0') {
                            var mnt = $("#UK-FCL-00105_0").val();
                            if (mnt) {
                                var checkfield = true;
                            } else {
                                var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val();
                                if (mncb) {
                                    var checkfield = true;
                                } else {
                                    var checkfield = false;
                                }
                            }
                        } else {
                            var checkfield = true;
                        }


                        if (formchk_id == 'UK-FCL-00132_0' || checkfield == false || formchk_id == 'UK-FCL-00324_0' || formchk_id == 'UK-FCL-00093_0' || formchk_id == 'UK-FCL-00096_0' || formchk_id == 'UK-FCL-00372_0' || formchk_id == 'UK-FCL-00137_0') {


                            var labelData = $("#label_" + formchk_id).text();

                            labelData = labelData.replace('(' + formchk_id + ')', "");
                            //alert(formchk_id);
                            if (formchk_id == "UK-FCL-00105_0") {
                                $("#input_" + formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                            } else {

                                $("#input_" + formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");

                            }

                            err = err + 1;
                            return false;
                        } else {
                            $(".form-control-feedback-addmore").remove();
                            /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                                if(vall==""){
                                    vall = 'NA';
                                }
                            }*/
                            td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="' + vall + '"  readonly/></td>';
                            fieldsIDArr.push(formchk_id);
                        }
                    }

                } else {
                    $(".form-control-feedback-addmore").remove();
                    //console.log(typeVal);
                    td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="' + vall + '"  readonly/></td>';
                	fieldsIDArr.push(formchk_id);
                }

            });
            if (err == 0) {
                // alert(JSON.stringify(fieldsIDArr));
                if (confirm('Before adding, please check whether the details entered is correct.')) {
                    $('#add_more_' + div_id).show();
                    $('#tbl_' + div_id).show();
                    td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_" + div_id + "'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                    tr_ += td_ + "</tr>";
                    $(tr_).appendTo($('#tbl_' + div_id));
                    // alert(fieldsIDArr);
                    fieldsIDArr.forEach(myFunction);

                    function myFunction(value, index, array) {
                    	console.log($('#' + value));
                        $("input:radio[name='" + value + "']").prop('checked', false);
                        $('#' + value).val("");
                        $("#" + value + "").select2("val", "");
                        $('.chk_' + value + ':checked').removeAttr('checked');
                    }
                    $("input[name=middlenamecheckbox]").prop('checked', false);
                    $("#UK-FCL-00133_0").attr('readonly', false);
                }
            } else
                return false;

            $('.del_1').on('click', function() {
                $(this).closest('tr').remove();
                var uio = $(this).attr('pi');
                if ($("." + uio).length < 2) {
                    $("#" + uio).css('display', 'none');
                }

            });
        } // success function close here
    }); //ajax end here
}


</script>