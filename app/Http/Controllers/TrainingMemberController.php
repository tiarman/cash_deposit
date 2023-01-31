<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\TrainingMember;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TrainingMemberImport;
use FontLib\Table\Type\post;

class TrainingMemberController extends Controller
{
    public function index($training_id) {
        if(!($data['training'] = Training::with('members')->find($training_id))){
            return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Training not found.');
          }
        return view('admin.tainingMember.list', $data);
    }


    public function create(Request $request) {
        $data['trainings'] = Training::select('id','title')->where('institute_id',auth()->user()->institute_id)->get();
        $data['users'] = User::select('id','name_en')->where('status','active')->get();

        if($request->status){
            return $request->status;
        }

        return view('admin.tainingMember.create',$data);
    }


    public function manage($training_id=null, $id = null) {
        if ($data['training_memeber'] = TrainingMember::find($id)) {
            $data['trainings'] = Training::select('id','title')->where('institute_id',auth()->user()->institute_id)->get();
            return view('admin.tainingMember.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.tainingMember.list', '<strong>Sorry!!!</strong> TrainingMember not found');
    }


    public function store(Request $request,$training_id) {
        $message = '<strong>Congratulations!!!</strong> Training Member successfully ';
        $rules = [
                 'name' => 'required|string',
                 'email' => 'required|email',
                 'phone' => 'required|regex:'.CustomHelper::PhoneNoRegex
            ];

        $trainingMembers = TrainingMember::get();

        if ($request->has('id')) {
            $trainingMember = TrainingMember::find($request->id);
            $message = $message . ' updated';
        } else {

        // checking training user unique
        if ($trainingMembers) {
            foreach ($trainingMembers as $trainingMember)
           {
            if(($trainingMember->training_id == $training_id) && ($trainingMember->phone==$request->phone)){
           return RedirectHelper::backWithInput('User should be Unique');
          } }
        }
            $trainingMember = new TrainingMember();
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $trainingMember->training_id = $training_id;
            $trainingMember->user_id = $request->user_id;
            $trainingMember->name = $request->name;
            $trainingMember->email = $request->email;
            $trainingMember->phone = $request->phone;
            if ($trainingMember->save()) {
                return RedirectHelper::routeSuccessWithParams('admin.training.member.list', $message,[$training_id]);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $trainingMember = TrainingMember::find($id);
            if ($trainingMember->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }

    public function importMember(Request $request,$training_id)
    {
        Excel::import(new TrainingMemberImport($training_id), $request->file);
        return back();
    }

    public function ajaxUserChange(Request $request){
        if($request->id){
            $data = User::find($request->id);
            // return view('admin.tainingMember.create',$dataa);
            return json_encode($data,200);
        }
    }
}
