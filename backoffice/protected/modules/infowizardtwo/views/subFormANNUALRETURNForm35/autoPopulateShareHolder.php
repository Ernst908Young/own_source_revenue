
      <?php
      //ic
         if(isset($fieldValue['UK-FCL-00263_0'])){
            echo '<strong>Authorised Share Capital/Quota:</strong>
               <table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_2912">
                  <thead>
                     <tr class="add_more_2912">
                        <th><b class="ukfcl" style="display:none;" title="3843"> </b> Class of Shares/Quotas </th>
                        <th><b class="ukfcl" style="display:none;" title="3844"> </b>Number of Shares/Quotas in each class</th>
                     </tr>
                  </thead>
                  <tbody>';
            foreach ($fieldValue['UK-FCL-00263_0'] as $key => $flieldVal) {
               echo '<tr class="add_more_2912">
                     <td><input type="text" name="UK-FCL-00643_0[]" value="'.@$fieldValue['UK-FCL-00263_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00263_0'][$key].'" '. (empty($fieldValue['UK-FCL-00263_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00644_0[]" value="'.@$fieldValue['UK-FCL-00264_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00264_0'][$key].'" '. (empty($fieldValue['UK-FCL-00264_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     
                  </tr>';
            }
            echo '
                  </tbody>
               </table>
                  
                
            ';
         }
         //s
        else if(isset($fieldValue['UK-FCL-00368_0'])){
         echo '<strong>Authorised Share Capital/Quota:</strong>
            <table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_2912">
               <thead>
                  <tr class="add_more_2912">
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b> Class of Shares/Quotas </th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Number of Shares/Quotas in each class</th>
                  </tr>
               </thead>
               <tbody>';
            foreach ($fieldValue['UK-FCL-00368_0'] as $key => $flieldVal) {
               echo '<tr class="add_more_2912">
                     <td><input type="text" name="UK-FCL-00643_0[]" value="'.@$fieldValue['UK-FCL-00368_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00368_0'][$key].'" '. (empty($fieldValue['UK-FCL-00368_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00644_0[]" value="'.@$fieldValue['UK-FCL-00369_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00369_0'][$key].'" '. (empty($fieldValue['UK-FCL-00369_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     
                  </tr>';
            }
            echo '
                  </tbody>
               </table>
                  
                
            ';
         }
         else
            //npc
            echo 'npc';
         
      ?>