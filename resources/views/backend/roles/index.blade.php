@extends('backend.layouts.app')
@section('title','Daftar Role Pengguna')
@section('content')
<x-page-index title="Role Pengguna" buttonLabel="Tambah Role" routeCreate="role.create">
    @if ($roles->IsNotEmpty())
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>
                    <div class="table-actions btn-group">
                        <a href="{{route('role.edit',$data->id)}}" class="table-action btn btn-primary mr-2"
                            data-toggle="tooltip" title="Ubah">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="tooltip" title="Delete"
                            value="{{$data->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="align-items-center bg-light p-3 border-secondary rounded">
        <span class="">Oops!</span><br>
        <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Role</p>
    </div>
    @endif
</x-page-index>
@include('backend.roles.role-modal')
@endsection
