@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header d-flex justify-content-between m-2">
                    <h2>Liste des permissions</h2>
                    {{-- @can('create', App\Models\Permission::class)
                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermission">Add</div>
                    @endcan --}}
                </div>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong> -
                    {{session('success')}}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"><i class="fa fa-window-close"></i></button>
                </div>
                @endif
                @if ($errors->any())
                <!-- Alert modal if exist -->
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                    <i class="ri-notification-off-line label-icon"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close btn-close-white swal2-close" data-bs-dismiss="alert"
                        aria-label="Close"><i class="fa fa-window-close"></i></button>
                </div>
                <!-- End alert modal -->
                @endif
                <div class="body table-responsive p-2">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                            <tr>
                                <th scope="row">{{$permission->id}}</th>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->description}}</td>
                                <td>
                                    @can('update', $permission)
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#permission{{$permission->id}}">edit</button>
                                    @endcan
                                    @can('delete', $permission)
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePermission{{$permission->id}}">delete</button>
                                    @endcan
                                </td>
                            </tr>
                            @include('Admins.Permissions.modal')
                            @empty
                            <tr>
                                <td colspan="2">
                                    <p>Pas de permission disponible</p>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">{!! $permissions->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
