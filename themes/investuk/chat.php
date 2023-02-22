	
	
	<?php
        
		$servername = "localhost";
		$dbusername = "SWCS_UK_AP_USER";
		$dbpassword = "unfold*mystries%";
		$dbname = "chat";

		// Create connection
		$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		
		$sql = "select * from users where id=1" ;
		$chatUserResult = $conn->query($sql) ;
		
		$chatUserResult = 	$chatUserResult->fetch_assoc() ;
		
		//echo "<pre>" ; print_r($chatUserResult['status']);
	
		$username = "gbdsansi" ;
		$password = "gbdsansi" ;
		
		$result = [];
	

?>

	<link href="/chatroom/css/chatstyle.css" type="text/css" rel="stylesheet" >
	<script src="/chatroom/js/socket.io-1.2.0.js"></script>
        <script src="/chatroom/js/moment.min.js"></script>
	

	<div class=" container-usr" id="login-box" >
		<div class="row" style="margin-top: 20px;" id="chat-now-box">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" id="chat-now-btm">
                         Chat Now                        
                    </div>
				</div>
            </div>
        </div>			
        <div class="row" style="margin-top: 20px; display:none;" id="chat-now-form">
            <div class="col-md-12">
                <div class="panel panel-primary"  style="background-color:#eee!important;" >
                    <div class="panel-heading" id="panel-heading-chat-now-form" >
                         Chat  &nbsp;     <a href="#" class="on-off-line right-align" style="color:#ff0000;" > Offline </a>                 
                    </div>
                    
                    <div class="panel-body">
                        
                        <div class="input-group" style="display:none;color:#ff0000;"  id="login-form-text">
                            We are currently offline <br >please raise your query
                        </div>
                        
                        <form action="">
                            <div class="input-group" style="display:none;" id="login-form-container"> 							
								<input type="text" id="username-name-login" name='username_name_login'  value="" class="form-control form-control-lg margin-bottom"  placeholder="Enter username" required />  
								<input type="email" id="email-login" name='email_login' value="" class="form-control form-control-lg margin-bottom" placeholder="Enter email"  required />  
								<input type="text" id="phonenumber-login" name='phonenumber_login' value="" class="form-control form-control-lg margin-bottom" placeholder="Enter phone number" required />
                            </div>
                        </form>
                        
                        
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-warning btn-sm" id="btn-chat-login">Chat Now</button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
	
    <div class=" container-usr" id="chat-box" style="display:none;">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-primary" style="background-color:#eee!important;">
                    <div class="panel-heading">
                         Chat  &nbsp;
                         <a href="#" class="on-off-line" style="color:#ff0000;"> Offline </a>						 
                        <a href="#" class="close-chat" > Close </a>						 
                    </div>
                    <div class="panel-body panel-body-chat">
						<form action="" id="otp-form" style="display:none;">
                            <div class="input-group" style="text-align: center;"> 							
								<input type="text" id="otp-input" name='otp_login'  value="" class="form-control form-control-lg margin-bottom"  placeholder="Enter otp" required />  
								<label id="label-invalid-otp" style="color:red;display:none;">Invalid OTP</label><br />
								<button class="btn btn-warning btn-sm" id="btn-verify-otp">Verify OTP</button>
							</div>
                        </form>
						
                        <ul class="chat chatlist">
                            
                        </ul>
                    </div>
					
                    <div class="panel-footer" id="chat-box-footer" style="display:none;">
                        <form action="" id="login-form-chat">
                            <div class="input-group"> 
								<input type="hidden" id="username-name" name='username_name'  value=""  />  
								<input type="hidden" id="room-name" name='room-name' value="" />  
								<input type="hidden" id="user_id" name='user_id' value="" />
								<input type="hidden" id="phone-number" name='phone_number' value="" />
								<input type="hidden" id="user-email" name='user_email' value="" />
                                
								<input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." autocomplete="off">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>


    <script type="template" id="show-message-as-other">
        <li class="left clearfix">
			<div class="row" style="margin-top: 5x;">
				<div class="col-md-12">
					<div class="chat-body clearfix right-align">
						<p class="message"></p>						
					</div>
				</div>
				<div class="col-md-12">
					<small class="pull-left text-muted"><span class="send_at">xxx</span></small>
				</div>
            </div>
        </li>
    </script>

    <script type="template" id="show-message-as-sender">
        <li class="right clearfix">
		
			<div class="row" style="margin-top: 5x;">				
				<div class="col-md-12">
					<div class="chat-body clearfix left-align">
						<p class="message"></p>						
					</div>					
				</div>
				<div class="col-md-12">
					<small class=" pull-right text-muted"><span class="send_at">xxx</span></small>
				</div>
				
				
			</div>
			
        </li>
    </script>

    
	
    <script>
        //var socket = io('https://www.<?php echo $_SERVER['HTTP_HOST']; ?>:3000',{secure:true,rejectUnauthorized: false,reconnect: true});
        var socket = io('http://<?php echo $_SERVER['HTTP_HOST']; ?>:3000',{secure:true,rejectUnauthorized: false,reconnect: true});
        var username = '';
        var room = '';
        var joinname = '';
        
        var user_id = 0;
        
        var offline =<?php  if($chatUserResult['status']==1) echo 'false'; else echo 'true' ; ; ?>;

		offlineAgent(offline);

        $( window ).unload(function() {
            socket.emit('unsubscribe', {room: room});
            return "Bye now!";
        });

        $('#login-form-chat').submit(function(){										
			
			if($('#message').val() == ''){
				return false ;
			}
			
			var user_id = $("#user_id").val() ;
			var username = $("#username-name").val() ;
			var room = $("#room-name").val() ;
			var data = { 
				sender: username,
				send_at: new Date().toISOString(),	
							
				room: room,
				username:username,
				joinname:room, 
				user_id:user_id, 
				message: $('#message').val()				
			}			
			
			setdata(data,"show-message-as-sender");			
            socket.emit('send', data);			
            $('#message').val('');
			
            return false;
			
        });

        socket.on('agent online', function(data){
            
            $(".on-off-line").text("Online").css('color','#00ff00');;
            offline = false ;
            
            offlineAgent(offline); 
			
        });
		
        socket.on('agent offline', function(data){
            
            $(".on-off-line").text("Offline").css('color','#ff0000');;;
            offline = true ;
            
            offlineAgent(offline)
			
        });
        
        socket.on('agent typing msg', function(data){	
			$("#message").prop("placeholder","Agent is typing message...") ;
		});
		
        socket.on('message', function(data){			
            setdata(data,"show-message-as-sender");		
        });
		
		socket.on('send customer', function(data){
			
			setdata(data,"show-message-as-other");			
		});
		
		$(document).on("keyup","#message",function(e){
			
			if($(this).val()!=''){
				
				var user_id = $("#user_id").val() ;
				var chatroom = $("#username-name").val() ;
				var roomname = $("#room-name").val() ;
							
				var msgData = {
					room: chatroom, 
					joinname: roomname, 
					send_at: new Date().toISOString(), 
					user_id: user_id
				};
				
				socket.emit('customer typing msg', msgData );
			}			
			
		});
		
		function setdata(data,msg_id){			
			
			var html =  $("#"+msg_id);
            var $html = $(html.html());

            $html.find(".username").text(data.sender);
            $html.find(".send_at").text(moment(data.send_at).format("LLL"));

            data.message = $("<div/>").text(data.message).html();
            
            var urlPattern = /(\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
            var result = data.message.match(urlPattern);			
			
            $html.find(".message").html(data.message);
            $('.chatlist').append($html);
			
			$("#message").prop("placeholder","Type your message here...") ;
			
            scrollToBottom($('.panel-body-chat')[0]);	
			
		}	
       

        function scrollToBottom($dom)
        {
            $dom.scrollTop = $dom.scrollHeight;
        }
		
		function offlineAgent(offline){
			
			if(offline == true){
				$(".on-off-line").text("Offline").css('color','#ff0000');;;
                $("#login-form-container").hide();
                $("#login-form-text").show();
                $("#login-form-chat").hide();
			}else{
				$(".on-off-line").text("Online").css('color','#00ff00');;
               $("#login-form-container").show();
               $("#login-form-text").hide();
               $("#login-form-chat").show();
			}
		}
		
		function isEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
		}
		
		function phonenumber(inputtxt) {
			var phoneno = /^\d{10}$/;
			if((inputtxt.match(phoneno))){
				return true;
			}else{				
				return false;
			}
		}

		$(document).on("click","#panel-heading-chat-now-form",function(){
			$("#chat-now-form").slideUp( "slow",function(){
				$("#chat-now-box").show();
			});
						
		});
		
		$(document).on("click","#chat-now-btm",function(){
			
			$("#chat-now-box").hide();
			$("#chat-now-form").slideDown( "slow" );                        
			offlineAgent(offline);			
			
		});
		
		$(document).on("click",".close-chat",function(){			
			
			var data = {					
				user_id:$("#user_id").val()
			}
                        
                        
			socket.emit('unsubscribe', data);			
			
			$("#chat-now-form").hide();
			
			$("#chat-box").slideUp( "slow",function(){
				$("#login-box").show();
				$("#chat-now-box").show();
				$(".chatlist").html('');
				$("#otp-input").val('');
			});
			
		});
		
		$(document).on("click","#btn-verify-otp",function(){
			
			if($("#otp-input").val()==''){
				$("#otp-input").addClass("error") ;
				return false ;
			}else{
				$("#otp-input").removeClass("error") ;
			}
			
			$.ajax({
				url:"/chatroom/pages/login.php",
				data:{otp:$("#otp-input").val(),user_id:$("#user_id").val()},
				type:"post",
				dataType:"json",
				success:function(response){		
                                    
					if(response.success){					
						
						$("#otp-input").removeClass("error") ;						
						$("#otp-form").hide();						
						$("#chat-box-footer").show();						
						$("#login-box").hide();
						$("#chat-box").show();	
						
						var phonenumber = $("#phone-number").val();
						var email = $("#user-email").val();
					
						setMessages(response.messages) ;
						
						var subscribeData = {
							username: $("#username-name").val(), 
							user_id:$("#user_id").val(),
							phonenumber:phonenumber,
							email:email
						} ;
						
						socket.emit('subscribe',subscribeData );
						
					}else{
						$("#label-invalid-otp").show();
						$("#otp-input").addClass("error") ;
					}
										
					
				}
				
			});
			
			return false ;
			
		});
		
		function setMessages(messages){
			
			if(messages){
				$.each(messages, function( index, value ) {
				
					var data = { 
						sender: $("#username-name").val(),
						send_at: value.updated_at,										
						room: $("#username-name").val(),
						username:$("#username-name").val(),
						joinname:$("#username-name").val(), 
						user_id:value.user_id, 
						message: value.message				
					}			
					
					var show_message = "show-message-as-sender" ; 
					if(value.sender_id==1){
						show_message = "show-message-as-other" ;
					}
					setdata(data,show_message);	
					
				});
			}
			
		}
		
		$(document).on("click","#btn-chat-login",function(){
		
			if($("#username-name-login").val()==''){
				$("#username-name-login").addClass("error") ;
				return false ;
			}else{
				$("#username-name-login").removeClass("error") ;
			}
			
			if(!isEmail($("#email-login").val())){
				$("#email-login").addClass("error") ;
				return false ;
			}else{
				$("#email-login").removeClass("error") ;
			}
			
			if(!phonenumber($("#phonenumber-login").val())){
				$("#phonenumber-login").addClass("error") ;
				return false ;
			}else{
				$("#phonenumber-login").removeClass("error") ;
			}
		
			$.ajax({
				url:"/chatroom/pages/login.php",
				data:{username:$("#username-name-login").val(),phonenumber:$("#phonenumber-login").val(),email:$("#email-login").val()},
				type:"post",
				dataType:"json",
				success:function(response){		
                                    
					
					var user_id = response.agent.user_id ;
					var username = response.agent.username ;
					
					//socket.emit('subscribe', {username: username, user_id:user_id});
					
					$("#username-name-login").val('') ;
					$("#email-login").val('');
					$("#phonenumber-login").val('') ;
					
					$("#username-name").val(response.agent.username);
					$("#room-name").val(response.agent.agentname);
					$("#user_id").val(response.agent.user_id);
					
					$("#phone-number").val(response.agent.phonenumber);
					$("#user-email").val(response.agent.email);
					
					$("#otp-form").show();
					
					$("#chat-box-footer").hide();
					
					$("#login-box").hide();
					$("#chat-box").show();					
					
										
					
				}
				
			});
			
			return false ;
			
		});
        
    </script>
