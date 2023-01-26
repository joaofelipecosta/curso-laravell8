@extends ('admin.layouts.app')

@section ('title', 'Criar novo Post')

@section('content')
    <h1>Cadastrar Novo post</h1>

    <form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
    @include('admin.posts._partials.form')
    </form>

@endsection
