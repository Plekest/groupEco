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

    /**
     * Resets the component's state to empty and turns off edit mode.
     *
     * This method is called when the user clicks the "Nova Unidade" button
     * or when the user closes the modal. It resets the component's state to
     * empty and turns off edit mode.
     *
     * @return void
     */
    public function resetModal()
    {
        $this->fantasy_name = '';
        $this->company_name = '';
        $this->cnpj = '';
        $this->flag_id = '';
        $this->editMode = false;
        $this->unitId = null;
    }

    /**
     * Validates the component's state and creates a new unit.
     *
     * This method is called when the user clicks the "Salvar" button in the
     * modal. It validates the component's state and creates a new unit if
     * validation passes. It then resets the component's state and closes
     * the modal.
     *
     * @return void
     */
    public function createUnit()
    {
        $this->validate([
            'fantasy_name' => 'required|string|max:120|unique:units,fantasy_name',
            'company_name' => 'required|string|max:120|unique:units,company_name',
            'cnpj' => 'required|cnpj|unique:units,cnpj',
            'flag_id' => 'required|exists:flags,id',
        ]);
    
        Unit::create([
            'fantasy_name' => $this->fantasy_name,
            'company_name' => $this->company_name,
            'cnpj' => $this->cnpj,
            'flag_id' => $this->flag_id,
        ]);
    
        $this->reset(['fantasy_name', 'company_name', 'cnpj', 'flag_id']);
        $this->dispatch('close-modal');
    }
    
    /**
     * Opens the modal to edit a unit.
     *
     * This method is called when the user clicks the "Editar" button in the
     * table. It finds the unit with the given id, copies its values to the
     * component's properties and sets `editMode` to true. It then opens the
     * modal by dispatching the "open-modal" event.
     *
     * @param int $id The id of the unit to be edited.
     *
     * @return void
     */
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

    /**
     * Updates an existing unit.
     *
     * Validates the fantasy name, company name, cnpj and flag id using the
     * validation rules specified in the class properties. If the validation
     * is successful, it updates the unit with the validated data. Resets the
     * component's state and closes the modal.
     *
     * @return void
     */
    public function updateUnit()
    {
        $this->validate([
            'fantasy_name' => 'required|string|max:120|unique:units,fantasy_name,' . $this->unitId,
            'company_name' => 'required|string|max:120|unique:units,company_name,' . $this->unitId,
            'cnpj' => 'required|cnpj|unique:units,cnpj,' . $this->unitId,
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

    /**
     * Deletes a unit.
     *
     * Finds the unit with the given id and deletes it if it exists.
     *
     * @param int $id The id of the unit to be deleted.
     *
     * @return void
     */
    public function deleteUnit($id)
    {
        $unit = Unit::find($id);

        if ($unit) {
            $unit->delete();
        }
    }

    /**
     * Renders the Livewire component.
     *
     * This method renders the Livewire component which displays a list of all
     * existing Units and allows the user to create new Units, edit existing
     * Units, and delete existing Units. The list of Units is paginated and
     * sorted in descending order by ID. The method also makes available the
     * list of all existing Flags, sorted in ascending order by name.
     *
     * @return \Illuminate\Contracts\View\View The rendered view.
     */
    public function render()
    {
        return view('livewire.units', [
            'units' => Unit::with('flag')->orderByDesc('id')->paginate(10),
            'flags' => Flag::orderBy('name')->get(),
        ]);
    }
}
