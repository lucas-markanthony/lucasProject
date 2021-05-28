@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><h3>View : {{ $user->name }}</h3></div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a></li>
                </ul>
                <div class="tab-content" id="myTab1Content">
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mt-4 ml-2 mr-2">
                        @include('admin.users.partials.profile')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <div class="mt-4 ml-2 mr-2">
                        @include('admin.users.partials.history')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalCenterTitle">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to remove  User?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"
            onClick="event.preventDefault();
            document.getElementById('delete-user-form-{{ $user->id }}').submit()">Delete</button>
      </div>

      <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
        @csrf
        @method("DELETE")
      </form>

    </div>
  </div>
</div>

@endsection

@section('third_party_scripts')
<script type="text/javascript">

    jQuery(document).ready(function(){

        $('#userSave').hide();
        $('#userCancel').hide();
        $('#userUpdate').show();
        $('.roleBox').prop('disabled', true);

        $('#userUpdate').click(function() {
            $('#userSave').show();
            $('#userCancel').show();
            $('#userUpdate').hide();

            $('#name').prop('readOnly', false);
            $('#email').prop('readOnly', false);
            $('.roleBox').prop('disabled', false);
        });

        $('#userCancel').click(function() {
            $('#userSave').hide();
            $('#userCancel').hide();
            $('#userUpdate').show();
            
            $('#name').prop('readOnly', true);
            $('#email').prop('readOnly', true);
            $('.roleBox').prop('disabled', true);
        });


    });

    


    </script>
@endsection