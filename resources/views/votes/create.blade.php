 @extends('layouts.app', ['page' => __('Create Vote'), 'pageSlug' => 'vote'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                    <h2 class="card-title">Create Vote</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12">
                        <form method="post" action="{{ route('votes.store') }}" autocomplete="off">
                            <div class="card-body">
                                @csrf
                                @include('alerts.success')
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label>{{ __('Vote Title') }}</label>
                                    <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Vote Title') }}" value="" required>
                                    @include('alerts.feedback', ['field' => 'title'])
                                </div>

                                <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label>{{ __('Date') }}</label>
                                    <input type="date" name="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="" required>
                                    @include('alerts.feedback', ['field' => 'date'])
                                </div>                                                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">{{ __('Create Vote') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
