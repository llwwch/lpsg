<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'users';

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = array('password', 'remember_token');

    protected $enableOnSearch = [
        ['id, username, activated, activation_code, activated_at, last_login, created_at, updated_at'],
    ];

    public function lists($data)
    {
        return $this->inputSearch(User::query(), $data)->orderBy('id', 'desc');
    }

    public function getUserNameByIds($ids)
    {
        $users = User::whereIn('id', $ids)->get();
        $names = [];
        foreach($users as $user) {
            $names[$user->id] = $user->first_name;
        }
        return $names;
    }

    public function test() {
        return ["hack"];
    }

    public function store($data)
    {
        try {
            $user = Sentry::createUser(array(
                'email' => $data['email'],
                'password' => $data['password'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'activated' => $data['activated']=='1' ? 1 : 0,
            ));

            // $group = Sentry::findGroupById($data['group_id']);
            // $user->addGroup($group);
            Session::flash('tips', ['success' => true, 'message' => "add user success"]);
            return true;

            //add log
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            Session::flash('tips', ['success' => false, 'message' => "username none"]);
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            Session::flash('tips', ['success' => false, 'message' => "password none"]);
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            Session::flash('tips', ['success' => false, 'message' => "username already exist"]);
        } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
            Session::flash('tips', ['success' => false, 'message' => "group none"]);
        }
        return true;
    }

    public function changePassword($id, $newPassword)
    {
        $user = Sentry::findUserById($id);
        $user->attemptResetPassword($user->getResetPasswordCode(), $newPassword);
    }

    public function addOperator($data)
    {
        foreach($data['data'] as $key=>$item) {
            if(empty($item['operator_id'])) {
                break;
            }
            $user = Sentry::findUserById($item['operator_id']);
            $data['data'][$k]['operator'] = $user->username;
        }

        return $data;
    }

    public function getUserNameByList($key=[], $list=[])
    {
        $ids = [];
        foreach($list as $l) {
            foreach($key as $k) {
                if(!isset($ids[$l->$k])) {
                    $ids[] = $l->$k;
                }
            }
        }

        $users = User::whereIn('id', $userIds)->get();
        $names = [];
        foreach($users as $user) {
            $names[$user->id] = $user->username;
        }
        return $names;
    }

}
