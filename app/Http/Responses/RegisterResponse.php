<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;

class RegisterResponse extends FortifyRegisterResponse
{
    protected $guard;

    protected $creator;

    public function __construct(StatefulGuard $guard, CreatesNewUsers $creator)
    {
        $this->guard = $guard;
        $this->creator = $creator;
    }

    public function toResponse($request)
    {
        // $this->guard->logout();

        // return parent::toResponse($request);
    }
}
