<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//Model基类

class Model extends BaseModel
{
    protected $guarded=[]; //不可以注入的字段 null:代表所有字段都可以注入

}
