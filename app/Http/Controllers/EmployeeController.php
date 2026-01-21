<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public $breadCrumbProps = [];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Employee",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Employee',
                ],
            ],
        ];

        // $employees = Employee::all();

        $employees = Employee::select(
            'id',
            'employee_code',
            'employee_name',
            'employee_designation',
            'employee_email',
            'employee_mobile',
            'employee_status'
        )
            ->get();

        return view('Employee.index', compact('breadCrumbProps', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Employee",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Employee',
                    'url' => route('employee.index'),
                ],
                [
                    'label' => 'New Employee',
                ],
            ],
        ];

        return view('Employee.create', compact('breadCrumbProps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'employee_code'        => 'required|string|max:10|min:10|unique:employees,employee_code',
            'employee_name'        => 'required|string|max:50',
            'employee_designation' => 'required|string|max:20',
            'employee_email'       => 'required|email|unique:employees,employee_email',
            'employee_mobile'      => 'required|string|max:20',
            'employee_status'      => 'required|in:Active,Inactive',
        ]);

        Employee::create($validated);

        return redirect()->route('employee.index')
            ->with('success', 'Employee was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Employee",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Employee',
                    'url' => route('employee.index'),
                ],
                [
                    'label' => 'Show Employee Details',
                ],
            ],
        ];

        return view('Employee.show', compact('employee', 'breadCrumbProps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Employee",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Employee',
                    'url' => route('employee.index'),
                ],
                [
                    'label' => 'Edit Employee Details',
                ],
            ],
        ];

        return view('Employee.edit', compact('breadCrumbProps', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //

        $validated = $request->validate([
            'employee_code'        => [
                'required',
                'string',
                'max:10',
                Rule::unique('employees', 'employee_code')->ignore($employee->id),
            ],
            'employee_name'        => 'required|string|max:50',
            'employee_designation' => 'required|string|max:20',
            'employee_email'       => [
                'required',
                'email',
                Rule::unique('employees', 'employee_email')->ignore($employee->id),
            ],
            'employee_mobile'      => 'required|string|max:20',
            'employee_status'      => 'required|in:Active,Inactive',
        ]);

        $employee->update($validated);

        return redirect()->route('employee.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        return redirect()->route('employee.index');
    }
}
