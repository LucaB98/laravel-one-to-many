{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Type_creation')


{{--Contenuto principale pagina--}}

@section('content')

<header>
    <h1 class="text-center my-5">Crea un nuovo tipo per i progetti</h1>
</header>
<main>
    <div class="container py-5">
        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <div class="row align-items-center justify-content-start">
                <div class="col-5">
                    <label for="label" class="form-label">Etichetta</label>
                    <input type="text" class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid  @enderror" id="label" name="label" placeholder="FrontEnd" value="{{ old('label') }}">
                </div>
                <div class="col-1">
                    <label for="color" class="form-label">Colore</label>
                    <input type="color" class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid  @enderror" id="color" name="color" value="{{ old('color') }}">
                </div>
            </div>
            <div class="my-5 text-end">
                <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Crea</button>
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
