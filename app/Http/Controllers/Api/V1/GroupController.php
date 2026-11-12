<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => \App\Models\Group::query()->with('faculty')->orderBy('name')->paginate(20)]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['data' => \App\Models\Group::query()->with('faculty')->findOrFail($id)]);
    }
}
