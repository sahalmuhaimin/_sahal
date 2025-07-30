<style>
.rating {
    direction: rtl;
    unicode-bidi: bidi-override;
    font-size: 2rem;
    display: inline-flex;
}
.rating input[type="radio"] {
    display: none;
}
.rating label {
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}
.rating input[type="radio"]:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #ffc700;
}
</style>
?>
<div class="card">
    <div class="card-header"><h4>Beri Rating Barang</h4></div>
    <div class="card-body">
        <form method="post">
            <?php foreach ($rinci as $r): ?>
                <div class="mb-3">
                    <label><b><?= htmlspecialchars($r->nama_barang ?? 'Barang tidak ditemukan') ?></b></label>
                    <br>
                    <div class="rating">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?= $i ?>_<?= $r->id_barang ?>" name="rating_<?= $r->id_barang ?>" value="<?= $i ?>" required>
                            <label for="star<?= $i ?>_<?= $r->id_barang ?>">&#9733;</label>
                        <?php endfor; ?>
                    </div>
                    <br>
                    <textarea name="review_<?= $r->id_barang ?>" class="form-control" placeholder="Tulis ulasan (opsional)"></textarea>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Kirim Rating</button>
        </form>
    </div>
</div>