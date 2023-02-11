<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\SubAgent;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class SubAgentController extends Controller
{
    public function index() {
        $data['users'] = User::with('roles')->orderby('id', 'desc')->paginate(100);
//        return $data;
        return view('admin.user.subAgent.list', $data);
    }


    public function create(){
        // return auth()->user()->roles->pluck('name')[0];
        if((auth()->user()->roles->pluck('name')[0] == "Super Admin")){
            $data['agents'] = User::whereHas('roles',function( $user){
                $user->where('roles.name','Agent');
            })->get();
            
            $data['isAdmin'] = true;
        }
        $data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
        return view('admin.user.subAgent.create', $data);
    }


    public function manage($id = null)
    {
        if ($data['subagent'] = SubAgent::find($id)) {
            return view('admin.user.subAgent.manage', $data);
        }
        return RedirectHelper::routeWarningWithParams('admin.subagent.list', '<strong>Sorry!!!</strong> Division not found');
    }



    public function store(Request $request) {
        // return $request->agent_id;
        $message = '<strong>Congratulations!!!</strong> Sub Agent Successfully';
        $rules = [
            'name' => 'required|string',
            'password' => 'required|string|min:' . User::$minimumPasswordLength,
            'status' => ['required', Rule::in(User::$statusArrays)],
        ];
        if ($request->has('id')) {
            $user = User::find($request->id);
            $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email,' . $request->id;
            $rules['username'] = 'required|string|min:6|max:8|unique:'.with(new user)->getTable().',username';
            $rules['phone'] = 'required|string|min:11|max:11|unique:' . with(new User)->getTable() . ',phone,' . $request->id;
            $rules['password'] = 'nullable|string|min:' . User::$minimumPasswordLength;
            $message = $message . ' updated';
        } else {
            $user = new User();
            $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email';
            $rules['username'] = 'required|string|min:6|max:8|unique:'.with(new user)->getTable().',username';
            // $rules['phone'] = 'required|string|min:11|max:11|unique:' . with(new User)->getTable() . ',phone';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $user->name_en = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if( !(auth()->user()->roles->pluck('name')[0]=='Super Admin')){
                $user->agent_id = auth()->id();
              }
              else{
            $user->agent_id = $request->agent_id;
              }
            $user->assignRole('Sub Agent');
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->status = strtolower($request->status);
            $role = Role::find($request->role);
            if ($user->save()) {
                if (isset($user->roles) && count($user->roles) > 1) {
                    CustomHelper::removeUsersRole($user);
                }
                $user->assignRole($role);
                return RedirectHelper::routeSuccess('admin.subagent.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }
    }


    public function destroy(Request $request)
    {
        $id = $request->post('id');
        try {
            $user = SubAgent::find($id);
            if ($user->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }


    /**
     * @param Request $request
     * @return string|void
     */
    public function ajaxUpdateStatus(Request $request)
    {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $user = SubAgent::find($id);
            if ($user->update(['status' => $status])) {
                return "success";
            }
        }
    }







}
