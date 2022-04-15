<?php
namespace app\api\controller;

use app\BaseController;
use think\App;
use app\common\business\api\User as Business;
use app\common\validate\api\User as Validate;
use think\Facade\Log;

class User extends BaseController
{
    protected $business = NULL;

    public function __construct(App $app) {
      parent::__construct($app);
      $this -> business = new Business();
    }

    public function register()
    {
      trace('错误信息', 'error');
      $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
      $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');

      try {
        validate(Validate::class) -> scene("login_register") -> check($data);
      } catch (\Exception $exception) {
        return $this ->fail($exception -> getMessage()); 
      }

      
      // Log::log('info',"aaaaaaaaaaaaaa");
      Log::write('测试日志信息，这是警告级别，并且实时写入','notice');
      $this ->business ->register($data);
      return $this -> success("注册成功！");

    }

}
