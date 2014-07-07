<div class="row">

    <div class="span10 offset1">
        <h1>Webhook</h1>
        <?=$this->draw('account/menu')?>
    </div>

</div>
<div class="row">
    <div class="span10 offset1">
        <form action="/account/notifywebhook/" class="form-horizontal" method="post">
            <div class="control-group">
                <div class="controls">
                    <p>
                        Add a URL that will be pinged whenever a notification (comment received etc) is sent.
			
                    </p>
                </div>
            </div>
	    <div class="control-group">
                <label class="control-label" for="name">Webhook URL</label>
                <div class="controls">
                    <input type="url" id="name" placeholder="WebHook Url" class="span4" name="webhook_notify_url" value="<?= \Idno\Core\site()->session()->currentUser()->webhook_notify_url; ?>" >
                </div>
            </div>
	    
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <?= \Idno\Core\site()->actions()->signForm('/account/notifywebhook/')?>
        </form>
    </div>
</div>
