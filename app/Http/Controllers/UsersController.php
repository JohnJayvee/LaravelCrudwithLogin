<?php

namespace App\Http\Controllers;

use App\Models\usersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index(Request $request)
    {

        $users = DB::table('tbl_users')->get();

        if ($request->ajax()) {
            $data = $users;
            return Datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Show" class="show btn btn-warning btn-sm showUser">Show</a>

                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>


                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('userView', compact('users'));
    }

    public function store(Request $request)
    {
        usersModel::updateOrCreate(
            ['id' => $request->user_id],
            ['firstName' => $request->firstName, 'lastName' => $request->lastName]
        );

        return response()->json(['success' => 'User saved successfully.']);
    }

    public function show($id)
    {
        $users = DB::table('tbl_users')->find($id);
        return response()->json($users);
    }

    public function edit($id)
    {
        $users = DB::table('tbl_users')->find($id);
        return response()->json($users);
    }

    public function destroy($id)
    {
        // DB::table('tbl_users')->delete($id);
        DB::table('tbl_users')->delete($id);
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
