<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculo;
use Illuminate\Http\Request;

class Curriculum extends Controller
{
    public function createCurriculum(CurriculumRequest $req)
    {
        $user = auth()->user();
        if($form_curriculum = $req->validated()) {
            $form_curriculum = Curriculo::create($form_curriculum);
        }
    }
}
