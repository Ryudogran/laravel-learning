<?php

namespace App\Services;

use App\Employee;

class EmployeeServices
{
    public $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function createNewEmployee($data)
    {
        return $this->employee->create($data);
    }

    public function updateEmployee($data, Employee $employee)
    {
        return $employee->update($data);
    }
}
