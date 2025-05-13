<div class="container">
  <div class="outer-wrapper">
    <div class="card-wrapper">
      <div class="flip-container">
        <div class="flipper">
          <?php if ($sales->avatar): ?>
            <img class="img-preview d-block mb-3 mx-auto"
                 data-barcode="<?= $sales->barcode ?>"
                 src="<?= BASE_URL . 'assets/img/avatars/' . $sales->avatar ?>" />
          <?php else: ?>
            <img class="img-preview d-block mx-auto"
                 data-barcode="<?= $sales->barcode ?>"
                 src="<?= BASE_URL ?>assets/img/avatars/anonim.jpg" />
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="sales-name"><?= $sales->namasales ?></div>

    <div class="company-info mt-3">
      <div class="row g-2 align-items-start">
        <div class="col text-center">
          <p class="mb-2 fw-bold"><img src="<?= BASE_URL . 'assets/img/logo-no-text.png'?>" alt="logo" class="img-fluid"></p>
          <p class="mb-1">Alamat: Perum GSM Kaja, Jln. Cempaka Kaja No 99, Gianyar</p>
          <p class="mb-0">Telp: 085648247182, 0361-4794548</p>
        </div>
      </div>
    </div>

  </div>
</div>