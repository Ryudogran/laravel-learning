<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Services\EmployeeServices;
use Illuminate\Http\Request;
use App\Company;
use App\Exports\ExcelMaker;
use App\Http\Requests\EmployeeRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Symfony\Component\HttpFoundation\Cookie;
use Excel;

class EmployeeController extends SessionController
{
    private $employeeServices;

    public function __construct(EmployeeServices $employeeServices)
    {
        $this->middleware('auth');
        $this->employeeServices = $employeeServices;
    }


    public function index(Company $company)
    {
        $employees = Employee::with('company')->where('company_id',$company->id)->paginate(10, ['*'], 'page');
        request()->session()->put('company_id',$company->id);
        return view('employees.index',compact('employees','company'));
    }

    public function create()
    {

        // dd(strpos('1/1/1','1'));
        $sessionName = config('const.session.defaultName');;
        $employee=null;
        $status=null;
        // $companies = Company::all();
        $companyId=request()->session()->get('company_id');
        $companies = Company::findOrFail($companyId);
        $backLink=null;
        if($companyId != null)
        {
            $backLink = route('employees.index',$companyId);
            // request()->session()->forget('company_id');
        }
        if(request()->session()->has($sessionName))
        {
            $status = $this->getSessionAndDelete();
        }

        return view('employees.create',compact('employee','status','companies','backLink'));
    }

    public function store(EmployeeRequest $request)
    {
        $sessionCreateSuccessType = config('const.session.createEmployeeSuccess');
        $sessionCreateFalseType = config('const.session.createEmployeeFalse');
        $sessionCreateSuccessMessage = config('const.session.createEmployeeSuccessMessage');
        $sessionCreateFalseMessage = config('const.session.createEmployeeFalseMessage');
        try {
            DB::beginTransaction();
            $employee = $this->employeeServices->createNewEmployee($request->all());
            if ($employee) {
                DB::commit();
                $this->createSession($sessionCreateSuccessType,$sessionCreateSuccessMessage);
                // return redirect(route('companies.index'));
                return back();
            }
            else
            {
                DB::rollback();
                $this->createSession($sessionCreateFalseType,$sessionCreateFalseMessage);
                return back();
            }
        } catch (Exception $e) {
            DB::rollback();
            $this->createSession($sessionCreateFalseType,$sessionCreateFalseMessage);
            Log::error('message: ' . $e);
        }
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        $sessionName = config('const.session.defaultName');;
        $status=null;
        // $companies = Company::all();
        $companyId=request()->session()->get('company_id');
        $companies = Company::findOrFail($companyId);
        $backLink=null;
        if($companyId != null)
        {
            $backLink = route('employees.index',$companyId);
            // request()->session()->forget('company_id');
        }
        if(request()->session()->has($sessionName))
        {
            $status = $this->getSessionAndDelete();
        }

        return view('employees.create',compact('employee','status','companies','backLink'));
    }

    public function update(Request $request, Employee $employee)
    {
        $sessionUpdateSuccessType = config('const.session.updateEmployeeSuccess');
        $sessionUpdateFalseType = config('const.session.updateEmployeeFalse');
        $sessionUpdateSuccessMessage = config('const.session.updateEmployeeSuccessMessage');
        $sessionUpdateFalseMessage = config('const.session.updateEmployeeFalseMessage');
        try {
            DB::beginTransaction();
            $result = $this->employeeServices->updateEmployee($request->all(),$employee);
            if ($result) {
                DB::commit();
                $this->createSession($sessionUpdateSuccessType,$sessionUpdateSuccessMessage);
                // return redirect(route('companies.index'));
                return back();
            }
            else
            {
                DB::rollback();
                $this->createSession($sessionUpdateFalseType,$sessionUpdateFalseMessage);
                return back();
            }
        } catch (Exception $e) {
            DB::rollback();
            $this->createSession($sessionUpdateFalseType,$sessionUpdateFalseMessage);
            Log::error('message: ' . $e);
        }
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back();
    }

    public function export(Company $company)
    {
        return Excel::download(new ExcelMaker($company),'excel.csv');
    }
}
