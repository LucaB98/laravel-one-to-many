{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Projects')

{{--Contenuto principale pagina--}}
@section('content')

<header class="mb-4 mt-5">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="">Progetti realizzati</h1>
    <div class="col-4">
      <form action="{{route('admin.projects.index')}}" method="GET">
        <div class="input-group">
          <select class="form-select" name="is_completed_filter">
            <option value="">Tutti</option>
            <option value="completed" @if($is_completed_filter === 'completed') selected @endif>Completati</option>
            <option value="uncompleted" @if($is_completed_filter === 'uncompleted') selected @endif>In corso</option>
          </select>
          <select class="form-select" name="type_filter">
            <option value="">Tutti</option>
            @foreach($types as $type)
            <option value={{ $type->id }} @if($type_filter == $type->id) selected @endif>{{ $type->label }}</option>
            @endforeach
          </select>
          <button class="btn btn-outline-secondary">Filtra</button>
        </div>
      </form>
    </div>
  </div>
</header>

<main>
    <div class="container py-5">
        <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Tipo</th>
                <th scope="col">Creato il</th>
                <th scope="col">Ultima modifica</th>
                <th scope="col">Completato</th>
                <th scope="col">
                  <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.projects.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus me-1"></i>Nuovo</a>
                    <a href="{{ route('admin.projects.trash')}}" class="btn btn-secondary btn-sm"><i class="fas fa-trash me-1 text-danger"></i>Cestino</a>
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
                <td>
                    @if($project->type)
                        <span class="badge" style="background-color: {{$project->type->color}}">{{$project->type->label}}</span>
                    @else 
                        -
                    @endif
                </td>
                </td>
                <td>{{ $project->getFormattedDate('created_at')}}</td>
                <td>{{ $project->getFormattedDate('updated_at')}}</td>
                <td class="ps-4">{!! $project->completeIcon() !!}</td>
                <td class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                    <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">
                    <h2 class="text-center">Nessun progetto realizzato</h2>
                </td>
              </tr> 
        
            @endforelse
            </tbody>
        </table>
        {{-- Paginazione --}}
        @if ($projects->hasPages())
        {{ $projects->links()}}
        @endif
    </div>
</main>

@endsection

{{--Scripts--}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
    @vite('resources/js/toast_timer.js')
@endsection


