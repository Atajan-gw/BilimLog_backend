<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'student', 403);
        return response()->json([
            'data' => $request->user()->student()->with(['faculty', 'group', 'grades.subject'])->firstOrFail(),
        ]);
    }
}
