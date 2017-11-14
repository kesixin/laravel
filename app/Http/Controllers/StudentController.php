<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Student;

class StudentController extends Controller
{
    public function uploads(Request $request)
    {
        if ($request->isMethod('POST')) {

            $file = $request->file('source');

            //文件是否上传成功
            if ($file->isValid()) {

                //原文件名
                $originaName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //MimeType
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();

                $fileName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;

                $bool = Storage::disk('uploads')->put($fileName, file_get_contents($realPath));

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
        Mail::send('student.mail', ['name' => 'ksx', 'phone' => '18819201898'], function ($message) {
            $message->to('903363777@qq.com');
        });
    }

    public function cache1()
    {
        Cache::put('key4', 'val4', 10);
    }

    public function cache2()
    {
        $val = Cache::get('key4');
        var_dump($val);
    }

    public function error()
    {
        echo $name;
    }


    public function index()
    {
        $students = Student::paginate(10);

        return view('student.index', [
            'students' => $students
        ]);
    }

    public function create(Request $request)
    {
        $student=new Student();
        if($request->isMethod('POST')){

            //1.控制器验证
            /*$this->validate($request,[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer'
            ],[
                'required'=>':attribute 为必填项',
                'integer'=>':attribute 为整数',
                'min'=>':attribute 长度不符合要求',
                'max'=>':attribute 长度不符合要求'
            ],[
                'Student.name'=>'姓名',
                'Student.age'=>'年龄',
                'Student.sex'=>'性别'
            ]);*/

            //2.Validator类验证  全局
            $validator=\Validator::make($request->input(),[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer'
            ],[
                'required'=>':attribute 为必填项',
                'integer'=>':attribute 为整数',
                'min'=>':attribute 长度不符合要求',
                'max'=>':attribute 长度不符合要求'
            ],[
                'Student.name'=>'姓名',
                'Student.age'=>'年龄',
                'Student.sex'=>'性别'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data=$request->input('Student');
            if(Student::create($data)){
                return redirect('student/index')->with('success','添加成功！');
            }else{
                return redirect()->back()->with('error','添加失败！');
            }
        }
        return view('student.create',[
            'student'=>$student
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->input('Student');
        $student = new Student();

        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save()) {
            return redirect('student/index');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request,$id)
    {

        $student=Student::find($id);

        if($request->isMethod('POST')){
            $data=$request->input('Student');
            $student->name=$data['name'];
            $student->age=$data['age'];
            $student->sex=$data['sex'];
            if($student->save()){
                return redirect('student/index')->with('success','修改成功-'.$id);
            }
        }

        return view('student/update',[
            'student'=>$student
        ]);
    }
}