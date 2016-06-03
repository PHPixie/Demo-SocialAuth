<?php $this->layout('app:layout');?>

You are now logged in (User ID <?=$user->id()?>)
</br>

<a href="<?=$this->httpPath('app.logout')?>">Logout</a>
