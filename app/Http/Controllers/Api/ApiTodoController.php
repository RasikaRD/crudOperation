<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Todolist;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ApiTodoController extends Controller
{
    /**
     * Display a listing of the Todo list.
     */
    public function index()
    {
       try{
        
        $todos = Todo::where('user_id', auth()->id())
                        ->latest()
                        ->get();
    
        $todo = Todolist::collection($todos);
        return response()->json(['data'=>$todo,'status'=>true,'message'=>'Success'],200);

       } catch (\Exception $exception) {
            return response()->json(['data'=>null,'status'=>false,'message'=>$exception->getMessage()], 500);
        }
    }

    /**
     * Store a newly created Todo in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:todos,title|min:3|max:255'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['data' => null, 'status' => false, 'message' => $validator->errors()], 422);
            }

            $data = request()->all();
            $todo = new Todo();
            $todo->title = $data['title'];
            $todo->user_id = auth()->user()->id;
            $todo->save();
            return response()->json(['data'=>$todo,'status'=>true,'message'=>'Success'], 200);

        }catch(\Exception $exception) {
            Log::info($exception);
            return response()->json(['data'=>null,'status'=>false,'message'=>$exception->getMessage()], 500);
        }
    }

    public function destroy($id){

        // dd($id);
        $todo = Todo::find($id);
        if(!$todo){
            return response()->json(['message' => 'TODO not found'], 404);
        }
        $todo->delete();
        return response()->json(['status'=>true,'message'=>'TODO deleted'], 200);
    }

    public function update($id, Request $request){
        $todo = Todo::find($id);
        if(!$todo){
            return response()->json(['message' => 'TODO not found'], 404);
        }
        $todo->title = $request->input('title');
        $todo->save();
        return response()->json(['status'=>true,'message'=>'TODO updated'], 200);

    }

 
}
