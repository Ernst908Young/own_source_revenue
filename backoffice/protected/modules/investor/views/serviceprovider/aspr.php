<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)</li>
    </ul>
  </div>
<div class="reservation-form">  
      <div class="form-part bussiness-det">   
        <h4 class="form-heading">Further Action</h4>
        <div class="form-row">
            <div class="form-group rbcb-group">
              <label>Please select any of the following options
               <span style="color: red;">*</span>
              </label><br>
           
           
               <input name="at_ch_box" type="radio"  class="chk_sp" value="Change of CTSP/CR" labelname="sp1" required >&nbsp;
                <span class="rc_label">Change of CTSP/CR</span>       
                <br>
                  <input name="at_ch_box" type="radio" value="Change at a later stage" class="chk_sp"
                    labelname="sp2" required >&nbsp;
                   <span class="rc_label">Change at a later stage</span>
                   <br>        
          </div>
       </div>
   </div>
</div>
</div>

<script type="text/javascript">
	 $(document).ready(function () { 
		  $("input[name=at_ch_box]").on("change",function(){     
		      if($(this).val()=='Change of CTSP/CR'){        
		         window.location.href = "/backoffice/investor/serviceprovider/observiceprovider/obsp/1"; 
		      }else{       
		         window.location.href = "/backoffice/investor/home/investorWalkthrough"; 
		      }   
		  });
	  });	  
</script>