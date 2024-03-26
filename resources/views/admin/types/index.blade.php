{{--Layout--}}
@extends('layouts.app')


{{--Titolo--}}
@section('title', 'Types')

{{--Contenuto principale pagina--}}
@section('content')
<header class="mb-4 mt-5">
    <div class="container d-flex justify-content-center align-items-center">
      <h1 class="">Lista tipologie progetti</h1>
    </div>
  </header>
  
  <main>
      <div class="container py-5">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Etichetta</th>
                    <th scope="col">Creato il</th>
                    <th scope="col">Ultima modifica</th>
                    <th scope="col">
                        <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.types.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus me-1"></i>Nuovo</a>
                        </div>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id}}</th>
                        <td>{{ $type->label}}</td>
                        <td>{{ $type->getFormattedDate('created_at')}}</td>
                        <td>{{ $type->getFormattedDate('updated_at')}}</td>
                        <td class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.types.show', $type)}}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.types.edit', $type)}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                            <form action="{{route('admin.types.destroy', $type)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <h2 class="text-center">Nessun tipo esistente</h2>
                        </td>
                    </tr> 
            
                    @endforelse
                </tbody>
            </table>
      </div>
  </main>

@endsection

{{--Scripts--}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
    @vite('resources/js/toast_timer.js')
@endsection