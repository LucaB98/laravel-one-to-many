@extends('layouts.app')
@section('title', 'Home')


@section('content')

<header>
    <h1 class="text-center my-5">Dettagli progetto</h1>
</header>
<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-10">
                <div class="card my-5" >
                    @if($project->image)
                    <img src="{{$project->printImage()}}" class="card-img-top" alt="{{$project->title}}">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title">{{$project->title}}</h5>
                    <div class="my-2">
                        @if($project->type)
                            <span class="badge" style="background-color: {{$project->type->color}}">{{$project->type->label}}</span>
                        @else 
                            <span class="text-danger"><b>Nessun tipo selezionato</b></span>
                        @endif
                    </div>
                    <p class="card-text">{{$project->description}}</p>
                    </div>
                </div>
            </div>

        <div>
    </div>
</main>



@endsection