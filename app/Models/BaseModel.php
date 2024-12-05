<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
    public function creater()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 1:
                return 'Active';
            case 0:
                return 'Deactive';
        }
    }

    public function getStatusClass()
    {
        switch ($this->status) {
            case 1:
                return 'badge bg-success';
            case 0:
                return 'badge bg-danger';
        }
    }
    public function getStatusTitle()
    {
        switch ($this->status) {
            case 1:
                return 'Deactive';
            case 0:
                return 'Active';
        }
    }
}
