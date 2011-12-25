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
            <input type="submit" value="Search" name="submit">
        </form>
        <form action="/assets/scripts/php/search.php" method="POST">
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
            <fieldset>
                <legend>Search by rating </legend>
                <select name="rating" id="rating">
                    <option value="select">Select an option</option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </fieldset>
            <fieldset>
                <legend>Search by release date </legend>
            </fieldset>
            <input type="submit" value="Search" name="submit" class="submit">
        </form>
    </div>
</body>
</html>
