{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Trash')

{{--Contenuto principale pagina--}}
@section('content')

<header>
    <h1 class="text-center my-5">Progetti Eliminati</h1>
</header>

<main>
    <div class="container py-5">
        <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il</th>
                <th scope="col">Ultima modifica</th>
                <th scope="col">
                  <div class="d-flex justify-content-end">
                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i>Svuota Cestino</a>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
            @forelse($projects as $project)
              <tr>
                <th scope="row">{{ $project->id}}</th>
                <td>{{ $project->title}}</td>
                <td>{{ $project->slug}}</td>
                <td>{{ $project->getFormattedDate('created_at')}}</td>
                <td>{{ $project->getFormattedDate('updated_at')}}</td>
                <td class="d-flex gap-2 justify-content-end ">
                    <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                    <form action="{{route('admin.projects.drop', $project)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    <form action="{{route('admin.projects.restore', $project)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type='submit' class="btn  btn-success btn-sm"><i class="fas fa-arrows-rotate"></i></button>
                    </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                    <h2 class="text-center">Nessun progetto nel cestino</h2>
                </td>
              </tr> 
        
            @endforelse
            </tbody>
        </table>
        {{-- Paginazione 
        @if ($projects->hasPages())
        {{ $projects->links()}}
        @endif--}}
        <hr>
    </div>
</main>
<footer>
    <div class="container">
        <a href="{{ route('admin.projects.index')}}" class="btn btn-secondary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
    </div>
</footer>

@endsection

{{--Scripts--}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
@endsection

