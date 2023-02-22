<style>
	table, td {
  border: .5px solid black;
     border-collapse: collapse;
  padding: 5px;
}
</style>

<?php if($category=='entities'){ ?>
   <table>
      <tr>
         <td>Total no. of Registered Entities</td>
         <td>Total No. of Active Entities</td>
         <td>Total No. of Dissolved Entities</td>
         <td>Total No. of Amalgamated Entities</td>
         <td>Total No. of Closed Entities</td>
         
      </tr>
      <tr>
         <td><strong><?php $total = $data_array['active_entity']['count']+$data_array['dissolved_entity']['count']+$data_array['amalgamated_entity']['count']+$data_array['closed_entity']['count'];
                         echo $total ?></strong></td>
         <td><strong><?= $data_array['active_entity']['count'] ?></strong></td>
         <td><strong> <?= $data_array['dissolved_entity']['count'] ?></strong></td>
         <td><strong><?= $data_array['amalgamated_entity']['count'] ?></strong></td>
         <td><strong><?= $data_array['closed_entity']['count'] ?></strong></td>
         
      </tr>
   </table>
<?php } ?>

<?php 

if($category=='helpdesk'){ ?>
   <table>
      <tr>
         <td>Total No. <?= $sub_category ?></td>
         <td>Total No. of Open</td>
         <td>Total No. of Resolved/Closed</td>
          <?php if($sub_category!='queries'){ ?>
            <td>Total of Reverted</td>
            <td>Total No. of Re-opened</td>
            <td>Total No. of Escalated</td>
          <?php } ?>
      </tr>
      <tr>
         <td><strong><?= $data_array['count'] ?></strong></td>
         <td><strong><?= $data_array['open'] ?></strong></td>
         <td><strong><?= $data_array['resol_close'] ?></strong></td>
         <?php if($sub_category!='queries'){ ?>
            <td><strong><?= $data_array['rever'] ?></strong></td>
            <td><strong><?= $data_array['reopen'] ?></strong></td>
            <td><strong><?= $data_array['esc'] ?></strong></td>
          <?php } ?>
      </tr>
   </table>

<?php } ?>