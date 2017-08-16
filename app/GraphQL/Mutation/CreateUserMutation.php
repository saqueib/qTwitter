<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'createUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:2',
            'password' => 'required|min:6',
            'avatar' => 'url'
        ];
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
            'avatar' => ['name' => 'avatar', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        return User::create($args);
    }
}