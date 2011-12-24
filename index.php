<!DOCTYPE html>

<html>
<head>
    <title>Aaron's Film Collection</title>
    <link href="/assets/styles/common.css" rel="stylesheet">
</head>

<body>
    <div id="page">
        <h1> Aaron's Film Collection </h1>
        <form action="/assets/scripts/php/search.php" method="POST">
            <fieldset>
                <legend>Search for a film </legend>
                <label for="film-search">Search by title</label>
                <input type="text" name="film-search" id="film-search"> 
            </fieldset>
            <fieldset>
                <legend>Search by genre </legend>
                <label for="genre-search"> Search by genre </label>
                <select name="genre" id="genre-search">
                    <option value="select"> Select an option </option>
                    <option value="action">Action </option>
                    <option value="romance"> Romance </option>
                    <option value="comedy"> Comedy </option>
                    <option value="thriller"> Thriller </option>
                    <option value="horror"> Horror </option>
                    <option value="disney"> Disney </option>
                    <option value="sci-fi"> Sci-Fi </option>
                </select>
            </fieldset>
            <input type="submit" value="Search" name="submit" class="submit">
        </form>
    </div>
</body>
</html>
