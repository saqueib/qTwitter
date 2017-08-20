<?php

namespace App\GraphQL\Mutation\Tweet;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateTweetMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateTweet'
    ];

    public function type()
    {
        return GraphQL::type('Tweet');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'body' => ['name' => 'body', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'body' => 'required|max:200'
        ];
    }

    public function resolve($root, $args)
    {
        $tweet = auth()->user()->tweets()->find($args['id']);

        if(! $tweet)
        {
            return null;
        }

        // update user
        $tweet->update(['body' => $args['body']]);

        return $tweet;
    }

}