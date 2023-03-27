<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Nowy produkt:</h5>
    <form action="?p=settings" method="post">
      <div class="mb-3">
        <label for="productNameInput" class="form-label">Nazwa produktu</label>
        <input type="text" class="form-control" id="productNameInput" name="productName" placeholder="np. Trusty Tahr">
      </div>
      <div class="mb-3">
        <label for="productAuthorInput" class="form-label">Autor produktu</label>
        <input type="text" class="form-control" id="productAuthorInput" name="productAuthor" placeholder="np. Debian Project Community">
      </div>
      <div class="mb-3">
        <label for="productDescriptionTextArea" class="form-label">Opis produktu</label>
        <textarea class="form-control" id="productDescriptionTextArea" name="productDesc" rows="2" placeholder="np. Dystrybucja systemu GNU/Linux"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Dodaj produkt</button>
    </form>
  </div>
</div>
