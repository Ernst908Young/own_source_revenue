<?php 
/**
 * 
 */
class Servicecategory 
{
	

	public static function category(){		
		$category = ['Name Reservation or Business Name Registration'=>'Name Reservation or Business Name Registration',
		'Incorporation of Company'=>'Incorporation of Company',
		'Incorporation of Non Profit Company'=>'Incorporation of Non Profit Company',
		'Registration of Charity'=>'Registration of Charity',
		'Registration of Society'=>'Registration of Society',
		'Registration of External Company'=>'Registration of External Company',
		'Registration of Limited Partnership'=>'Registration of Limited Partnership',
		'Registration of Notices- Companies'=>'Registration of Notices- Companies',
		'Registration of notices- Societies'=>'Registration of notices- Societies',
		'Registration of notices- Individual or Firm'=>'Registration of notices- Individual or Firm',
		'Annual Return- Company'=>'Annual Return- Company',
		'Continuance- Companies'=>'Continuance- Companies',
		'Continuance- Societies'=>'Continuance- Societies',
		'Amendment- Companies'=>'Amendment- Companies',
		'Amendment- Societies'=>'Amendment- Societies',
		'Revival of Societies'=>'Revival of Societies',
		'Revival of Companies'=>'Revival of Companies',
		'Proxy - Companies'=>'Proxy - Companies',
		'Charge'=>'Charge',
		'Notice of Registration'=>'Notice of Registration',
		'Restatement of Articles'=>'Restatement of Articles',
		'Articles of Re-Organisation- Companies'=>'Articles of Re-Organisation- Companies',
		'Articles of Re-Organisation- Societies'=>'Articles of Re-Organisation- Societies',
		'Exemption- Companies'=>'Exemption- Companies',
		'Amalgamation of Companies'=>'Amalgamation of Companies',
		'Amalgamation of Societies'=>'Amalgamation of Societies',
		'Intent to dissolve- companies'=>'Intent to dissolve- companies',
		'Intent to dissolve- societies'=>'Intent to dissolve- societies',
		'Notice Of Cancellation- Company'=>'Notice Of Cancellation- Company',
		'Cessation'=>'Cessation',
		'Dissolution of Societies'=>'Dissolution of Societies',
		'Dissolution of Companies'=>'Dissolution of Companies'];

		return $category;
	}

	public static function categorywithservices($category=NULL){		
		$categorys = ['Name Reservation or Business Name Registration'=>['2.0'],
		'Incorporation of Company'=>['4.0'],
		'Incorporation of Non Profit Company'=>['5.0'],
		'Registration of Charity'=>['6.0','7.0'],
		'Registration of Society'=>['9.0'],
		'Registration of External Company'=>['8.0'],
		'Registration of Limited Partnership'=>['10.0'],
		'Registration of Notices- Companies'=>['13.0','14.0','15.0','18.0'],
		'Registration of notices- Societies'=>['12.0','17.0','16.0'],
		'Registration of notices- Individual or Firm'=>['11.0'],
		'Annual Return- Company'=>['29.0','30.0','32.0'],
		'Continuance- Companies'=>['21.0'],
		'Continuance- Societies'=>['22.0'],
		'Amendment- Companies'=>['20.0'],
		'Amendment- Societies'=>['19.0'],
		'Revival of Societies'=>['23.0'],
		'Revival of Companies'=>['24.0'],
		'Proxy - Companies'=>['26.0','28.0','27.0'],
		'Charge'=>['34.0','36.0'],
		'Notice of Registration'=>['35.0'],
		'Restatement of Articles'=>['33.0'],
		'Articles of Re-Organisation- Companies'=>['25.0'],
		'Articles of Re-Organisation- Societies'=>['45.0'],
		'Exemption- Companies'=>['31.0'],
		'Amalgamation of Companies'=>['37.0'],
		'Amalgamation of Societies'=>['38.0'],
		'Intent to dissolve- companies'=>['41.0'],
		'Intent to dissolve- societies'=>['42.0'],
		'Notice Of Cancellation- Company'=>['44.0'],
		'Cessation'=>['43.0'],
		'Dissolution of Societies'=>['40.0'],
		'Dissolution of Companies'=>['39.0']];

		if($category!=NULL){
			$categorysf = [];
			foreach ($category as $key => $value) {
				foreach ($categorys[$value] as $k => $v) {
					$categorysf[$v] = $v;
				}			
			}
			return $categorysf;
		}else{
			return $categorys;
		}				
	}


	public static function appstatus($app_status=NULL){
		 switch ($app_status) {
            case "I":
             $status =  "Draft";
                  break;
            case "DP":
               $status =  "Draft";      
              break;
               case "SP":
               $status =  "Draft";      
              break;

             case "PD":                      
              $status =  "Payment Due";                
              break; 

            case "P":
              $status =  "Pending for Approval";
              break;
            case "F":
              $status =  "Pending for Approval";
              break;
            case "FA":
              $status =  "Pending for Approval";
              break; 
            case "AB":
              $status =  "Pending for Approval";
              break; 

            case "A":
              $status =  "Approved";
              break;                                     
                           
            case "H":
              $status =  "Reverted";    
              break;  
            
            case "R":
              $status =  "Rejected";
              break;
            case "W":
              $status =  "Withdrawn";
              break;  
			case "RI":
              $status =  "Refund Initiated";
              break;  
            case "RS":
              $status =  "Refund Success";
              break; 
            default:
              $status =  "No Status";
          }

          return $status;
	}

/*
* Ticket Query & Grevaince status
*/
	public static function tqgstatus($tqg_status=NULL){
		 switch ($tqg_status) {
            case "O":
             $status =  "Open";
             break;
            case "RV":
               $status =  "Reverted";      
              break;
            case "RS":
               $status =  "Resolved";      
              break;
            case "RO":                      
              $status =  "Reopened";                
              break; 
            case "C":
              $status =  "Closed";
              break;
            case "ESC":
              $status =  "Escalated";
              break;
            case "W":
              $status =  "Withdrawn";
              break;
           
            default:
              $status =  "No Status";
          }

          return $status;
	}

	public static function getalltqgstatus(){
		return ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated','W'=>'Withdrawn'];
	}


	public static function getallservicestatus(){
		return ['D'=>'Draft','PD'=>'Payment Due','P'=>'Pending For Approval','A'=>'Approved','H'=>'Reverted','R'=>'Rejected','W'=>'Withdrawn','RI'=>'Refund Initiated','RS'=>'Refund Success'];
	}

	public static function mappedservicestatus($status){
		$status_arr = ['D'=>['D','I','SP'],'PD'=>['PD'],'P'=>['P','F','FA','AB'],'A'=>['A'],'H'=>['H'],'R'=>['R'],'W'=>['w'],'RI'=>['RI'],'RS'=>['RS']];

		return $status_arr[$status];
	}
}