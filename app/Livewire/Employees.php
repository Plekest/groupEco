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

    public function createEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'required|string|max:14',
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

    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'required|string|max:14',
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

    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();
        }
    }

    public function render()
    {
        return view('livewire.employees', [
            'employees' => Employee::with('unit')->orderByDesc('id')->paginate(10),
            'units' => Unit::orderBy('fantasy_name')->get(),
        ]);
    }
}
