<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'amount',
        'currency',
        'amount_in_company_currency',
        'category',
        'description',
        'date',
        'status',
        'receipt_path',
    ];

    // Expense belongs to an employee
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Expense has many approval records
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    // Helper: get latest approval status
    public function latestApproval()
    {
        return $this->hasOne(Approval::class)->latestOfMany();
    }
}
