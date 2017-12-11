<?php
namespace app\common\model;

use think\Model;

class AdminUser extends Model
{
  public $table;
  //自定义初始化
  protected function initialize()
  {
      //需要调用`Model`的`initialize`方法
      parent::initialize();
      //TODO:自定义的初始化
      $this->table = db('admin_user');
  }

  /**
   * 增
   */
  public function inserts($data)
  {
    $this->table->insert($data);
    return $this->table->getLastInsID();
  }

  /**
   * 删
   */
  public function deletes($id)
  {
    return $this->table->delete($id);
  }

  /**
   * 改
   */
  public function updates($id,$data)
  {
    return $this->table->where('id', $id)->update($data);
  }

  /**
   * 查
   */
  public function selects($select, $where, $orderBy, $limit)
  {
    // sql
    $sql = "SELECT {$select} FROM `admin_user` {$where} {$orderBy} {$limit}";
    return $this->table->query($sql);
  }

}




