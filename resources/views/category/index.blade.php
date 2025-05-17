@extends('../layout')

@section('title', 'Kategori')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Kategori</h3>
      </div>

      <div class="card-body">

        <form action="" onsubmit="disableSubmitButton()">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nama Kategori...">
          </div>

          <div class="input-group mb-3">
            <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Deskripsi..."></textarea>
          </div>
        </form>

      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Kategori</h3>
      </div>

      <div class="card-body">

      </div>
    </div>
  </div>
</div>
@endsection