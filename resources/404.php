<style>
    .container {
        display: flex;
        flex-direction: column;
        margin: auto;
        align-items: center;
    }

    h1 {
        font-size: 150px;
        font-weight: 900;
        margin-bottom: 20px;
        color: #dd1010a1;
        user-select: none;
        /* Standard */
    }

    h3 {
        font-size: 30px;
        font-family: Arial, Helvetica, sans-serif;
        margin-bottom: 10px;
        color: #9d9191;
        user-select: none;
        /* Standard */

    }

    p {
        font-size: 18px;
        font-family: Arial, Helvetica, sans-serif;
        margin-bottom: 50px;
        color: #9d9191;
        user-select: none;
        /* Standard */
        text-align: center;

    }

    a {
        padding: 15px 30px;
        background-color: #ff0000a1;
        font-family: Arial, Helvetica, sans-serif;
        color: white;
        font-size: 20px;
        border: 0;
        border-radius: 25px;
        cursor: pointer;
    }

    a:hover {
        color: #a49292;

    }
</style>

<div class="container">
    <h1>Oops!</h1>
    <h3>404 - PAGE NOT FOUND</h3>
    <p>The page you are looking for might be removed or temporarily unavailable</p>
    <a href="<?= RouteHelper::getRoute('') ?>">GOTO HOMEPAGE</a>
</div>