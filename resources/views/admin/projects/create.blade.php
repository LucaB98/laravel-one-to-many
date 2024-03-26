{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'New_project')


{{--Contenuto principale pagina--}}
@section('content')

<header>
    <h1 class="text-center my-5">Nuovo Progetto</h1>
</header>

<main>
    {{--Form per la creazione di un progetto--}}
    <div class="container py-5">
        @include('includes.projects.form')      
    </div>
</main>

@endsection


{{--Scripts--}}
@section('scripts')
    @vite('resources/js/slug_field.js')
    @vite('resources/js/image_preview.js')
@endsection

