<?php
namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType {

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'bio' => [
                'type' => Type::string()
            ],
            'designation' => [
                'type' => Type::string()
            ],
            'company' => [
                'type' => Type::string()
            ],
            'city' => [
                'type' => Type::string()
            ],
            'country' => [
                'type' => Type::string()
            ],
            'dob' => [
                'type' => Type::string()
            ],
            'created_at' => [
                'type' => Type::string()
            ],
            'updated_at' => [
                'type' => Type::string(),
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