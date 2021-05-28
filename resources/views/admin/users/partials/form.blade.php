@csrf
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="cil-user"></i>
            </span>
        </div>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
            name="name" id="name" value="{{ old('name') }}"
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
            name="email" value="{{ old('email') }}" placeholder="Email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
        <input type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="pass12345">
        <input type="hidden" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="pass12345">

    <div class="input-group mb-3">
        @foreach($roles as $role)
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                  <input class="form-check-input" name="roles[]" id="{{ $role->name }}" type="checkbox" value="{{ $role->id }}">
                  <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                </div>
            </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn-usrregister">Register</button>
    </div>