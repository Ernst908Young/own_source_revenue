<style type="text/css">
   .comment_section{
   display: inline;
   background: #ddd;
   color:red;
   resize: none;
   padding: 5px 15px 5px 15px;
   }
   .apprvr_comments{
   display: inline;
   background: #F7F7F7;
   color:#222;
   resize: none;
   padding: 5px 15px 5px 15px;  
   }
   div.heading{
   background-color: #006699;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   font-weight: bold;
   }
   .control-label{
   font-size: 0.9em;
   font-weight: 800;
   height: 20px;
   text-align: left;
   }
   ::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
   ::-moz-placeholder { font-size:.9em; font-weight: bold}
   :-ms-input-placeholder { font-size:.9em; font-weight: bold}
   input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>
<div class="panel-body">
   <div class="row">&nbsp;</div>
   <table cellpadding="1" border="1" cellspacing="1">
      <tr>
         <td><b>SNo</b></td>
         <td><b>IUID</b></td>
         <td><b>Full Name</b></td>
         <td colspan="2"><b>Email Id</b></td>
         <td><b>Mobile Number</b></td>
          <td><b>PAN No.</b></td>
         <td><b>Aadhar Card</b></td>
         <td><b>Country</b></td>
         <td><b>State</b></td>
         <td><b>City</b></td>
         <td><b>District</b></td>
         <td><b>Postal Code</b></td>
         <td colspan="2"><b>Address</b></td>
         <td><b>Registeration Date</b></td>
         <td><b>Status</b></td>
      </tr>
      <?php
         $count=1;
         foreach ($data as $key => $userData) {
            $CountryName=LandregionExt::getLandRegionNameViaId($userData->country_name);
            $stateName=LandregionExt::getLandRegionNameViaId($userData->state_name);
            $status='';
            if($userData->is_account_active=='Y')
               $status="Active";
            else
               $status="Inactive";
            echo "<tr>
            <td>".$count++."</td><td>".$userData->iuid."</td><td>". $userData->first_name." ".$userData->last_name."</td>";
            ?>
              <td colspan="2">
            <?php
             echo $userData->email."</td><td>". $userData->mobile_number."</td><td>". $userData->pan_card."</td><td>". $userData->adhaar_number."</td><td>". $CountryName."</td><td>". $stateName."</td><td>". $userData->city_name."</td><td>". $userData->distt_name."</td><td>". $userData->pin_code."</td>";
            ?>
            <td colspan="2">
            <?php
             echo $userData->address."</td><td>". $userData->created_on."</td><td>". $status."</td>
            </tr>";
            
         }
      ?>
   </table>
   </div>