<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'username',
        'password',
        'avatar',
        'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['avatar_url'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canSetAvatar(): bool
    {
        return in_array($this->role, ['teacher', 'student'], true);
    }

    public function replaceAvatar(UploadedFile $file): void
    {
        $previous = $this->avatar;
        $path = $file->store('avatars', 'public');

        abort_if($path === false, 500, 'Avatar could not be stored.');

        $this->update(['avatar' => $path]);

        if (is_string($previous) && $previous !== $path) {
            Storage::disk('public')->delete($previous);
        }
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'teacher_id');
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! is_string($this->avatar)) {
                return null;
            }

            $disk = Storage::disk('public');

            return $disk instanceof Cloud ? $disk->url($this->avatar) : null;
        });
    }
}
