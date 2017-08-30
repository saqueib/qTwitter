<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LikeType extends GraphQLType {

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
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

            // Nested Resource
            'user' => [
                'type' => GraphQL::type('User')
            ]
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->diffForHumans();
    }
}