<?php

header('Content-type:text/json;charset=UTF-8');

$id_list = array(
    "19723756",
    "3779629",
    "2884035",
    "3778678",
    "991319590",
    "71384707",
    "1978921795",
    "2250011882",
    "2617766278",
    "3136952023",
    "3180475090"
);  //初始化库

$id = array_rand($id_list);
$id = $id_list["$id"];


function music($id){
    $playlist_url="https://music.163.com/api/playlist/detail?id=$id";  # 歌单api

    $playlist = file_get_contents($playlist_url);
    $playlist = json_decode($playlist,true);
    $playlist = $playlist["result"];
    $playlist = $playlist["tracks"];
    
    $random   = rand(0,sizeof($playlist));  # 根据范围给出随机参数
    
    $name          = $playlist["$random"]["name"];                  # 歌曲名
    $song_id       = $playlist["$random"]["id"];                    # 歌曲id
    $blurPicUrl    = $playlist["$random"]["album"]["blurPicUrl"];   # 歌曲头像
    $artists_name  = $playlist["$random"]["artists"]["0"]["name"];  # 歌手名字
    
    usleep(5000);

    $song_url="http://music.163.com/api/v1/resource/comments/R_SO_4_$song_id"; # 歌曲评论api  
    
    $song = file_get_contents($song_url);

    $song = json_decode($song,true);

    $song_rand = rand(0,3);

    $song = $song["hotComments"]["$song_rand"];
    
    $user_nickname  = $song["user"]["nickname"];                     # 用户名称
    $user_avatarUrl = $song["user"]["avatarUrl"];                    # 用户头像
    $user_content   = $song["content"];                              # 用户评论
    $user_content = str_ireplace("\n\r","",$user_content);  # 过滤空格回车
    $user_content = str_ireplace("\r\n","",$user_content);  # 过滤空格回车
    
    $info2 = "{\"song_id\":\"$song_id\",\"title\":\"$name\",\"author\":\"$artists_name\",\"images\":\"$blurPicUrl\",\"comment_content\":\"$user_content\",\"comment_nickname\":\"$user_nickname\"}";

    echo $info2;
}

if ($id == ""){
    echo "id为空";
}else{ music($id);}

?>