<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $cpf;
    public $unit_id;
    public $editMode = false;
    public $employeeId;


    /**
     * Resets the component's state to empty and turns off edit mode.
     *
     * This method is called when the user clicks the "Novo Funcion rio" button
     * or when the user closes the modal. It resets the component's state to
     * empty and turns off edit mode.
     *
     * @return void
     */
    public function resetModal()
    {
        $this->name = '';
        $this->email = '';
        $this->cpf = '';
        $this->unit_id = '';
        $this->editMode = false;
        $this->employeeId = null;
    }

    /**
     * Validates the component's state and creates a new employee.
     *
     * This method is called when the user submits the form to create a new
     * employee. It validates the provided input data and creates a new 
     * employee record if validation passes. It then resets the input fields
     * and closes the modal.
     *
     * @return void
     */

    public function createEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:120|unique:employees,name',
            'email' => 'required|email|max:120|unique:employees,email',
            'cpf' => 'required|cpf|unique:employees,cpf',
            'unit_id' => 'required|exists:units,id',
        ]);

        Employee::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'unit_id' => $this->unit_id,
        ]);

        $this->reset(['name', 'email', 'cpf', 'unit_id']);
        $this->dispatch('close-modal');
    }

    /**
     * Opens the modal to edit an employee.
     *
     * This method is called when the user clicks the "Editar" button in the
     * table. It finds the employee with the given id, copies its values to the
     * component's properties and sets `editMode` to true. It then opens the
     * modal by dispatching the "open-modal" event.
     *
     * @param int $id The id of the employee to be edited.
     *
     * @return void
     */
    public function editEmployee($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $this->employeeId = $employee->id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->cpf = $employee->cpf;
            $this->unit_id = $employee->unit_id;

            $this->editMode = true;
            $this->dispatch('open-modal');
        }
    }

    /**
     * Validates the component's state and updates an existing employee.
     *
     * This method is called when the user submits the form to edit an
     * existing employee. It validates the provided input data and updates
     * the existing employee record if validation passes. It then resets the
     * input fields and closes the modal.
     *
     * @return void
     */
    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:120|unique:employees,name,' . $this->employeeId,
            'email' => 'required|email|max:120|unique:employees,email,' . $this->employeeId,
            'cpf' => 'required|string|max:14|unique:employees,cpf,' . $this->employeeId,
            'unit_id' => 'required|exists:units,id',
        ]);

        $employee = Employee::find($this->employeeId);

        if ($employee) {
            $employee->update([
                'name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unit_id' => $this->unit_id,
            ]);
        }

        $this->reset(['name', 'email', 'cpf', 'unit_id', 'employeeId', 'editMode']);
        $this->dispatch('close-modal');
    }

    /**
     * Deletes an existing employee.
     *
     * Finds the employee with the given id and deletes it if it exists.
     * Does nothing if the employee is not found.
     *
     * @param int $id The id of the employee to be deleted.
     *
     * @return void
     */
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();
        }
    }

    /**
     * Renders the Livewire component.
     *
     * This method renders the Livewire component which displays a list of all
     * existing Employees and allows the user to create new Employees, edit
     * existing Employees, and delete existing Employees. The list of Employees
     * is paginated and sorted in descending order by ID. The method also makes
     * available the list of all existing Units, sorted in ascending order by
     * name.
     *
     * @return \Illuminate\Contracts\View\View The rendered view.
     */
    public function render()
    {
        return view('livewire.employees', [
            'employees' => Employee::with('unit')->orderByDesc('id')->paginate(10),
            'units' => Unit::orderBy('fantasy_name')->get(),
        ]);
    }
}
