<?php

namespace app\common\model\api;

use think\Model;

class User extends Model
{
  protected $table = "api_user";

  public function updateLoginInfo($data)
  {
    $result = $this->findByUserNameWithStatus($data['username']);
    return $result->allowField(['last_login_token'])->save($data);
  }

  public function findByUserName($username)
  {
    return $this->where('username', $username)->find();
  }

  public function findByUserNameWithStatus($username)
  {
    return $this->where(['username' => $username, 'status' => 1])->find();
  }
}
