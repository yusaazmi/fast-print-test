<div class="card mt-2">
    <div class="card-body">
        <h4 class="card-title">Edit Produk</h4>
        <form method="post" action="<?= base_url() ?>/page/updateData/<?= $product->product_id?>">
            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama Produk</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="name" value="<?= $product->name?>" placeholder="Nama Produk" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="company" class="col-sm-2 text-end control-label col-form-label">Harga</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="nama" name="price" value="<?= $product->price?>" placeholder="Harga" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="category" class="col-sm-2 text-end control-label col-form-label">Kategori</label>
                <div class="col-sm-8">
                    <select name="category_id" id="category" required>
                    <?php foreach ($categories as $c) : 
                        if($c->category_id == $product->category_id) :
                    ?>
                        <option class="form-control" value="<?= $c->category_id ?>" selected><?= $c->category_name ?></option>
                        <?php else : ?>
                        <option class="form-control" value="<?= $c->category_id ?>"><?= $c->category_name ?></option>
                    <?php endif; endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="status" class="col-sm-2 text-end control-label col-form-label">Status</label>
                <div class="col-sm-8">
                    <select name="status_id" id="status" required>
                    <?php foreach ($statuses as $s) : 
                        if($s->status_id == $product->status_id) :
                        ?>
                        <option class="form-control" value="<?= $s->status_id ?>" selected><?= $s->status_name ?></option>
                        <?php else :?>
                        <option class="form-control" value="<?= $s->status_id ?>"><?= $s->status_name ?></option>
                    <?php endif; endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>