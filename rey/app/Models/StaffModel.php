<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'position', 'availability'];
    protected $useTimestamps = true; // Optional: if you have created_at and updated_at columns

    // Validation Rules (optional)
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'position' => 'required|min_length[3]|max_length[100]',
        'availability' => 'required',
    ];
}
