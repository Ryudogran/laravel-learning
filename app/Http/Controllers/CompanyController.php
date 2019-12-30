<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Services\CompanyServices;
use App\Http\Requests\CompanyRequest;
use DB;
use Exception;
use Log;
use DataTables;
use Storage;

class CompanyController extends SessionController
{
    private $companyServices;

    public function __construct(CompanyServices $companyServices)
    {
        $this->middleware('auth');
        $this->companyServices = $companyServices;
    }

    public function index()
    {
        $companies = $this->companyServices->getAllCompanies();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $company = null;
        $status=null;
        $sessionName= config('const.session.defaultName');
        $sessionMessage = config('const.session.createCompanySuccessMessage');
        if (request()->session()->has($sessionName)) {
            $status = $this->getSessionAndDelete();
        }
        // dd($status);
        return view('companies.create', compact('company','status','sessionMessage'));
    }

    public function store(CompanyRequest $request)
    {
        $sessionCreateSuccessType = config('const.session.createCompanySuccess');
        $sessionCreateFalseType = config('const.session.createCompanyFalse');
        $sessionCreateSuccessMessage = config('const.session.createCompanySuccessMessage');
        $sessionCreateFalseMessage = config('const.session.createCompanyFalseMessage');
        try {
            DB::beginTransaction();
            $company = $this->companyServices->createNewCompany($request->except('logo'));
            $result = true;
            if ($request->logo != null) {
                $result = $this->companyServices->uploadLogoImage($request->logo, $company);
            }
            if ($company && $result) {
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

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        $status = null;
        if (request()->session()->has(config('const.session.defaultName'))) {
            $status = $this->getSessionAndDelete($status);
        }
        return view('companies.create', compact('company', 'status'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $sessionUpdateSuccessType = config('const.session.updateCompanySuccess');
        $sessionUpdateFalseType = config('const.session.updateCompanyFalse');
        $sessionUpdateSuccessMessage = config('const.session.updateCompanySuccessMessage');
        $sessionUpdateFalseMessage = config('const.session.updateCompanyFalseMessage');
        try
        {
            $result = true;
            DB::beginTransaction();
            $company->update($request->only('name','email','website'));
            if ($request->logo != null) {
                $result = $this->companyServices->uploadLogoImage($request->logo, $company);
            }
            if($result)
            {
                DB::commit();
                $this->createSession($sessionUpdateSuccessType,$sessionUpdateSuccessMessage);
                return back();
            }
            else
            {
                DB::rollback();
                $this->createSession($sessionUpdateFalseType,$sessionUpdateFalseMessage);
                return back();
            }

        }catch(Exception $e)
        {
            DB::rollback();
            $this->createSession($sessionUpdateFalseType,$sessionUpdateFalseMessage);
            Log::error('message: ' . $e);
            return back();
        }

    }

    public function destroy(Company $company)
    {
        $company->delete();
        return 200;
    }

    public function getIndexDataTable(Request $request)
    {
        // simple datatable usage
        // return Datatables::of(User::query())->make(true);

        if ($request->ajax()) {
            $data = Company::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('logo', function ($company) {
                        return '<img src="' .  (($company->logo!==null) ? Storage::url($company->logo) : Storage::url("/company_logo.jpg")) . '" alt="Hinh o day" class="img-circle img-avatar-list responsive">';
                    })
                    ->addColumn('action', function($company){

                           $btn = '<button type="button" class="btn btn-primary btnEditCompany mt-1" data-route="'.route('companies.edit',$company->id).'">Edit</button>
                           <button type="button" class="btn btn-danger mt-1 btnDeleteDatatableCompany" data-message="Do you want to delete '.$company->name.'?">Delete</button>
                            <button class="btn btn-info btnViewEmployees mt-1" data-route="'.route('employees.index',$company->id).'">Employees</button>
                            <input type="hidden" name="id" value="'.$company->id.'" />';
                            return $btn;
                    })
                    ->rawColumns(['action','logo'])
                    ->make(true);
        }
        return view('companies.datatableIndex');
    }
}

