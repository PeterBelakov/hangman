<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php /** * @var \DTO\AllCategoryDTO[] $category */ ?>
<h1>Hello, HANGMAN</h1>

<div>
    <?php foreach ($alphas as $letter): ?>
        <a href="profile.php?letter=<?= $_SESSION['select_letter'] = $letter;?>"><?= $letter; ?></a>
    <?php endforeach; ?>
</div>

<img src = 'images/<?php echo $_SESSION['error']; ?>.gif' />
<form method="POST" action="./profile.php">

    <select name="category">
        <?php foreach ($category as $value): ?>
        <div>
            <option
                <?php if (isset($_SESSION['category']) && ($_SESSION['category'] == $value->getId())): ?>selected="selected" <?php endif; ?>
                value="<?= $value->getId(); ?>"><?= $value->getCategory(); ?></option>
            <?php endforeach; ?>
        </div>

    </select>
    <br><br>
    <div>Select category</div>
    <input type="submit" value="Select">
</form>
</body>
</html>