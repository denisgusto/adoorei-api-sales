<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;

class CompanyController extends Controller
{
    /**
     * Retorna a lista de empresas.
     *
     * @return CompanyCollection
     */
    public function index(): CompanyCollection
    {
        $companies = Company::query()->get();
        
        return new CompanyCollection($companies);
    }

    /**
     * Retorna uma empresa específica.
     *
     * @param int $id
     * @return CompanyResource|JsonResponse
     */
    public function show(int $id): CompanyResource|JsonResponse
    {
        $company = Company::query()->find($id);

        if(!$company) {
            return response()->json(['message' => 'Company not found.'], 404);
        }

        return new CompanyResource($company);
    }
}
