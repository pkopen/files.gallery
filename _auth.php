<?php
header('Content-type:text/json;charset=utf-8');
echo $_POST ? '{"status":1,"type":1}' : '{"status":0,"msg":"not found"}';
