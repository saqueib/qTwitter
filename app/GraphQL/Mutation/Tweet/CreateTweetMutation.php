<?php

namespace App\GraphQL\Mutation\Tweet;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateTweetMutation extends Mutation {

    protected $attributes = [
        'name' => 'createTweet'
    ];

    public function type()
    {
        return GraphQL::type('Tweet');
    }

    public function rules()
    {
        return [
            'body' => 'required|max:200'
        ];
    }

    public function args()
    {
        return [
            'body' => ['name' => 'body', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        return auth()->user()->tweets()->create($args);
    }
}