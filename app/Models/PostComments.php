<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', "customer_id");
    }

    public function replies()
    {
        return $this->hasMany('App\Models\PostComments', "comment_id");
    }

    // In your PHP code (controller or helper function)
    public function generateCommentColor($commentId)
    {
        // Define a color palette
        $colors = ['#ff9999', '#99ff99', '#9999ff', '#ffff99', '#99ffff', '#ff99ff', '#ffcc99', '#cc99ff', '#99ccff', '#ccff99'];

        // Use the comment's ID to select a color from the palette
        $index = $commentId % count($colors);
        return $colors[$index];
    }
}
