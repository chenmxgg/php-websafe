<?php
namespace chenm\websafe\tpl;

class DefaultTpl
{

    /**
     * 是否AJAX请求
     *
     * @return boolean
     */
    public static function isAjax()
    {
        if (defined('IS_AJAX')) {
            return IS_AJAX;
        }
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
    }
    /**
     *  防护提示页
     */
    public static function showPage($str = '')
    {
        if (self::isAjax()) {
            $str    = !empty($str) ? "监测到非法字符：" . $str : '提交内容包含危险字符';
            $msg    = $str . "，已被程序拦截！<br>您可以规范内容后再尝试提交<br>如误报请联系网站管理员处理";
            $result = ['code' => -1, "msg" => $msg];
            exit(json_encode($result, JSON_UNESCAPED_UNICODE));
        }
        @header("HTTP/1.1 403 Forbidden");
        @header('Content-Type: text/html; charset=UTF-8');
        $pape = <<<HTML
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>输入内容存在危险字符，安全起见，已被本站拦截</title>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 微软雅黑,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size: 100%;cursor:default;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<body>
<div class="ip-attack">
<dl>
<dt><img  src='http://p2.qhimg.com/t016dd70ac04d942b1b.png' /></dt>
HTML;

        try {
            if (\think\facade\App::isDebug() && $str != "") {
                $pape .= '<h5>' . $str . '</h5>';
            }
        } catch (\Exception $e) {
            //
        }
        $pape .= <<<HTML2
<dt><a href="javascript:history.go(-1)">返回上一页</a></dt>
</dl>
</div>
</body>
</html>
HTML2;
        die($pape);
    }
}
