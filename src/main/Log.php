<?php
/*
 * @Author: 沉梦 chenmxgg@163.com <blog.achaci.cn>
 * @Date: 2022-08-13 15:41:41
 * @LastEditors: 沉梦 chenmxgg@163.com <blog.achaci.cn>
 * @LastEditTime: 2022-10-22 22:10:23
 * @Description:
 *
 * Copyright (c) 2022 by 成都沉梦科技, All Rights Reserved.
 */

namespace chenm\websafe\main;

!defined('DS') && define('DS', DIRECTORY_SEPARATOR);

/**
 * 简单的日志记录类
 */
class Log
{
    private $name;
    private $dir;
    private $dirname;
    private $path;
    private $saveDay = 15;

    /**
     *  初始化构造函数
     *
     * @param  integer $_saveDay 日志保留天数
     * @return Log
     */
    public function __construct($_saveDay = 15)
    {
        $this->date = date("Ymd");
        if ($_saveDay > 0) {
            $this->saveDay = $_saveDay;
        }

        //日志目录
        $this->dirname = dirname(__DIR__) . "/runtime/";
        //设置日志目录和路径
        $this->setLogDir();
        //删除历史过期日志
        $this->delDir($this->dirname);
        return $this;
    }

    /**
     * 设置日志子类型名称
     *
     * @param  string|null $name
     * @return Log
     */
    public function setName(string $name = null)
    {
        if ($name) {
            $this->name = $name;
            //日志目录
            $this->dirname = ROOT_PATH . "runtime/system/" . $this->name . '/';
            //设置日志目录和路径
            $this->setLogDir();
        }
        
        
        return $this;
    }

    /**
     * 添加自动日志
     * @param  string $action  类型
     * @param  string $msg     内容 可空
     * @param  bool   $desc    是否记录GET和POST数据
     */
    public function add($action, $msg = '', $desc = true)
    {
        $runPath = $this->getRunPath();
        $txt     = "[" . date("Y-m-d H:i:s") . "] ";
        if ($action) {
            $txt .= '>>' . $action . '<< ';
        }

        if ($msg) {
            $txt .= $msg;
        }

        if ($desc) {
            $txt .= "\nPOST:" . json_encode($_POST) . "\nGET:" . json_encode($_GET);
            $txt .= "\nrunPath:" . $runPath;
        }

        $txt .= "\n";
        $fp = fopen($this->path, "a");
        if ($fp) {
            flock($fp, LOCK_EX);
            fwrite($fp, $txt);
            flock($fp, LOCK_UN);
            fclose($fp);
        }
    }

    private function getRunPath()
    {
        if (!empty($_SERVER["REQUEST_URI"])) {
            $scriptName = $_SERVER["REQUEST_URI"];
        } else {
            $scriptName = $_SERVER["PHP_SELF"];
        }
        $s = stripos($scriptName, '?');
        if ($s > 0) {
            $scriptName = substr($scriptName, 0, $s);
        }
        return $scriptName;
    }

    /**
     * 递归创建文件夹
     * @param  [type] $dir 文件夹路径
     */
    private function makedir($dir = '')
    {
        $dir    = str_replace('/', DS, $dir);
        $arr    = explode(DS, trim($dir, DS));
        $newDir = DS;
        if (count($arr)) {
            foreach ($arr as $key => $value) {
                $newDir .= $value . DS;
                if (stripos($newDir, ROOT_PATH) !== false && !is_dir($newDir)) {
                    mkdir($newDir, 0755);
                }
            }
        }
        return is_dir($newDir) == true;
    }

    /**
     * 设置日志文件目录
     * @param  [type] $dir 文件夹路径
     */
    private function setLogDir()
    {
        $this->dir = $this->dirname;
        $this->dir = rtrim($this->dir, '/') . '/' . date("Ym/d");
        $this->makedir($this->dir);
        $this->setLogFile();
        return true;
    }

    /**
     * 设置日志文件名称
     */
    private function setLogFile()
    {
        $h = date("H");
        $i = date("i");
        if ($i > 30) {
            $e    = $h + 1;
            $file = $this->dir . '/' . $h . ':30~' . $e . ':00.txt';
        } else {
            $file = $this->dir . '/' . $h . ':00~' . $h . ':30.txt';
        }

        $this->file = $file;
        $this->path = $file;
        return true;
    }

    /**
     * 递归删除过期日志文件
     * @param  [type] $dir 文件夹路径
     */
    private function delDir($dir)
    {
        $dir = rtrim($dir, '/') . '/';
        if (!is_dir($dir)) {
            return;
        }

        $files = scandir($dir);
        $time  = date("Ym");
        if (count($files) > 0) {
            foreach ($files as $filename) {
                if ($filename === "." || $filename === "..") {
                    continue;
                }
                if (is_dir($dir . $filename)) {
                    $dirTime = intval($filename);
                    $dirDay  = floor($time - $dirTime);
                    if ($dirDay > $this->saveDay && $this->saveDay > 0) {
                        $this->delFile($dir . $filename . '/');
                        @rmdir($dir);
                    }
                }
            }
        }
        return true;
    }

    /**
     * 递归删除目录文件
     * @param  string $dir 文件夹路径
     */
    private function delFile($dir)
    {
        $dir   = rtrim($dir, '/') . '/';
        $files = scandir($dir);
        if (count($files) > 2) {
            foreach ($files as $filename) {
                if ($filename === "." || $filename === "..") {
                    continue;
                }
                if (is_dir($dir . $filename)) {
                    //递归删除
                    $this->delFile($dir . $filename . '/');
                } else {
                    //删除文件
                    @unlink($dir . $filename);
                }
            }
        }
        //最后删除当前目录
        @rmdir($dir);
        return true;
    }
}
