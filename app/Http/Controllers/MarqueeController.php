<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Marquee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    public function index() {
        $data['datas'] = Marquee::with('division:id,name')->orderby('name', 'desc')->get();
        return view('admin.district.list', $data);
    }


    public function create() {
        $data['divisions'] = Marquee::select('id', 'name')->orderBy('name')->get();
        return view('admin.marquee.create', $data);
    }


    public function manage($id = null) {
        if (in_array($id, [1, 2, 3])) {
            return RedirectHelper::routeWarning('admin.district.list', '<strong>Sorry!!!</strong> Marquee update not possible');
        }
        if ($data['district'] = Marquee::find($id)) {
            $data['divisions'] = Marquee::select('id', 'name')->orderBy('name')->get();
            return view('admin.district.manage', $data);
        }
        return RedirectHelper::routeWarning('admin.district.list', '<strong>Sorry!!!</strong> Marquee not found');
    }


    public function store(Request $request) {
        $message = '<strong>Congratulations!!!</strong> Marquee successfully ';
        if ($request->has('id')) {
            $marquee = Marquee::find($request->id);
            $rules['headline'] = 'nullable|longText' . with(new Marquee)->getTable() . ',headline,' . $request->id;
            $message = $message . ' updated';
        } else {
            $marquee = new Marquee();
            $rules['headline'] = 'required|longText' . with(new Marquee)->getTable() . ',headline';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $marquee->headline = $request->headline;
            if ($marquee->save()) {
                return RedirectHelper::routeSuccess('admin.district.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
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
