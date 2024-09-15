<?php

namespace App\Http\Controllers;

use App\Events\AccessEvent;
use App\Http\Requests\CredentialAccessRequest;
use App\Http\Requests\CredentialCreateRequest;
use App\Models\Credential;

class CredentialController extends Controller
{
    public function listAll()
    {
        return response()->json([
            'credentials' => Credential::all()
        ]);
    }

    public function create(CredentialCreateRequest $request)
    {
        Credential::create($request->validated());

        return response()->json([
            'credentials' => Credential::all()
        ]);
    }

    public function access(CredentialAccessRequest $request)
    {
        $credential = Credential::where('access_code', $request->access_code);

        if (!$credential->exists()) {
            event(new AccessEvent(false));

            return response()->json([
                'message' => 'Access denied'
            ], 403);
        }

        event(new AccessEvent(true));

        return response()->json([
            'message' => 'Access allowed'
        ]);
    }
}