<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('posts/create'); ?>
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Add title">
    </div>
    <div class="mb-3">
        <label class="form-label">Body</label>
        <textarea id="ckeditor" class="form-control" name="body" placeholder="Add body"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>