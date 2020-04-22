<div class="form-container">
    <button class='btn btn--close' id='close'></button>
    <div class="form-container__headline-container">
        <h2 class="form-container__headline">New category</h2>
    </div>
    <form method="POST" enctype="multipart/form-data" class="form-container__form">
        <label class="form-container__label" for="name">Title</label>
        <input type="text" class="form-container__input" name="name">
        <label class="form-container__label" for="image">Upload image</label>
        <input type="file" name="image" accept="image/" class="form-container__input">
        <div class="form-container__submit-container">
            <input type="submit" class="btn btn--done" name="addCat" value="">
            <input type="hidden" name="ID" id="cat-id">
        </div>
    </form>
</div>

</section>

