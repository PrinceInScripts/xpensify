<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'rule_type',
        'percentage_threshold',
        'specific_role',
        'sequence',
    ];

    protected $casts = [
        'sequence' => 'array',
    ];

    // Belongs to one company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
