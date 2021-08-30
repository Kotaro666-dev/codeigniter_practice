<?php echo form_open('users/register'); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center"><?= $title; ?></h2>
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
            <br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
<?php echo form_close(); ?>