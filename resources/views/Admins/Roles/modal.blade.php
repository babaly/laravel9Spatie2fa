   <!-- Modal Edit-->
   <div class="modal fade" id="addRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Rôle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
        <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nom</label>
                  <input type="text" class="form-control" name="name" id="recipient-name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    @foreach ($permissions as $key=>$perm)
                        <div class="form-check">
                            <input class="form-check-input"
                                name="permissions[]"
                                type="checkbox"
                                value="{{ $perm->id}}"
                                id="permission-{{ $key}}"
                            >
                            <label class="form-check-label" for="permission-{{ $key}}">
                            {{$perm->description}}
                            </label>
                        </div>
                    @endforeach
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit-->
  <div class="modal fade" id="role{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Rôle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
        <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nom</label>
                  <input type="text" class="form-control" name="name" id="recipient-name" value="{{ $role->name }}">
                </div>
                <div class="mb-3">
                    @foreach ($permissions as $key=>$perm)
                        <div class="form-check">
                            <input class="form-check-input"
                                name="permissions[]"
                                type="checkbox"
                                value="{{ $perm->id}}"
                                id="permission-{{ $key}}"
                                {{ $role->hasPermissionTo($perm) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="permission-{{ $key}}">
                            {{$perm->description}}
                            </label>
                        </div>
                    @endforeach
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Modal Delete-->
  <div class="modal fade" id="deleteRole{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete rôle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
            @csrf
            @method('DELETE')
        <div class="modal-body center">
            <h3 class="title">Are you sure you want delete role ?</h3>
                <div class="mb-3">
                  <input type="text" class="form-control" hidden value="{{ $role->id }}">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
    </form>
      </div>
    </div>
  </div>
