<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
/**
 * 用户授权策略类文件
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 当两个 id 相同时，则代表两个用户是相同用户，用户通过授权，可以接着进行下一个操作。
     *  如果 id 不相同的话，将抛出 403 异常信息来拒绝访问
     * @param obj $currentUser 当前登录用户实例
     * @param obj $user 进行授权的用户实例
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }


    /**
     * 只有当前登录用户为管理员才能执行删除操作
     *  删除的用户对象不是自己（即使是管理员也不能自己删自己）
     * @param obj $currentUser 当前登录用户实例
     * @param obj $user 进行授权的用户实例
     */
    public function destroy(User $currentUser, User $user)
    {
        //只有当前用户拥有管理员权限且删除的用户不是自己时才显示链接
        return $currentUser->is_admin &&  $currentUser->id !== $user->id;
    }

}
