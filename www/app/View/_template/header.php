<!DOCTYPE html>
<html>
    <head>
        <title><?= $this->escapeHTML($this->title . " - " . APP_NAME); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="" rel="shortcut icon">
        <link href="<?= $this->makeURL("bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= $this->makeURL("bower_components/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <?= $this->getCSS(); ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="navbar" class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= $this->makeURL(); ?>"><?= $this->escapeHTML(APP_NAME); ?></a>
                    </div>
                    <div id="main-navbar" class="collapse navbar-collapse"></div>
                    <!-- /#main-navbar -->
                </div>
            </div>
            <!-- /#navbar -->
            <div id="container">
                <div id="header"></div>
                <!-- /#header -->
                <div id="content">
