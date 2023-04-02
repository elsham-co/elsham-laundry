<?php

namespace Modules\Core\Services;

use Modules\Auth\Repositories\UserGroupRepositoryEloquent;
use Modules\Core\Repositories\GroupRepositoryEloquent;
use Modules\Core\Repositories\UserRepositoryEloquent;

class UsersSearchService
{
    private $user;
    private $group;
    private $userGroup;

    public function __construct(UserRepositoryEloquent      $user, GroupRepositoryEloquent $group,
                                UserGroupRepositoryEloquent $userGroup)
    {
        $this->user = $user;
        $this->group = $group;
        $this->userGroup = $userGroup;
    }

    public function getUsers($data = null)
    {
        $group = $this->group->where('name', 'customer')->first();
        $users_group = $this->userGroup->where('group_id', $group->id)->pluck('user_id')->toArray();
        $reduceArr = array_chunk($users_group,50);
        $customersArray = [];
        foreach ($reduceArr as $arr){
            $customers = $this->user->whereIn('id', $arr);
            if (empty($data['search'])) {
                array_push($customersArray,$customers->get()) ;


            } else {
                $customers = $customers
                    ->where('username', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('phone', 'LIKE', '%' . $data['search'] . '%')
                    ->get();
                array_push($customersArray,$customers);

            }
        }

        $users = [];
        foreach ($customersArray as $group) {
            foreach ($group as $customer){
                $users[] = array(
                    "id" => $customer->id,
                    "text" => (empty($data['search']) || (str_contains($data['search'], '@') != 1 && preg_match('/^[0-9]+$/', $data['search']) != 1))
                        ? $customer->username : (str_contains($data['search'], '@')
                            ? $customer->email : (preg_match('/^[0-9]+$/', $data['search']) ?
                                $customer->phone : ''))
                );
            }

        }

        return $users;

    }
    public function getNewUsers($data = null)
    {
        $group = $this->group->where('name', 'customer')->first();
        $users_group = $this->userGroup->where('group_id', $group->id)->pluck('user_id')->toArray();
        $reduceArr = array_chunk($users_group,50);
        $customersArray = [];
        foreach ($reduceArr as $arr){
            $customers = $this->user->where('created_on','>',strtotime("-30 days"))->whereIn('id', $arr);
            if (empty($data['search'])) {
                array_push($customersArray,$customers->get()) ;


            } else {
                $customers = $customers
                    ->where('username', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $data['search'] . '%')
                    ->orWhere('phone', 'LIKE', '%' . $data['search'] . '%')
                    ->get();
                array_push($customersArray,$customers);

            }
        }

        $users = [];
        foreach ($customersArray as $group) {
            foreach ($group as $customer){
                $users[] = array(
                    "id" => $customer->id,
                    "text" => (empty($data['search']) || (str_contains($data['search'], '@') != 1 && preg_match('/^[0-9]+$/', $data['search']) != 1))
                        ? $customer->username : (str_contains($data['search'], '@')
                            ? $customer->email : (preg_match('/^[0-9]+$/', $data['search']) ?
                                $customer->phone : ''))
                );
            }

        }

        return $users;

    }
    public function getAdmins($data = null)
    {
        $group = $this->group->where('name', 'admin')->firstOrFail();
        $users_group = $this->userGroup->where('group_id', $group->id)->pluck('user_id')->toArray();
        if (empty($data['search'])) {
            $customers = $this->user->whereIn('id', $users_group)->get();

        } else {
            $customers = $this->user->whereIn('id', $users_group)
                ->where('username', 'LIKE', '%' . $data['search'] . '%')
                ->orWhere('email', 'LIKE', '%' . $data['search'] . '%')
                ->orWhere('phone', 'LIKE', '%' . $data['search'] . '%')
                ->get();

        }
        $users = [];
        foreach ($customers as $customer) {
            $users[] = array(
                "id" => $customer->id,
                "text" => (empty($data['search']) || (str_contains($data['search'], '@') != 1 && preg_match('/^[0-9]+$/', $data['search']) != 1))
                    ? $customer->username : (str_contains($data['search'], '@')
                        ? $customer->email : (preg_match('/^[0-9]+$/', $data['search']) ?
                            $customer->phone : ''))
            );
        }
        return $users;

    }

}
