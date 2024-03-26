{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Type_details')


{{--Contenuto principale pagina--}}

@section('content')

<header>
    <h1 class="text-center my-5">{{ $type->label}}</h1>
</header>
<main>
    <div class="container py-5">
        <div>
            <strong>Creato il:</strong> {{ $type->getFormattedDate('created_at')}}
            <strong>Creato il:</strong> {{ $type->getFormattedDate('updated_at')}}
        </div>
        <hr>      
    </div>
</main>

<footer>
    <div class="container py-5 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.types.index')}}" class="btn btn-secondary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.types.edit', $type)}}" class="btn btn-warning"><i class="fas fa-pencil me-2"></i>Modifica</a>
            <form action="{{route('admin.types.destroy', $type)}}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-danger"><i class="fas fa-trash me-2"></i>Elimina</button>
            </form>
        </div>
    </div>
</footer>

@endsection


{{--Scripts--}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
@endsection
