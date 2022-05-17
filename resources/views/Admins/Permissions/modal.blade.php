   <!-- Modal Edit-->
   <div class="modal fade" id="addPermission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
        <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nom</label>
                  <input type="text" class="form-control" name="name" id="recipient-name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="recipient-name" value="{{ old('description') }}">
                  </div>
                <div class="mb-3">
                    @foreach ($roles as $key=>$role)
                        <div class="form-check">
                            <input class="form-check-input"
                                name="roles[]"
                                type="checkbox"
                                value="{{ $role->id}}"
                                id="role-{{ $key}}"
                            >
                            <label class="form-check-label" for="role-{{ $key}}">
                            {{$role->name}}
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
  <div class="modal fade" id="permission{{$permission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf
            @method('PUT')
        <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nom</label>
                  <input type="text" class="form-control"  name="name" id="recipient-name" value="{{ $permission->name }}">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="recipient-name" value="{{ $permission->description }}">
                  </div>
                <div class="mb-3">
                    @foreach ($roles as $key=>$role)
                    <div class="form-check">
                        <input class="form-check-input"
                            name="roles[]"
                            type="checkbox"
                            value="{{ $role->id}}"
                            id="role-{{ $key}}"
                            {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="role-{{ $key}}">
                        {{$role->name}}
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
  <div class="modal fade" id="deletePermission{{$permission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}">
            @csrf
            @method('DELETE')
        <div class="modal-body center">
            <h3 class="title">Are you sure you want delete permission ?</h3>
                <div class="mb-3">
                  <input type="text" class="form-control" hidden value="{{ $permission->id }}">
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
