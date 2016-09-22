<?php
return array(
    // set your paypal credential
    'client_id' => 'ATmf7s9JT5L5wYDjm03smMuyY8zZsJm8ZrJwgjkKk5R6t5qXP0n_rmb6AVhbXrI1EzJYrEGDSgDrYS82',
    'secret' => 'ENrfgHeUbgZZT9q2Jjv4Ix9tbXg2GIdTOn1Sz2DOq1ohuztnlmI6bkuXvP7aZZ_wrzrVJSmD1EBkZZno',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
