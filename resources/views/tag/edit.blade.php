@extends('../layout')

@section('title', 'Edit Tag')

@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Tag</h3>
        </div>

        <div class="card-body">

          <form action="{{ route('sys.tag.update', $tag->id) }}" method="POST" onsubmit="disableSubmitButton()">
            @csrf
            @method('PUT')

            @error('name')
            <span class="badge bg-danger">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
              <input
                type="text"
                class="form-control"
                name="name"
                placeholder="Nama Tag..."
                value="{{ old('name', $tag->name) }}"
              >
            </div>

            <div class="input-group mb-3">
              <textarea
                name="description"
                cols="30" rows="10"
                class="form-control"
                placeholder="Deskripsi...">{{ old('description', $tag->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('sys.tag') }}" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-in-left"></i> Batal
              </a>

              <button type="submit" class="btn btn-outline-secondary" id="submit-btn">
                <span id="button-text">Edit</span>
                <i class="bi bi-pencil-square" id="edit-icon"></i>
                <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
              </button>
            </div>


          </form>

        </div>
      </div>
    </div>

    <div class="col-md-7">
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
                  <td>
                    <a href="{{ route('sys.tag.edit', $tag->id) }}" class="btn text-bg-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    |
                    <form id="delete-form-{{ $tag->id }}" action="{{ route('sys.tag.destroy', $tag->id) }}" method="POST" class="d-inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn text-bg-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" onclick="confirmDelete(event, '{{ $tag->id }}')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
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
      const editIcon = document.getElementById('edit-icon');

      submitButton.disabled = true;
      spinner.style.display = 'inline-block';

      if (buttonText) {
        buttonText.textContent = 'Edit...';
      }

      if (editIcon) {
        editIcon.style.display = 'none';
      }
    }

  </script>

  <script>
    function confirmDelete(event, tagId) {
      event.preventDefault();
      Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak bisa dikembalikan! Termasuk semua data transaksi yang terhubung",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-' + tagId).submit();
        }
      });
    }
  </script>

  <script>
    $(document).ready(function () {
      $('[data-bs-toggle="tooltip"]').tooltip();
    });
  </script>
@endpush