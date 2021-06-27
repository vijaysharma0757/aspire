<?php

namespace App\Http\Controllers;

use App\Http\repositories\LoanRepository;
use Illuminate\Http\Request;
use  App\User;
use Illuminate\Support\Facades\Auth;

class LoanController extends APIController
{
    private $_loanRepo;
    public function __construct()
    {
        $this->_loanRepo = new LoanRepository();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return Response
     */
    public function addLoan(Request $request)
    {
        $request = $request->all();
        $request['userId'] = Auth::id();
        return $this->_loanRepo->addLoan($request);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 600
        ], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
}
