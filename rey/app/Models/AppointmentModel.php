<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';  // The table this model interacts with
    protected $primaryKey = 'id';  // Primary key of the table

    // Fields that are allowed to be inserted or updated
    protected $allowedFields = [
        'user_id', 
        'service_id', 
        'full_name', 
        'email', 
        'phone', 
        'appointment_date', 
        'status'
    ];

    // Enabling automatic handling of timestamps
    protected $useTimestamps = true;  // Automatically handles `created_at` and `updated_at`
    protected $createdField  = 'created_at';  // The field that stores the creation timestamp
    protected $updatedField  = 'updated_at';  // The field that stores the last update timestamp

    // Enabling soft deletes, so records are not permanently removed from the database
    protected $useSoftDeletes = true;  // Allows soft deletion
    protected $deletedField  = 'deleted_at';  // The field that stores the deletion timestamp
}
