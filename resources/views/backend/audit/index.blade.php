@extends('backend.layouts.app')
@section('title','Data Audit Air')
@section('content')
<x-page-index title="Data Audit Air" buttonLabel="Tambah Data" routeCreate="audit.create">
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Pilihan Jawaban</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $i=>$audit)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$audit->pertanyaan}}</td>
                <td>
                    @php
                    $data = json_decode($audit->jawaban, true);
                    @endphp
                    <ol type="A">
                        @foreach($data as $jawaban)
                        <li class="mt-2">
                            {{$jawaban['jawaban']}} <b>({{$jawaban['parameter']}})</b>
                        </li>
                        @endforeach
                    </ol>
                </td>
                <td>
                    <a href="" class="table-action btn btn-primary mr-2" data-toggle="tooltip" title="Ubah">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="tooltip" title="Delete"
                        value="">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-page-index>
@endsection

@push('scripts')

@endpush
