
@extends('templates/main',
    [
        'titulo'=>"Leafy",
        'cabecalho' => 'Alterar Livro',
        'rota' => '',
        'relatorio' => '',
    ]
)
@section('conteudo')

    <form action="{{route('book.update', $book->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col" >
                <div class="input-group mb-3">
                    <span style="background-color: #92AF8D" class="input-group-text text-white">Capa</span>
                    <input class="form-control text-secondary" type="file" name="cover"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="title"
                        placeholder="Titulo"
                        value="{{ $book->title }}"
                    />
                    <label for="title">Título</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="author"
                        placeholder="Autor"
                        value="{{ $book->author }}"
                    />
                    <label for="author">Autor</label>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="genre"
                        placeholder="Genre"
                        value="{{ $book->genre }}"
                    />
                    <label for="genre">Gênero</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="sinopsis"
                        placeholder="Sinopsis"
                        value="{{ $book->sinopsis }}"
                    />
                    <label for="sinopsis">Sinopse</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="releaseDate"
                        placeholder="ReleaseDate"
                        value="{{ $book->releaseDate }}"
                    />
                    <label for="releaseDate">Ano de Publicação</label>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col">
                <a href="{{route('book.index')}}" style="background-color: #92AF8D; color: #fcfcfcff" class="btn btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffffff" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
                <button type="submit" style="background-color: #4A6745; color: #fcfcfcff" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffffff" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>

@endsection
