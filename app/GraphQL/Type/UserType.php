<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'User',
        'description' => 'A user'
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
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'avatar' => [
                'type' => Type::string(),
                'description' => 'The avatar of user'
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
            'tweets' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'id of the tweet',
                    ],
                    'first' => [
                        'type' => Type::int(),
                        'description' => 'limit result',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('Tweet')),
                'description' => 'tweet description',
            ],
            'profile' => [
                'type' => GraphQL::type('Profile'),
                'description' => 'user profile',
            ],
            'followers' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'id of the follower',
                    ],
                    'first' => [
                        'type' => Type::int(),
                        'description' => 'limit result',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('User')),
                'description' => 'followers User',
            ],
            'following' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'id of the following',
                    ],
                    'first' => [
                        'type' => Type::int(),
                        'description' => 'limit result',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('User')),
                'description' => 'following User',
            ],
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    // You can also resolve any nested resource filed in same way
    protected function resolveTweetsField($root, $args)
    {
        $tweets = $root->tweets();

        if (isset($args['id'])) {
            return  $tweets->where('id', $args['id']);
        }

        // check for limit
        if( isset($args['first']) ) {
            $tweets =  $tweets->limit($args['first'])->latest();
        }

        return $tweets->get();
    }

    protected function resolveProfileField($root, $args) {
        return $root->profile;
    }

    protected function resolveFollowersField($root, $args) {
        $users = $root->followers();

        if (isset($args['id'])) {
            return  $users->where('id', $args['id']);
        }

        // check for limit
        if( isset($args['first']) ) {
            $users =  $users->limit($args['first'])->latest();
        }

        return $users->get();
    }

    protected function resolveFollowingField($root, $args) {
        $users = $root->following();

        if (isset($args['id'])) {
            return  $users->where('id', $args['id']);
        }

        // check for limit
        if( isset($args['first']) ) {
            $users =  $users->limit($args['first'])->latest();
        }

        return $users->get();
    }
}