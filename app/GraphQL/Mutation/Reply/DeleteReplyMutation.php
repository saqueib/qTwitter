<?php

namespace App\GraphQL\Mutation\Reply;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteReplyMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteReply'
    ];

    public function type()
    {
        return GraphQL::type('Reply');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
        ];
    }

    public function resolve($root, $args)
    {
        if( $reply = auth()->user()->replys()->findOrFail($args['id']) ) {
            $reply->delete();
            return $reply;
        }

        return null;
    }

}