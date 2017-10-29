<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            $userData = $request->all();
            $userData['password'] = md5($request->password);
            $userData['updated_at'] = Carbon::now();
            $userData['created_at'] = Carbon::now();
            $userData['updated_by'] = $request->input('requestUserId', null);
            $userData['created_by'] = $request->input('requestUserId', null);
            User::create($userData);
        } catch (Exception $e) {
            return $this->internalError('Error Adding User');
        }
        return $this->successfulResponse(['result' => 'User Successfully Added.']);
    }
    public function show(User $user)
    {

    }
    public function edit(User $user)
    {

    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->updated_at = Carbon::now();
            $user->updated_by = $request->input('requestUserId', null);
            $user->update($request->except(['email', 'password']));
        } catch (Exception  $e) {
            return $this->internalError('Error Updating User');
        }
        return $this->successfulResponse(['result' => 'User Successfully Updated.']);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->updated_by = $request->input('requestUserId', null);
            $user->delete();
        } catch (Exception  $e) {
            return $this->internalError('Error Deleting User');
        }
        return $this->successfulResponse(['result' => 'User Successfully Deleted.']);
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            if (!$request->has('password') or !$request->has('confirm_password')) {
                return $this->badRequest('Confirm Password is Required.');
            }
            if ($request->input('password') !== $request->input('confirm_password')) {
                return $this->badRequest('Confirm Password Does Not Match.');
            }
            $user = User::findOrFail($id);
            if ($request->input('old_password') !== $user->password) {
                return $this->badRequest('Old Password Does Not Match.');
            }
            $user->password = md5($request->input('password'));
            $user->updated_by = $request->input('requestUserId', null);
            $user->save();
        } catch (Exception $e) {
            return $this->internalError('Error Updating Password');
        }
        return $this->successfulResponse(['result' => 'Password Successfully Updated.']);
    }

    public function login(Request $request)
    {
        try {
            if (!$request->has('username') or !$request->has('password')) {
                return $this->badRequest([
                    'message' => 'Invalid Parameters.',
                    'required-fields' => ['username', 'password']
                ]);
            }
            $user = User::with('applications')
                ->where('email', $request->input('username'))
                ->where('password', md5($request->input('password')))->first();
            if($user === null) {
                return $this->badRequest('Invalid Username or Password.');
            }
            $tokenizer = md5($user->id . Carbon::now()->timestamp);
            Token::where('user_id', $user->id)
                ->update(['expires_at' => Carbon::now()]);
            $token = new Token;
            $token->user_id = $user->id;
            $token->token = $tokenizer;
            $token->created_at = Carbon::now();
            $token->expires_at = Carbon::now()->addHours(3);
            if (!$token->save()) {
                return $this->internalError('Error While Logging In.');
            }
            $responseResult = [
                'token' => $tokenizer,
                'user' => $user,
            ];
            return $this->successfulResponse(['result' => $responseResult]);
        } catch (Exception $e) {
            return $this->internalError('Error Logging In.');
        }
    }

    public function logout(Request $request)
    {
        Token::where('token', $request->header('x-rccl-session-id'))
            ->update(['expires_at' => Carbon::now()]);
        return $this->successfulResponse(['result' => 'Logout Successful.']);
    }
}
