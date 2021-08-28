<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('posts/update'); ?>
<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>">
</div>

<div class="mb-3">
    <label class="form-label">Body</label>
    <textarea class="form-control" name="body" placeholder="Add body"><?php echo $post['body']; ?></textarea>
</div>
<br>
<button type="submit" class="btn btn-primary">Submit</button>
</form>