<?php

namespace App\Http\Controllers;

use App\Events\UsersEvent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    /*
     * 添加用户
     * */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data = [
            'confirm_code' => str_random(48),
            'avatar' => '/images/233.jpg',
        ];
        //保存用户数据
        $user = User::create(array_merge($request->all(), $data));

        //send mail
//        $subject = 'Confirm Your Email';
//        $view = 'email.register';
//        $this->sendTo($user, $subject, $view, $data);
        \Event::fire(new UsersEvent($user));

        //重定向
        return redirect('/');
    }

    public function login()
    {
        return view('user.login');
    }

    /*
     * 登录
     * */
    public function signin(Requests\UserLoginRequest $request)
    {
        if (\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            return redirect('/');
        }
        \Session::flash('user_login_failed', '密码或邮箱不正确');
        return redirect('/user/login')->withInput();
    }

    /*
     * 退出登录
     * */
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    /*
     * 上传头像视图
     * */
    public function avatar()
    {
        return view('user.aratar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('avatar');
//        $input = array('image' => $file);
//        $rules = array('image' => 'image');
//        $validator = \Validator::make($input, $rules);
//        if ($validator->falis()) {
//            return \Response::json([
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray(),
//            ]);
//        }
        $path = 'uploads/';
        $filename= \Auth::user()->id . '_' .time().$file->getClientOriginalName();
        $file->move($path, $filename);
        Image::make($path.$filename)->fit(400)->save();

        return \Response::json([
            'success' => true,
            'avatar' => asset($path.$filename),
            'image' => $path.$filename,
        ]);
//        return redirect('/user/avatar');
    }
    
    public function cropAvatar(Request $request)
    {
        $photo =  $request->get('photo');
        $width = (int) $request->get('w');
        $height = (int) $request->get('h');
        $xAlign = (int) $request->get('x');
        $yAlign = (int) $request->get('y');

        Image::make($photo)->crop($width, $height, $xAlign, $yAlign)->save();

        $user = \Auth::user();
        $user->avatar = asset($photo);
        $user->save();

        return redirect('/user/avatar');
        
    }

    /*
     * 发送邮件
     * @param object $user 新建用户对象
     * @param string $subject 
     * $view string $view 渲染视图
     * $data array $data 模板传递遍历
     * */
    public function sendTo($user, $subject, $view, $data = [])
    {
        \Mail::queue($view,$data,function($message) use ($user,$subject){

            $message->to($user->email)->subject($subject);

        });
    }

    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();

        if (is_null($user)) {
            return redirect('/');
        }

        $user->is_confirmed = 1;

        $user->confirm_code = str_random(46);

        $user->save();

        return redirect('user/login');

    }
}
