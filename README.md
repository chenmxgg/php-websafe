# chenm-websafe php web防御脚本

## 介绍

chenm-websafe 专为支持psr-4规范框架开发的web安全防御脚本，支持POST、GET、COOKIE、SESSION、XSS等方面的常见注入防御，后续会完善更多外部数据层面的漏洞防护和相关功能

> 部分来源于网络收集封装

QQ：857285711

助手交流群：暂无

微信群：暂无

## 特点
无第三方依赖，安装即能用
拦截日志自动记录并自动清理
代码简单易懂，完美支持自定义修改


## 安装使用

```bash
#安装命令如下 注意，需要在服务器命令行的项目下执行
cd "自己的项目路径"
composer require chenm/websafe
```
## 自定义配置

在src/Main/Config配置文件中，你可以自定义修改配置，包括防御规则、开关、提示模板、白名单等
```php

namespace Chenm\websafe\Main;

/**
 * web 配置文件
 */
class Config
{
    /**
     * 基础数据检测配置
     *
     * @var array
     */
    protected $config = [
        'GET'     => [
            //开关
            'open'  => true,
            //日志级别
            'level' => 3,
        ],
        'POST'    => [
            'open'  => true,
            'level' => 3,
        ],
        'COOKIE'  => [
            'open'  => true,
            'level' => 2,
        ],
        'SESSION' => [
            'open'  => true,
            'level' => 2,
        ],
        'SERVER'  => [
            'open'  => true,
            'level' => 1,
        ],

    ];

    /**
     * 扩展检测配置
     *
     * @var array
     */
    protected $config_extends = [
        'XSS' => [
            'open'  => true,
            'level' => 1,
        ],

    ];

    /**
     * url白名单正则模式 通过匹配 $_SERVER['REQUEST_URI'] 来验证
     * 此处默认的白名单以TP6框架后台路径为例 可自行修改
     * @var array
     */
    protected $white = [
        'GET'     => [
            //
            '^\/[a-zA-Z0-9\-]+\.php\/(.*?)$',
        ],
        'POST'    => [
            '^\/[a-zA-Z0-9\-]+\.php\/(.*?)$',
        ],
        'COOKIE'  => [
            '^\/[a-zA-Z0-9\-]+\.php\/(.*?)$',
        ],
        'SESSION' => [
            '^\/[a-zA-Z0-9\-]+\.php\/(.*?)$',
        ],
        'SERVER'  => [
            '^\/[a-zA-Z0-9\-]+\.php\/(.*?)$',
        ],
    ];

    /**
     * 安全拦截提示模板  
     * 模板保存在在src/Tpl下
     * @var string
     */
    protected $tpl = 'DefaultTpl';
```
