@extends('plantilla')

@section('contenido')
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">Editar Autor</div>
                <div class="card body">
                    <form id="frAuthors" method="POST" action="{{ url ('authors', [$author])}}">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="author" value="{{$author->author}}" class="form-control" maxlength="50" placeholder="Author" required>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <button class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection