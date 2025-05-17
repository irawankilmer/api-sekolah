@extends('../layout')

@section('title', 'Tag')

@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Tag</h3>
      </div>

      <div class="card-body">

        <form action="" onsubmit="disableSubmitButton()">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nama Tag...">
          </div>

          <div class="input-group mb-3">
            <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Deskripsi..."></textarea>
          </div>

          <div class="input-group d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-secondary" id="submit-btn">
              <span id="button-text">Add</span>
              <i class="bi bi-folder-plus" id="add-icon"></i>
              <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Tag</h3>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="tag-table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tag['name'] }}</td>
                <td>{{ $tag['description'] }}</td>
                <td>edit | hapus</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tag-table').DataTable();
    });

    function disableSubmitButton() {
      const submitButton = document.getElementById('submit-btn');
      const spinner = document.getElementById('loading-spinner');
      const buttonText = document.getElementById('button-text');
      const addIcon = document.getElementById('add-icon');

      submitButton.disabled = true;
      spinner.style.display = 'inline-block';

      if (buttonText) {
        buttonText.textContent = 'Add...';
      }

      if (addIcon) {
        addIcon.style.display = 'none';
      }
    }
  </script>
@endpush