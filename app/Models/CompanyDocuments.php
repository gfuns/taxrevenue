<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDocuments extends Model
{
    use HasFactory;

    public function docs()
    {
        return $this->belongsTo('App\Models\UploadableDocs', 'document_id');
    }
}
