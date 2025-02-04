<?php

namespace App\Livewire;

use App\Models\EconomicGroup as ModelsEconomicGroup;
use Livewire\Component;
use Livewire\WithPagination;

class EconomicGroup extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $editMode = false;
    public $economicGroupId;

    public function createEconomicGroup()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        ModelsEconomicGroup::create(['name' => $this->name]);

        $this->name = '';

        $this->dispatch('close-modal');
    }

    public function editEconomicGroup($id)
    {
        $economicGroup = ModelsEconomicGroup::find($id);

        if ($economicGroup) {
            $this->economicGroupId = $economicGroup->id;
            $this->name = $economicGroup->name;

            $this->editMode = true;
            $this->dispatch('open-modal');
        }
    }

    public function updateEconomicGroup()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $economicGroup = ModelsEconomicGroup::find($this->economicGroupId);

        if ($economicGroup) {
            $economicGroup->update(['name' => $this->name]);
        }

        $this->reset(['name', 'economicGroupId', 'editMode']);

        $this->dispatch('close-modal');
    }

    public function deleteEconomicGroup($id)
    {
        $economicGroup = ModelsEconomicGroup::find($id);

        if ($economicGroup) {
            $economicGroup->delete();
        }
    }


    public function render()
    {
        return view('livewire.economic-group', [
            'economicGroups' => ModelsEconomicGroup::orderByDesc('id')->paginate(10)
        ]);
    }
}

