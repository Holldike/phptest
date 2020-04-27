<!DOCTYPE html>
<html>
<head>
    <title><?= $this->title ?></title>
    <link rel="stylesheet" type="text/css" href="/assets/css/common.css">

    <?php if ($this->assets['css']) { ?>
        <?php foreach ($this->assets['css'] as $style) { ?>
            <link rel="stylesheet" type="text/css" href="<?= $style ?>">
        <?php } ?>
    <?php } ?>
</head>

<body>
    <header></header>
    <div id="content">
        <?php require $this->content ?>
    </div>
    <footer></footer>

    <script type="text/javascript" src="/assets/js/jquery-3.5.0.min.js"></script>
    <?php if ($this->assets['js']) { ?>
        <?php foreach ($this->assets['js'] as $js) { ?>
            <script type="text/javascript" src="<?= $js ?>"></script>
        <?php } ?>
    <?php } ?>
</body>
</html>