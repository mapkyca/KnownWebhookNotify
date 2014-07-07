<?php

    /**
     * Plugin administration
     */

    namespace IdnoPlugins\Bitly\Pages {

        /**
         * Default class to serve the homepage
         */
        class Admin extends \Idno\Common\Page
        {

            function getContent()
            {
                $this->adminGatekeeper(); // Admins only
                $t = \Idno\Core\site()->template();
                $body = $t->draw('admin/notifywebhook');
                $t->__(['title' => 'Notify via Webhook', 'body' => $body])->drawPage();
            }

            function postContent() {
                $this->adminGatekeeper(); // Admins only
              
		
		$webhook_notify_url = $this->getInput('webhook_notify_url');
		
                \Idno\Core\site()->config->config['webhook_notify_url'] = $webhook_notify_url;
		
                \Idno\Core\site()->config()->save();
                \Idno\Core\site()->session()->addMessage('Your Webhook details were saved.');
                $this->forward('/admin/notifywebhook/');
            }

        }

    }