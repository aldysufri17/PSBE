@extends('backend.layouts.app')
@section('title','Tambah Data Audit')
@section('content')
<x-page-form page='create' route="audit.index" title="Data Audit">
    <form action="{{route('audit.store')}}" method="post">
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pertanyaan</label>
                <textarea class="form-control" placeholder="Isi Pertanyaan" name="pertanyaan"
                    id="exampleFormControlTextarea1" style="height:100%;" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Jawaban</label>
                <div class="input-group hdtuto control-group lst increment">
                    <input placeholder="Opsi Jawaban" type="text" name="jawaban[]" class="myfrm form-control">
                    <div class="col-md-2">
                        <input type="number" placeholder="Parameter Nilai" name="parameter[]" class="myfrm form-control">
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i
                                class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                </div>
                <div class="clone"></div>
            </div>
        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('audit.index') }}">Batal</a>
            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
        </div>
    </form>
</x-page-form>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#rmv").hide();
        $(".btn-success").click(function () {
            $(".clone").append(`
                <div class="hide">
                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                        <input placeholder="Opsi Jawaban" type="text" name="jawaban[]" class="myfrm form-control">
                        <div class="col-md-2">
                            <input type="number" placeholder="Parameter Nilai" name="parameter[]" class="myfrm form-control">
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-danger" id="rmv" type="button"><i
                                    class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
            `)
        });
        $("body").on("click", ".btn-danger", function () {
            $(this).parents(".hdtuto").remove();
        });
    });

</script>
@endpush
