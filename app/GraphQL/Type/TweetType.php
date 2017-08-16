<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TweetType extends GraphQLType {

    protected $attributes = [
        'name' => 'Tweet',
        'description' => 'A Tweet'
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
                'description' => 'The id of the tweet'
            ],
            'body' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Body of of a tweet'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user of reply'
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
            'replies' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'id of the reply',
                    ],
                    'first' => [
                        'type' => Type::int(),
                        'description' => 'limit result',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('Reply')),
                'description' => 'reply description',
            ],
            'likes' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'id of the like',
                    ],
                    'first' => [
                        'type' => Type::int(),
                        'description' => 'limit result',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('Like')),
                'description' => 'A Like type',
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at->diffForHumans();
    }

    // You can also resolve any nested resource filed in same way
    protected function resolveRepliesField($root, $args)
    {
        $replies = $root->replies();

        if (isset($args['id'])) {
            $replies =  $replies->where('id', $args['id']);
        }

        // check for limit
        if( isset($args['first']) ) {
            $replies =  $replies->limit($args['first'])->latest();
        }

        return $replies->get();
    }

    protected function resolveLikesField($root, $args)
    {
        $likes = $root->likes();

        if (isset($args['id'])) {
            $likes =  $likes->where('id', $args['id']);
        }

        // check for limit
        if( isset($args['first']) ) {
            $likes =  $likes->limit($args['first'])->latest();
        }

        return $likes->get();
    }

}