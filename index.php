<?php

include"classes/VirtualHoster.php";

/** Instantiate VirtualHoster */
$vh = new VirtualHoster();

/** @var string $projectName */
$projectName = 'new-project-name';
$username = 'donallynch';

/* Output project setup instructions */
$vh->generate($username, $projectName);

