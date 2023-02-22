<style type="text/css">
    .fa-spin-hover {
        animation: fa-spin 2s infinite linear;

    }
    @-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
    @keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}

</style>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i style="font-size: 40px;" class="fa fa-hourglass-half fa-spin-hover font-green"></i>
            <span class="caption-subject bold font-green uppercase"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Timelines</span>
            <span class="caption-subject bold font-green uppercase">Application ID : <?php echo $app_comments[0]["submission_id"]; ?></span>
        </div>
    </div>




    <div class="portlet-body">
        <div class="mt-timeline-2">
            <div class="mt-timeline-line border-grey-steel"></div>
            <ul class="mt-container">


                <?php
                $alt = 0;
                // echo "<pre>";print_r($app_comments);die;
                foreach ($app_comments as $app => $data) {
                    $timestamp = strtotime($data['created_date_time']);
                    $day = date('l, d-m-Y', $timestamp);
                    if ($alt % 2 == 0) {
                        ?>

                        <li class="mt-item">
                            <div class="mt-timeline-icon bg-blue-chambray bg-font-blue-chambray border-grey-steel">
                                <i class="icon-bubbles"></i>
                            </div>
                            <div class="mt-timeline-content">
                                <div class="mt-content-container">
                                    <div class="mt-title">
                                        <h3 class="mt-content-title"><?php echo ucwords($data['application_status']) ?></h3>
                                    </div>
                                    <div class="mt-author">
                                        <div class="mt-avatar">
                                            <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/users/avatar80_1.jpg" />
                                        </div>
                                        <div class="mt-author-name">
                                            <a href="javascript:;" class="font-blue-madison"><?php echo ucwords($data['full_name']) ?></a>
                                        </div>
                                        <div class="mt-author-notes font-grey-mint"><?php echo $day; ?></div>
                                    </div>

                                    <?php
                                    if ($data['approver_comments'] === NULL) {
                                        echo"<p> No Comments &hellip; </p>";
                                    } else {
                                        echo"<div class='mt-content border-grey-salt'>" . $data['approver_comments'] . "</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                    <?php } else {
                        ?>
                        <li class="mt-item">
                            <div class="mt-timeline-icon bg-blue bg-font-blue border-grey-steel">
                                <i class="icon-calendar"></i>
                            </div>
                            <div class="mt-timeline-content">
                                <div class="mt-content-container bg-white border-grey-steel">
                                    <div class="mt-title">
                                        <h3 class="mt-content-title"><?php echo ucwords($data['application_status']) ?></h3>
                                    </div>
                                    <div class="mt-author">
                                        <div class="mt-avatar">
                                            <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/users/avatar80_1.jpg" />
                                        </div>
                                        <div class="mt-author-name">
                                            <a href="javascript:;" class="font-blue-madison"><?php echo ucwords($data['full_name']) ?></a>
                                        </div>
                                        <div class="mt-author-notes font-grey-mint"><?php echo $day; ?></div>
                                    </div>

                                    <?php
                                    if ($data['approver_comments'] === NULL) {
                                        echo"<p> No Comments &hellip; </p>";
                                    } else {
                                        echo"<div class='mt-content border-grey-steel'>" . $data['approver_comments'] . "</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
    <?php
    }
    $alt++;
}
?>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
</section>
</div>
<!--timeline end-->  