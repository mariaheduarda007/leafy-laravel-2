<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Aluno::class);
        $alunos = Aluno::all();
        // dd($alunos);
        return view('aluno.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Aluno::class);
        $cursos = Curso::all();
        return view('aluno.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Aluno::class);
        $curso = Curso::find($request->curso);

        if(isset($curso)) {
            $aluno = new Aluno();
            $aluno->nome = mb_strtoupper($request->nome, 'UTF-8');
            $aluno->ano = $request->ano;
            $aluno->curso()->associate($curso);
            $aluno->save();

            if($request->hasFile('foto')) {
                // Upload File
                $extensao_arq = $request->file('foto')->getClientOriginalExtension();
                $name = $aluno->id.'_'.time().'.'.$extensao_arq;
                $request->file('foto')->storeAs('fotos', $name, ['disk' => 'public']);
                $aluno->foto = 'fotos/'.$name;
                $aluno->save();
            }
        }

        return redirect()->route('aluno.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', Aluno::class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aluno = Aluno::find($id);
        Gate::authorize('update', $aluno);

        if(isset($aluno)) {
            $cursos = Curso::all();
            return view('aluno.edit', compact(['aluno', 'cursos']));
        }

        return redirect()->route('aluno.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aluno = Aluno::find($id);
        Gate::authorize('update', $aluno);
        $curso = Curso::find($request->curso);

        if(isset($curso) && isset($aluno)) {
            $aluno->nome = mb_strtoupper($request->nome, 'UTF-8');
            $aluno->ano = $request->ano;
            $aluno->curso()->associate($curso);

            if($request->hasFile('foto')) {
                // Upload File
                $extensao_arq = $request->file('foto')->getClientOriginalExtension();
                $name = $aluno->id.'_'.time().'.'.$extensao_arq;
                $request->file('foto')->storeAs('fotos', $name, ['disk' => 'public']);
                $aluno->foto = 'fotos/'.$name;
            }
            $aluno->save();
        }

        return redirect()->route('aluno.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aluno = Aluno::find($id);
        Gate::authorize('delete', $aluno);

        if(isset($aluno)) {
            $aluno->delete();
        }

        return redirect()->route('aluno.index');
    }

    public function report() {
        $alunos = Aluno::with(['curso'])->get();
        // Gera um PDF a partir de uma view Blade
        $pdf = Pdf::loadView('aluno.report', ['alunos' => $alunos]);
        // Exibe o PDF no navegador
        return $pdf->stream('document.pdf');
        // Ou Faz o download do PDF
        // return $pdf->download('document.pdf');
}
}
