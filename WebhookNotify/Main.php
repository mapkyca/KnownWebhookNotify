<?php

    namespace IdnoPlugins\WebhookNotify {
	
        class Main extends \Idno\Common\Plugin {
		
			
            function registerPages() {

		// Register admin settings
                \Idno\Core\site()->addPageHandler('admin/notifywebhook', '\IdnoPlugins\WebhookNotify\Pages\Admin');
                \Idno\Core\site()->template()->extendTemplate('admin/menu/items', 'admin/webhooknotify/menu');
		
		// Register an account menu
		\Idno\Core\site()->addPageHandler('account/notifywebhook', '\IdnoPlugins\WebhookNotify\Pages\Account');
                \Idno\Core\site()->template()->extendTemplate('account/menu/items','account/webhooknotify/menu');
		
		// Add notify method
		\Idno\Core\site()->addEventHook('notify', function (\Idno\Core\Event $event) {

                    $user = $event->data()['user'];

                    if ($user instanceof \Idno\Entities\User && $context = $event->data()['context']) {

			$vars = $event->data()['vars'];
			if (empty($vars)) {
			    $vars = [];
			}
			$vars['object'] = $event->data()['object'];

			$urls = [];
			if ($user->webhook_notify_url)
			    $urls[] = $user->webhook_notify_url;
			if (\Idno\Core\site()->config->config['webhook_notify_url'])
			    $urls[] = \Idno\Core\site()->config->config['webhook_notify_url'];

			if (count($urls)) {

			    $hook = [
				'user' => $user->getUUID(),
				'object' => $event->data()['object'],
				'context' => $event->data()['context'],
				'message' => $event->data()['message'],

				'vars' => $event->data()['vars'],
			    ];

			    // Send hook
			    foreach ($urls as $url)
				\Idno\Core\Webservice::post ($url, ['content' => json_encode($hook)]);
			}

		    }


                });
            }
        }
    }

