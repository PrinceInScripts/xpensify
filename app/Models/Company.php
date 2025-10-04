<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'currency',
    ];

    // A company has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A company has many expenses (through employees)
    public function expenses()
    {
        return $this->hasManyThrough(Expense::class, User::class, 'company_id', 'employee_id');
    }

    // A company has one approval rule
    public function approvalRule()
    {
        return $this->hasOne(ApprovalRule::class);
    }
}
