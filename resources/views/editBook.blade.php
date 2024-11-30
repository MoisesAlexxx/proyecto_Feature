@extends('plantilla')

@section('contenido')
<div class="row mt-3">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-dark text-white">Editar Libro</div>
            <div class="card-body">
                <form id="frBooks" method="POST" action="{{ url('books', [$book]) }}">
                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-book"></i></span>
                        <input type="text" name="titulo" value="{{ $book->titulo }}" class="form-control" maxlength="100" placeholder="Título" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-pencil-alt"></i></span>
                        <input type="text" name="public_en" value="{{ $book->public_en }}" class="form-control" maxlength="100" placeholder="Lugar de publicación" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <select name="id_author" class="form-select" required>
                            <option value="">Selecciona un autor</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ $book->id_author == $author->id ? 'selected' : '' }}>{{ $author->author }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid col-6 mx-auto">
                        <button class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
