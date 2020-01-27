@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-5">Manage Challenges</h1>
            <challenge-management :challenges="{{ $challenges }}" :categories="{{ $categories }}"></challenge-management>
        </div>
    </div>
</div>
@endsection
