<?php

namespace App\Models;

use AliCloud\Core\Profile\DefaultProfile;
use AliCloud\Core\DefaultAcsClient;
use AliCloud\Vod\GetVideoInfoRequest;
use AliCloud\Vod\GetVideoPlayAuthRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceVideo extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['resource_id','ali_id'];


    /**
     * 获取aliyun 视频ID的playAuth
     *
     */
    public function getPlayAuthAttribute(){
        //获取playauth所必须的基础配置
        $access_key_id = setting('ali_access');
        $access_key_secret = setting('ali_secret');
        $region_id = setting('ali_region');

        //视频id转playauth的过程
        try{
            $profile = DefaultProfile::getProfile($region_id,$access_key_id,$access_key_secret);

            $client = new DefaultAcsClient($profile);

            $videoId = $this->ali_id;
            $req = new GetVideoPlayAuthRequest();
            $req->setVideoId($videoId);
            $req->setAcceptFormat("JSON");
            $response = $client->getAcsResponse($req);
            //var_dump($response);
        }catch (Exception $e){
            exit($e);
        }

        return $response;

    }

}
