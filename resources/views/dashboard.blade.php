@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="ml-4 text-left">
                            <h2 class="card-title">Information and Communications Technologies</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h5 class="card-category">Employee of the Month</h5>
                        <h2 class="card-title">Past Results</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Year
                                    </th>
                                    <th>
                                        Month
                                    </th>
                                    <th>
                                        Employee
                                    </th>
                                    <th class="text-center">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (!empty($votes))
                                @foreach($votes as $vote)
                                <tr>
                                    <td>{{$vote->id}}</td>
                                    <td>{{$vote->title}}</td>
                                    <td>{{date('d F Y',strtotime($vote->date))}}</td>
                                    @if ($vote->is_active)
                                    <td><span class="badge badge-success">Active</span></td>
                                    @elseif (!$vote->is_active)
                                    <td><span class="badge badge-secondary">Not Active</span></td>
                                    @endif
                                    @php
                                        $count = 0;
                                        foreach ($vote->profiles as $profiles) {
                                            if (!empty($profiles->id)) {
                                                $count = $count + 1;
                                            }
                                        }
                                    @endphp
                                    <td>{{$count}}</td>                                    
                                    <td><a href="{{ route('votes.show', $vote->id ) }}"><span class="badge badge-outline-success">View</span></a></td>
                                </tr>
                                @endforeach
                                @endif        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection