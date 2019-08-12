<?php

namespace App\Http\Middleware;

use Closure;

class AuthUserMiddleware
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
        $user_id = session()->get('user_id');

        if(!is_null($user_id)){
            //session 有資料 允許登入
            $is_allow_access = true;
        }
        //允許存取 繼續下個請求
        return $next($request);

        if(!$is_allow_access){
            //若不允許 回首頁
            return redirect()->to('/login');
        }

        
    }
}
