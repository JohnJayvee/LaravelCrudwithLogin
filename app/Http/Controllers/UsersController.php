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
        // usersModel::updateOrCreate(
        //     ['id' => $request->user_id],
        //     ['firstName' => $request->firstName, 'lastName' => $request->lastName]
        // );

        // return response()->json(['success' => 'User saved successfully.']);

        $users = new usersModel;
        $users->firstName = $request->firstName;
        $users->lastName = $request->lastName;
        $users->save();

        return response()->json([
            "message" => "users record created"
        ], 201);
    }


    public function edit($id)
    {
        $users = usersModel::find($id);
        return response()->json($users);
    }

    public function update(Request $request, $id)
    {
        // usersModel::updateOrCreate(
        //     ['id' => $request->user_id],
        //     ['firstName' => $request->firstName, 'lastName' => $request->lastName]
        // );

        // return response()->json(['success' => 'User saved successfully.']);

        if (usersModel::where('id', $id)->exists()) {
            $users = usersModel::find($id);
            $users->firstName = is_null($request->firstName) ? $users->firstName : $request->firstName;
            $users->lastName = is_null($request->lastName) ? $users->lastName : $request->lastName;
            $users->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
    public function destroy($id)
    {
        if(usersModel::where('id', $id)->exists()) {
            $users = usersModel::find($id);
            $users->delete();

            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }

    }
}
