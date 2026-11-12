<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => \App\Models\Subject::query()->orderBy('name')->paginate(20)]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['data' => \App\Models\Subject::query()->findOrFail($id)]);
    }
}
