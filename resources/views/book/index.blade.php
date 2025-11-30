@extends('templates/main',
[
'titulo'=>"Leafy",
'cabecalho' => 'Lista de Livros',
'rota' => 'book.create',
'relatorio' => '',
'class' => App\Models\Book::class,
]
)
@section('conteudo')
<form action="{{ route('book.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="encontre livros por título, autor, gênero ou ano" value="{{ request('search') }}" style="outline: none; box-shadow: none;">
        <button class="btn btn-light" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

<table class="table align-middle caption-top table-striped">
    <thead>
        <th class="text-secondary">TÍTULO</th>
        <th class="d-none d-md-table-cell text-secondary">AUTOR</th>
        <th class="d-none d-md-table-cell text-secondary">GÊNERO</th>
        <th class="d-none d-md-table-cell text-secondary">ANO</th>
        <th class="text-secondary">AÇÕES</th>
    </thead>
    <tbody>
        @foreach ($books as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td class="d-none d-md-table-cell">{{ $item->author }}</td>
            <td class="d-none d-md-table-cell">{{ $item->genre }}</td>
            <td class="d-none d-md-table-cell">{{ $item->releaseDate }}</td>
            <td>
                <a href="{{ asset('storage/'.$item->cover) }}" target="_blank" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                        <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                    </svg>
                </a>
                <a href="{{ route('book.show', $item->id) }}" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                    </svg>
                </a>

                @can('update', $item)
                <a href="{{route('book.edit', $item->id)}}" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                    </svg>
                </a>
                @endcan

                @can('delete', $item)
                <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item->id }}', '{{ $item->title }} - {{ $item->author }}')" class="btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#d9534f" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg>
                </a>

                <form action="{{route('book.destroy', $item->id)}}" method="POST" id="form_{{$item->id}}">
                    @csrf
                    @method('delete')
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $books->withQueryString()->links() }}

@endsection