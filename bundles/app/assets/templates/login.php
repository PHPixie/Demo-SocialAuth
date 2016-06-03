<?php $this->layout('app:layout');?>

Click link to login:

<ul>
    <?php foreach(array('facebook', 'twitter', 'google', 'vk') as $provider): ?>
        <li>
            <a href="<?=$this->httpPath('app.loginRedirect', array('socialProvider' => $provider))?>"><?=$_($provider)?></a>
        </li>
    <?php endforeach;?>
</ul>
