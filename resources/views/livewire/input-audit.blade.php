<div>
    @if(!empty($successMessage))
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

    {{-- Step 1
        <div id="step1" class="needs-validation" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
    <div class="card my-3">
        <div class="card-header bg-white fw-bold">Komponen Kebijakan (1/7)</div>
        <div class="card-body">
            <div class="question fw-bold">Pembentukan gugus tugas hemat energi dan air:</div>
            <div class="">
                <label class="radio-inline me-2 my-2"><input type="radio" wire:model="status" class="me-1" value="1"
                        {{{ $status == 'single' ? "checked" : "" }}}>Ada SK, SOP, dan kewajiban
                    membuat laporan HEA pada
                    tahun ini dan tahun sebelumnya</label>
                <label class="radio-inline me-2 my-2"><input type="radio" wire:model="status" class="me-1" value="2"
                        {{{ $status == 'single' ? "checked" : "" }}}>Ada SK, SOP, dan kewajiban
                    membuat laporan HEA pada
                    tahun ini dan tahun sebelumnya</label>
                <label class="radio-inline me-2 my-2"><input type="radio" wire:model="status" class="me-1" value="3"
                        {{{ $status == 'single' ? "checked" : "" }}}>Ada SK, SOP, dan kewajiban
                    membuat laporan HEA pada
                    tahun ini dan tahun sebelumnya</label>
                <label class="radio-inline me-2 my-2"><input type="radio" wire:model="status" class="me-1" value="4"
                        {{{ $status == 'single' ? "checked" : "" }}}>Ada SK, SOP, dan kewajiban
                    membuat laporan HEA pada
                    tahun ini dan tahun sebelumnya</label>
            </div>
        </div>
        <div class="card-footer bg-white text-end border-0">
            <button class="btn btn-primary" wire:click="firstStepSubmit" type="button">Next</button>
        </div>
    </div>
</div> --}}
<form wire:submit.prevent="store">
    @foreach ($audits as $i=>$audit)
    <div class="card my-3">
        <div class="card-header bg-white fw-bold">Komponen Kebijakan <b>{{$i+1}}</b></div>
        <div class="card-body">
            <span>{{$audit->pertanyaan}}</span>
            @php
            $data = json_decode($audit->jawaban, true);
            print_r($selectedAnswers);
            print_r($start);
            @endphp
            @foreach($data as $jawaban)
            <div class="mt-2">
                <input class="form-check-input" type="radio" wire:click="answers('{{ $audit->id }}', '{{$jawaban['jawaban'] }}', '{{$jawaban['parameter'] }}','{{$audit->count()}}')" {{in_array($audit->id.'-'.$jawaban['jawaban'], $selectedAnswers) ? 'checked': ""}} class="form-control @error('name')is-invalid @enderror"> 
                <label class="form-check-label">{{$jawaban['jawaban']}}</label>
                @error('name')
                <span class="invalid-feedback">
                        {{ $message }}
                </span>
            @enderror
            </div>
            @endforeach
        </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{$audits->links()}}
        </div>

        <div class="card-footer text-end">
            @if ($audits->currentPage() == $audits->lastPage())
            <button type="submit" class="btn btn-primary">Kirim</button>
            {{-- @else
            <button type="button" class="btn btn-primary">Next</button> --}}
            @endif
        </div>
    </div>
</form>
</div>
