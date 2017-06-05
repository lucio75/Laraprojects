<?php
namespace LaraCourse\Models;
use Illuminate\Database\Eloquent\Model;

use LaraCourse\Models\Photo;
/**
 * LaraCourse\Models\Album
 *
 * @property int $id
 * @property string $album_name
 * @property string $description
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed album_thumb
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereAlbumName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\Models\Album whereUserId($value)
 * @mixin \Eloquent
 */
class Album extends Model{

    protected $table ='Albums';
    protected $primaryKey ='id';
    protected $fillable =['album_name','description','user_id'];

    public function  getPathAttribute(){
        $url = $this->album_thumb;
        if(stristr($this->album_thumb ,'http') === false){
            $url = 'storage/'.$this->album_thumb;
        }
        return $url;
    }

    public function photos(){
        return $this->hasMany(Photo::class,'album_id','id');
    }

}