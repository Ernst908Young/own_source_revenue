    <style type="text/css">
        .main-header .breadcrumb > li + li:before {
            color:#000;
        }
    </style>
    <header class="main-header" style='background-color:#f1f1f1; color:#333'>
        <div class="container" > 
            <h3 class="page-title" style='color:#333'><?php echo $page_name;?></h3>

            <ol class="breadcrumb pull-right" style='color:#333'>
                <li><a href="#" style='color:#333'>You are Now on:</a></li>
                <li style='color:#333'><?php echo $page_name;?> </li>
            </ol>
        </div>
  </header>
	<div class="content margin-top20 margin-bottom20">
        <div class="container">
			<?php
			if (isset($page_content)) {
				echo $page_content;
			}
			?>
		</div>
	</div>