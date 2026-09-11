<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create a response after successful authentication.
     */
    public function toResponse($request)
    {
        return match ($request->user()->role) {
            'learner' => redirect()->route('learner.dashboard'),
            'creator' => redirect()->route('creator.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => abort(403),
        };
    }
}
