@extends('layouts.app')
@section('title','Tambah Role Pengguna')
@section('content')
<x-page-form page='create' route="role.index" title="Role Pengguna">
    <form action="{{route('role.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <x-form-input label="Nama" type="text" required="required" name="name"></x-form-input>
        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('role.index') }}">Batal</a>
            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
        </div>
    </form>
</x-page-form>
@endsection