<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VagaRequest;
use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;

class VagaController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function store(VagaRequest $req)
    {
        try{
            if($form_vaga = $req->validated()){
              $vaga = Vaga::create(array_merge($form_vaga, [
                    "id_user" => $this->user->id,
                    "company_name" => $this->user->name
                ]));
                return response()->json(['response' => $vaga], 201);
            }
        }catch (\Exception $e){
            return $e;
        }
    }
}
