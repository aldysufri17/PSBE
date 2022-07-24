@extends('backend.layouts.app')
@section('title','Daftar Role Pengguna')
@section('content')
<x-page-index title="Role Pengguna" buttonLabel="Tambah Role" routeCreate="role.create">
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
                        <a href="{{route('role.edit',$data->id)}}" class="table-action btn btn-primary mr-2" data-toggle="tooltip"
                            title="Ubah">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="tooltip" title="Delete" value="{{$data->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-page-index>
@include('backend.roles.role-modal')
@endsection