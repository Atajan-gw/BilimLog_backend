<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        abort_unless($request->user()->role === 'student', 403);
        $student = $request->user()->student;
        abort_unless($student, 404, 'Student profile not found.');

        return response()->json([
            'data' => $student->grades()->with('subject')->latest()->paginate(20),
        ]);
    }
}
