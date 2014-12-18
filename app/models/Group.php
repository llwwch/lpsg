<?php

class Group extends \BaseModel
{

    protected $table = 'groups';

    public $enableOnSearch = [
        ['id, name, department, created_at, updated_at'],
    ];

    public function lists($data)
    {
        return $this->inputSearch(Group::query(), $enableOnSearch)->orderBy('id', 'desc');
    }

    public function store($data)
    {
        $data['permissions'] = [];
        if(isset($data['permissions'])) {
            $permissions = [];
            foreach(Input::get('permissions', []) as $permission) {
                $permissions[$permission] = 1;
            }

            $data['permissions'] = $permissions;
        }

        $result = false;
        try {
            $group = Sentry::createGroup($data);
            Session::flash('tips', ['success' => true, 'message' => "add group success"]);
            $result = true;

            //add log

        } catch (Cartalyst\Sentry\Groups\NameRequiredException $e) {
            Session::flash('tips', ['success' => false, 'message' => "role name none"]);
        } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
            Session::flash('tips', ['success' => false, 'message' => "role name exist"]);
        }

        return $result;
    }

    public function addGroupName($users)
    {
        foreach($users['data'] as $key=>$user) {
            $userGroupModel = new UserGroup;
            $ids = $userGroupModel->userGroupIds($user['id']);

            $groups = Group::whereIn('id', $ids)->get();
            $groupNames = [];
            foreach($groups as $group) {
                $groupNames[] = $group->name;
            }

            $name = '';
            if(!empty($groupNames)) {
                $name = implode(',', $groupNames);
            }

            $users['data'][$key]['role'] = $name;
        }

        return $users;
    }
}