<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    public function index () {
        return response()->json(['data' => ClassRoom::paginate(20)]);
    }

    public function store (Request $request) {
        \DB::beginTransaction();
		try{
            $rules = [
                'name' => 'required|unique:classrooms|max:15',
                'whiteboard' => 'required',
                'teacher_desk' => 'required',
                'student_seat' => 'required',
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                $response = ClassRoom::create($request->all());
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
                'name' => 'required|max:15',
                'whiteboard' => 'required',
                'teacher_desk' => 'required',
                'student_seat' => 'required',
            ];
            $response = array('response' => '', 'success'=>false);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            } else {
                ClassRoom::where('id', $id)->update($request->all());
                $response = ClassRoom::find($id);
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
            $response = ClassRoom::where('id', $id)->delete();
            \DB::commit();
            return response()->json($response);
        } catch(\Exception $e){
			\DB::rollback();
			return response()->json($e->getMessage(), 500);
        }
    }
}
