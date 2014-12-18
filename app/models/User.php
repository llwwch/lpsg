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
        ['id, activated, activation_code, activated_at, last_login, created_at, updated_at'],
    ];

    public function list()
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

    public function store($data)
    {
        try {
            $user = Sentry::createUser(array(
                'email' => $data['email'],
                'password' => $data['password'],
                'username' => $data['username'],
                'realname' => $data['realname'],
                'activated' => $data['activated']=='1' ? 1 : 0;
            ));

            $group = Sentry::findGroupById($data['group_id']);
            $user->addGroup($group);
            Session::flash('tips', ['success' => true, 'message' => "add user success"]);

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
    }

}
