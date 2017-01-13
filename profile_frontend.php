<?php include 'header.html'; ?>
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
        <H3>
            <?php foreach ($_SESSION['answer'] as $value) {
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
        </H3>
    </div>
<?php else: ?>

    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?= 'Choose category!' ?></strong>
    </div>
<?php endif; ?>
<div class="alert alert-dismissible alert-success">
    <img src='images/<?= $_SESSION['error']; ?>.gif'/>
</div>
<?php if ($_SESSION['error'] >= $max): ?>
    <div class="center">
        <strong><h2>GAME OVER!</h2></strong>
    </div>
    </div>
<?php endif; ?>
<form method="POST" action="./profile.php">
    <select name="category">
        <?php foreach ($category as $value): ?>
        <div class="center">
            <option
                <?php if (isset($_SESSION['category']) && ($_SESSION['category'] == $value->getId())): ?>selected="selected" <?php endif; ?>
                value="<?= $value->getId(); ?>"><?= $value->getCategory(); ?></option>
            <?php endforeach; ?>
        </div>

    </select>
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
</form>
</body>
</html>
