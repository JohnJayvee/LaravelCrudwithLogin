<?php

namespace App\Http\Controllers;

use App\Models\usersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        // $json = DB::table('tbl_users')->get()->tojson();
        $users = usersModel::get()->toJson();

        if ($request->ajax()) {
            $data = json_decode($users);
            return Datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                      $btn = '
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>


                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm     deleteUser">Delete</a>
                            ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('userView');
    }

    public function store(Request $request)
    {
        if ($users = new usersModel()) {
            $users->firstName = $request->firstName;
            $users->lastName = $request->lastName;
            $users->save();

            return response()->json([
                "message" => "users record created"
            ], 201);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function edit($id)
    {
        // $users = usersModel::find($id);
        // return response()->json($users);
        if (usersModel::where('id', $id)->exists()) {
            $users = usersModel::find($id);
            return response($users, 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (usersModel::where('id', $id)->exists()) {
            $users = usersModel::find($id);
            $users->firstName = is_null($request->firstName) ? $users->firstName : $request->firstName;
            $users->lastName = is_null($request->lastName) ? $users->lastName : $request->lastName;
            $users->save();

            return response()->json([
                "message" => "User record updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if (usersModel::where('id', $id)->exists()) {
            $users = usersModel::find($id);
            $users->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }
}
