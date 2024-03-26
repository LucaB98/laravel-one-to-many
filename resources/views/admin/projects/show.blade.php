{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Projects')


{{--Contenuto principale pagina--}}

@section('content')

<header>
    <h1 class="text-center my-5">{{ $project->title}}</h1>
</header>
<main>
    <div class="container py-5">
        <div class="my-2">
            @if($project->type)
                <span class="badge" style="background-color: {{$project->type->color}}">{{$project->type->label}}</span>
            @else 
                <span class="text-danger"><b>Nessun tipo selezionato</b></span>
            @endif
        </div>
        <div class="clearfix">
            @if ($project->image)
                <img src="{{ $project->printImage() }}" alt="{{$project->title}}" class="me-2 float-start">
            @endif
            <p>{{$project->description}}</p>
            <strong>Creato il:</strong> {{ $project->getFormattedDate('created_at')}}
            <strong>Creato il:</strong> {{ $project->getFormattedDate('updated_at')}}
        </div>
        <hr>      
    </div>
</main>

<footer>
    <div class="container py-5 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.projects.index')}}" class="btn btn-secondary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning"><i class="fas fa-pencil me-2"></i>Modifica</a>
            <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="delete-form">
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
