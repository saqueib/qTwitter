<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType {

    protected $attributes = [
        'name' => 'Profile',
        'description' => 'A user profile'
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
            'bio' => [
                'type' => Type::string(),
                'description' => 'The bio of user'
            ],
            'designation' => [
                'type' => Type::string(),
                'description' => 'The designation of user'
            ],
            'company' => [
                'type' => Type::string(),
                'description' => 'The company of user'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'The city of user'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'The country of user'
            ],
            'dob' => [
                'type' => Type::string(),
                'description' => 'The date of birth of user'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Creation datetime'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Updating datetime'
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }
}