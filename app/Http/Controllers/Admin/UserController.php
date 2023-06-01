<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->title = ucwords('companies');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (request()->ajax()) {
            $users = User::with('profile')->whereHas('profile')->latest()->get();
            // $candidates = Candidate::with('attempts')->withCount('attempts')->orderBy('id', 'desc')->get();

            return DataTables::of($users)
                // ->addColumn('checkbox', function ($data) {
                //     return '<input type="checkbox" class="delete_checkbox flat" value="' . $data['id'] . '">';
                // })
                ->addColumn('status', function ($data) {

                    $unverifiedSelected = $data->status == "0" ? 'selected' : '';
                    $activeSelected = $data->status == "1" ? 'selected' : '';
                    $blockSelected = $data->status == "2" ? 'selected' : '';
                    return '<select data-id=' . $data['id'] . ' class="user-status">
                                <option  value="0" ' . $unverifiedSelected . '>Unverified</option>
                                <option  value="1" ' . $activeSelected . '>Active</option>
                                <option  value="2" ' . $blockSelected . ' >Block</option>
                            </select>';
                })
                ->addColumn('action', function ($data) {
                    $delete = '<a href="' . route('admin.users.delete', $data['id']) . '" title="Delete" type="button" name="delete" id="' . $data['id'] . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    $view = '<a  href="' . route('admin.users.show', $data['id']) . '"title="View" type="button" name="view" id="' . $data['id'] . '" class="view btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;';
                    return  $view . $delete;
                })->rawColumns(['checkbox', 'action', 'image', 'status'])->make(true);
        }
        $content['title'] = $this->title;

        return view('admin.users.index')->with($content);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::with(['pictures', 'profile'])->find($id);
        // return $user;
        return view('admin.users.show', compact('user'));
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
        try {
            $user = User::findOrFail($id);

            if ($user) {
                $user->delete();
                return redirect()->back()->with(['success' => "Successfull Deleted"]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => "Delete Operation Failed"]);
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            if ($user) {
                $user->status = $request->status;
                $user->save();
                return redirect()->back()->with(['success' => "Successfull Updated"]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => "Update Operation Failed"]);
        }
    }
}