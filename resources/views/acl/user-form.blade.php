<form class="form-layout form-layout-5" method="post" id="quill-form-submit" data-state="{{ isset($data) ? 'edit' : 'create' }}">
  {{ csrf_field() }}

  <div class="mb-3">
    <label class="form-label" for="kode">Nama <span class="text-danger">*</span> :</label>
    <input name='name' autocomplete="off" value="{{ !is_null(old('name')) ? old('name') : (isset($data->name) ?
    $data->name : '') }}" required="required" class="form-control">

    <div class="invalid-feedback">
      {{ $errors->first('name') }}
    </div>
  </div>
  {{-- <div class="mb-3">
    <label class="form-label" for="kode">Role <span class="text-danger">*</span> :</label>
    <select name='role' class="form-select select2">
      @foreach($role as $id => $row)

      @php
      $selected = !is_null(old('role')) ? old('role') : (isset($data) ? $data->id_role : '');
      $selected = $selected == $row->id ? "selected" : "";
      @endphp

      <option value="{{$row->id}}" {{$selected}}>{{$row->nama}}</option>
      @endforeach
    </select>

    <div class="invalid-feedback">
      {{ $errors->first('role') }}
    </div>
  </div> --}}

  <div class="mb-3">
    <label class="form-label" for="kode">E-Mail <span class="text-danger">*</span> :</label>
    <input name='email' autocomplete="off" value='{{ !is_null(old('email')) ? old('email') : (isset($data->email)
    ? $data->email : '') }}' required="required" class="form-control" type="email">

    <div class="invalid-feedback">
      {{ $errors->first('email') }}
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="username">Username <span class="text-danger">*</span> :</label>
    <input name='username' autocomplete="off" value='{{ !is_null(old('username')) ? old('username') : (isset($data->username)
    ? $data->username : '') }}' required="required" class="form-control" type="text">

    <div class="invalid-feedback">
      {{ $errors->first('username') }}
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="kode">Password {!! !isset($data->id) ? '<span class="text-danger">*</span>' : ''!!}
      :</label>
    <input name='password' autocomplete="off" {!! !isset($data->id) ? 'required' : ''!!} class="form-control"
    type="password">
    {!! isset($data->id) ? '<span class="tx-danger" align="center">isi Password jika ingin menggantinya</span>' :
    ''!!}

    <div class="invalid-feedback">
      {{ $errors->first('password') }}
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="kode">Konfirmasi Password {!! !isset($data->id) ? '<span
        class="text-danger">*</span>'
      : ''!!} :</label>
    <input name='conf_password' {!! !isset($data->id) ? 'required' : ''!!} class="form-control" type="password">

    <div class="invalid-feedback">
      {{ $errors->first('conf_password') }}
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <button type="button" class="btn btn-outline-secondary btn-block w-100" onclick="hideOffcanvas()">Cancel</button>
    </div>

    <div class="col-6">
      <button type="submit" class="btn btn-secondary btn-block w-100 btn-submit">Submit</button>
    </div>

  </div>
</form>
