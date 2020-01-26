@extends('layouts.app')

@section('content')
<div class="container py-3 mb5">
  <h3 class="mb-5">Challenges</h1>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-header">
                        {{ $category->name }}
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a data-toggle="collapse" href="#{{ $category->short_name }}-challenges" role="button" aria-expanded="false" aria-controls="{{ $category->short_name }}-challenges">
                                <img src="images/icons/{{ $category->short_name }}.svg" class="category-icon" />
                            </a>
                        </div>
                        <div class="collapse" id="{{ $category->short_name }}-challenges">
                            <div class="card card-body">
                                @forelse ($challenges[$category->id] as $challenge)
                                    <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#challenge-{{ $challenge->id }}">{{ $challenge->name }}</button>
                                @empty
                                   Nothing found here!
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $counts[$category->id] }} challenges
                    </div>
                </div>
            </div>
            @if ($loop->index % 3 == 2)
                </div>
                <div class="row">
            @endif
        @endforeach
    </div>
</div>
@endsection

@section('modals')
    @foreach ($categories as $category)
        @foreach ($challenges[$category->id] as $challenge)
            <div class="modal fade bd-example-modal-lg" id="challenge-{{ $challenge->id }}" tabindex="-1" role="dialog" aria-labelledby="challenge-label-{{ $challenge->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="challenge-label-{{ $challenge->id }}">{{ $challenge->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mb-4 mt-4 pl-5 pr-5">
                            {{ $challenge->description }}
                            
                        </div>
                        <div class="modal-footer">
                                <form class="form-inline form-flag">
                                    <label class="sr-only" for="form-label-{{ $challenge->id }}">Flag</label>
                                    <div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0 input-flag">
                                        <input type="text" name="flag" class="form-control" id="form-label-{{ $challenge->id }}"  placeholder="NUT{...}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary submit-flag" data-challenge-id="{{ $challenge->id }}">Check</button>
                                    <span class="invalid-feedback d-block"><strong id="error-{{ $challenge->id }}"></strong></span>
                                    <span class="invalid-feedback d-block text-success"><strong id="success-{{ $challenge->id }}"></strong></span>
                                </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection

@section('additional-scripts')
    <script>
        $('.submit-flag').click(function(e) {
            e.preventDefault();
            submitObject = $(this);
            errorBox = $(submitObject).next().children().first();
            successBox = $(submitObject).next().next().children().first()
            challenge_id = $(submitObject).data("challenge-id");
            flag = $("#form-label-" + challenge_id).val();
            axios.post('/submissions', {
                flag: flag,
                challenge_id: challenge_id
            })
            .then(function (response) {
                if (response.data.status == "success") {
                    $(errorBox).html("");
                    $(successBox).html(response.data.message);
                    setTimeout(() => {
                        $(successBox).html("");
                    }, 15000);
                }
            })
            .catch(function (error) {
                $(successBox).html("");
                $(errorBox).html("&nbsp;");
                if (typeof error.response.data.errors.flag !== 'undefined') {
                    setTimeout(() => {
                         $(errorBox).html(error.response.data.errors.flag);
                    }, 15);
                } else if (typeof error.response.data.errors.challenge_id !== 'undefined') {
                    setTimeout(() => {
                         $(errorBox).html(error.response.data.errors.challenge_id);
                    }, 15);
                } else {
                     setTimeout(() => {
                         $(errorBox).html("There has been an unexpected error. Try refreshing the page!");
                    }, 15);
                }
                setTimeout(() => {
                     $(errorBox).html("");
                }, 15000);
            });
        });
    </script>
@endsection
