<?php

namespace JuheApi\AuthMenu;

trait Common
{
  /**
   * php处理耗时任务，提高页面响应速度
   * 主要任务就一完成。这时我可以先把结果返回给浏览器，告诉用户已完成。提升用户体验.要用利用php的缓存数据输出，将返回的数据提前返回到浏览器。
   * 结束输出缓冲数据
   *
   * @return void [type] [description]
   */
  public static function finishRequest()
  {
    ignore_user_abort(true); // 客户端关闭程序继续执行
    if (function_exists('fastcgi_finish_request')) {
      fastcgi_finish_request(); // 响应完成, 关闭连接。只在FastCGI有效
    } else {
      header('X-Accel-Buffering: no'); // nginx 不缓存输出
      header('Content-Length: ' . strlen(ob_get_contents()));
      header("Connection: close");
      header("HTTP/1.1 200 OK");
      ob_end_flush();
      flush();
    }
  }
}
