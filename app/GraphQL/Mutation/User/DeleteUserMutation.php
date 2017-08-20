<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
        if( $user = User::findOrFail($args['id']) ) {
            $user->delete();
            return $user;
        }

        return null;
    }

}