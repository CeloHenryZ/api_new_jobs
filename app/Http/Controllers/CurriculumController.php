<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculo;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createCurriculum(CurriculumRequest $req)
    {
        try{

            $user = auth()->user();
            if($form_curriculum = $req->validated()) {
                $parts = explode(" ", $user->name);
                $lastName = array_pop($parts);
                $firstName = implode(" ", $parts);
                $form_curriculum = Curriculo::create(
                    array_merge($form_curriculum, [
                        "name" => $firstName,
                        "last_name" => $lastName,
                        "email" => $user->email,
                    ])
                );
                return response()->json([
                    "response" => $form_curriculum
                ], 201);
            }

        }
        catch(\Exception $e) {
            return $e;
        }

    }
}
;
