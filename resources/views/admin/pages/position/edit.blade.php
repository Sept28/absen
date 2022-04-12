<style>
    .modal-footer-new{;
        padding-top: 30px;
    }
</style>

<form action="{{ route('position.update', $positions->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Nama Jabatan</label>
        <input name="name" class="form-control" type="text" placeholder="Ketik disini!" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Hak Akses</label>
        <select class="form-control" name="user_id">
            <option hidden>Pilih Hak Akses</option>
            <option value="owner">Owner</option>
            <option value="manager">Manager</option>
            <option value="employee">Employee</option>
            {{-- @foreach ($permissions as $permission)
                <option value="{{ $permission->user->id }}">{{ $permission->user->role }}</option>
            @endforeach --}}
        </select>
    </div>
    <div class="modal-footer-new d-flex justify-content-end">
        <button type="button" class="btn btn-secondary me-2" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>