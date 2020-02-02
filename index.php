<?php
include("header.php");
?>

    <div class="parallax-container valign-wrapper">
        <div class="container col s12 valign center-block center">
            <h2 class="zTitle1">Cei mai activi jucători | Most Active Players</h2>
            <h5 class="zTitle2">Minim 12 Ore | Hours</h5>
        </div>
        <div class="parallax">
            <img class="parallax-text" src="img/p_01.jpg">
        </div>
    </div>
    <div class="section">
        <div class="container">
            <form class="col s12" method="POST" id="search">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input id="searchbox" name="search_terms" type="text" class="active zTextStyle" required>
                        <input type="hidden" name="action" value="search">
                        <label for="searchbox">Cuvânt Cheie</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div id="tab"></div>
        </div>
    </div>

<?php
include("footer.php");