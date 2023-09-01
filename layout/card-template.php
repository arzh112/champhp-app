<div class="card col-3 px-0 m-2">
    <img class="card-img-top" src="assets/pictures/<?php echo $mushroom->getMainPicture(); ?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?php echo $mushroom->getName(); ?></h5>
        <p><i><?php echo $mushroom->getLatinName(); ?></i></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><?php echo $mushroom->getCategory(); ?></li>
    </ul>
    <div class="card-body">
        <a href="mushrooms-details.php?id=<?php echo $mushroom->getId(); ?>"  class="card-link">Voir plus</a>
    </div>
</div>