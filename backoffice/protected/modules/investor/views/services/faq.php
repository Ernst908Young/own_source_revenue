<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  border:1px solid #000;
  border-top:0;
}

.acr button:first-child{
  border-top:1px solid #000;
}

.active, .accordion:hover {
  background-color: #0f6fb5;
  color:#fff;
}

.accordion:after {
  content: '\002B';
  color: #ef7b20;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.accordion.active:after {
  content: "\2212";
}

.panel {
  padding: 5px 18px;
  background-color: white;
  display: none;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  border: 1px solid #44444454;
}
</style>
<title>FAQ's</title>
<div class="dashboard-home">
	<div class="applied-status"> 
	    <ul class="breadcrumb">
	        <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
	        <li>FAQ's</li>
	    </ul>

      <!--?php  Closeentity::parentfunction(); ?-->
	    <div class="row my-4 acr">
        
  
         

        
	    	
<button class="accordion acrdn1" onclick="maupulatiaccordian(1)">In how many locations online filing is available at NCLT?</button>
<div class="panel acrdnpanel1">
  <p style="text-align: justify;">Online filing facility is available at NCLT New Delhi location. The service will soon be rolled out for Mumbai location as well</p>
 
</div>

<button class="accordion acrdn2" onclick="maupulatiaccordian(2)">How will I know whether the submitted case has been listed in NCLT bench?</button>
<div class="panel acrdnpanel2">
  <p style="text-align: justify;">All the parties involved in a case who have registered themselves on https://efiling.nclt.gov.in get SMS/Email with listing date after causelists are finalized.</p>
  
</div>

<button class="accordion acrdn3" onclick="maupulatiaccordian(3)">What type of documents can be uploaded in eFiling software?</button>
<div class="panel acrdnpanel3">
  <p style="text-align: justify;">Only files with .pdf extension can be uploaded.</p>
</div>
<button class="accordion acrdn4" onclick="maupulatiaccordian(4)">Is there any restriction on the size and number of documents that can be uploaded?</button>
<div class="panel acrdnpanel4">
  <p style="text-align: justify;">There is no restriction on size and number of documents that can be filed under a single application/petition. However, the users are advised not to upload files with more than 20 Mb size scanned at 300 dpi or less to avoid application performance issues. If required, users can create multiple volumes of the application/petition and upload them one by one. </p>
</div>
<button class="accordion acrdn5" onclick="maupulatiaccordian(5)">How do I get started?</button>
<div class="panel acrdnpanel5">
   <p style="text-align: justify;">User is advised to go to the Help Center provided on the right hand side of home page of the website. The user can find supporting user manuals and videos on how to create a user and navigate the application.</p>
</div>
<button class="accordion acrdn6" onclick="maupulatiaccordian(6)">Whom should I reach out to in case of queries/issues?</button>
<div class="panel acrdnpanel6">
   <p style="text-align: justify;">User is advised to go to the Help Center provided on the right hand side of home page of the website. The user can find helpdesk contact details on the page under Suggestion & Feedback. Also, in case of any issues user can log an issue under Report an Issue link on Help Center page.</p>
</div>
<button class="accordion acrdn7" onclick="maupulatiaccordian(7)">Are there any prerequisites for filing application/petition online?</button>
<div class="panel acrdnpanel7">
   <p style="text-align: justify;">Users need to register with their authenticated email id and mobile numbers via OTP and need to upload a proof of identity for generating their login id and one time password.</p>
</div>
<button class="accordion acrdn8" onclick="maupulatiaccordian(8)">Do users need to submit anything offline as well?</button>
<div class="panel acrdnpanel8">
   <p style="text-align: justify;">Users need to submit two hard copy of the petition/application at NCLT counters. Also, users who have selected offline mode of payment need to submit the demand draft at NCLT counter.</p>
</div>
<button class="accordion acrdn9" onclick="maupulatiaccordian(9)">Can I make payment for filing any application/petition online?</button>
<div class="panel acrdnpanel9">
   <p style="text-align: justify;">User has the option of paying the application/petition fee both offline and online.In case of online payment user will be redirected to Bharatkosh portal for payment.</p>
</div>
<!-- <button class="accordion acrdn10" onclick="maupulatiaccordian(10)">I’ve signed up and logged in. Now what?</button>
<div class="panel acrdnpanel10">
   <p style="text-align: justify;">Congratulations, you have successfully signed up with us, and are ready to start your e-filing. You can select from the list of services on the left of the screen, and apply for whichever service you require. Note that only the services listed under “Name Related Services” and “Incorporation” are live in Phase 1. All other services are coming in Phase 2.</p>
</div>
<button class="accordion acrdn11" onclick="maupulatiaccordian(11)">Where can I find out more about the different processes relating to business names and companies?</button>
<div class="panel acrdnpanel11">
   <p style="text-align: justify;">Under the “Corporate Affairs” tab on our website, you can click any service/process, and find the Frequently Asked Questions related to that particular item.</p>
</div>
<button class="accordion acrdn12" onclick="maupulatiaccordian(12)">Where can I report bugs or errors with the new system?</button>
<div class="panel acrdnpanel12">
  <p>Once logged in you can use the Ticket/Query link to raise any issues with us.</p>
</div> -->
<script>
	function maupulatiaccordian(i){
		$(".accordion").removeClass("active");
		$(".panel").attr("style","display:none;");

		$(".acrdn"+i).addClass("active");
		$(".acrdnpanel"+i).attr("style","display:block;");

	
	}
</script>
	    </div>
    </div>
</div>