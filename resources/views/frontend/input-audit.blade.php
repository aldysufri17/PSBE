@extends('frontend.layouts.app')
@section('title', 'Input data Audit')
@section('content')
<x-alert />
<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-weight-bold">Input data Audit</h2>
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Input data Audit</li>
            </ol>
        </div>

    </div>
</section><!-- Breadcrumbs Section -->

<div class="container-fluid">
    @if ($hasil)
    <h1>Total Skor Anda = {{$hasil->total}}</h1>
    <ol>
        @foreach (json_decode($hasil->jawaban, true) as $values)
        <li>{{$values['jawab']}} <b>{{$values['parameter']}}</b></li>
        @endforeach
    </ol>
    @else
    <livewire:input-audit>
    @endif
</div>
@endsection
