<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function main()
    {
        return new JsonResponse($this->adminService->build());
    }
}