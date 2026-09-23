<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'company_id',
        'title',
        'slug',
        'location',
        'contract_type',
        'experience_level',
        'salary_min',
        'salary_max',
        'skills_required',
        'description',
        'is_active',
        'posted_at',
    ];

    protected $casts = [
        'skills_required' => 'array',
        'is_active' => 'boolean',
        'posted_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters)
    {
        $filters = array_filter($filters, fn ($v) => $v !== null && $v !== '');

        if (isset($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', "%{$filters['keyword']}%")
                    ->orWhere('description', 'like', "%{$filters['keyword']}%");
            });
        }

        if (isset($filters['location']) && $filters['location'] !== '') {
            $query->where('location', 'like', "%{$filters['location']}%");
        }

        if (isset($filters['contract_type']) && $filters['contract_type'] !== '') {
            $query->where('contract_type', $filters['contract_type']);
        }

        if (isset($filters['experience_level']) && $filters['experience_level'] !== '') {
            $query->where('experience_level', $filters['experience_level']);
        }

        if (isset($filters['skill']) && $filters['skill'] !== '') {
            $query->whereJsonContains('skills_required', $filters['skill']);
        }

        return $query;
    }

    public function scopeSorted($query, ?string $sort)
    {
        return match ($sort) {
            'date_asc' => $query->orderBy('posted_at', 'asc'),
            'date_desc' => $query->orderBy('posted_at', 'desc'),
            'salary_asc' => $query->orderBy('salary_min', 'asc'),
            'salary_desc' => $query->orderBy('salary_min', 'desc'),
            default => $query->orderBy('posted_at', 'desc'),
        };
    }
}
