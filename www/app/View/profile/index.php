<?php if (isset($this->data)): ?>
    <div class="container">
        <div class="jumbotron">
            <h1><?= $this->escapeHTML($this->data->name); ?></h1>
            <p><a href="<?= $this->escapeHTML($this->makeURL("profile/{$this->data->username}")); ?>">@<?= $this->escapeHTML($this->data->username); ?></a></p>
        </div>
    </div>
<?php endif; ?>