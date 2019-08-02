<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index () {
        return response()->json(['data' => Student::paginate(20)]);
    }

    public function store (Request $request) {
        \DB::beginTransaction();
		try{
            $rules = [
                'name' => 'required|max:50',
                'address' => 'required|max:100',
                'city' => 'required|max:20',
                'province' => 'required|max:30',
                'gender' => 'required',
                'guardian_name' => 'required|max:50',
                'phone' => 'required|max:12'
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                $response = Student::create($request->all());
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
                'address' => 'required|max:100',
                'city' => 'required|max:20',
                'province' => 'required|max:30',
                'gender' => 'required|max:15',
                'guardian_name' => 'required|max:50',
                'phone' => 'required|max:12'
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                Student::where('id', $id)->update($request->all());
                $response = Student::find($id);
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
            $response = Student::where('id', $id)->delete();
            \DB::commit();
            return response()->json($response);
        } catch(\Exception $e){
			\DB::rollback();
			return response()->json($e->getMessage(), 500);
        }
    }
}
