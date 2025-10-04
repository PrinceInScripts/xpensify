<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_id',
        'manager_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Each user belongs to one company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Manager-Employee relationship
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function employees()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    // Expenses created by employee
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'employee_id');
    }

    // Approvals made by this user
    public function approvals()
    {
        return $this->hasMany(Approval::class, 'approver_id');
    }
}
