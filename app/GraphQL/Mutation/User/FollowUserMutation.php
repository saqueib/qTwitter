<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class FollowUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'followUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function args()
    {
        return [
            'user_id' => ['name' => 'user_id', 'type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args)
    {
        $me = auth()->user();

        if( ! $me->followers()->where('follow_id', $args['user_id'])->exists() ) {
            return $me->followers()->attach($args['user_id']);
        }

        return null;
    }
}