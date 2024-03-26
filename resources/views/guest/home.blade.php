@extends('layouts.app')
@section('title', 'Home')


@section('content')

<header>
    <h1 class="text-center my-5">Benvenuti! Questi sono i miei progetti</h1>
</header>
<main>
    <div class="container py-5">
        <div class="row">
            @forelse($projects as $project)
            <div class="col-4">
                <div class="card my-5" >
                    @if($project->image)
                    <img src="{{ $project->printImage() }}" class="card-img-top" alt="{{$project->title}}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$project->title}}</h5>
                        <p class="card-text">{{$project->description}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('guest.projects.show', $project->slug)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            <div class="my-2">
                                @if($project->type)
                                    <span class="badge" style="background-color: {{$project->type->color}}">{{$project->type->label}}</span>
                                @else 
                                    <span class="text-danger"><b>Nessun tipo selezionato</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{--Se non ho progetti --}}
            @empty
            <div class="col-8">
                <h1 class="text-center">Attualmente non ci sono progetti....</h1>
            </div>
            @endforelse
        </div>

        <div>
            {{-- Paginazione --}}
            @if ($projects->hasPages())
            {{ $projects->links()}}
            @endif
        </div>
    </div>
</main>



@endsection