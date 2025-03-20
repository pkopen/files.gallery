修改过程：

 1.files gallery是一个单文件的 PHP 程序，只需要把这个文件放到任意文件夹，通过浏览器访问，该文件夹就变成了网页版本的文件库，可以预览图片、视频、音频，以及文本文件。此版本是 0.12.4，官网下载仅单文件index.php； 

 2.修改index.php。找到var CodeMirror = {};（在// load _files/js/custom.js前几行），在它下面打空行，插入以下代码，再打空行：

!function(){const t=window.XMLHttpRequest;window.XMLHttpRequest=function(){const e=new t;return e.open=function(n,o,s,p,l){"GET"===n&&o.startsWith("<?php echo config::$version ?>files.photo.gallery@")&&o.endsWith("/lang/zh.json")&&(arguments[1]=arguments[1].replace(/@[0-9\.]+\/lang/,"@latest/lang")),"POST"===n&&o.includes("auth.photo.gallery")&&(e.send=function(e){t.prototype.send.apply(this,["app=2&host=demo.files.gallery"])}),t.prototype.open.apply(this,arguments)},e}}();

//这是为了将指定的URL中的版本号替换为 @latest/lang、将包含 auth.photo.gallery的URL修改请求内容使其始终发送固定的数据 app=2&host=demo.files.gallery。

3.编辑其中的配置，启用 'allow_settings' => true,（启用直接从界面编辑选项和创建用户）

使用成品： 

files.gallery存储库中单文件已编辑好。 放到网站目录，用浏览器首次访问，将自动创建配置文件_files/config/config.php。网页界面编辑'username' => 'pkopen','password' => 'md5值'；编辑'allow_all' => true。官方md5工具https://www.files.gallery/tools/hash
