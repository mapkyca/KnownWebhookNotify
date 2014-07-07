<?php

    /**
     * Plugin user settings
     */

    namespace IdnoPlugins\WebhookNotify\Pages {

        /**
         * Default class to serve the homepage
         */
        class Account extends \Idno\Common\Page
        {

            function getContent()
            {
                $this->adminGatekeeper(); // Admins only
                $t = \Idno\Core\site()->template();
                $body = $t->draw('account/notifywebhook');
                $t->__(['title' => 'Notify via Webhook', 'body' => $body])->drawPage();
            }

            function postContent() {
                $this->gatekeeper(); 
		
		$user = \Idno\Core\site()->session()->currentUser();
              
		
		$webhook_notify_url = $this->getInput('webhook_notify_url');
		
                $user->webhook_notify_url = $webhook_notify_url;
		
                $user->save();
		
                \Idno\Core\site()->session()->addMessage('Your Webhook details were saved.');
                $this->forward('/account/notifywebhook/');
            }

        }

    }