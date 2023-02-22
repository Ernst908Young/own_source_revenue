<?php 
/**
 * 
 */
class Dss 
{
	

	public static function category(){		
		$category = [
		''=>'Select category',
		'entities'=>'Entities',
		'filings'=>'Filings',
		'helpdesk' => 'Helpdesk',
		'revenue' => 'Revenue',
		'service provider' =>'Service Provider',
		'BO user analysis'=>'BO User Analysis'
		];

		return $category;
	}

	public static function subcategory($category){		
		switch ($category) {
			case 'entities':
				$records = [''=>'Select sub category','companies'=>'Companies','business names'=>'Business Names','firms'=>'Firms','societies'=>'Societies','charities'=>'Charities'];
				break;
			case 'filings':
				$records = [''=>'Select sub category'];
				break;
			case 'helpdesk':
				$records = [''=>'Select sub category','tickets'=>'Tickets','grievances'=>'Grievances','queries'=>'Queries'];
				break;
			case 'revenue':
				$records = [''=>'Select sub category'];
				break;
			case 'service provider':
				$records = [''=>'Select sub category'];
				break;
			case 'BO user analysis':
				$records = [''=>'Select sub category'];
				break;
			
			default:
				$records = [''=>'Select sub category'];
				break;
		}
		

		return $records;
	}





	
}