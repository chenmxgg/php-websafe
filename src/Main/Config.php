<?php
/*
 * @Author: 沉梦 chenmxgg@163.com <blog.achaci.cn>
 * @Date: 2022-10-29 15:41:41
 * @LastEditors: 沉梦 chenmxgg@163.com <blog.achaci.cn>
 * @LastEditTime: 2022-10-22 22:10:23
 * @Description:
 *
 * Copyright (c) 2022 by 成都沉梦科技, All Rights Reserved.
 */

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
     * 验证代码只写了XSS的 后续会更新可自定义其他要检查的项
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
     * 模板保存在src/Tpl下
     * @var string
     */
    protected $tpl = 'DefaultTpl';

    /**
     * @var string GET规则
     */
    protected static $GET_S = "/\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\\s*?\(.*\)|sleep\\s*?\(.*\)|\\b(group_)?concat[\\s\\/\\*]*?\\([^\\)]+?\\)|\bcase[\\s\/\*]*?when[\\s\/\*]*?\([^\)]+?\)|load_file\\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\\s*?=|^\\+\\/v(8|9)|<.+(javascript|vbscript|expression|applet|meta|xml|blink\\(|link\\(|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)|UPDATE\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|<.*(iframe|frame|style|embed|object|frameset|meta|xml)|copy\\(|eval|mkdir|assert|rename|chmod|dirname\\(|fputs\\(|file_put_contents|exit|readfile|fflush|fopen\\(|fgetc|fgetcsv|fgetss|file\\(|fwrite\\(|fread\\(|link\\(|linkinfo|pathinfo|realpath|touch|^exec$|
system|chroot|getcwd|scandir|chgrp|chown|shell_exec|pcntl_exec|ini_alter|ini_restore|readlink\\(|popepassthru|imap_open|passthru|curl_multi_exec|escapeshellcmd|escapeshellarg|insert\\s|select\\s|information_schema|union\\s|database|concat|connection_id|group_concat|update\\s|`|create_function|call_user_func|unlink\\(|delete\\s|phpinfo|preg_replace|popen|proc_open|ini_get|ini_set|parse_str|extract|mb_parse_str|import_request_variables|glob\\(|get_defined_vars|get_defined_constants|get_defined_functions|get_included_files|proc_get_status|openlog|syslog|dl\\(|chr\\(/i";

    /**
     * @var string POST规则
     */
    protected static $POST_S = "/<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\\s*?\(.*\)|sleep\\s*?\(.*\)|\\b(group_)?concat[\\s\\/\\*]*?\\([^\\)]+?\\)|\bcase[\\s\/\*]*?when[\\s\/\*]*?\([^\)]+?\)|load_file\\s*?\\()|<.+(javascript|vbscript|expression|applet|meta|xml|blink\\(|link\\(|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)|UPDATE\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|<.*(iframe|frame|style|embed|object|frameset|meta|xml)|copy\\(|eval|mkdir|assert|rename|chmod|dirname\\(|fputs\\(|file_put_contents|exit|readfile|fflush|fopen\\(|fgetc|fgetcsv|fgetss|file\\(|fwrite\\(|fread\\(|link\\(|linkinfo|pathinfo|realpath|touch|^exec$|
system|chroot|getcwd|scandir|chgrp|chown|shell_exec|pcntl_exec|ini_alter|ini_restore|readlink\\(|popepassthru|imap_open|passthru|curl_multi_exec|escapeshellcmd|escapeshellarg|insert\\s|select\\s|information_schema|union\\s|database|concat|connection_id|group_concat|update\\s|`|create_function|call_user_func|unlink\\(|delete\\s|phpinfo|preg_replace|popen|proc_open|ini_get|ini_set|parse_str|extract|mb_parse_str|import_request_variables|glob\\(|get_defined_vars|get_defined_constants|get_defined_functions|get_included_files|proc_get_status|openlog|syslog|dl\\(|chr\\(/i";

    /**
     * @var string COOKIE规则
     */
    protected static $COOKIE_S = "/benchmark\\s*?\(.*\)|sleep\\s*?\(.*\)|load_file\\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)|UPDATE\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)/i";

    /**
     * @var string SESSION规则
     */
    protected static $SESSION_S = "/\\bEXEC\\b|UNION.+?SELECT\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)|UPDATE\\s*(\(.+\)\\s*|@{1,2}.+?\\s*|\\s+?.+?|(`|'|\").*?(`|'|\")\\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|<.*(iframe|frame|style|embed|object|frameset|meta|xml)|copy\\(|eval|mkdir|assert|rename|chmod|dirname\\(|fputs\\(|file_put_contents|exit|readfile|fflush|fopen\\(|fgetc|fgetcsv|fgetss|file\\(|fwrite\\(|fread\\(|link\\(|linkinfo|pathinfo|realpath|touch|exec|
system|chroot|getcwd|scandir|chgrp|chown|shell_exec|symlink|ini_alter|ini_restore|readlink\\(|popepassthru|imap_open|passthru|curl_multi_exec|escapeshellcmd|escapeshellarg|insert\\s|select\\s|information_schema|union\\s|database|concat|connection_id|group_concat|update\\s|`|create_function|call_user_func_|unlink\\(|delete\\s|phpinfo\\(|preg_replace|popen|proc_open|ini_get|ini_set|parse_str|extract|mb_parse_str|import_request_variables|glob\\(|get_defined_vars|get_defined_constants|get_defined_functions|get_included_files|proc_get_status|openlog|syslog|apache_setenv|pcntl_([\\w]+)|dl\\(|chr\\(/i";

    /**
     * @var string SERVER规则
     */
    protected static $SERVER_S = "/copy\\(|eval|mkdir|assert|rename|chmod|dirname\\(|fputs\\(|file_put_contents|exit|readfile|fflush|fopen\\(|fgetc|fgetcsv|fgetss|file\\(|fwrite\\(|fread\\(|link\\(|linkinfo|pathinfo|realpath|touch|^exec$|
system|chroot|getcwd|scandir|chgrp|chown|shell_exec|pcntl_exec|ini_alter|ini_restore|readlink\\(|popepassthru|imap_open|passthru|curl_multi_exec|escapeshellcmd|escapeshellarg|insert\\s|select\\s|information_schema|union\\s|database|concat|connection_id|group_concat|update\\s|`|create_function|call_user_func|unlink\\(|delete\\s|phpinfo|preg_replace|popen|proc_open|ini_get|ini_set|parse_str|extract|mb_parse_str|import_request_variables|glob\\(|get_defined_vars|get_defined_constants|get_defined_functions|get_included_files|proc_get_status|openlog|syslog|dl\\(|chr\\(/i";

    /**
     * @var string XSS规则
     */
    protected static $XSS_S = "/onabort|onactivate|onafterprint|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onblur|onbounce|oncellchange|onchange|onclick|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondblclick|ondeactivate|ondrag|ondragend|ondragenter|ondragleave|ondragover|ondragstart|ondrop|onerror|onerrorupdate|onfilterchange|onfinish|onfocus|onfocusin|onfocusout|onhelp|onkeydown|onkeypress|onkeyup|onlayoutcomplete|onload|onlosecapture|onmousedown|onmouseenter|onmouseleave|onmousemove|onmouseout|onmouseover|onmouseup|onmousewheel|onmove|onmoveend|onmovestart|onpaste|onpropertychange|onreadystatechange|onreset|onresize|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onselect|onselectionchange|onselectstart|onstart|onstop|onsubmit|onunload|<script(.*?)>|<script|<link|<link(.*?)>|<iframe|<head(.*?)>|<applet|<meta(.*?)>|<meta|<javascript(.*?)>|<javascript|<vbscript(.*?)>|<vbscript|<base|<title|<embed|object|xml|<xml|<\?php|<\?|<\?=|<%|<%=/i";
}
