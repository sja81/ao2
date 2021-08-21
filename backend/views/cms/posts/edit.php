<?php
use yii\helpers\Url;
use backend\assets\RealAsset;

$this->registerCSSFile('@web/assets/node_modules/summernote/dist/summernote-bs4.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/summernote/dist/summernote-bs4.min.js',['depends'=>RealAsset::className()]);

$this->title = "Editácia stránky #" . $post->id;
?>
<div class="container-fluid">

    <form method="post">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <input type="submit" value="Aktualizovať" class="btn btn-success">
            <a href="<?= Url::to(['cms/posts']) ?>" class="btn btn-danger">Späť</a>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Obsah</div>
                <div class="card-body">

                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Názov:</label>
                            <input type="text" name="" class="form-control" value="<?= $post->post_title ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">SLUG:</label>
                            <input type="text" name="" class="form-control" value="<?= $post->post_slug ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <textarea name="Post[post_content]" class="form-control summernote" style="height: 400px;">
                            <?= $post->post_content ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="row">

                        <?php
                        foreach($post->slices as $slc) {
                        ?>

                            <div class="slice">
                                <div class="slice-head">
                                    Section id #1
                                </div>
                                <div class="slice-body">

                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="form-control-label">Title:</label>
                                            <input type="text" class="form-control" value="<?= $slc->title ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="form-control-label">Title Anim:</label>
                                            <select name="" class="form-control dropdown">

                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Widgety -->
            <div class="card">
                <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Widgety</div>
                <div class="card-body">
                </div>
            </div>
            <!-- Vlastnosti stranky -->
            <?php
            $config = $post->getPostConfig(true);
            ?>
            <?php
            if (isset($config) && is_array($config)) {
                ?>
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Vlastnosti
                        stránky
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Layout:</label>
                                <select name="Post[config][layout]" class="form-control dropdown">

                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Canvas Class:</label>
                                <input type="text" class="form-control" name="Post[config][canvas][class]" value="<?= $config['canvas']['class'] ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Canvas Banner:</label>
                                <input type="file" class="form-control-file">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Bottom Animation:</label>
                                <select name="Post[config][bottom][anim]" class="form-control dropdown">

                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Bottom Animation Speed:</label>
                                <input type="text" class="form-control" name="Post[config][bottom][delay]" value="<?= $config['bottom']['delay'] ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Bottom Image:</label>
                                <input type="file" class="form-control-file">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Bottom Video Type:</label>
                                <select name="Post[config][bottom][video][type]" class="form-control dropdown">
                                    <option value="">Zvoľte typ</option>
                                    <option value="youtube">Youtube</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Bottom Video URL:</label>
                                <input type="text" class="form-control" name="Post[config][bottom][video][url]" value="<?= $config['bottom']['video']['url'] ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Width:</label>
                                <input type="text" class="form-control" name="Post[config][bottom][video][width]" value="<?= $config['bottom']['video']['width'] ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Height:</label>
                                <input type="text" class="form-control" name="Post[config][bottom][video][height]" value="<?= $config['bottom']['video']['height'] ?>">
                            </div>
                        </div>

                    </div>
                </div>
                <?php
            }
            ?>

        </div>

    </div>

    </form>

</div>

<?php
$js = <<<JS
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
JS;

$this->registerJS($js);

$css = <<<CSS
    .slice {
        border: 1px solid #ddd; 
        width: 98%;       
        margin: auto; 
    }
    .slice-head{
        width: 100%;
        border-bottom: 1px solid #ddd;
        background-color: #dadada;
        padding-top: 5px;
        padding-left: 10px;
        padding-bottom: 5px;
        font-weight: 500;
        font-size: 0.83rem;
    }
    .slice-body{
        padding: 20px;
    }
CSS;
$this->registerCSS($css);
