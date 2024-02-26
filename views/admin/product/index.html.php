<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Role</th>
        <th>Name</th>
        <th>Password</th>
        <th>Identity</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($productss as $product): ?>
            <tr>
                <td>
                    <?= $product->getId() ?>
                </td>
                <td>
                    <?= $product->getTitle() ?>
                </td>
                <td>
                    <?= $product->getPrice() ?>
                </td>
                <td>
                    <?= $product->getCategory->get() ?>
                </td>


                <td>
                    <a href="<?= addLink("product", "update", $product->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= addLink("product", "delete", $product->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?= addLink("product", "show", $product->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-eye"></i>
                    </a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>