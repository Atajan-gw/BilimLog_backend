<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FacultyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => \App\Models\Faculty::query()->orderBy('name')->paginate(20)]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['data' => \App\Models\Faculty::query()->findOrFail($id)]);
    }
}
