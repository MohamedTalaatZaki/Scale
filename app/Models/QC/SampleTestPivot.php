<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Support\Facades\DB;


class SampleTestPivot extends Model
{
    protected $table    =   'qc_pivot_result_rpt';
    protected $guarded  =   ['id'];


	public static function getElementsNames($item_group_id){
		$elements=[];
        $data= DB::select("
			select e.en_name from qc_test_header h
			join qc_test_details d  on (h.id = d.qc_test_header_id)
			join qc_elements e  on (e.id = d.qc_element_id)
			where h.item_group_id = $item_group_id");

		foreach ($data as $el) {
			$elements[]="[$el->en_name]";
		}
				
		return $elements;
	}

       public static function getSampleTestResult($item_group_id,$from_date,$to_date){

		$elementsNames=implode(self::getElementsNames($item_group_id),',');
		
		$data= DB::select("
			select t.id transport_header_id
					, h.transport_detail_id
					, t.item_group_id
					, ig.en_name item_name
					, td.truck_plates
					, t.transport_number+'-'+cast(td.id as varchar(20)) transport_no
					, h.result 
					, h.created_at test_datetime
					, h.id sample_test_header_id
					, cast(h.created_at as date) test_date
					, Cast(cast(h.created_at as time) as varchar(8)) test_time
					, $elementsNames
			from samples_test_header h left join 
					(                        
						select sample_test_header_id , $elementsNames
								From
									(
										select	sample_test_header_id
												,element_name
												, case when element_type = 'range' then sampled_range
														else sampled_expected_result
														end result_value  
										from samples_test_details
									) details
								PIVOT  
									(  
										SUM(result_value) FOR element_name IN ( $elementsNames)
									) AS pivot_sample_details) d

			on (h.id=d.sample_test_header_id)
			left join transport_details td on (td.id=h.transport_detail_id)
			left join transports t on (t.id=td.transport_id)
			left join item_group ig on (t.item_group_id=ig.id) 
			where t.item_group_id = $item_group_id  and cast(h.created_at as date) between '$from_date' and '$to_date'"
		);
		
			   if(count($data) > 0){
				   return  collect($data);
			   }
			   return [];
		   }

}
// where t.item_type_id = 1 and  td.id=$transport_detail_id and ( h.created_at >='$from_date' or  h.created_at <='$to_date')"