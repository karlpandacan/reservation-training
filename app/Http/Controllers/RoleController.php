<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use App\Models\Role;

class RoleController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->internalError('Invalid URL');
    }

    public function create()
    {
        return $this->internalError('Invalid URL');
    }

    public function store(Request $request)
    {
        try {
            $request->input('updated_at', Carbon::now());
            $request->input('created_at', Carbon::now());
            $request->input('updated_by', $request->input('requestUserId', null));
            $request->input('created_by', $request->input('requestUserId', null));
            Role::create($request->all());
        } catch (Exception $e) {
            return $this->internalError('Error Adding Role');
        }
        return $this->successfulResponse(['result' => 'Role Successfully Added.']);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->updated_at = Carbon::now();
            $role->updated_by = $request->input('requestUserId', null);
            $role->update($request->all());
        } catch (Exception  $e) {
            return $this->internalError('Error Updating Role');
        }
        return $this->successfulResponse(['result' => 'Role Successfully Updated.']);
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->updated_by = $request->input('requestUserId', null);
            $role->delete();
        } catch (Exception  $e) {
            return $this->internalError('Error Deleting Role.');
        }
        return $this->successfulResponse(['result' => 'Role Successfully Deleted.']);
    }
}
