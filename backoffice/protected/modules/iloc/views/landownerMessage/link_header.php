<style>
.errorSummary { color:red }
.control-label{text-align: left !important;}

.msglink{color:#2b3643;}
.msglink:hover{color:#2b3643;}
nav>li>a:hover {
    color: #fff;
}
.navbar-inverse .navbar-nav>li>a, .navbar-inverse .navbar-text {
    color: #ffffff;
}
.navbar_inverse {
    background-color: #32c5d2 !important;
	border-color: #32c5d2 !important;
}
.navbar_inverse .navbar-nav>.active>a, .navbar_inverse .navbar-nav>.active>a:focus, .navbar_inverse .navbar-nav>.active>a:hover {
    color: #fff;
    background-color: #27a4b0 !important;
}

.link_color{ color:#3590c1; cursor: pointer;  }

.notifycircle {
    left: 95%;
    top: -9px;
	padding: 1px 6px 3px;
}
.new {
    background: #ee4c40;
    border-radius: 11px !important;
}
.lheight16 {
    font-size: 15px !important;
	line-height: 16px;
}
.cfff {
    color: #fff;
}

</style>

    
     <?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){
        ?>
	<style>	
        .page-sidebar.navbar-collapse.collapse {
            display: none !important;
        }   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;

        }
		</style>

        

<div class="row">


<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >

<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerConnect/create')?>"><span>Add New Land Record for Sale/Lease </span></a>


</div>

<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >

<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerConnect/manage')?>"><span>Manage Property</span></a>


</div>

</div>

<?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE ?>
