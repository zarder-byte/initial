<?php

<<<<<<< HEAD
//公共函数库
=======
/**
 * 自定义函数库
 * 弹出信息提示框
 * @param [type] $msg 要在网页上显示的提示信息
 * @param string $type success / danger
 * @return void
 */

 function alert($msg, $type='success'){
     session()->flash($type,$msg);
 }
>>>>>>> 04-02-01
