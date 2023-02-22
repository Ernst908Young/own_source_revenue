
<?php 

   /*echo '<pre>';
   print_r($fieldValues);
   die;*/

 ?>
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>BUSINESS NAMES RULES, 1940</strong></span><br><br>
        <span style="font-size: 11;">FORM 3</span><br><br>
        <span style="font-size: 11;"><strong>STATEMENT GIVING NOTICE OF CHANGES</strong></span><br>
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
     <tr>
      <td width="5%">        
      </td>
      <td width="95%">To the Registrar,<br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00430_0']; ?> hereby give you notice in accordance of the following Changes in the firm of in respect of the <?php echo @$fieldValues['UK-FCL-00488_0']; ?> carrying on business in the name of<br><?php echo @$fieldValues['UK-FCL-00489_0']; ?><br>which is required to be registered under Section 8 of The Registration of Business Names Act, Cap. 317.</span>
      </td>
    </tr>

    <?php if(!empty($fieldValues['UK-FCL-00418_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of Name of Firm:</strong><br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00418_0']; ?></span>
      </td>
    </tr>
  <?php }?>
   
   <?php if(!empty($fieldValues['UK-FCL-00301_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of persons with names in full of new individuals:</strong><br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00301_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00105_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00106_0'][0]; ?></span>
      </td>
    </tr>
  <?php } ?>

  <?php if(!empty($fieldValues['UK-FCL-00315_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of the name of persons who own the firm or business:</strong><br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00315_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00133_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00419_0'][0]; ?></span>
      </td>
    </tr>
  <?php } ?>

  <?php if(!empty($fieldValues['UK-FCL-00420_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Corporate Name of Corporation:</strong><br><br><span  style="margin-top:10px;">Name of the Company :<?php echo @$fieldValues['UK-FCL-00084_0']; ?> Address:<?php echo @$fieldValues['UK-FCL-00421_0']; ?> Type of Change :<?php echo @$fieldValues['UK-FCL-00422_0']; ?></span>
      </td>
    </tr>
  <?php } ?>


  <?php if(!empty($fieldValues['UK-FCL-00397_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of the name of persons who own the firm or business:</strong><br><br><span  style="margin-top:10px;"> Name : <?php echo @$fieldValues['UK-FCL-00397_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00316_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00423_0'][0]; ?> Present Nationality: <?php echo @$fieldValues['UK-FCL-00424_0'][0]; ?> Nationality of origin: <?php echo @$fieldValues['UK-FCL-00425_0'][0]; ?></span>
      </td>
    </tr>
  <?php } ?>

  <?php if(!empty($fieldValues['UK-FCL-00107_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of place of Business:</strong><br><br><span  style="margin-top:10px;"> Address : <?php echo @$fieldValues['UK-FCL-00397_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00335_0'][0]; ?> Parish: <?php echo @$fieldValues['UK-FCL-00406_0'][0]; ?> Postal Code: <?php echo @$fieldValues['UK-FCL-00401_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00320_0'][0]; ?></span>
      </td>
    </tr>
  <?php } ?>


  <?php if(!empty($fieldValues['UK-FCL-00107_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of Registered Office:</strong><br><br><span  style="margin-top:10px;"> Address : <?php echo @$fieldValues['UK-FCL-00397_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00335_0'][0]; ?> Parish: <?php echo @$fieldValues['UK-FCL-00406_0'][0]; ?> Postal Code: <?php echo @$fieldValues['UK-FCL-00401_0'][0]; ?> <?php echo @$fieldValues['UK-FCL-00320_0'][0]; ?></span>
      </td>
    </tr>
  <?php } ?>


  <?php if(isset($fieldValues['UK-FCL-00426_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of Nature of Business:</strong><br><br><span  style="margin-top:10px;"> Business Activity : <?php echo @$fieldValues['UK-FCL-00426_0'][0]; ?> Nature/description of business :<?php echo @$fieldValues['UK-FCL-00427_0']; ?> Type of Change: <?php echo @$fieldValues['UK-FCL-00428_0']; ?>  ?></span>
      </td>
    </tr>
  <?php } ?>


  <?php if(!empty($fieldValues['UK-FCL-00429_0'])){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Any other Change:</strong><br><br><span  style="margin-top:10px;"> <?php echo @$fieldValues['UK-FCL-00429_0']; ?></span>
      </td>
    </tr>
  <?php } ?>

</table>

