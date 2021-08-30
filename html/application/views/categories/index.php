<h2><?= $title; ?></h2>
<ul class="list-group">
    <?php foreach ($categories as $category) : ?>
        <li class="list-group-item">
            <a href="<?php echo site_url('/categories/posts/'.$category['id']) ?>"><?php echo $category['name'] ?></a>
            <?php if ($category['user_id'] == $this->session->userdata('user_id')) :?>
                <form action="categories/delete/<?php echo $category['id']; ?>" method="POST" class="category-delete">
                    <input type="submit" class="btn-link text-danger" value="[X]">
                </form>
            <?php endif; ?>
        </li>
    <?php  endforeach; ?>
</ul>