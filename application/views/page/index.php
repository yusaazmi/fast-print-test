
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">FastPrint | Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item companies">
                </li>
                <li class="nav-item employee">
                </li>
              </ul>
            </div>
          </nav>
        <div class="container-sm">
        <div class="d-flex justify-content-between">
  <div class="p-1">
    <h4>Data Produk</h4>
  </div>
  <div class="p-1">
    <a href="<?= base_url() ?>page/getData" class="btn btn-primary">Sync Data</a>
    <a href="<?= base_url() ?>page/add" class="btn btn-secondary">Tambah Data</a>
  </div>
</div>
  <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nama Produk</th>
          <th scope="col">Harga</th>
          <th scope="col">Kategori</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>    

        <?php 
        if($products != null) :
        foreach ($products as $p) : ?>
        <tr>
          <th scope="row"><?= $p->product_id ?></th>
          <td><?= $p->name ?></td>
          <td>Rp.<?= number_format($p->price) ?></td>
          <td><?= $p->category_name ?></td>
          <td><?= $p->status_name ?></td>
          <td>
              <a href="page/editData/<?= $p->product_id ?>" class="btn btn-success">Edit</a>
              <a class='btn btn-danger' href='page/deleteData/<?=$p->product_id?>' onclick="return confirm('apakah anda yakin ingin menghapus data ?')" aria-expanded='false'> Delete </a>
              <!-- <a href="#" class="btn btn-danger" onclick="confirmDelete('<?= site_url('page/deleteData/' . $product->id); ?>')">Delete</a> -->
          </td>
        </tr>
        <?php endforeach; 
        endif;?>
      </tbody>
  </table>
        </div>
    </div>