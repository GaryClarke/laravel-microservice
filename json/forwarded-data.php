<?php

$arr = [
    'event' => 'subscription_started', // from DB lookup using notification_type and trial info
    'properties' => [
        'subscription_id' => 'premium_monthly',
        'platform' => 'Google Android', // Determined from webhook structure
        'auto_renew_status' => true, // data.developer_notification.auto_renewing
        'currency' => 'USD', // data.developer_notification.price_currency_code
        'in_trial' => false, // data.subscription_notification.in_trial
        'product_name' => 'premium_monthly', // data.developer_notification.product_id
        'renewal_date' => '2021-07-17T00:00:00+00:00',
        'start_date' => '2021-06-17T00:00:00+00:00',
    ],
    'user' => [
        'id' => 'USER-001', // data.developer_notification.user_account_id
        'email' => 'joe@example.com', // data.developer_notification.email
        'region' => 'US', // data.developer_notification.region_code
    ]
];

