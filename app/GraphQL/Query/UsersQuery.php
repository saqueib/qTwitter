<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class UsersQuery extends Query {

    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'first' => ['name' => 'first', 'type' => Type::int()],
            'offset' => ['name' => 'offset', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args)
    {

        $user = new User;

        // check for limit
        if( isset($args['first']) ) {
            $user =  $user->limit($args['first'])->latest();
        }

        if( isset($args['offset']) ) {
            $user =  $user->offset($args['offset']);
        }

        if(isset($args['email']))
        {
            $user = $user->where('email', $args['email']);
        }

        if(isset($args['username']))
        {
            $user = $user->where('username', $args['username']);
        }

        if(isset($args['id']))
        {
            $user = $user->where('id' , $args['id']);
        }

        return $user->get();
    }
}