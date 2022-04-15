<?php
namespace app\common\business\api;
use app\common\model\api\User as UserModel;
use app\common\business\lib\Str;
use Exception;
use think\facade\Log;

class User 
{
  private $userModel = NULL;
  private $str = NULL;

  public function __construct(){
    $this -> userModel = new UserModel();
    $this -> str = new Str();
  }

  public function register($data) {
    Log::write('测试日志信息，这是警告级别，并且实时写入','error');
    Log::record('测试日志信息','info');
    $isExist = $this -> userModel -> findByUserName($data['username']);
    Log::record($isExist,'info');
    if (!empty($isExist)) {
      throw new Exception("用户名已经被注册！");
    }

    $data['password_salt'] = $this -> str -> salt(5);
    $data['password'] = md5($data['password_salt'].$data['password'].$data['password_salt']);
  
    $this -> userModel -> save($data);
  
  }

}