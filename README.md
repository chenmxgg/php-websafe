# Chenm - helper php 开发助手

## 介绍

Chenm - helper 是为广大 phper 解决多个繁琐且常用的操作封装，如文件类、日志类、邮件类、短信类等无需自行封装直接使用

> 部分来源于网络收集封装

QQ：857285711

助手交流群：暂无

微信群：暂无


## 安装使用

目前功能还未完善，后续将完善其他功能类

```bash
#安装命令如下 注意，需要在服务器命令行的项目下执行
cd "自己的项目路径"
composer require chenm/helper
```
Log类支持自动清理过期日志，更节省性能的单例操作并支持链式方法，方便多个容器储存分开使用
```php
#使用例子 
use Chenm\Helper\Log;
Log::getInstance()->setSaveDir(__DIR__)->write(Log::ERROR, '测试日志内容');
Log::getInstance()->setLogWrite(false)->write(Log::ERROR, '测试日志内容')->getLog();
Log::getInstance()->setLogWrite(true)->user('测试日志内容')->getLog();
#配置自定义参数
Log::getInstance()->addRecord($msg, $context, [
    //日志目录
    'dir' => '储存文件夹路径(不含文件名)',
    //日志容器名称
    'name' => 'Default',
    //日志文件名称
    'filename' => 'log.txt',
    //日志单天记录级别 h 时 m 分
    'log_level' => 'h',
    //日志文件过期时间 单位天
    'expire' => 7,
], Log::INFO);
```
