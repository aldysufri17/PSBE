<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use App\Models\Hasil;
use App\Models\Hasil_Audit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InputAudit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selectedAnswers = [];
    public $parameterNilai = [];
    public $jawaban = [];
    public $start = [];
    public $total;

    public function answers($auditId, $jawaban, $parameter, $total)
    {
        $this->total = $total;
        $this->parameterNilai[$auditId] = $parameter;
        $this->selectedAnswers[$auditId] = $auditId . '-' . $jawaban;
        $this->jawaban[(int)$auditId] = array(
            'jawab' => $jawaban,
            'parameter' => $parameter,
        );
    }

    public function render()
    {
        $audits = Audit::paginate(1);
        return view('livewire.input-audit', [
            'audits' => $audits
        ]);
    }

    public function store()
    {
        $arr = $this->total;
        $validator = $this->validate([
            'jawaban' => "required|array|min:$arr",
        ]);


        Hasil::create([
            'user_id' => Auth::user()->id,
            'jawaban' => json_encode($this->jawaban),
            'total' => array_sum($this->parameterNilai)
        ]);
        return redirect()->route('input.audit')->with('success', 'Audit Disimpan');
    }
}
