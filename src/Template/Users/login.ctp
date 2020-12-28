<h3>Welcome to Bafana Dashboard</h3>
<p>Login in.</p>
<?php echo $this->Form->create() ?>
<form class="m-t">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required="">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
</form>
<p class="m-t"> <small>&copy; <?php echo '2015 - '.date('Y'); ?> Copyright Bafana</small> </p>