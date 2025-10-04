<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'approver_id',
        'sequence_order',
        'status',
        'comments',
        'approved_at',
    ];

    // Each approval belongs to an expense
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    // Each approval belongs to an approver (user)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
