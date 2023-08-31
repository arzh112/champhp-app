<div class="card col-3 px-0">
    <img class="card-img-top" src=<?php echo $mushroom->getMainPicture(); ?> alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?php echo $mushroom->getName(); ?></h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item" style=""><i><?php echo $mushroom->getLatinName(); ?></i></li>
        <li class="list-group-item"><?php echo $mushroom->getGenus(); ?></li>
    </ul>
    <div class="card-body">
        <a href="#" class="card-link">Voir plus</a>
    </div>
</div>