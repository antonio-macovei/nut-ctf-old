@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-5">Manage Challenges</h1>
            <div class="row">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        @foreach ($challenges as $challenge)
                            <a class="list-group-item list-group-item-action list-group-item-warning with-icon {{ $loop->first ? "active" : "" }}" id="ch-{{ $challenge->id }}-list" data-toggle="list" href="#ch-{{ $challenge->id }}" role="tab" aria-controls="{{ $challenge->id }}">
                                <div class="list-item-icon-container"><img src="/images/icons/{{ $challenge->category->short_name }}.svg" class="list-item-icon" /></div> {{ $challenge->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                    @foreach ($challenges as $challenge)
                        <div class="tab-pane fade {{ $loop->first ? "show active" : "" }}" id="ch-{{ $challenge->id }}" role="tabpanel" aria-labelledby="ch-{{ $challenge->id }}-list">{{ $challenge->description }}<br /> <br /> <a href="#!" class="btn btn-outline-warning"><span class="fas fa-download mr-2"></span>With Icon</a></div>
                   @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
