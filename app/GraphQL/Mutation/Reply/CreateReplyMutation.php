<?php

namespace App\GraphQL\Mutation\Reply;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateReplyMutation extends Mutation {

    protected $attributes = [
        'name' => 'createReply'
    ];

    public function type()
    {
        return GraphQL::type('Reply');
    }

    public function rules()
    {
        return [
            'body' => 'required|max:200',
            'tweet_id' => 'required|integer|exists:tweets,id'
        ];
    }

    public function args()
    {
        return [
            'body' => ['name' => 'body', 'type' => Type::string()],
            'tweet_id' => ['name' => 'tweet_id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
        $data = [
            'body' => $args['body'],
            'tweet_id' => $args['tweet_id'],
            'user_id' => auth()->id,
        ];

        return Tweet::replies()->create($data);
    }
}