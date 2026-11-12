<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'faculty_id',
        'group_id',
        'specialty',
        'course_year',
        'student_id_card_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
