<?php

namespace Runline\ProfileTool\Http\Controllers;

use Illuminate\Routing\Controller;

class ToolController extends Controller
{
    public function index()
    {
        return response()->json([
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => "First name",
                "name" => "First name",
                "attribute" => "first_name",
                "value" => auth()->user()->first_name,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => "Last name",
                "name" => "Last name",
                "attribute" => "last_name",
                "value" => auth()->user()->last_name,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => "E-mail",
                "name" => "E-mail",
                "attribute" => "email",
                "value" => auth()->user()->email,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => "Password",
                "name" => "Password",
                "attribute" => "password",
                "value" => null,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => "Password Confirmation",
                "name" => "Password Confirmation",
                "attribute" => "password_confirmation",
                "value" => null,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ]
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed'
        ]);

        if(request()->has('password')) {
            auth()->user()->update([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
            ]);
        } else {
            auth()->user()->update(request()->only('name', 'email'));
        }

        return response()->json(__("Your profile has been updated!"));
    }
}
