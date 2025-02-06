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
        $this->economic_group_id = '';
        $this->editMode = false;
        $this->flagId = null;
    }

    /**
     * Creates a new Flag.
     *
     * Validates the input data for the flag's name and the associated economic group.
     * If validation passes, a new Flag is created and the input fields are reset.
     * Finally, the modal is closed.
     *
     * @return void
     */

    public function createFlag()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:flags,name',
            'economic_group_id' => 'required|exists:economic_groups,id',
        ]);

        Flag::create([
            'name' => $this->name,
            'economic_group_id' => $this->economic_group_id,
        ]);

        $this->reset(['name', 'economic_group_id']);
        $this->dispatch('close-modal');
    }

    /**
     * Prepares the component to edit an existing Flag.
     *
     * Finds the Flag with the given $id and populates the component's state with
     * the Flag's data. Sets edit mode to true and opens the modal.
     *
     * @param int $id The ID of the Flag to be edited.
     *
     * @return void
     */
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

    /**
     * Updates an existing Flag.
     *
     * Validates the name and economic group ID using the validation rules
     * specified in the class properties. If the validation is successful, it
     * updates the Flag with the validated data. Resets the component's state
     * and closes the modal.
     *
     * @return void
     */
    public function updateFlag()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:flags,name,' . $this->flagId,
            'economic_group_id' => 'required|exists:economic_groups,id',
        ]);
    
        $flag = Flag::find($this->flagId);
    
        if ($flag) {
            $flag->update([
                'name' => $this->name,
                'economic_group_id' => $this->economic_group_id,
            ]);
        }
    
        $this->reset(['name', 'economic_group_id', 'flagId', 'editMode']);
        $this->dispatch('close-modal');
    }

    /**
     * Deletes an existing Flag.
     *
     * Finds the Flag with the given $id and deletes it. Does nothing if the
     * Flag is not found.
     *
     * @param int $id The ID of the Flag to be deleted.
     *
     * @return void
     */
    public function deleteFlag($id)
    {
        $flag = Flag::find($id);

        if ($flag) {
            $flag->delete();
        }
    }

    /**
     * Renders the Livewire component.
     *
     * This method renders the Livewire component which displays a list of all
     * existing Flags and allows the user to create new Flags, edit existing
     * Flags, and delete existing Flags. The list of Flags is paginated and
     * sorted in descending order by ID. The method also makes available the
     * list of all existing EconomicGroups, sorted in ascending order by name.
     *
     * @return \Illuminate\Contracts\View\View The rendered view.
     */
    public function render()
    {
        return view('livewire.flags', [
            'flags' => Flag::with('economicGroup')->orderByDesc('id')->paginate(10),
            'economicGroups' => EconomicGroup::orderBy('name')->get(),
        ]);
    }
}
