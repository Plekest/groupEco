<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Flag;
use Livewire\Component;
use Livewire\WithPagination;

class Units extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fantasy_name;
    public $company_name;
    public $cnpj;
    public $flag_id;
    public $editMode = false;
    public $unitId;

    public function createUnit()
    {
        $this->validate([
            'fantasy_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'flag_id' => 'required|exists:flags,id', // Corrigido aqui
        ]);
    
        Unit::create([
            'fantasy_name' => $this->fantasy_name,
            'company_name' => $this->company_name,
            'cnpj' => $this->cnpj,
            'flag_id' => $this->flag_id, // Corrigido aqui
        ]);
    
        $this->reset(['fantasy_name', 'company_name', 'cnpj', 'flag_id']);
        $this->dispatch('close-modal');
    }
    
    public function editUnit($id)
    {
        $unit = Unit::find($id);

        if ($unit) {
            $this->unitId = $unit->id;
            $this->fantasy_name = $unit->fantasy_name;
            $this->company_name = $unit->company_name;
            $this->cnpj = $unit->cnpj;
            $this->flag_id = $unit->flag_id;

            $this->editMode = true;
            $this->dispatch('open-modal');
        }
    }

    public function updateUnit()
    {
        $this->validate([
            'fantasy_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'flag_id' => 'required|exists:flags,id',
        ]);

        $unit = Unit::find($this->unitId);

        if ($unit) {
            $unit->update([
                'fantasy_name' => $this->fantasy_name,
                'company_name' => $this->company_name,
                'cnpj' => $this->cnpj,
                'flag_id' => $this->flag_id,
            ]);
        }

        $this->reset(['fantasy_name', 'company_name', 'cnpj', 'flag_id', 'unitId', 'editMode']);
        $this->dispatch('close-modal');
    }

    public function deleteUnit($id)
    {
        $unit = Unit::find($id);

        if ($unit) {
            $unit->delete();
        }
    }

    public function render()
    {
        return view('livewire.units', [
            'units' => Unit::with('flag')->orderByDesc('id')->paginate(10),
            'flags' => Flag::orderBy('name')->get(),
        ]);
    }
}
