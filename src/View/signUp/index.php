<div class="wrapper">
    <form method="post">
        <label id="name">
            <span class="title">ФИО</span>
            <input name="name" type="text" placeholder="ФИО" value="<?= $this->data['person']['name']?>">
        </label>
        <label id="email">
            <span class="title">E-mail</span>
            <input name="email" type="text" placeholder="E-mail" value="<?= $this->data['person']['email']?>">
        </label>
        <label id="region">
            <span class="title">Область</span>
            <select name="region">
                <option value="" selected>Не выбран</option>
                <?php foreach ($this->data['regions'] as $region) { ?>
                    <option value="<?= $region['reg_id'] ?>"><?= $region['ter_name'] ?></option>
                <?php } ?>
            </select>
        </label>
    </form>
</div>