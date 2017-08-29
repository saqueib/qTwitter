<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class FollowSuggestionsQuery extends Query {

    protected $attributes = [
        'name' => 'should_follow'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'first' => ['name' => 'first', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        $me = auth()->user();
        $followingUser = $me->following()->pluck('follow_id')->toArray();

        $user = User::whereNotIn('id', $followingUser + [$me->id] )->inRandomOrder();
        return $user->limit(isset($args['first']) ? $args['first'] : 5)->get();
    }
}