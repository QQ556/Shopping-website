<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    // 預設認證
    use AuthenticatesUsers;

    //facebook sign
    public function facebookSignInProcess()
    {
        $redirect_url = env('FB_REDIRECT');

        return Socialite::driver('facebook')
            ->scopes(['user_friends'])
            ->redirectUrl($redirect_url)
            ->redirect();
    }
    public function facebookSignInCallbackProcess()
    {
        if (request()->error == 'access_denied') {
            throw new Exception('授權失敗');
        }
        //依照網域產生出重新導向連結(來驗證是否為發出時同一 callback)
        $redirect_url = env('FB_REDIRECT');
        //取得第三方資料
        $FacebookUser = Socialite::driver('facebook')
            ->fields([
                'name',
                'email',
                'gender',
                'verified',
                'link',
                'first_name',
                'last_name',
                'locale',
            ])
            ->redirectUrl($redirect_url)->user();
        $facebook_email = $FacebookUser->email;

        if (is_null($facebook_email)) {
            throw new Exception('未授權取得使用著email');
        }
        //取得facebook 資料
        $facebook_id = $FacebookUser->id;
        $facebook_name = $FacebookUser->name;

        //取用使用者資料是否有此 facebook id 資料
        $User = User::where('facebok_id', $facebook_id)->first();

        if (is_null($User)) {
            //尚未註冊
            $input = [
                'email' => $facebook_email,
                'nickname' => $facebook_name,
                'password' => uniqid(),
                'facebook_id' => $facebook_id,
                'type' => 'G',
            ];
            //密碼加密
            $input['password'] = Hash::make($input['password']);
            //新增會員資料
            $user = User::create($input);

            //寄送註冊通知信
            $mail_binding = [
                'nickname' => $input['nickname']
            ];

            Mail::send(
                'email.signUpEmailNotification',
                $mail_binding,
                function ($mail) use ($input) {
                    $mail->to($input['email']);
                    $mail->from('laravel.shop');
                    $mail->subject('恭喜註冊成功');
                }
            );

            //登入會員
            //session 紀錄會員編號
            session()->put('user_id', $User->id);

            //重新導向到原先使用著造訪頁面
            return redirect()->intended('/');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
