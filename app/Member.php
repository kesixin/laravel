<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    public static function getMember(){

        return 'getMember';

    }

    public function Members(){

        return 'Members';

    }

}