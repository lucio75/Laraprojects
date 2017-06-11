<?php

namespace LaraCourse\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * LaraCourse\Models\Photo
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $album_id
 * @property string $deleted_at
 * @property string $img_path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereImgPath($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
   // protected $table ='Photos';

    public function  getImgPathAttribute($value){

        if(stristr($value ,'http') === false){
            $value = 'storage/'.$value;
        }
        return $value;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name']=strtoupper($value);
    }
}
