<?php if (isset($this->data)): ?>
    <div class="container">
        <div class="jumbotron">
            <h1><?= $this->escapeHTML($this->data->name); ?></h1>
        </div>
    </div>
<?php endif; ?>