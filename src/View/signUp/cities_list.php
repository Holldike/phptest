<label id="city">
    <span class="title">Город</span>
    <?php if ($this->data['cities']) { ?>
        <select name="city">
            <option value="" selected>Не выбран</option>
            <?php foreach ($this->data['cities'] as $city) { ?>
                <option value="<?= $city['ter_id'] ?>"><?= $city['ter_name'] ?></option>
            <?php } ?>
        </select>
    <?php } else { ?>
        города не найдены
    <?php } ?>
</label>