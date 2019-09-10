<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 預設不允許
        $is_allow_access = false;
        // 取得會員編號
        $user_id = Auth::id();

        if(!is_null($user_id)){
            //是會員
            $User = User::findorFail($user_id);

            if($User->type =='A'){
                //且是管理者
                $is_allow_access = true;
            }
        }

        if(!$is_allow_access){
            //若不允許 回首頁
            return redirect()->to('/login');
        }

        //允許存取 繼續下個請求
        return $next($request);

        
    }
}
