<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;

class Employees extends Component
{
    public $name, $age, $email, $salary, $designation, $phonenumber;

    public function store()
    {
        $validated_data = $this->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email',
            'salary' => 'required|numeric',
            'designation' => 'required',
            'phonenumber' => 'required|numeric'
        ]);

        Employee::create($validated_data);

        session()->flash('message', 'Employee created successfully.');
        $this->resetInputFields();
    }
    private function resetInputFields(){
      $this->name ='';
      $this->email = '';
      $this->age = '';
      $this->designation = '';
      $this->salary = '';
      $this->phonenumber = '';
    }

    public function render()
    {
        $this->employees = Employee::all();
        return view('livewire.employees');
    }
}
