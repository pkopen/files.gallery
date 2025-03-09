过程：
1.官网下载www.files.gallery，当前下载的版本是Files Gallery 0.12.0，仅单文件index.php；
2.修改index.php。将以下代码插入// load _files/js/custom.js之前的var CodeMirror = {};打空行之后，再空行：

!function(){const t=window.XMLHttpRequest;window.XMLHttpRequest=function(){const e=new t;return e.open=function(n,o,s,p,l){"GET"===n&&o.startsWith("<?php echo config::$version ?>files.photo.gallery@")&&o.endsWith("/lang/zh.json")&&(arguments[1]=arguments[1].replace(/@[0-9\.]+\/lang/,"@latest/lang")),"POST"===n&&o.includes("auth.photo.gallery")&&(e.send=function(e){t.prototype.send.apply(this,["app=2&host=demo.files.gallery"])}),t.prototype.open.apply(this,arguments)},e}}();

//这是为了将指定的URL中的版本号替换为 @latest/lang、将包含 auth.photo.gallery的URL修改请求内容使其始终发送固定的数据 app=2&host=demo.files.gallery，
编辑配置文件，启用 'allow_settings' => true,（直接从界面编辑选项和创建用户）

成品：
github的files.gallery中单文件已编辑好。
1.放入网站目录，首次浏览器访问，自动创建配置文件_files/config/config.php。网页界面编辑'allow_all' => true,编辑'username' => 'pkopen','password' => 等等。官方配置介绍https://www.files.gallery/docs/config/#allow_settings。
