<?php

return array(
    'domains' => array(
        'default' => array(

            // using the 'user' repository from the 'app' bundle
            'repository' => 'app.user',
            'providers'  => array(

                'session' => array(
                    'type' => 'http.session'
                ),
                // password login support
                'social' => array(
                    'type' => 'social.oauth',
                    'persistProviders' => array('session')
                )
            )
        )
    )
);
