@extends ('admin.layouts.app')

@section ('title', 'Criar novo Post')

@section('content')
    <h1 class="text-center text-3x1 uppercase font-black my-4"> Novo post</h1>

    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
        <form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
        @include('admin.posts._partials.form')
        </form>
    </div>

@endsection
