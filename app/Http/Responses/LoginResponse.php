<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        $home = $user->hasRole('content moderator') ? '/moderator/overview' : '/myconference';
        
        return redirect()->intended($home);
    }
}