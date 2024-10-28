<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextController extends Controller
{
    public function getText()
    {
        $jsonData = [
            "users" => [
                [
                    "id" => 1,
                    "name" => "John Doe",
                    "email" => "john.doe@example.com",
                    "age" => 28,
                    "address" => [
                        "street" => "123 Main St",
                        "city" => "New York",
                        "state" => "NY",
                        "zip" => "10001"
                    ]
                ],
                [
                    "id" => 2,
                    "name" => "Jane Smith",
                    "email" => "jane.smith@example.com",
                    "age" => 34,
                    "address" => [
                        "street" => "456 Oak Ave",
                        "city" => "Los Angeles",
                        "state" => "CA",
                        "zip" => "90001"
                    ]
                ],
                [
                    "id" => 3,
                    "name" => "Alice Johnson",
                    "email" => "alice.johnson@example.com",
                    "age" => 22,
                    "address" => [
                        "street" => "789 Pine Rd",
                        "city" => "Chicago",
                        "state" => "IL",
                        "zip" => "60601"
                    ]
                ]
            ]
        ];

        return view('text', [
            'getData' => $jsonData['users']
        ]);

    }
}
