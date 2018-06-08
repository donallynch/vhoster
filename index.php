<?php

include"classes/VirtualHoster.php";

/** Instantiate VirtualHoster */
$vh = new VirtualHoster();

/** @var string $projectName Define the new projects name */
$projectName = 'new-project-name';

/** @var string $username Define the github username */
$username = 'donallynch';

/* Output project setup instructions */
$vh->generate($username, $projectName);

