<?php

namespace App\Services;

use App\Company;
use Storage;

class CompanyServices
{
    public $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getAllCompanies()
    {
        $perPage = $this->company->getPerPage();
        return $this->company->paginate($perPage);
    }

    public function createNewCompany($data)
    {
        return $this->company->create($data);
    }

    public function uploadLogoImage($imageLogo,$company)
    {
        $fileName = $imageLogo->getClientOriginalName();
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $ext = substr($fileName, strrpos($fileName, '.') + 1);
        $fileNameChange = $withoutExt . '_' . time() . '.' . $ext;
        $dataFile = [
            'logo' => $fileNameChange
        ];
        $result1 = $imageLogo->storeAs('public', $fileNameChange);
        $result2 = $company->update($dataFile);
        if($result1==true && $result2==true)
        {
            return true;
        }
        else
        {
            Storage::delete($fileNameChange);
            return false;

        }

    }
}
