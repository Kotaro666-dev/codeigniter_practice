<h2><?= $title; ?></h2>

<?php echo form_open('users/register'); ?>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <?php echo form_error('name'); ?>
        <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <?php echo form_error('username'); ?>
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <?php echo form_error('email'); ?>
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="mb-3">
        <label class="form-label">Zipcode</label>
        <?php echo form_error('zipcode'); ?>
        <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <?php echo form_error('password'); ?>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <?php echo form_error('name'); ?>
        <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>