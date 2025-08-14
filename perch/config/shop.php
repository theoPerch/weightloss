<?php
	return [

		/*
		|--------------------------------------------------------------------------
		| Gateway settings
		|--------------------------------------------------------------------------
		*/

		'gateways' => [

			'default' => [
				'enabled'   => true,
				'test_mode' => false,
				'live' => [
					'api_key'      => 'abc123',
				],
				'test' => [
					'api_key'      => 'abc123',
				],
			],

 'paypal' => [
                                        'enabled'   => true,
                                        'test_mode' => true,
                                        'live' => [
                                          'client_id'  => 'paypal_api_username',
                                          'client_secret'  => 'paypal_api_password',

                                        ],
                                        'test' => [
                                          'client_id'  => 'AVO1z6xmHDNyVNq3ZXH021xIU7bY2z7vfvxRa-7UPztuvrw0_fuz6VM42f6krObj1Maz3VvORET3-17s',
                                          'client_secret'  => 'EPcQEIxcCiwLYQ1tb0NBwql7zqhxYbz_SUkMNSGQ_ofWz1tWpuuc7Pv8uqXevM_MPSmpfHrCaBfUh2ZA',

                                        ],
                                      ],
      	'revolut' => [
      				'enabled'   => true,
                  'test_mode' => true,
                      'live' => [
                        'secret_key'      => '',
                        'publishable_key' => '',
                      ],
                      'test' => [
                        'secret_key'      => 'sk_CBCSpPdEc4JUsKisaYSzcD7JPY7T4yh6sQ5vuotDp233e235LOXGhWD4qvsPAQ-g',
                        'publishable_key' => 'pk_VTdMkPG2aZ0ZkmkOQH5tAXvPKwmZZLKb5F8RlzY6D0iNwkVH',
                      ],
      			],
	'klarna' => [
				'enabled'   => true,
            'test_mode' => true,

                'live' => [
                  'secret_key'      => '',
                  'publishable_key' => '',
    'merchantId' =>  'PK380613',

                ],
                'test' => [
                  'secret_key'      => '2dcf1465-0ca1-424f-aa72-5462cba12480',
                  'publishable_key' => 'klarna_test_api_MkZBN0xHVSNHd0YpL1M5dCpoWG8qa1VaLyN4M3gxTlAsMmRjZjE0NjUtMGNhMS00MjRmLWFhNzItNTQ2MmNiYTEyNDgwLDEsR1NpaDlZRGdGVWs4R2ZZMyt0OGlzKzVwRVpDaTU2TzhGdW0zQnJENEF1RT0',
    'merchantId' =>  'PK380613',
                ],
			],
	'stripe' => [
				'enabled'   => true,
            'test_mode' => false,
                'live' => [
                  'secret_key'      => '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',
                  'publishable_key' => 'pk_live_51RNsBbE7JoDzRqbhOhRfs8RHcRb39U1tGXl2X57SYngCsG9fFhK7awRp1QvQfzwuKzaddgaRy7Lxj7hISFM4Fs4C00DBFMVFCQ',
                ],
                  /* 'test' => [
                                  'secret_key'      => 'sk_test_51PxVsqRrSaU6VOtMFDuMcB8xjxFWyXGpV5vBpN0xwk9A6lXYzwEadenUuhWjjjeDr6ahag3g1QB8DSLsApSItZJy0019uUFElB',
                                  'publishable_key' => 'pk_test_51PxVsqRrSaU6VOtMMMQ13aJtfX9vJfSCAGNREs0Xv1IrkE0n4Cx5WaKqRvtJHQPQJmFVBBml6yrcYEoiLhyrBh1O00FKFPRXPU',
                                ],*/
                'test' => [
                  'secret_key'      => 'sk_test_51RNsBiCeux1vWiSRwtRv3b4a2YhXSHN6z87DlVCfQYXc0HG2RfiGJPR6adKsQSVE5qYaKC5PPpngco0M34G9HXBv00nlEP6znR',
                  'publishable_key' => 'pk_test_51RNsBiCeux1vWiSRg9dP1KykB31YwDWNIFEnYQTjontB9aAN7nkKucqALaFbieYrF1S7wcF4ZG0UZEzuxBUZXbOz00K3SmQEcR',
                ],
			],

		],

	];
