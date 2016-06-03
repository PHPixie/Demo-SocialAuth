<?php $this->layout('app:layout');?>

<h3><?=$isNew ? 'Registered new user' : 'Logged in existing user'?></h3>

Your app should do an automatic redirect here back to the frontpage,
to prevent the user from refreshing the callback page.
<br>
<a href="<?=$this->httpPath('app.frontpage')?>">Home</a>
<br>
<br>
The redirect is not added here so you can see the data returned by the API

<pre>
    <?php print_r($socialUser->loginData()); ?>
</pre>
