
<?php  include('link_header.php');   ?>


<div class='portlet box'>
<div class="col-md-12" style="padding: 0px;">
                                
								
	<nav class="navbar navbar-inverse navbar_inverse">
		  <ul class="nav navbar-nav">
			<li><a href="/backoffice/iloc/landownerMessage/inbox">
															Inbox
														   </a></li>
			<li class="active" ><a href="/backoffice/iloc/landownerMessage/sent">Sent</a></li>
		  </ul>
    </nav>
	
</div>
<hr>

<div class="portlet-body">
    <div class="portlet-title" style="">
					<div class="caption">
							<i class="fa fa-comment-o" aria-hidden="true"></i>
							<span class="caption-subject font-purple-soft bold uppercase"><b><?php  echo  $conversation[0]['land_title']?$conversation[0]['land_title']:'';   ?></b> </span> 
							
							<br/> Land Id: ILOC000<?php  echo  $conversation[0]['land_id']?$conversation[0]['land_id']:'';   ?>    
					</div>
    <hr>
    <div class="tab-pane activ" id="tab1" style="background-color:#fff;">
	

		
		
			<div class="portlet-body" >
				<div class="slimScrollDiv">
				
				<div class="scroller"  data-always-visible="1" data-rail-visible1="1" data-initialized="1">
				
					<ul class="chats inner_msg">
					
					<?php    if($conversation){
						 foreach($conversation as $message){  //echo '<pre/>'; print_r($message); exit();
						 //$user_css=($message['from_user']==$login_user)?'align_me':'align_to';
						 $user_name=($message['from_user']==$login_user)?'Me':$to_user_name;
						 
					    if($message['from_user']==$login_user){ ?>
					   
						<li class="out">
							<?php /* <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg">  */ ?>
							<div class="message">
								<span class="arrow"> </span>
								<a href="javascript:;" class="name"> <?php  echo $user_name;   ?> </a>
								<span class="datetime"> at <?php   echo $message['created_date']?date('d M Y H:i:s a', strtotime($message['created_date'])):'';   ?></span>
								<span class="body"> <?php   echo $message['message']?$message['message']:'';   ?> </span>
							</div>
						</li>
						
						<?php }else{ ?>
						
						<li class="in">
							<?php /* <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg">  */ ?>
							<div class="message">
								<span class="arrow"> </span>
								<a href="javascript:;" class="name"> <?php  echo $user_name;   ?> </a>
								<span class="datetime"> at <?php   echo $message['created_date']?date('d M Y H:i:s a', strtotime($message['created_date'])):'';   ?> </span>
								<span class="body"> <?php   echo $message['message']?$message['message']:'';   ?></span>
							</div>
						</li>
						
					
						<?php }  }} ?> 	
						
					</ul>
					
					
				 </div>
				
                <?php /*				
				 <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 311.089px;"></div>
				<div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
				*/ ?>
				
				</div>  
				
				
				<div> <span  class="link_color" onclick="reloadPage()"> Check for new messages </span> </div>
				
				
				<div class="chat-form">
				
				   
				
				
				
				 <form action=""  method='POST' id='messageForm'>
				
					<div class="input-cont">
					
						<input class="form-control" type="text" id='message' name="message" placeholder="Type a message here..." required> </div>
						
						 <input type="hidden" name="land_id"  value="<?php  echo  $conversation[0]['land_id']?$conversation[0]['land_id']:'';   ?>"    >
						<input type="hidden" name="from_user"  value="<?php  echo  $login_user?$login_user:'';   ?>"    >
						<input type="hidden" name="to_user"  value="<?php  echo  $send_to?$send_to:'';   ?>"    >
						<input type="hidden" name="from_user_type"  value="<?php  echo  $login_type?$login_type:'';   ?>"    >
						<input type="hidden" name="to_user_type"  value="<?php  echo  $send_to_type?$send_to_type:'';   ?>"    >
						
					<div class="btn-cont">
						<span class="arrow"> </span>
						<a href="javascript:(none)" class="btn blue icn-only">
							<i class="fa fa-check icon-white msg_submit"></i>
						</a>
					</div>
					
					  </form>
				</div>
			</div>
		
	

    </div>
    </div>
	
	
<script>

   function reloadPage() {
       location.reload();
   }

    $(document).ready(function () {
		
        $(".msg_submit").on('click', function () {
           
            //var districtValue = $(this).val();
            $.ajax({
                type: "POST",
				data: $("#messageForm").serialize(),
				dataType: 'html',
                url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/landownerMessage/saveConversation",
                success: function (result) {
					
					//console.log(result);
					$('#message').val('');
					$( ".inner_msg" ).append(result);
				}
            });
			
        });
		
		$('#message').keydown(function (e){
			if(e.keyCode == 13){
				 $.ajax({
						type: "POST",
						data: $("#messageForm").serialize(),
						dataType: 'html',
						url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/landownerMessage/saveConversation",
						success: function (result) {
							
							//console.log(result);
							$('#message').val('');
							$( ".inner_msg" ).append(result);
						}
					});
					
				e.preventDefault();	
			}
		})
		
    });
	
</script>
