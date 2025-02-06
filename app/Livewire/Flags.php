<?php

namespace App\Livewire;

use App\Models\Flag;
use App\Models\EconomicGroup;
use Livewire\Component;
use Livewire\WithPagination;

class Flags extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $economic_group_id;
    public $editMode = false;
    public $flagId;

    public function createFlag()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'economic_group_id' => 'required|exists:economic_groups,id', // Corrigido
        ]);

        Flag::create([
            'name' => $this->name,
            'economic_group_id' => $this->economic_group_id, // Corrigido
        ]);

        $this->reset(['name', 'economic_group_id']);
        $this->dispatch('close-modal');
    }

    public function editFlag($id)
    {
        $flag = Flag::find($id);

        if ($flag) {
            $this->flagId = $flag->id;
            $this->name = $flag->name;
            $this->economic_group_id = $flag->economic_group_id;

            $this->editMode = true;
            $this->dispatch('open-modal');
        }
    }

    public function updateFlag()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'economic_group_id' => 'required|exists:economic_groups,id', // Corrigido
        ]);
    
        $flag = Flag::find($this->flagId);
    
        if ($flag) {
            $flag->update([
                'name' => $this->name,
                'economic_group_id' => $this->economic_group_id, // Corrigido
            ]);
        }
    
        $this->reset(['name', 'economic_group_id', 'flagId', 'editMode']);
        $this->dispatch('close-modal');
    }

    public function deleteFlag($id)
    {
        $flag = Flag::find($id);

        if ($flag) {
            $flag->delete();
        }
    }

    public function render()
    {
        return view('livewire.flags', [
            'flags' => Flag::with('economicGroup')->orderByDesc('id')->paginate(10), // Corrigido
            'economicGroups' => EconomicGroup::orderBy('name')->get(),
        ]);
    }
}
