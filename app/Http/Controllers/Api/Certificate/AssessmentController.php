<?php

namespace App\Http\Controllers\Api\Certificate;

use App\Assessment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the $data['form ']for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $q=request('q');
        $columns = ['assessment_id','assessment_date','carried_by','property_address','property_type','any_tenant'];
        $rows=Assessment::orderBy('assessment_id', 'DESC');
        foreach ($columns as $column){
            $rows->orwhereRaw("( " . $column . " LIKE '%" . $q . "%')");
        }
        $rows=$rows->paginate(10);

        $response = [
            'pagination' => [
                'total' => $rows->total(),
                'per_page' => $rows->perPage(),
                'current_page' => $rows->currentPage(),
                'last_page' => $rows->lastPage(),
                'from' => $rows->firstItem(),
                'to' => $rows->lastItem()
            ],
            'data' => $rows
        ];
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        foreach ($request->data as $data){
            $RawDate=explode('T',$data['form1']['dateOfAssessment']);
            $add=Assessment::create([
//                Tab1
                'assessment_date'=>$RawDate[0],
                'carried_by'=>$data['form1']['assessmentCarriedOutBy'],
                'property_type'=>$data['form1']['propertyType'],
                'any_tenant'=>$data['form1']['tenent'],
                'cold_water_system'=>$data['form1']['typeColdWater'],
                'property_address'=>$data['form1']['propertyAddress'],

//                Tab2
                'is_cold_water_temperature_below_20'=>$data['form2']['isColdWaterTemprature'],
                'is_hot_water_temperature_50'=>$data['form2']['isHotWaterTemprature'],
                'defect'=>$data['form2']['defect'],
                'recommendation'=>$data['form2']['recommendation'],
                'responsible_person'=>$data['form2']['responsiblePerson'],
                'cold_tank_present'=>$data['form2']['isOnePresent'],
                'cold_tank_location'=>$data['form2']['location'],
                'tight_fitting'=>$data['form2']['isTightFitingLid'],
                'cold_tank_clean'=>$data['form2']['isTankClean'],
                'cold_water_below_20'=>$data['form2']['waterTemp'],
                'is_tank_insulated'=>$data['form2']['isTankInsulated'],
                'cold_water_defect'=>$data['form2']['coldeWaterDefect'],
                'cold_water_recom'=>$data['form2']['coldWaterRecommendation'],
                'cold_water_respon_person'=>$data['form2']['coldWaterResponsiblePerson'],
//                 Tab3

                'hot_water_temp_60'=>$data['form3']['isBoilerSetting'],
                'defect_2'=>$data['form3']['defect'],
                'recommendation_2'=>$data['form3']['recommendation'],
                'responsible_person_2'=>$data['form3']['responsiblePerson'],

//                Tab4
                'any_water_outlets'=>$data['form4']['isWaterOutlet'],
                'little_outlets_location'=>$data['form4']['location'],
                'defect_3'=>$data['form4']['defect'],
                'recommendation_3'=>$data['form4']['recommendation'],
                'responsible_person_3'=>$data['form4']['responsiblePerson'],

//                tab5

                'any_showers_property'=>$data['form5']['isShower'],
                'shower_heads_location'=>$data['form5']['location'],
                'defect_4'=>$data['form5']['defect'],
                'recommendation_4'=>$data['form5']['recommendation'],
                'responsible_person_4'=>$data['form5']['responsiblePerson'],


                'dead_legs_property'=>$data['form5']['isDeadLegs'],
                'dead_legs_location'=>$data['form5']['deadLegsLocation'],
                'defect_5'=>$data['form5']['deadLegsDefect'],
                'recommendation_5'=>$data['form5']['deadLegsRecommendation'],
                'responsible_person_5'=>$data['form5']['deadLegsResponsiblePerson'],

//                tab6
                'unoccupied_properties_christmas'=>$data['form6']['isLeftUnOccupied'],
                'defect_6'=>$data['form6']['defect'],
                'recommendation_6'=>$data['form6']['recommendation'],
                'responsible_person_6'=>$data['form6']['responsiblePerson'],

                'advice_to_tenants'=>$data['form6']['hasAdvoice'],
//                tab7
                'change_water_system'=>$data['form7']['isChangeSystem'],
                'change_use_of_building'=>$data['form7']['isChangeBuilding'],
                'risks_control_measures'=>$data['form7']['isControllMeasure'],
                'review_temperature_below_50'=>$data['form7']['isBelowTemprature50'],
                'review_temperature_above_20'=>$data['form7']['isAboveTemprature20'],
                'review_current_tenants'=>$data['form7']['isCurrentTenants'],
                'review_legionnaires_disease'=>$data['form7']['isLegionnaires'],
                'fk_user_id'=>Auth::user()->id,
            ]);
        }
        return  response()->json(['status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if(!$id)return response()->json(['status'=>false,'msg'=>'Wrong Request']);
        $data=Assessment::find($id);
        if($data):
            return response()->json(['status'=>true,'data'=>$data]);
        else:
            return response()->json(['status'=>false,'msg'=>'No Such Data Found.']);
        endif;
    }

    /**
     * Show the $data['form ']for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        foreach ($request->data as $data){
            $RawDate=explode('T',$data['form1']['dateOfAssessment']);
            $assessment=new Assessment();
            $add=$assessment->where('assessment_id',$id)->update([
//                Tab1
                'assessment_date'=>$RawDate[0],
                'carried_by'=>$data['form1']['assessmentCarriedOutBy'],
                'property_type'=>$data['form1']['propertyType'],
                'any_tenant'=>$data['form1']['tenent'],
                'cold_water_system'=>$data['form1']['typeColdWater'],
                'property_address'=>$data['form1']['propertyAddress'],

//                Tab2
                'is_cold_water_temperature_below_20'=>$data['form2']['isColdWaterTemprature'],
                'is_hot_water_temperature_50'=>$data['form2']['isHotWaterTemprature'],
                'defect'=>$data['form2']['defect'],
                'recommendation'=>$data['form2']['recommendation'],
                'responsible_person'=>$data['form2']['responsiblePerson'],
                'cold_tank_present'=>$data['form2']['isOnePresent'],
                'cold_tank_location'=>$data['form2']['location'],
                'tight_fitting'=>$data['form2']['isTightFitingLid'],
                'cold_tank_clean'=>$data['form2']['isTankClean'],
                'cold_water_below_20'=>$data['form2']['waterTemp'],
                'is_tank_insulated'=>$data['form2']['isTankInsulated'],
                'cold_water_defect'=>$data['form2']['coldeWaterDefect'],
                'cold_water_recom'=>$data['form2']['coldWaterRecommendation'],
                'cold_water_respon_person'=>$data['form2']['coldWaterResponsiblePerson'],
//                 Tab3

                'hot_water_temp_60'=>$data['form3']['isBoilerSetting'],
                'defect_2'=>$data['form3']['defect'],
                'recommendation_2'=>$data['form3']['recommendation'],
                'responsible_person_2'=>$data['form3']['responsiblePerson'],

//                Tab4
                'any_water_outlets'=>$data['form4']['isWaterOutlet'],
                'little_outlets_location'=>$data['form4']['location'],
                'defect_3'=>$data['form4']['defect'],
                'recommendation_3'=>$data['form4']['recommendation'],
                'responsible_person_3'=>$data['form4']['responsiblePerson'],

//                tab5

                'any_showers_property'=>$data['form5']['isShower'],
                'shower_heads_location'=>$data['form5']['location'],
                'defect_4'=>$data['form5']['defect'],
                'recommendation_4'=>$data['form5']['recommendation'],
                'responsible_person_4'=>$data['form5']['responsiblePerson'],


                'dead_legs_property'=>$data['form5']['isDeadLegs'],
                'dead_legs_location'=>$data['form5']['deadLegsLocation'],
                'defect_5'=>$data['form5']['deadLegsDefect'],
                'recommendation_5'=>$data['form5']['deadLegsRecommendation'],
                'responsible_person_5'=>$data['form5']['deadLegsResponsiblePerson'],

//                tab6
                'unoccupied_properties_christmas'=>$data['form6']['isLeftUnOccupied'],
                'defect_6'=>$data['form6']['defect'],
                'recommendation_6'=>$data['form6']['recommendation'],
                'responsible_person_6'=>$data['form6']['responsiblePerson'],

                'advice_to_tenants'=>$data['form6']['hasAdvoice'],
//                tab7
                'change_water_system'=>$data['form7']['isChangeSystem'],
                'change_use_of_building'=>$data['form7']['isChangeBuilding'],
                'risks_control_measures'=>$data['form7']['isControllMeasure'],
                'review_temperature_below_50'=>$data['form7']['isBelowTemprature50'],
                'review_temperature_above_20'=>$data['form7']['isAboveTemprature20'],
                'review_current_tenants'=>$data['form7']['isCurrentTenants'],
                'review_legionnaires_disease'=>$data['form7']['isLegionnaires'],
                'fk_user_id'=>Auth::user()->id,
            ]);
        }
        return  response()->json(['status'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
