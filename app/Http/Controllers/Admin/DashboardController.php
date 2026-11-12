<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();

        $groupsCount = Group::count();

        $teachersCount = User::where('role', 'teacher')->count();

        $usersCount = User::count();

        $groups = Group::with(['teacher', 'students'])
            ->withCount('students')
            ->latest()
            ->get();

        $teachers = User::where('role', 'teacher')
            ->withCount('groups')
            ->get();

        return view('admin.dashboard', compact(
            'studentsCount',
            'groupsCount',
            'teachersCount',
            'usersCount',
            'groups',
            'teachers'
        ));
    }
}