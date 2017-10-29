<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationUser;

class ApplicationController  extends Controller
{
    use SoftDeletes;
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
            User::find($request->input('user_id'))
                ->applications()
                ->attach($request->input('application_id'), [
                    'role_id' => $request->input('role_id'),
                    'created_by' => $request->input('requestUserId'),
                    'updated_by' => $request->input('requestUserId'),
                ]);
        } catch (Exception $e) {
            return $this->internalError('Error Adding Application User');
        }
        return $this->successfulResponse(['result' => 'Application User Successfully Added.']);
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
            $applicationUser = ApplicationUser::findOrFail($id);
            $applicationUser->updated_at = Carbon::now();
            $applicationUser->updated_by = $request->input('requestUserId', null);
            $applicationUser->update($request->all());
        } catch (Exception  $e) {
            return $this->internalError('Error Updating Application');
        }
        return $this->successfulResponse(['result' => 'Application User Successfully Updated.']);
    }

    public function destroy($id)
    {
        try {
            User::find($request->input('user_id'))
                ->applications()
                ->detach($request->input('application_id'));
        } catch (Exception  $e) {
            return $this->internalError('Error Deleting Application');
        }
        return $this->successfulResponse(['result' => 'Application User Deleted.']);
    }
}
