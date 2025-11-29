<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'description', 'price'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[100]',
        'description' => 'required|min_length[10]|max_length[255]',
        'price'       => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'The service name is required.',
            'min_length' => 'The service name must be at least 3 characters long.',
            'max_length' => 'The service name cannot exceed 100 characters.',
        ],
        'description' => [
            'required' => 'The service description is required.',
            'min_length' => 'The description must be at least 10 characters long.',
            'max_length' => 'The description cannot exceed 255 characters.',
        ],
        'price' => [
            'required' => 'The service price is required.',
            'numeric' => 'The price must be a numeric value.',
            'greater_than' => 'The price must be greater than 0.',
        ],
    ];
}
