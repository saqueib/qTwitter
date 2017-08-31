<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ReplyType extends GraphQLType {

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'body' => [
                'type' => Type::nonNull(Type::string())
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'tweet_id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'created_at' => [
                'type' => Type::string()
            ],
            'updated_at' => [
                'type' => Type::string()
            ],
            'replies_count' => [
                'type' => Type::int()
            ],
            'likes_count' => [
                'type' => Type::int()
            ],
            'user' => [
                'type' => GraphQL::type('User')
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveBodyField($root, $args)
    {
        return nl2br($root->body);
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->diffForHumans();
    }
}