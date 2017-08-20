<?php

namespace App\GraphQL\Mutation\Tweet;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class LikeTweetMutation extends Mutation {

    protected $attributes = [
        'name' => 'likeTweet'
    ];

    public function type()
    {
        return GraphQL::type('Like');
    }

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:tweets'
        ];
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args)
    {
        // If already liked unlike it
        $myLikes = auth()->user()->likes();

        if( $like = $myLikes->where('tweet_id', $args['id'])->get() ) {
            $like->delete();
            return $like;
        }

        return $myLikes->create(['tweet_id' => $args['id']]);
    }
}