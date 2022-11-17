<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurriculumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('check.cpf');
    }

    public function createCurriculum(CurriculumRequest $req)
    {
        try{

            if($form_curriculum = $req->validated()) {
                $form_curriculum = Curriculo::create(
                    array_merge($form_curriculum, ["id_user" => Auth::user()->_id])
                );
                return response()->json([
                    "response" => $form_curriculum,
                ],  201);
            }

        }
        catch(\Exception $e) {
            return $e;
        }

    }
}
;
