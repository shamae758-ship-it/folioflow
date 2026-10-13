<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'portfolios';

    /**
     * Mass-assignable attributes.
     * Anything the user can submit from the form.
     */
    protected $fillable = [
        'full_name',
        'profile_picture',
        'email',
        'contact_number',
        'address',
        'about_me',
        'education',
        'skills',
        'projects',
        'experience',
        'social_links',
        'template',
    ];

    /**
     * Cast JSON columns to native PHP arrays automatically.
     * So $portfolio->skills returns an array — no json_decode() needed.
     */
    protected $casts = [
        'education'    => 'array',
        'skills'       => 'array',
        'projects'     => 'array',
        'experience'   => 'array',
        'social_links' => 'array',
    ];

    /**
     * Optional helper: get the profile picture URL.
     * Falls back to a placeholder if none is uploaded.
     */
    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name ?? 'User') . '&background=6366f1&color=fff';
    }

    /**
     * Optional helper: get the first letter of the name (for avatar fallback).
     */
    public function getInitialAttribute(): string
    {
        return strtoupper(substr($this->full_name ?? 'U', 0, 1));
    }
}