<div class="form-container">
    <div class="form-container__headline-container">
        <h2 class="form-container__headline">Ny Kategori</h2>
    </div>
    <form method="POST" enctype="multipart/form-data" class="form-container__form">
        <label class="form-container__label" for="name">Titel</label>
        <input type="text" class="form-container__title" name="name">
        <label class="form-container__label" for="image">Ladda upp bild</label>
        <input type="file" name="image" accept="image/" class="form-container__img-file">
        <div class="form-container__submit-container">
            <input type="submit" class="form-container__submit" value="SKICKA" name="addCat">
            <input type="hidden" name="ID" id="cat-id">
        </div>
    </form>
</div>

</section>

