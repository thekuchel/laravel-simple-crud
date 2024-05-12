<form class="user" method="POST" id="quill-form-submit" data-state="{{ isset($data) ? 'edit' : 'create' }}">
    @csrf

    <div class="col mb-3">
        <label for="nik" class="form-label">NIK <span class="text-danger">*</span> :</label>
        <input class="form-control {{ isset($errors) && $errors->has('nik') ? 'is-invalid' : '' }}" type="text"
            name="nik" value="{{ old('nik') ? old('nik') : (isset($data) ? $data->nik : '') }}">

        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    </div>
    <div class="col mb-3">
        <label for="name" class="form-label">Nama <span class="text-danger">*</span> :</label>
        <input class="form-control {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}" type="text"
            name="name" value="{{ old('name') ? old('name') : (isset($data) ? $data->name : '') }}">

        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    </div>
    {{-- <div class="col mb-3">
        <label for="username" class="form-label">Username <span class="text-danger">*</span> :</label>
        <input class="form-control {{ isset($errors) && $errors->has('username') ? 'is-invalid' : '' }}" type="text"
            name="username" value="{{ old('username') ? old('username') : (isset($data) ? $data->user->username : '') }}">

        <div class="invalid-feedback">
            {{ $errors->first('username') }}
        </div>
    </div>

    <div class="col mb-3">
        <label for="password" class="form-label">Password {!! !isset($data->id) ? '<span class="text-danger">*</span>' : '' !!} :</label>
        <input class="form-control {{ isset($errors) && $errors->has('password') ? 'is-invalid' : '' }}" type="password"
            name="password" {!! !isset($data->id) ? 'required' : '' !!}>

        {!! isset($data->id)
            ? '<span class="text-danger" align="center">Leave it blank if you don\'t want to change</span>'
            : '' !!}

        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    </div> --}}
    <div class="col mb-3">
        <label for="divisi" class="form-label">Divisi <span class="text-danger">*</span> :</label>
        <input class="form-control {{ isset($errors) && $errors->has('divisi') ? 'is-invalid' : '' }}" type="text"
            name="divisi" value="{{ old('divisi') ? old('divisi') : (isset($data) ? $data->divisi : '') }}">

        <div class="invalid-feedback">
            {{ $errors->first('divisi') }}
        </div>
    </div>

    <div class="col mb-3">
        <button type="submit" class="btn btn-primary btn-submit btn-block">Submit</button>
    </div>
</form>
