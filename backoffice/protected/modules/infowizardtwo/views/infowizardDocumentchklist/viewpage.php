<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function change(){ //alert(document.getElementById('proServices').value);
   if(document.getElementById('proServices').value =='Yes') 
	 {
	document.getElementById('RFO1').style.display='block';
	document.getElementById('RFO2').style.display='block';
	}
	 else if(document.getElementById('proServices').value =='No')  
	 {
	document.getElementById('RFO2').style.display='none';
	document.getElementById('RFO1').style.display='none';
	}
}
</script>
<style>
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<body>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Form Design</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">
 <form>
 <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label>Name of the Service</label></div>
	<div class="col-md-8"><input type="text" name="firstname">
	</div>
 </div >
 <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label >Incidence of the Service</label></div>
	<div class="col-md-8"><input type="checkbox" name="vehicle1" value="Bike"> Pre-Establishment
                          <input type="checkbox" name="vehicle2" value="Car"> Pre-Operations
						  <input type="checkbox" name="vehicle2" value="Car"> Post-Operations
	</div>
 </div>
  <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label >Which sectors does the service relate to ?</label></div>
	<div class="col-md-8"><div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Select an option</option>
      </select>
    </div>
    <div id="checkboxes">
        <input type="checkbox" id="1" />All Sectors<br />
        <input type="checkbox" id="2" />Mining<br />
        <input type="checkbox" id="3" />Agriculture<br />
        <input type="checkbox" id="4" />Food Processing<br />
    </div>
  </div>
	</div>
 </div>
  <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label>Type of Service</label></div>
	<div class="col-md-8">
	   <select><option value="">Select an option</option>
	   <option value="Approval">Approval</option>
	   <option value="Certificates">Certificates</option>
	   <option value="Intimation">Intimation</option>
	   <option value="License">License</option>
	   <option value="Permission">Permission</option>
	    <option value="Permit">Permit</option>
		 <option value="Registration">Registration</option>
      </select>
	</div>
 </div>
 <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label>Additional Sub-Services</label></div>
       <div class="col-md-8">
	   <select multiple="multiple"><option value=""><----Select----></option>
	   <option value="Amendment including cancellation">Amendment including cancellation</option>
	   <option value="Surrender">Surrender</option>
	   <option value="Transfer">Transfer</option>
	   <option value="Duplicate Copy">Duplicate Copy</option>
	   <option value="Renewal">Renewal</option>
	    <option value="Return">Return</option>
		 <option value="Maintenance of Register">Maintenance of Register</option>
      </select>
	</div>
 </div>
 <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4">
	<label>Requires Services of Professionals</label></div>
	<div class="col-md-8">
	   <select id="proServices" onchange="change()"><option value=""><----Select----></option>
	   <option value="Yes">Yes</option>
	   <option value="No">No</option>
      </select>
	</div>
 </div>
 <br />
  <div class="row" class="col-md-12">
	<div class="col-md-4" id="RFO1" style="display:none;">
	<label>Please list the Professionals</label></div>
	<div class="col-md-8" id="RFO2" style="display:none;">
	   <select id="proServices" multiple="multiple"><option value=""><----Select----></option>
	   <option value="Chartered Accountant">Chartered Accountant</option>
	   <option value="Architect">Architect</option>
	   <option value="Structural Engineer">Structural Engineer</option>
	   <option value="Draftsman">Draftsman</option>
      </select>
	</div>
 </div>
</form> 	
</div></div></div>
</body>
</html>
