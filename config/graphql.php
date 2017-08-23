<?php


return [

    // The prefix for router
    'prefix' => 'graphql',

    // The router to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'router' => 'path/to/query/{graphql_schema?}',
    //
    // or define each router
    //
    // 'router' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    //     'mutation' => 'graphiql'
    // ]
    //
    // you can also disable router by setting router to null
    //
    // 'router' => null,
    //
    'router' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Folklore\GraphQL\GraphQLController@query',
    //     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Folklore\GraphQL\GraphQLController::class.'@query',

    // The name of the input that contain variables when you query the endpoint.
    // Most library use "variables", you can change it here in case you need it.
    // In previous versions, the default used to be "params"
    'variables_input_name' => 'variables',

    // Any middleware for the graphql route group
    'middleware' => ['graphql', 'auth'],

    // Any headers that will be added to the response returned by the default controller
    'headers' => [],

    // Any json encoding options when returning a response from the default controller
    // See http://php.net/manual/function.json-encode.php for list of options
    'json_encoding_options' => 0,

    // Config for GraphiQL (https://github.com/graphql/graphiql).
    // To disable GraphiQL, set this to null.
    'graphiql' => [
        'router' => '/graphiql/{graphql_schema?}',
        'controller' => \Folklore\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql'
    ],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'schema' => 'default',

    // The schemas for query and/or mutation. It expects an array to provide
    // both the 'query' fields and the 'mutation' fields. You can also
    // provide directly an object GraphQL\Schema
    //
    // Example:
    //
    // 'schemas' => [
    //     'default' => new Schema($config)
    // ]
    //
    // or
    //
    // 'schemas' => [
    //     'default' => [
    //         'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //     ]
    // ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                'users' => App\GraphQL\Query\UsersQuery::class,
                'tweets' => App\GraphQL\Query\TweetsQuery::class,
            ],
            'mutation' => [
                'createUser' => App\GraphQL\Mutation\User\CreateUserMutation::class,
                'updateUser' => App\GraphQL\Mutation\User\UpdateUserMutation::class,
                'deleteUser' => App\GraphQL\Mutation\User\DeleteUserMutation::class,

                'followUser' => App\GraphQL\Mutation\User\FollowUserMutation::class,
                'unFollowUser' => App\GraphQL\Mutation\User\UnFollowUserMutation::class,

                'createTweet' => App\GraphQL\Mutation\Tweet\CreateTweetMutation::class,
                'updateTweet' => App\GraphQL\Mutation\Tweet\UpdateTweetMutation::class,
                'deleteTweet' => App\GraphQL\Mutation\Tweet\DeleteTweetMutation::class,

                'likeTweet' => App\GraphQL\Mutation\Tweet\LikeTweetMutation::class,

                'createReply' => App\GraphQL\Mutation\Reply\CreateReplyMutation::class,
                'updateReply' => App\GraphQL\Mutation\Reply\UpdateReplyMutation::class,
                'deleteReply' => App\GraphQL\Mutation\Reply\DeleteReplyMutation::class
            ]
        ]
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    // or whitout specifying a key (it will use the ->name property of your type)
    //
    // 'types' => [
    //     'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'User' => App\GraphQL\Type\UserType::class,
        'Profile' => App\GraphQL\Type\ProfileType::class,
        'Tweet' => App\GraphQL\Type\TweetType::class,
        'Reply' => App\GraphQL\Type\ReplyType::class,
        'Like' => App\GraphQL\Type\LikeType::class
    ],

    // This callable will received every Error objects for each errors GraphQL catch.
    // The method should return an array representing the error.
    //
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    //
    'error_formatter' => [\Folklore\GraphQL\GraphQL::class, 'formatError'],

    // Options to limit the query complexity and depth. See the doc
    // @ https://github.com/webonyx/graphql-php#security
    // for details. Disabled by default.
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ]
];
