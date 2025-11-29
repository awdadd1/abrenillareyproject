<?php

namespace App\Models;

use CodeIgniter\Model;

class SystemSettingModel extends Model
{
    protected $table = 'system_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['system_mode'];
    protected $returnType = 'array';

    public function getMode()
    {
        return $this->first()['system_mode'] ?? 'online';
    }

    public function toggleMode()
    {
        $current = $this->getMode();
        $newMode = ($current === 'online') ? 'maintenance' : 'online';
        $this->update(1, ['system_mode' => $newMode]);
        return $newMode;
    }
}
