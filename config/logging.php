<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'billing_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/billing_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'churn_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/churn_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'digital_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/digital_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthbilling_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthbilling_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthchurn_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthchurn_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthdigital_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthdigital_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthescalation_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthescalation_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthinbound_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthinbound_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthlivecall_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthlivecall_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthoutbound_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthoutbound_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthservicesupport_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthservicesupport_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthshops_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthshops_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'dthwelcome_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/dthwelcome_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'escalation_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/escalation_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],

        'inbound_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/inbound_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'livecall_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/livecall_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'outbound_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/outbound_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'servicesupport_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/servicesupport_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'shops_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/shops_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'welcome_category' => [
            'driver' => 'daily',
            'path' => storage_path('logs/welcome_category.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'summarystergth' => [
            'driver' => 'daily',
            'path' => storage_path('logs/summarystergth.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'summarygap' => [
            'driver' => 'daily',
            'path' => storage_path('logs/summarygap.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'summaryvoc' => [
            'driver' => 'daily',
            'path' => storage_path('logs/summaryvoc.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'fiberlivecalls' => [
            'driver' => 'daily',
            'path' => storage_path('logs/fiberlivecalls.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'agentalertfrom' => [
            'driver' => 'daily',
            'path' => storage_path('logs/agentalertfrom.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'callcategory' => [
            'driver' => 'daily',
            'path' => storage_path('logs/callcategory.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'subcallcategory' => [
            'driver' => 'daily',
            'path' => storage_path('logs/subcallcategory.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'course' => [
            'driver' => 'daily',
            'path' => storage_path('logs/course.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'parameterquestions' => [
            'driver' => 'daily',
            'path' => storage_path('logs/parameterquestions.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'schedule' => [
            'driver' => 'daily',
            'path' => storage_path('logs/schedule.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'examstatus' => [
            'driver' => 'daily',
            'path' => storage_path('logs/examstatus.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'updateparameter' => [
            'driver' => 'daily',
            'path' => storage_path('logs/updateparameter.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'callrecord' => [
            'driver' => 'daily',
            'path' => storage_path('logs/callrecord.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'issuegeneral' => [
            'driver' => 'daily',
            'path' => storage_path('logs/issuegeneral.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'subissuegeneral' => [
            'driver' => 'daily',
            'path' => storage_path('logs/subissuegeneral.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'strengthSummaryaudit' => [
            'driver' => 'daily',
            'path' => storage_path('logs/strengthSummaryaudit.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'gapSummaryaudit' => [
            'driver' => 'daily',
            'path' => storage_path('logs/gapSummaryaudit.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'brief' => [
            'driver' => 'daily',
            'path' => storage_path('logs/brief.log'),
            'level' => 'debug',
            'days' => 30,
        ],
        'reactivateexam' => [
            'driver' => 'daily',
            'path' => storage_path('logs/reactivateexam.log'),
            'level' => 'debug',
            'days' => 30,
        ],'newexamstatus' => [
            'driver' => 'daily',
            'path' => storage_path('logs/newexamstatus.log'),
            'level' => 'debug',
            'days' => 30,
        ],'coachingform' => [
            'driver' => 'daily',
            'path' => storage_path('logs/coachingform.log'),
            'level' => 'debug',
            'days' => 30,
        ],'supervisorSignAlertForm' => [
            'driver' => 'daily',
            'path' => storage_path('logs/supervisorSignAlertForm.log'),
            'level' => 'debug',
            'days' => 30,
        ],'agentSignAlertForm' => [
            'driver' => 'daily',
            'path' => storage_path('logs/agentSignAlertForm.log'),
            'level' => 'debug',
            'days' => 30,
        ],'agentSignAlertForm' => [
            'driver' => 'daily',
            'path' => storage_path('logs/agentSignAlertForm.log'),
            'level' => 'debug',
            'days' => 30,
        ],'supervisorsignCoachingForm' => [
            'driver' => 'daily',
            'path' => storage_path('logs/supervisorsignCoachingForm.log'),
            'level' => 'debug',
            'days' => 30,
        ],'agentsignCoachingForm' => [
            'driver' => 'daily',
            'path' => storage_path('logs/agentsignCoachingForm.log'),
            'level' => 'debug',
            'days' => 30,
        ],'EditDepartment' => [
            'driver' => 'daily',
            'path' => storage_path('logs/EditDepartment.log'),
            'level' => 'debug',
            'days' => 30,
        ],







    ],

];
