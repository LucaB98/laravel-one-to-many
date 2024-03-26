{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Type_edit')


{{--Contenuto principale pagina--}}

@section('content')

<header>
    <h1 class="text-center my-5">Modifica un tipo</h1>
</header>
<main>
    <div class="container py-5">
        <form action="{{route('admin.types.update', $type->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row align-items-center justify-content-start">
                <div class="col-5">
                    <label for="label" class="form-label">Etichetta</label>
                    <input type="text" class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid  @enderror" id="label" name="label" placeholder="FrontEnd" value="{{ old('label', $type->label) }}">
                </div>
                <div class="col-1">
                    <label for="color" class="form-label">Colore</label>
                    <input type="color" class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid  @enderror" id="color" name="color" value="{{ old('color', $type->color) }}">
                </div>
            </div>
            <div class="my-5 text-end">
                <button class="btn btn-warning"><i class="fa-solid fa-pen-to-square me-2"></i>Modifica</button>
            </div>
        </form> 
        <hr>
    </div>
</main>

<footer>
    <div class="container py-5 d-flex justify-content-start">
        <a href="{{ route('admin.types.index')}}" class="btn btn-secondary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
    </div>
</footer>

@endsection