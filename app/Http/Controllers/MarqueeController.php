<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Marquee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    public function index() {
        $data['datas'] = Marquee::orderby('id', 'desc')->get();
        return view('admin.marquee.list', $data);
    }


    public function create() {
        $data['divisions'] = Marquee::select('id', 'headline')->orderBy('headline')->get();
        return view('admin.marquee.create', $data);
    }


    public function manage($id = null) {
        if ($data['marquee'] = Marquee::find($id)) {
            return view('admin.marquee.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.marquee.list', '<strong>Sorry!!!</strong> Marquee not found');
    }


    public function store(Request $request) {

        $message = '<strong>Congratulations!!!</strong> Marquee successfully ';
        if ($request->has('id')) {
            $marquee = Marquee::find($request->id);
            $rules['headline'] = 'nullable|string';
            $message = $message . ' updated';
        } else {
            $marquee = new Marquee();
            $rules['headline'] = 'required|string';
            $message = $message . ' created';
        }

        $request->validate($rules);

        try {
            $marquee->headline = $request->headline;
            if ($marquee->save()) {
                return RedirectHelper::routeSuccess('admin.marquee.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return $e;
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function destroy(Request $request) {
        $id = $request->post('id');
        try {
            $marquee = Marquee::find($id);
            if ($marquee->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }
}
