@extends('layouts.app')
@section('title','Daftar Pengguna')
@section('content')
<x-page-index title="Pengguna" buttonLabel="Tambah Pengguna" routeCreate="pengguna.create">
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->role->name}}</td>
                <td>
                    @if ($data->status == 0)
                    <span class="badge badge-danger">Inactive</span>
                    @elseif ($data->status == 1)
                    <span class="badge badge-success">Active</span>
                    @endif
                </td>
                <td>
                    <div class="table-actions btn-group">
                        @if ($data->status == 0)
                        <a href="{{ route('pengguna.status', ['user_id' => encrypt($data->id), 'status' => 1]) }}"
                            title="Inactive" class="table-action btn btn-success mr-2" data-toggle="tooltip">
                            <i class="fa fa-check"></i>
                        </a>
                        @elseif ($data->status == 1)
                        <a href="{{ route('pengguna.status', ['user_id' => encrypt($data->id), 'status' => 0]) }}"
                            title="Active" class="table-action btn btn-danger mr-2" data-toggle="tooltip">
                            <i class="fa fa-ban"></i>
                        </a>
                        @endif
                        <button class="table-action btn btn-warning reset-btn mr-2" title="Reset Password" data-toggle="tooltip" value="">
                            <i class="fas fa-history"></i>
                        </button>
                        <a href="" class="table-action btn btn-info mr-2" data-toggle="tooltip"
                            title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('pengguna.edit',$data->id)}}" class="table-action btn btn-primary mr-2" data-toggle="tooltip"
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
@include('user.user-modal')
@endsection

