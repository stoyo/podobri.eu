<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    protected $table = 'videos';
    protected $fillable = [
        'problem_id',
        'video_id',
    ];

    public function problem() {
        return $this->belongsTo('Podobri\Models\Problem', 'problem_id');
    }

    public function getVideoId() {
        if ($this->video_id) {
            return "{$this->video_id}";
        }

        return null;
    }

    public function getVideoThumbnail() {
        if ($this->video_id) {

            $hash = @unserialize(file_get_contents("https://vimeo.com/api/v2/video/$this->video_id.php"));

            if($hash === FALSE){
                return 'https://podobri.eu/images/vimeo.jpg';
            }else{
                $videothumb = $hash[0]['thumbnail_large'];
                if(str_contains($videothumb, "https")){
                    return $videothumb;
                }else{
                    return str_replace("http", "https", $videothumb);
                }
            }

        }

        return null;
    }

}
