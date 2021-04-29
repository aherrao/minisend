<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    /**
     * typecast
     * @var array
     */
    protected $casts = ['extra_data' => 'array'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
//    protected static function boot()
//    {
//        parent::boot();
//    }

    /**
     * This function is used in extended models, So it need to define here also.
     */
//    public static function defineModel()
//    {}

    /**
     * To get the extra data values
     *
     * @return mixed Always json_decode settings so they are usable
     */
//    public function getExtraDataAttribute()
//    {
//        return (isset($this->attributes['extra_data'])) ? (is_array($this->attributes['extra_data']) ? $this->attributes['extra_data'] : json_decode($this->attributes['extra_data'], true)) : [];
//    }

    /**
     * Get defined fields for model
     *
     * @return bool return false OR defined fields
     */
//    public static function getDefinedFields()
//    {
//        return isset(static::defineModel()['defined_fields']) ? static::defineModel()['defined_fields'] : [];
//    }
}
