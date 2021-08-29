<h2><?= $title; ?></h2>

<?php echo form_open_multipart('posts/create'); ?>
    <div class="mb-3">
        <label class="form-label">Title</label>
        <?php echo form_error('title'); ?>
        <input type="text" class="form-control" name="title" placeholder="Add title">
    </div>
    <div class="mb-3">
        <label class="form-label">Body</label>
        <?php echo form_error('body'); ?>
        <textarea id="ckeditor" class="form-control" name="body" placeholder="Add body"></textarea>
    </div>
    <div class-="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="userfile" size="20">
    </div>

    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>