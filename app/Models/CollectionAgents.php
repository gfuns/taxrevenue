<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionAgents extends Model
{
    use HasFactory;

    public function pos()
    {
        return $this->belongsTo('App\Models\PosTerminals', 'terminal_id');
    }

    public function posDetails()
    {
        if (isset($this->pos)) {
            return $this->pos->model . " Model <br/> Serial No: " . $this->pos->serial_number . " <br/> Terminal ID: " . $this->pos->terminal_id;
        }

        return "Not Assigned";
    }
}
