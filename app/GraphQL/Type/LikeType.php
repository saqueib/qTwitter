<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LikeType extends GraphQLType {

    protected $attributes = [
        'name' => 'Like',
        'description' => 'A user like on a tweet'
    ];

    /*
       * Uncomment following line to make the type input object.
       * http://graphql.org/learn/schema/#input-types
       */
    // protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of like'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'tweet_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the tweet'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Creation datetime'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Updating datetime'
            ],

            // Nested Resource
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'A User type',
            ]
        ];
    }

    protected function resolveUserField($root, $args)
    {
        return $root->user;
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->diffForHumans();
    }
}