<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
@method('PATCH')
    @csrf
<div class="mx-2">
    @can('is-admin')
        <button type="submit" class="btn btn-primary float-left mx-1 mb-4">Update</button>      
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCenter">
            Delete
        </button>
    @endcan
</div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cil-user"></i>
            </span>
        </div>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
            name="name" id="name" value="{{ old('name') }} @isset($user) {{ $user->name }} @endisset"
            placeholder="Full Name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cil-envelope-open"></i>
            </span>
        </div>
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }} @isset($user) {{ $user->email }} @endisset" placeholder="Email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        @foreach($roles as $role)
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" name="roles[]" id="{{ $role->name }}" 
                    type="checkbox" value="{{ $role->id }}"
                    @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
                  <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                </div>
            </div>
        @endforeach
    </div>
</form>
