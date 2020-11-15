<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Get countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountries()
    {
        $countryArray = [
            [
                'id' => 1,
                'name' => 'United Kingdom'
            ],
            [
                'id' => 2,
                'name' => 'China',
            ],
            [
                'id' => 3,
                'name' => 'United States'
            ]
        ];

        return response()->json($countryArray);
    }
}
