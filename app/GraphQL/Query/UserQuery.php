<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class UserQuery extends Query {

    protected $attributes = [
        'name' => 'user'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        $fields = $info->getFieldSelection($depth = 3);

        $user = User::query();

        // check for fields
        foreach ($fields as $field => $keys) {
            if ($field === 'followers_count') {
                $user->withCount('followers');
            }

            if ($field === 'following_count') {
                $user->withCount('following');
            }

            if ($field === 'likes_count') {
                $user->withCount('likes');
            }

            if ($field === 'tweets_count') {
                $user->withCount('tweets');
            }
        }

        // check by email
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

        $user = $user->first();

        // check is current user following it
        $user->is_following = auth()->user()->isFollowing($user->id);

        return $user;
    }
}