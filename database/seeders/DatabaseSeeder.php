<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'System', 'surname' => 'Administrator',
            'phone_number' => '+490000000000', 'username' => 'admin',
            'password' => 'password',
        ]);

        $faculties = collect([
            ['name' => 'Computer Science', 'description' => 'Computing and information technology'],
            ['name' => 'Information Technology', 'description' => 'Networks, systems, and applied computing'],
            ['name' => 'Economics', 'description' => 'Economics, finance, and business administration'],
            ['name' => 'Law', 'description' => 'Legal studies and public law'],
            ['name' => 'Medicine', 'description' => 'Medical science and clinical practice'],
            ['name' => 'Engineering', 'description' => 'Mechanical, civil, and electrical engineering'],
            ['name' => 'Philology', 'description' => 'Languages, literature, and translation'],
            ['name' => 'Mathematics', 'description' => 'Pure and applied mathematics'],
            ['name' => 'Pedagogy', 'description' => 'Education and teaching methods'],
            ['name' => 'Natural Sciences', 'description' => 'Physics, chemistry, and biology'],
        ])->map(fn (array $data) => Faculty::create($data));

        $faculty = $faculties->firstWhere('name', 'Computer Science');
        $group = Group::create(['name' => 'CS-101', 'faculty_id' => $faculty->id, 'course_number' => 1]);

        $subjects = collect([
            ['name' => 'Programming', 'credits' => 6, 'description' => 'Programming fundamentals'],
            ['name' => 'Database Systems', 'credits' => 5, 'description' => 'Relational database design'],
            ['name' => 'Mathematics', 'credits' => 5, 'description' => 'Applied mathematics'],
        ])->map(fn ($data) => Subject::create($data));

        foreach (range(1, 10) as $i) {
            $user = User::factory()->create([
                'username' => "student{$i}",
                'phone_number' => '+4912345'.str_pad((string) $i, 6, '0', STR_PAD_LEFT),
            ]);
            $student = Student::create([
                'user_id' => $user->id, 'faculty_id' => $faculty->id, 'group_id' => $group->id,
                'specialty' => 'Software Engineering', 'course_year' => 1,
                'student_id_card_number' => 'STU-'.str_pad((string) $i, 6, '0', STR_PAD_LEFT),
            ]);
            foreach ($subjects as $subject) {
                Grade::create([
                    'student_id' => $student->id, 'subject_id' => $subject->id,
                    'score' => fake()->randomFloat(2, 55, 100), 'semester' => '2026-Spring',
                ]);
            }
        }
    }
}
