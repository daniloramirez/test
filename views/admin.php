<link rel="stylesheet" href="resources/css/style.css">
<body>
	<div class="container-movie">
		<div class="container-screen">
            
            <?php if(!empty($model->errors)): ?>
                <div class="get-errors"><?= $model->errors ?></div>
            <?php endif; ?>

            <form action="<?php echo $helper->url("movie","update"); ?>" method="post" class="col-lg-5">
                <div class="right">
                    <button class="btn btn-primary btn-large btn-block" type="submit">Update Movie List</button>
                </div>
            </form>

            <br><br><br><br>

            <form action="<?php echo $helper->url("movie","admin"); ?>" method="post" class="col-lg-5">
                
                <table class="form-movies">
                    <tr>
                        <td>Search by title</td>
                        <td row="2">Date Range</td>
                        <td>Sort by</td>
                    </tr>
                    <tr>
                        <td><input type="text" value="<?php echo $model->title ?>" placeholder="Search" id="title" name="title"></td>
                        <td row="2">
                            <input type="text" value="<?php echo $model->initDate ?>" placeholder="YYYY" id="initDate" name="initDate">
                            <input type="text" value="<?php echo $model->endDate ?>" placeholder="YYYY" id="endDate" name="endDate">
                        </td>
                        <td>
                            <div class="custom-select">
                                <select id="sort" name="sort">
                                    <option value=""  <?= (empty($model->sort))? "selected" : ""; ?> >asc</option>
                                    <option value="1" <?= ($model->sort == "1")? "selected" : ""; ?> >title</option>
                                    <option value="2" <?= ($model->sort == "2")? "selected" : ""; ?> >date</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="left"><button class="btn btn-primary btn-large btn-block submit-movies" type="submit">Submit</button></div></td><td row="2"></td><td></td>
                    </tr>
                </table>

                
            </form>



            <div class="control-group">
                <table class="movies">
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Poster</th>
                    </tr>
                    <?php if($model->search): ?>
                        
                        <?php foreach ($model->search as $movie): ?>

                            <tr>
                                <td> <?= $movie->Title ?> </td>
                                <td> <?= $movie->Year ?> </td>
                                <td> <?= $movie->Type ?> </td>
                                <td> <a href="<?= $movie->Poster ?>" target="_blank"><?= $movie->Poster ?></a></td>
                            </tr>
                            
                        <?php  endforeach; ?>

                    <?php endif; ?>
                </table>
            </div>
        </div>
	</div>
</body>
<script src="resources/js/main.js"></script>