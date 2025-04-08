<?php
# controller/publicController.php

# chargement des dépendances
include_once "../model/FakeModel.php";

# récupération des données depuis un modèle
$model = fakeValue();

# Appel de la vue
include_once "../view/homepage.view.php";