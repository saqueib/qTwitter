<?php

namespace App\GraphQL\Mutation\Reply;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateReplyMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateReply'
    ];

    public function type()
    {
        return GraphQL::type('Reply');
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
        $reply = auth()->user()->replys()->find($args['id']);

        if(! $reply)
        {
            return null;
        }

        // update user
        $reply->update(['body' => $args['body']]);

        return $reply;
    }

}