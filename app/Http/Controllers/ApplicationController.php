<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use App\Models\Application;

class ApplicationController  extends Controller
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
            Application::create($request->all());
        } catch (Exception $e) {
            return $this->internalError('Error Adding Application');
        }
        return $this->successfulResponse(['result' => 'Application Successfully Added.']);
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
            $application = Application::findOrFail($id);
            $application->updated_at = Carbon::now();
            $application->updated_by = $request->input('requestUserId', null);
            $application->update($request->all());
        } catch (Exception  $e) {
            return $this->internalError('Error Updating Application');
        }
        return $this->successfulResponse(['result' => 'Application Successfully Updated.']);
    }

    public function destroy($id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->updated_by = $request->input('requestUserId', null);
            $application->delete();
        } catch (Exception  $e) {
            return $this->internalError('Error Deleting Application');
        }
        return $this->successfulResponse(['result' => 'Application Successfully Deleted.']);
    }
}
