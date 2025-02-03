<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Corretor;
use App\Http\Resources\v1\CorretorResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CorretorController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CorretorResource::collection(Corretor::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validação
        $validator = Validator::make($request->all(),[
            //validação dos caracteres dos campos
            'nome' =>'required|min:2',
            'cpf' =>'required|min:11|max:11',
            'creci' =>'required|min:2'
        ]);

        if ($validator->fails()){
            return $this->error('Erro de validação!', 422, $validator->errors());
        }

        //$created sao os dados ja cadastrados
        $created = Corretor::create($validator->validated());

        if($created) {
            return $this->response('cadastrado com sucesso!', 200, $created);
        }
        return $this->error('Erro ao tentar cadastrar!', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Corretor $corretor)
    {
        return new CorretorResource($corretor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Corretor $corretor)
    {
        //validação
        $validator = Validator::make($request->all(),[
            //validação dos caracteres dos campos
            'nome' =>'required|min:2',
            'cpf' =>'required|min:11|max:11',
            'creci' =>'required|min:2'
        ]);

        if ($validator->fails()){
            return $this->error('Erro de validação!', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $corretor->update([
            'nome' => $validated['nome'],
            'cpf' => $validated['cpf'],
            'creci' => $validated['creci'],
        ]);

        if($updated){
            return $this->response('Editado com sucesso!', 200, new CorretorResource($corretor));
        }
        return $this->error('Erro ao tentar editar!', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corretor $corretor)
    {
        $delete = $corretor->delete();

        if($delete){
            return $this->response('Deletado com sucesso!', 200);
        }
        return $this->error('Erro ao tentar deletar!', 400);
    }
}

