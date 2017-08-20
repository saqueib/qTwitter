<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'email' => 'email|unique:users',
            'name' => 'min:2',
            'password' => 'min:6',
            'avatar' => 'url'
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::find($args['id']);

        if(! $user)
        {
            return null;
        }

        // update user
        $fields = isset($args['password'])
                ? array_merge($args, ['password' => bcrypt($args['password'])])
                : $args;

        $user->update($fields);

        return $user;
    }

}