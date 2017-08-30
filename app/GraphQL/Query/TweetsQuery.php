<?php
namespace App\GraphQL\Query;

use GraphQL;
use App\Tweet;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class TweetsQuery extends Query {

    protected $attributes = [
        'name' => 'tweets'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Tweet'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'first' => ['name' => 'first', 'type' => Type::int()],
            'offset' => ['name' => 'offset', 'type' => Type::int()],
            'username' => ['name' => 'username', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['id'])) {
            $tweet = Tweet::withCount('replies', 'likes')->with('replies')->find($args['id']);
        } else {
            // Get all the latest tweet by followings user
            $followingUser = auth()->user()->following()->pluck('follow_id')->toArray() + [auth()->user()->id];
            $tweet = Tweet::with('user')->withCount('replies', 'likes')->whereIn('user_id', $followingUser);
        }


        // check for limit
        if( isset($args['first']) ) {
            $tweet =  $tweet->limit($args['first'])->latest();
        }

        if( isset($args['offset']) ) {
            $tweet =  $tweet->offset($args['offset']);
        }

        if(isset($args['id']))
        {
            $tweet = $tweet->where('id' , $args['id']);
        }

        if(isset($args['email']))
        {
            $tweet = $tweet->where('email', $args['email']);
        }

        return $tweet->get();
    }

}