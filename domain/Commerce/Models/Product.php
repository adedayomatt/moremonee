<?php
namespace Domain\Commerce\Models;

use App\Classes\UUID;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UUID;


    protected $casts = [
        'media' => 'array'
    ];

    protected $appends = [
        'preview'
    ];

    public function getPreviewAttribute() {
        return collect($this->media)->firstWhere('type', 'image')
            ?: "https://moremoneegroup.com/images/phone.png";
    }

}
