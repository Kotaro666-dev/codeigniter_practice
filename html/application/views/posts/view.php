<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?>, Last Update: <?php echo $post['updated_at']; ?>, views: <?php echo $post['views']; ?></small><br>
<img class="img-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<div class="post-body">
    <?php echo $post['body']; ?>
</div>


<?php if ($this->session->userdata('user_id') == $post['user_id']) : ?>
    <hr>
    <a class="btn btn-default pull-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
    <?php echo form_open('posts/delete/'.$post['id']); ?>
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
    <hr>
<?php endif; ?>

<h3>Comments</h3>
<?php if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment): ?>
    <div class="well">
        <strong><?php echo $comment['name']; ?></strong>
        <h5><?php echo $comment['body']; ?></h5>
        <h6>commented at <?php echo $comment['created_at']; ?></h6>
    </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>No comments to display</p>
<?php endif; ?>

<hr>
<h3>Add Comment</h3>
<?php echo form_open('comments/create/'.$post['id']); ?>
    <?php if (!$this->session->userdata('logged_in')) : ?>
		<?php echo form_error('name'); ?>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
		<?php echo form_error('email'); ?>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
        </div>
    <?php else : ?>
        <p>Name: <?php echo $this->session->userdata('username') ?></p>
        <p>Email: <?php echo $this->session->userdata('email') ?></p>
    <?php endif; ?>
    <?php echo form_error('body'); ?>
    <div class="form-group">
        <label>Body</label>
        <textarea name="body" class="form-control"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
    <button class="btn btn-primary" type="submit">Submit</button>
</form>



