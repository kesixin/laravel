<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Mail;

class StudentController extends Controller
{
    public function uploads(Request $request)
    {
        if($request->isMethod('POST')){

            $file = $request->file('source');

            //文件是否上传成功
            if($file->isValid()){

                //原文件名
                $originaName=$file->getClientOriginalName();
                //扩展名
                $ext=$file->getClientOriginalExtension();
                //MimeType
                $type=$file->getClientMimeType();
                //临时绝对路径
                $realPath=$file->getRealPath();

                $fileName=date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;

                $bool=Storage::disk('uploads')->put($fileName,file_get_contents($realPath));

                var_dump($bool);

                exit;

            }

        }

        return view('student/uploads');
    }

    //邮件发送
    public function mail()
    {
        //发送文本邮件
//        Mail::raw('邮件测试',function ($message){
//            $message->from('462369233@qq.com','ksx');
//            $message->subject('测试内容');
//            $message->to('251882635@qq.com');
//        });

        //发送html格式邮件
        Mail::send('student.mail',['name'=>'ksx','phone'=>'18819201898'],function ($message){
            $message->to('903363777@qq.com');
        });
    }

    public function  cache1()
    {
        Cache::put('key4','val4',10);
    }

    public function cache2()
    {
        $val=Cache::get('key4');
        var_dump($val);
    }

    public function error()
    {
        echo $name;
    }

}