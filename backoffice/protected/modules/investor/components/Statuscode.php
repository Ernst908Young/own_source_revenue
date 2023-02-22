<?php 

	Class Statuscode{

		public static function paymentmode($val){
					switch ($val) {
						case '1':
							$text = 'Online';
							break;
						case '2':
							$text = 'Wallet';
							break;
						case '3':
							$text = 'Offline';
							break;						
						default:
							$text = 'NA';
							break;
					}
				return $text;
		}

		public static function paymentgatewaymethod($val){
					switch ($val) {
						case '1':
							$text = 'Ezpay';
							break;
											
						default:
							$text = 'NA';
							break;
					}
				return $text;
		}	

			
	}
?>