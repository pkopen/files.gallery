修改过程：
 1.官网下载，此版本是Files Gallery 0.12.0，仅单文件index.php； 2.修改index.php。找到var CodeMirror = {};（在// load _files/js/custom.js前几行），在下面打空行，插入以下代码，再打空行：

!function(){const t=window.XMLHttpRequest;window.XMLHttpRequest=function(){const e=new t;return e.open=function(n,o,s,p,l){"GET"===n&&o.startsWith("files.photo.gallery@")&&o.endsWith("/lang/zh.json")&&(arguments[1]=arguments[1].replace(/@[0-9.]+/lang/,"@latest/lang")),"POST"===n&&o.includes("auth.photo.gallery")&&(e.send=function(e){t.prototype.send.apply(this,["app=2&host=demo.files.gallery"])}),t.prototype.open.apply(this,arguments)},e}}();

//这是为了将指定的URL中的版本号替换为 @latest/lang、将包含 auth.photo.gallery的URL修改请求内容使其始终发送固定的数据 app=2&host=demo.files.gallery。
2.编辑配置文件，启用 'allow_settings' => true,（启用直接从界面编辑选项和创建用户）

使用成品： 
files.gallery存储库中单文件已编辑好。 放到网站目录，用浏览器首次访问，自动创建配置文件_files/config/config.php。网页界面编辑'username' => 'pkopen','password' => 'md5值'；编辑'allow_all' => true；等。官方配置介绍https://www.files.gallery/docs/config
