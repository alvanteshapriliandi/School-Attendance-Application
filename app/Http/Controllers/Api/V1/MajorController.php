<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function index () {
        return response()->json(['data' => Major::paginate(20)]);
    }

    public function store (Request $request) {
        \DB::beginTransaction();
		try{
            $rules = [
                'name' => 'required|unique:majors|max:50',
                'kode' => 'required|unique:majors',
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                $response = Major::create($request->all());
            }
            \DB::commit();
            return response()->json($response);
        } catch(\Exception $e){
			\DB::rollback();
			return response()->json($e->getMessage(), 500);
		}
    }

    public function update (Request $request, $id) {
        \DB::beginTransaction();
		try{
            $rules = [
                'name' => 'required|max:50',
                'kode' => 'required',
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                Major::where('id', $id)->update($request->all());
                $response = Major::find($id);
            }
            \DB::commit();
            return response()->json($response);
        } catch(\Exception $e){
			\DB::rollback();
			return response()->json($e->getMessage(), 500);
		}
    }

    public function delete ($id) {
        \DB::beginTransaction();
		try{
            $response = Major::where('id', $id)->delete();
            \DB::commit();
            return response()->json($response);
        } catch(\Exception $e){
			\DB::rollback();
			return response()->json($e->getMessage(), 500);
        }
    }
}
