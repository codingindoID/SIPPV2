<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0"><?= $title ?></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><?= $title ?></li>
                    <?php if ($sub) : ?>
                        <li class="breadcrumb-item active"><?= $sub ?></li>
                    <?php endif ?>
                </ol>
            </div>
        </div>
    </div>
</div>