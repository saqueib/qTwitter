<?php

namespace App\GraphQL\Mutation\Tweet;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteTweetMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteTweet'
    ];

    public function type()
    {
        return GraphQL::type('Tweet');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
        if( $tweet = auth()->user()->tweets()->findOrFail($args['id']) ) {
            $tweet->delete();
            return $tweet;
        }

        return null;
    }

}