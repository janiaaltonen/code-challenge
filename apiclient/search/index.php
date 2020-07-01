<?php

    $content = "<div>
    <div>
        <h2> Search for movie </h2>
        <form method=\"get\" id=\"Fform\" action=\"results.php\">
            <label> Title
                <input type=\"text\" name=\"t\" required>
            </label>
            <label> Year
                <input type=\"number\" name=\"y\">
            </label>
            <label> Plot
                <select name=plot>
                    <option value=\"short\"> Short </option>
                    <option value=\"full\"> Full </option>
                </select>
            </label>
            <button type=\"submit\" name=\"submit\" value=\"movie\"> Search </button>
        </form>
    </div>
    <div>
        <h2> Search for book </h2>
        <form method=\"get\" action=\"results.php\">
            <label> ISBN Number
                <input type=\"text\" name=\"bibkeys\" required>
            </label>
            <button type=\"submit\" name=\"submit\" value=\"book\"> Search </button>
        </form>
    </div>
</div>";

    include('../base.php');
