<?php include 'header.html';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php /** * @var \DTO\AllCategoryDTO[] $category */ ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="profile.php">Hangman</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">User: <?= $data->getUsername(); ?></a></li>
                    <li><a href="#">Victory: <?= $victory; ?></a></li>
                    <li><a href="#">Wasted: <?= $waste; ?></a></li>
                    <li class="dropdown">

                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">log out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (!empty($_SESSION['wordLength'])): ?>
        <div class="center">
            <h3>
                <?php  foreach ($_SESSION['answer'] as $value) {
                    if ($value == reset($_SESSION['answer'])) {
                        echo reset($_SESSION['answer']);
                    } elseif ($value == end($_SESSION['answer'])) {
                        echo end($_SESSION['answer']);
                    } elseif (in_array($value, $_SESSION['selected_letter'], TRUE)) {
                        echo $value;
                    } else {
                        echo $value = ' _';
                    }
                } ?>
            </h3>
            <?php if (!empty($_SESSION['answer'])):?>
                <?= $_SESSION['wordDescription'];?>
            <?php endif; ?>
        </div>

        <!--<div class="center"></div>-->
    <?php else: ?>

        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?= 'Choose category!' ?></strong>
        </div>
    <?php endif; ?>
    <div class="alert alert-dismissible alert-success">
        <?php if (!isset($_SESSION['error'])): ?>
            <img src='images/0.gif'/>
        <?php else: ?>
            <img src='images/<?= $_SESSION['error']; ?>.gif'/>
        <?php endif; ?>
        <?php if (isset($_SESSION['successful_letters_int']) && isset($_SESSION['wordLength'])): ?>
            <?php if (($_SESSION['successful_letters_int']) == $_SESSION['wordLength']): ?>
                <div class="center">
                    <strong>CONGRATULATIONS YOU GUESSED IT!</strong>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error']) && $_SESSION['error'] >= $max): ?>
            <div class="center">
                <strong>GAME OVER!</strong>
            </div>
    </div>
    <?php endif; ?>
    <form method="POST" action="./profile.php">
        <label>
            <select name="category">
                    <?php foreach ($category as $value): ?>

                    <option
                    <?php if (isset($_SESSION['category']) && ($_SESSION['category'] == $value->getId())):
                    ?>selected="selected" <?php endif; ?>
                    value="<?= $value->getId(); ?>"><?= $value->getCategory(); ?>
                    </option>
                    <?php endforeach; ?>
            </select>
        </label>
        <br><br>
        <div>Select category</div>
        <input type="submit" value="Select">
        <div class="well bs-component">
            <h4>
                <?php foreach ($alphas as $letter): ?>
                    <a href="profile.php?letter=<?= $_SESSION['select_letter'] = $letter; ?>"><?= $letter; ?></a>
                <?php endforeach; ?>
            </h4>
        </div>
        <?php if (!empty($_SESSION['selected_letter'])):?>
        <div class="well bs-component" >
            <h4>Selected letters!</h4>
            <p><?php foreach ($_SESSION['selected_letter'] as $letter):?>
             <?= $letter ;?>
            <?php endforeach;?></p>
        </div>
        <?php endif; ?>
    </form>
    </body>
</html>
