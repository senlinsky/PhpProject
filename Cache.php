<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cache
 *
 * @author Senlinsky
 */
class Cache {
    //put your code here
    private $cache_path;
    private $cache_expire;
    public function Cache($exp_time=3600,$path="cache/")
    {
        $this->cache_expire=$exp_time;
        $this->cache_path=$path;               
    }
    private function fileName($key){
        return $this->cache_path.md5($key);
    }
    public function put($key,$data){
        $value=  serialize($data);
        $filename=  $this->fileName($key);
        $file=  fopen($filename, "w");
        if($file)
        {
            fwrite($file, $value);
            fclose($file);
        }
        else {
            return false;
        }
    }
    public function get($key){
        $filename=  $this->fileName($key);
        if(!file_exists($filename)||!is_readable($filename)){
            return false;
        }
        if(time()<(filemtime($filename)+$this->cache_expire)){
            $file=  fopen($filename, "r");
            if($file){
                $data=  fread($file, filesize($filename));
                fclose($file);
                return unserialize($data);
            }
            else return false;
        }else return false;
    }
    
}
?>