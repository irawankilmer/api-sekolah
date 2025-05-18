@extends('../layout')

@section('title', 'Tag')

@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Tag</h3>
      </div>

      <div class="card-body">

        <form action="{{ route('sys.tag.store') }}" method="POST" onsubmit="disableSubmitButton()">
          @csrf

          @error('name')
          <span class="badge bg-danger">{{ $message }}</span>
          @enderror
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nama Tag...">
          </div>

          <div class="input-group mb-3">
            <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Deskripsi...">{{ old('description') }}</textarea>
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
                  <a href="#"
                     class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center justify-content-center"
                     data-bs-toggle="modal" data-bs-target="#editModal{{ $tag->id }}"
                     data-bs-placement="top" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form id="delete-form-{{ $tag->id }}" action="{{ route('sys.tag.destroy', $tag->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center justify-content-center"
                            data-bs-placement="top" title="Hapus"
                            onclick="confirmDelete(event, '{{ $tag->id }}')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="editModal{{ $tag->id }}"
                   tabindex="-1" aria-labelledby="editModalLabel{{ $tag->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('sys.tag.update', $tag->id) }}" method="POST"
                          onsubmit="disableEditButton('{{ $tag->id }}')">
                      @csrf
                      @method('PUT')
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $tag->id }}">Edit Tag</h5>
                      </div>
                      <div class="modal-body">
                        @error('edit.name')
                        <span class="badge bg-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                          <label for="name{{ $tag->id }}" class="form-label">Nama Tag</label>
                          <input
                            type="text"
                            class="form-control" id="name{{ $tag->id }}"
                            name="edit[name]"
                            value="{{ old('edit.name', $tag->name) }}"
                          >
                        </div>
                        <div class="mb-3">
                          <label for="description{{ $tag->id }}" class="form-label">Deskripsi</label>
                          <textarea
                            class="form-control"
                            id="description{{ $tag->id }}"
                            name="edit[description]"
                            rows="3"
                          >{{ old('edit.description', $tag->description) }}</textarea>
                        </div>
                      </div>
                      <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-outline-secondary" id="edit-btn-{{ $tag->id }}">
                          <span id="buttonEdit-text-{{ $tag->id }}">Edit</span>
                          <i class="bi bi-pencil-square" id="edit-icon-{{ $tag->id }}"></i>
                          <span
                            id="loadingEdit-spinner-{{ $tag->id }}"
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                            style="display: none;"></span>
                        </button>

                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          <i class="bi bi-box-arrow-in-left"></i> Batal
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@if ($errors->any() && session('edit_tag_id'))
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modalId = "editModal{{ session('edit_tag_id') }}";
      const modal = new bootstrap.Modal(document.getElementById(modalId));
      modal.show();
    });
  </script>
@endif

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

  <script>
    function disableEditButton(id) {
      const editButton = document.getElementById(`edit-btn-${id}`);
      const spinnerEdit = document.getElementById(`loadingEdit-spinner-${id}`);
      const buttonEditText = document.getElementById(`buttonEdit-text-${id}`);
      const editIcon = document.getElementById(`edit-icon-${id}`);

      if (editButton) editButton.disabled = true;
      if (spinnerEdit) spinnerEdit.style.display = 'inline-block';
      if (buttonEditText) buttonEditText.textContent = 'Edit...';
      if (editIcon) editIcon.style.display = 'none';
    }
  </script>

  <script>
    function confirmDelete(event, tagId) {
      event.preventDefault();
      Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
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
@endpush