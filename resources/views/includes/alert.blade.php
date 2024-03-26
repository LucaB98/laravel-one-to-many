@session('message')
<div class="container my-5">
    <div class="alert alert-{{ session('type', 'info')}} alert-dismissible fade show" role="alert">
        {{ $value}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

@endsession