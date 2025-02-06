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

    /**
     * Resets the component's state to empty and turns off edit mode.
     *
     * This method is called when the user clicks the "Novo Grupo Econômico" button
     * or when the user closes the modal. It resets the component's state to
     * empty and turns off edit mode.
     *
     * @return void
     */
    public function resetModal()
    {
        $this->name = '';
        $this->economicGroupId = null;
        $this->editMode = false;
    }

    /**
     * Creates a new EconomicGroup.
     *
     * This function validates the name using the validation rules specified in
     * the class properties. After validation, it creates a new EconomicGroup
     * using the validated name.
     *
     * @return void
     */
    public function createEconomicGroup()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:economic_groups,name',
        ]);

        ModelsEconomicGroup::create(['name' => $this->name]);

        $this->name = '';

        $this->dispatch('close-modal');
    }

    /**
     * Prepares the component to edit an existing EconomicGroup.
     *
     * Retrieves the EconomicGroup by its ID, and if found, sets the component's
     * state with the group's details for editing. Opens the modal for editing.
     *
     * @param int $id The ID of the EconomicGroup to be edited.
     * @return void
     */

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

    /**
     * Updates an existing EconomicGroup.
     *
     * Validates the name using the validation rules specified in the class
     * properties. If the validation is successful, it updates the EconomicGroup
     * with the validated name. Resets the component's state and closes the
     * modal.
     *
     * @return void
     */
    public function updateEconomicGroup()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:economic_groups,name,' . $this->economicGroupId,
        ]);

        $economicGroup = ModelsEconomicGroup::find($this->economicGroupId);

        if ($economicGroup) {
            $economicGroup->update(['name' => $this->name]);
        }

        $this->reset(['name', 'economicGroupId', 'editMode']);

        $this->dispatch('close-modal');
    }

    /**
     * Deletes an existing EconomicGroup.
     *
     * Finds the EconomicGroup with the given $id and deletes it. Does nothing
     * if the EconomicGroup is not found.
     *
     * @param int $id The ID of the EconomicGroup to be deleted.
     *
     * @return void
     */
    public function deleteEconomicGroup($id)
    {
        $economicGroup = ModelsEconomicGroup::find($id);

        if ($economicGroup) {
            $economicGroup->delete();
        }
    }


    /**
     * Renders the Livewire component.
     *
     * @return \Illuminate\Contracts\View\View The rendered view.
     */
    public function render()
    {
        return view('livewire.economic-group', [
            'economicGroups' => ModelsEconomicGroup::orderByDesc('id')->paginate(10)
        ]);
    }
}

