@extends('layouts.app', ['page' => __('View Vote'), 'pageSlug' => 'view'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-12">
                        <h2 class="card-title">Vote #{{$vote->id}} Summary</h2>
                    </div>
                </div>
            </div>
            <div class="card">               
                <h6 class="card-header">
                    <div class=" d-flex flex-row">
                        <div class="m-3">
                            Vote Details
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->is_admin) 
                            <a href="{{ route('votes.edit', $vote->id ) }}" class="btn btn-warning btn-sm ml-auto btn-edit">Edit</a>
                            @endif
                        @endif
                    </div>
                </h6>        
                <div class="card-body mt-2">
                    <table class="table card-table table-borderless table-condensed col-md-12">
                        <tr>
                            <td>
                                <h7><strong>Vote ID</strong></h7><br>
                                <h7>{{$vote->id}}</h7>
                            </td>
                        <tr>
                            <td>
                                <h7><strong>Vote Title</strong></h7><br>
                                <h7>{{$vote->title}}</h7>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h7><strong>Vote Code</strong></h7><br>
                                <h7>{{$vote->code}}</h7>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h7><strong>Vote Date</strong></h7><br>
                                <h7>{{date('d F Y',strtotime($vote->date))}}</h7>
                            </td>
                            <td>
                                <h7><strong>Status</strong></h7><br>
                                @if ($vote->is_active)
                                <h7><span class="badge badge-success">Active</span></h7>
                                @else
                                <h7><span class="badge badge-secondary">Not Active</span></h7>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h7><strong>Total Voters</strong></h7><br>
                                @php 
                                    $total_voters = 0; 
                                @endphp
                                @foreach ($vote->profiles as $profile)
                                    @if (!empty($profile->result->count))
                                    @php
                                        $total_voters += $profile->result->count;
                                    @endphp
                                    @endif                                    
                                @endforeach
                                <h7>{{$total_voters}}</h7>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <h6 class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Nominee Details
                        </div>
                    </div>
                </h6>
                <div class="card-body mt-2">
                    <table class="table card-table table-borderless table-condensed col-md-12">
                    <tr>
                        <td>
                            <h7><strong>Vote ID</strong></h7><br>
                        </td>
                        <td>
                            <h7><strong>Total Votes(%)</strong></h7><br>
                        </td>
                        @foreach ($vote->profiles as $profile)
                            <tr>
                                <td>
                                    <h7>{{$profile->name}}</h7>
                                </td>
                                @if (!empty($profile->result->count))
                                @php
                                    $result_percentage = $profile->result->count/$count*100;
                                    $total = round($result_percentage, $precision = 0, $mode = PHP_ROUND_HALF_UP);
                                @endphp
                                <td>
                                    <h7>{{$total}}</h7>
                                </td>
                                @else
                                <td>
                                    <h7>0</h7>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
