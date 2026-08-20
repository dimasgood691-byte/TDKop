<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    protected $fillable = ['name', 'gender'];

    protected $appends = ['gender_label', 'display_name'];

    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    public function getGenderLabelAttribute(): string
    {
        $gender = strtolower((string) ($this->gender ?? ''));

        return match ($gender) {
            'laki-laki', 'l', 'male', 'pria', 'lakilaki' => 'Laki-laki',
            'perempuan', 'p', 'female', 'wanita' => 'Perempuan',
            default => 'Umum',
        };
    }

    public function getDisplayNameAttribute(): string
    {
        $label = $this->gender_label;

        if ($label === 'Umum') {
            return $this->name;
        }

        return sprintf('%s (%s)', $this->name, $label);
    }
}