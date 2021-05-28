@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h4 class="text-black-50">Welcome! {{ Auth::user()->name }}</h4>
    </div>

@if($isEmpty == 'false')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $studentCount->studentCount }}</div>
                        <div>Students Registered</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-9">
            <div class="card text-white bg-info">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">School Year: {{ $currentSchoolYear->schoolyear }}</div>
                        <div>Statistics</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $enrolled }}</div>
                        <div>Enrolled</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $completed }}</div>
                        <div>Completed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $graduated }}</div>
                        <div>Graduated</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $failed }}</div>
                        <div>Dropped / Failed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
<div class="row">
    <div class="col-sm-6 col-lg-12">
        <div class="card text-white bg-info">
            <div class="card-body card-body pb-3 d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-value-lg">It seems School year is not yet configured. Please contact ADMIN to Configure</div>
                    <div>Admin->New School Year Setup</div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endif

    

@endsection
