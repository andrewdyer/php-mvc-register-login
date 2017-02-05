<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <?php if (isset($this->songs)) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">The Official UK Top 10 Singles Chart (05/02/2017)</h3>
                    </div>
                    <ul class="list-group">
                        <?php foreach ($this->songs as $song) : ?>
                            <li class="list-group-item"><?= $this->escapeHTML($song["title"] . " by " . $song["artist"]); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>