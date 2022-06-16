<?php

namespace Modullo\ModulesLmsBaseAccounts\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulesLmsBaseAccountsTenantController extends Controller
{
    protected Sdk $sdk;
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function index()
    {
        $data = [];
        return view('modules-lms-base-accounts::tenants.learner.index',compact('data'));
    }

    public function create()
    {
        return view('modules-lms-base-accounts::tenants.learner.create');
    }

    public function store()
    {
        //
    }

    public function show(string $id, Sdk $sdk)
    {
        //
        return view('modules-lms-base-accounts::tenants.learner.show');
    }

    public function edit(string $id)
    {
        //
        return view('modules-lms-base-accounts::tenants.learner.edit');
    }

    public function update(string $id, Sdk $sdk)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
