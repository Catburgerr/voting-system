@extends('layouts.app', ['page' => __('Edit Vote'), 'pageSlug' => 'edit'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                    <h2 class="card-title">{{ __('Edit Vote') }}</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12">
                        <form method="post" action="{{ route('votes.update', $vote->id) }}" autocomplete="off">
                            <div class="card-body">
                                @csrf
                                @method('put')

                                @include('alerts.success')
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Vote Title') }}" value="{{ old('title', $vote->title) }}">
                                    @include('alerts.feedback', ['field' => 'title'])
                                </div>
                                <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label>{{ __('Date') }}</label>
                                    <input type="date" name="date" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('title', $vote->date) }}">
                                    @include('alerts.feedback', ['field' => 'date'])
                                </div> 
                                <div class="form-group{{ $errors->has('is_active') ? ' has-danger' : '' }}">
                                    <label>{{ __('Status') }}</label><span class="required">*</span>
                                    <div class="custom-select">
                                        <select class="form-control{{ $errors->has('is_active') ? ' is-invalid' : '' }}" name="is_active" required>
                                            @if ($vote->is_active == true)
                                            <option selected value="{{$vote->is_active}}">Active</option>
                                            <option value="0">Inactive</option>
                                            @else
                                            <option selected value="{{$vote->is_active}}">Inactive</option>
                                            <option value="1">Active</option>
                                            @endif
                                        </select>
                                    </div>                                    
                                </div>                                                                                          
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                    <h2 class="card-title">{{ __('Nominee List') }}</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12">
                    <!-- <form method="post" action="{{ route('nominee.store', $vote->id) }}" autocomplete="off">
                        @csrf -->
                        <div class="card-body ">
                            <div class="table-full-width table-responsive">
                                <table class="table">
                                    <tbody>
                                    @foreach ($vote->profiles as $profile)
                                        <tr>
                                            <td hidden>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" name="profile_id[]" type="checkbox" value="{{$profile->id}}">
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="title">{{$profile->name}}</p>
                                                <p class="text-muted">{{$profile->job_role}}</p>
                                            </td>    
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div hidden class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Appoint Nominees') }}</button>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
