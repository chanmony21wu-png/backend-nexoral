<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'cat', 'section', 'price', 'note', 'description', 'specs', 'img'];

    protected $casts = [
        'price' => 'float',
        'specs' => 'array',
    ];

    // the shape the React shop expects
    public function toApi(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cat' => $this->cat,
            'section' => $this->section,
            'price' => (float) $this->price,
            'note' => $this->note ?? '',
            'desc' => $this->description ?? '',
            'specs' => $this->specs ?? [],
            'img' => $this->img ?? '',
        ];
    }

    // pictures like /images/1.png live in the React shop, so the admin page must load them from there
    public function previewUrl(): string
    {
        $img = $this->img ?? '';

        return str_starts_with($img, '/images/') ? 'http://localhost:5173' . $img : $img;
    }
}