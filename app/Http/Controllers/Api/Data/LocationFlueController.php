<?php

namespace App\Http\Controllers\Api\Data;

use App\FlueType;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationFlueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $loctions=Location::all();
       $flue_type=FlueType::all();
       return response()->json(['location'=>$loctions,'flueType'=>$flue_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $form=request('form');
        if($form){
            if($form=="Location"){
                $v=Validator::make($request->all(),[
                'location'=>"required|unique:locations,location_name"
                ]);
                if ($v->fails())
                {
                    return response()->json([
                        'status' => false,
                        'error' => $v->errors()->first('location')
                    ], 200);
                }
                $save=Location::create([
                    'location_name'=>$request->location,
                    'fk_user_id'=>$user->id
                ]);

            }elseif ($form=="Flue Type"){
                $v=Validator::make($request->all(),[
                    'fluetype'=>"required|unique:flue_types,type_name"
                ]);
                if ($v->fails())
                {
                    return response()->json([
                        'status' => false,
                        'error' =>$v->errors()->first('fluetype')
                    ], 200);
                }
                $save=FlueType::create([
                    'type_name'=>$request->fluetype,
                    'fk_user_id'=>$user->id
                ]);
            }

        }
        if($save):
            $status=true;
        else:
            $status=false;
        endif;
            return response()->json(['status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
        //
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
