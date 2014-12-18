<?php

class UserGroup extends \BaseModel
{
    protected $table = 'users_groups';

    public function userGroupIds($userId)
    {
        $userGroups = UserGroup::where('user_id', $userId)->get();

        $ids = [];
        foreach($userGroups as $userGroup) {
            $ids[] = $userGroup->group_id;
        }

        return $ids;
    }

    public function getCurrentUserGroupName()
    {
        $userId = Sentry::getUser()->id;
        $ids = $this->userGroupids($userId);
        $groupId = last($ids);
        $group = Sentry::findGroupById($groupId);
        $role = $group->name;

        return $role;
    }
}