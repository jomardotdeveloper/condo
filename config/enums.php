<?php

return [
    'user_types' => [
        1 => 'User',
        2 => 'Admin',
    ],
    'unit_types' => [
        1 => 'Residential', 
        2 => 'Commercial'
    ],
    'unit_status' => [
        1 => 'Occupied By Tenant', 
        2 => 'Occupied By Owner', 
        3 => 'Occupied By SPA', 
        4 => 'Repossessed', 
        5 => 'Re-open', 
        6 => 'EELHI'
    ],
    'application_status' => [
        1 => 'New Application', 
        2 => 'For Payment', 
        3 => 'Lobby Guard',
        4 => 'Done'
    ],
    'payment_status' => [
        1 => 'Pending', 
        2 => 'Paid', 
        3 => 'Rejected'
    ],

    'marital_status' => [
        1 => 'Single',
        2 => 'Married',
        3 => 'Widowed',
    ], 

    'gender' => [
        1 => 'Male',
        2 => 'Female'
    ],

    'leave_status' => [
        1 =>'Pending',
        2=>'Approved',
        3=>'Rejected',
    ],
    'purchase_status' => [
        1 => 'Request For Quotation',
        2 => 'Purchase Order',
        3 => 'Paid',
    ],

    'debit_types' => [
        1 => 'Move In',
        2 => 'Move Out',
        3 => 'Monthly Dues',
    ],

    // 'vehicles' => [
    //     1 => 'Motorcycle',
    //     2 => 'Car',
    //     3 => 'B-Slot',
    //     4 => 'Bike',
    // ],

    // 'occupant_type' => [
    //     1 => 'Non-Member',
    //     2 => 'Owner',
    //     3 => 'Tenant',

    // ],
];
