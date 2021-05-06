@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h3>Payment Scheme Management</h3></div>
            <div class="card-body">
                <div class="btn-group">
                    <button class="btn btn-info" type="button">Profiles</button>
                    <button class="btn btn-info dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" style="margin: 0px;">
                        @foreach ($paymentProfiles as $paymentProfile)
                            <a class="dropdown-item" href="{{ route('admin.paymentScheme.show', $paymentProfile->id) }}">{{ $paymentProfile->name }}</a>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCreateNewProfile">
                    Create new profile
                </button>
            </div>
        </div>
    </div>
</div>

@isset($paymentSchemedata)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>View</strong> <small>Form</small></div>
            <div class="card-body mx-3">
                <div class="form-group row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2">
                        <div class="input-group float-right">
                            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#modalAddFee" data-whatever="@getbootstrap">Add Fee</button>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFeeModalCenter">
                                Delete
                            </button>
                        </div>
                    </div>
                    

                    <div class="input-group mx-2 pt-2 pb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Payment Scheme Name</span></div>
                        <input class="form-control" type="text" placeholder="{{ $paymentSchemedata->name }}" readonly>
                    </div>
                    @isset($paymentSchemedata->fees['fees'])
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Fee Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentSchemedata->fees['fees'] as $fee)
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="{{ $fee['feeName'] }}" value="{{ $fee['feeName'] }}" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="{{ $fee['feeName'] }}_amount" value="{{ $fee['fullAmount']  }}" readonly>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset

                </div>
            </div> 
        </div>
    </div>
</div>

<!-- Add new fee Modal -->
<div class="modal fade" id="modalAddFee" tabindex="-1" role="dialog" aria-labelledby="modalAddFeeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddFeeTitle">Add Fee for Profile: {{ $paymentSchemedata->name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('admin.paymentScheme.addNewFee') }}">
            @csrf
            <input class="form-control" id="profileId" type="hidden" value="{{ $paymentSchemedata->id }}" name="profileId">

            <div class="modal-body">
                <div class="input-group mb-2">
                    <div class="input-group-prepend"><span class="input-group-text">Fee Name</span></div>
                    <input class="form-control" id="name" type="text" name="name">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Full Amount</span></div>
                    <input class="form-control" id="fullAmount" type="text" name="fullAmount">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteFeeModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteFeeModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteFeeModalCenterTitle">Delete Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure to remove Fee Profile?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"
              onClick="event.preventDefault();
              document.getElementById('delete-fee-form-{{ $paymentSchemedata->id }}').submit()">Delete</button>
        </div>
  
        <form id="delete-fee-form-{{ $paymentSchemedata->id }}" action="{{ route('admin.paymentScheme.destroy', $paymentSchemedata->id) }}" method="POST" style="display: none">
          @csrf
          @method("DELETE")
        </form>
  
      </div>
    </div>
  </div>

@endisset

<!-- Add new profile Modal -->
<div class="modal fade" id="modalCreateNewProfile" tabindex="-1" role="dialog" aria-labelledby="modalCreateNewProfileTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateNewProfileTitle">Create New Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('admin.paymentScheme.store') }}">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Profile Name</span></div>
                    <input class="form-control" id="name" type="text" name="name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection