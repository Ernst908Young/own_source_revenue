<?php
if (isset($_GET['s'])) {
    $s = $_GET['s'];
} else {
    $s = "";
}
$sql = "SELECT submission_id,application_created_date from bo_application_submission ORDER BY application_created_date";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$datefirst = $command->queryAll();
$rer = $datefirst[0]['application_created_date'];
$rer = "1900-03-03";
$stateProcesed = "'0'";
$statePending = "'0'";
if (isset($fY) && !empty($fY)) {
    $financial_year = $fY; //print_r($financial_year); //die;
    if ($financial_year == "ALL") {
        $startdate = date('Y-m-d', strtotime($rer));
        $enddate = date('Y-m-d');
    } else if ($financial_year != "ALL") {
        $data = explode("-", $financial_year);
        $startdate = $data[0] . "-04-01";
        $enddate = $data[1] . "-03-31";
    }
} else {
    $fDate = date('Y-m-d');
    //$fDate = '2015-04-01';
    $keyy = explode("-", $fDate);
    $todayDate = date('Y-m-d', strtotime($fDate));
    $sdate = $keyy[0] . "-04-01";
    $DateBegin = date('Y-m-d', strtotime($sdate));
    $yy = $keyy[0];
    $yy1 = $keyy[0] + 1;
    $yy2 = $keyy[0] - 1;

    if (($todayDate >= $DateBegin)) {
        $financial_year = $yy . "-" . $yy1;
    } else if (($todayDate < $DateBegin)) {
        $financial_year = $yy2 . "-" . $yy;
    }
    $data = explode("-", $financial_year);
    $startdate = $data[0] . "-04-01";
    $enddate = date('Y-m-d');
}

$enddate = date('Y-m-d', strtotime($enddate . '+1 day'));

//print_r($financial_year);die;
?>
<div class="portlet-body">
    <div class="clearfix">        
        <div class="page-bar">
            <form name="form" action="" method="POST" id="filterform"> 
                <table>
                    <tr>
                        <td><b>Currently you are viewing data for "<?php echo $fY; ?>", If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
                        <td> 
                            <select name="FY" class="form-control yu" id="fy"  ><!--onchange="this.form.submit()" -->
                               <!--<select name="financial_year" class="form-control" id="huik" onchange="window.location = '/backoffice/mis/ServiceMapReport/psindex/s/<?php echo $s ?>/' + this.value" >-->
                                <!--<option value="d1/2015-04-01/d2/2018-03-31" -->
                                <option value="ALL" 
                                <?php
                                if ($fY == "ALL") {
                                    echo "selected='selected'";
                                }
                                ?>  >ALL</option>
                                        <?php
                                        $pp = '2015';
                                        $yyy = '2019';
                                        for ($i = $pp; $i < $yyy; $i++) {
                                            $j = $i + 1;
                                            $k = $i . '-' . $j;
                                            $z = 'd1/' . $i . '-04-01/d2/' . $j . '-03-31'
                                            ?>
                                    <option value="<?php echo $k; ?>" <?php
                                        if ($fY == $k) {
                                            echo "selected='selected'";
                                        }
                                            ?>><?php echo $k; ?></option>
                                        <?php } ?>
                            </select>

                        </td>
                        <?php
                        if (isset($_GET['swcs_status'])) {
                            $swcs_status = $_GET['swcs_status'];
                        } else
                            $swcs_status = "both";
                        ?>    
                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;Application Type&nbsp;&nbsp; </b></td>
                        <td> 
                            <select name="swcs_status" class="form-control yu" id="swcs"  >

                                <option value="both" <?php if ($swcs_status == "Both") {
                            echo "selected='selected'";
                        } ?>  >Both</option>
                                <option value="Y" <?php if ($swcs_status == "Y") {
                            echo "selected='selected'";
                        } ?>  >Applied through Single Window</option>
                                <option value="N" <?php if ($swcs_status == "N") {
                            echo "selected='selected'";
                        } ?>  >Applied through Departmental Native Portal</option>
                            </select>

                        </td>
                        
                        <?php
                        if (isset($_GET['caf'])) {
                            $caf_status = $_GET['caf'];
                        } else
                            $caf_status = "both";
                        ?>    
                        <td><b>&nbsp;&nbsp;&nbsp;CAF&nbsp;&nbsp; </b></td>
                        <td> 
                            <select name="caf_status" class="form-control yu" id="caf"  >

                                <option value="both" <?php if ($caf_status == "Both") {
                            echo "selected='selected'";
                        } ?>  >Both</option>
                                <option value="Y" <?php if ($caf_status == "Y") {
                            echo "selected='selected'";
                        } ?>  >Applied With CAF</option>
                                <option value="N" <?php if ($caf_status == "N") {
                            echo "selected='selected'";
                        } ?>  >Applied Without CAF</option>
                            </select>

                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <hr /></div></div>