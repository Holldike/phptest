<label id="area">
    <span class="title">Район</span>
    <?php if ($this->data['areas']) { ?>
        <select name="area">
            <option value="" selected>Не выбран</option>
            <?php foreach ($this->data['areas'] as $area) { ?>
                <option value="<?= $area['ter_id'] ?>"><?= $area['ter_name'] ?></option>
            <?php } ?>
        </select>
    <?php } else { ?>
        районы не найдены
    <?php } ?>
</label>